<?php

namespace LazyCode404\laravelwebinstaller\controllers;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use LazyCode404\laravelwebinstaller\models\Configuration;

class SetupController extends Controller
{
    protected array $dbConfig;

    public function __construct()
    {
        set_time_limit(8000000);
    }
    public function index()
    {
        return view('vendor.installer.welcome');
    }

    public function requirements()
    {
        [$checks, $success] = $this->checkMinimumRequirements();
        return view('vendor.installer.requirements', compact('checks', 'success'));
    }

    public function database()
    {
        return view('vendor.installer.database');
    }

    public function checkMinimumRequirements()
    {
        $checks = [
            'php_version' => PHP_VERSION_ID >= 70400,
            'extension_bcmath' => extension_loaded('bcmath'),
            'extension_ctype' => extension_loaded('ctype'),
            'extension_json' => extension_loaded('json'),
            'extension_mbstring' => extension_loaded('mbstring'),
            'extension_openssl' => extension_loaded('openssl'),
            'extension_pdo_mysql' => extension_loaded('pdo_mysql'),
            'extension_tokenizer' => extension_loaded('tokenizer'),
            'extension_xml' => extension_loaded('xml'),
            'env_writable' => File::isWritable(base_path('.env')),
            'storage_writable' => File::isWritable(storage_path()) && File::isWritable(storage_path('logs')),
        ];
        $success = (!in_array(false, $checks, true));
        return [$checks, $success];
    }
    public function databaseSubmit(Request $request)
    {
        try {
            $request->validate([
                'host' => 'required|ip',
                'port' => 'required|integer',
                'database' => 'required',
                'user' => 'required',
            ]);
            $this->createDatabaseConnection($request->all());
            $migration = $this->runDatabaseMigration();
            if ($migration !== true) {
                return redirect()->back()->withInput()->withErrors([$migration]);
            }
            $this->changeEnvDatabaseConfig($request->all());
            return view('vendor.installer.account');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    /**
     * This function is used to create a database connection
     * @param Array of User Submitted Details Of Database
     * @return Response
     */
    public function createDatabaseConnection($details)
    {
        Artisan::call('config:clear');
        $this->dbConfig = config('database.connections.mysql');
        $this->dbConfig['host'] = $details['host'];
        $this->dbConfig['port'] = $details['port'];
        $this->dbConfig['database'] = $details['database'];
        $this->dbConfig['username'] = $details['user'];
        $this->dbConfig['password'] = $details['password'];
        Config::set('database.connections.setup', $this->dbConfig);
    }

    /**
     * This function is used to run the database migration
     */

    public function runDatabaseMigration()
    {
        try {
            Artisan::call('migrate:fresh', [
                '--database' => 'setup',
                '--force' => 'true',
                '--no-interaction' => true,
            ]);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

        /**
     * This function is used to change the Database Config In ENV File
    */

    public function changeEnvDatabaseConfig($config)
    {
        $this->changeEnvValues('DB_HOST', $config['host']);
        $this->changeEnvValues('DB_PORT', $config['port']);
        $this->changeEnvValues('DB_DATABASE', $config['database']);
        $this->changeEnvValues('DB_USERNAME', $config['user']);
        $this->changeEnvValues('DB_PASSWORD', $config['password']);
    }


    /**
     * This function is used to change the ENV Values
     */

    private function changeEnvValues($key, $value)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . env($key),
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }

        /**
     * This function is used to print the setup complete View
     * @return Renderable
     * @method GET /setup/complete/
     */

    public function setupComplete()
    {
        try{
           $setupStage = Configuration::where('config', 'setup_stage')->firstOrFail();
           if($setupStage['value'] != '3'){
               return redirect()->back()->withInput()->withErrors(['errors' => 'Setup Is Incomplete']);
           }
           $setupStage->update(['value' => '4']);
           Configuration::where('config', 'setup_complete')->firstOrFail()->update(['value' => '1']);;
           return view('vendor.installer.complete');
        }catch(Exception $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

}

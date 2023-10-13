<?php

namespace LazyCode404\laravelwebinstaller\controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LazyCode404\laravelwebinstaller\models\Configuration;

class ConfigurationController extends Controller
{
    /**
     * This function is used to return View of Configuration
     * @method GET /setup/configuration/
     * @return Renderable
     */

     public function configuration()
     {
         return view('vendor.installer.config');
     }

     /**
      * This function is used to save the configuration values in the database
      * @param Request
      * @return Renderable
      * @method POST /setup/configuration-submit/
      */

    public function configurationSubmit(Request $request)
    {
        try{
            $configurations = $this->processInputs($request);
            $configurations['setup_stage'] = '3';
            foreach($configurations as $key => $config){
                Configuration::updateOrCreate(
                    [
                      'config' => $key
                    ],
                    [
                      'value' => $config
                    ]
                  );
            }
            return redirect()->route('setup.complete');
        }catch(Exception $e){
            return redirect()->route('setup.config')->withInput()->withErrors([$e->getMessage()]);
        }
    }

    /**
     * This function is used to process the inputs
     * It makes the validation first and saves the images etc. to desired path
     * @param Array
     * @return Array
     */

    public function processInputs($request)
    {
        $validated = $this->validateInput($request);
        //$logo = saveImage($validated['config_app_logo'], 'img');
        //$favicon = saveImage($validated['config_app_favicon_icon'], 'img');
        //$validated['config_app_logo'] = $logo;
        //$validated['config_app_favicon_icon'] = $favicon;
        return $validated;
    }



    /**
     * This function is used to validate the config submitted input values
     * @param Array
     * @return Array
     */

     public function validateInput($request)
     {
         return $request->validate([

         ]);
     }
}

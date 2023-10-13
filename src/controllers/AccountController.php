<?php

namespace LazyCode404\laravelwebinstaller\controllers;

use Hash;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LazyCode404\laravelwebinstaller\models\Configuration;

class AccountController extends Controller
{
    /**
     * This function is used to return View of Account Setup
     * @method GET /setup/account/
     * @return Renderable
     */

    public function account()
    {
        return view('vendor.installer.account');
    }

        /**
     * This function is used to create the user Account
     * @param Request
     * @method POST /setup/account-submit/
     * @return Renderable
     */

    public function accountSubmit(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'profile_pic' => 'required|max:2048|mimes:png,jpg,jpeg,gif',
                'password' => 'required|same:confirm_password',
            ]);
            $profilePic = saveImage($request->profile_pic, 'img/profile');
            User::updateOrCreate([
                'email' => $request->email,
            ],[
                'name' => $request->name,
                'email' => $request->email,
                'profile_pic' => $profilePic,
                'role_id' => 1,
                'password' => Hash::make($request->password),
            ]);
            $stage = Configuration::where('config', 'setup_stage')->firstOrFail()->update(['value' => '2']);
            return redirect()->route('setup.configuration');
        } catch (Exception $e) {
            return redirect()->route('setup.account')->withInput()->withErrors([$e->getMessage()]);
        }
    }
}

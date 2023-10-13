<?php

use LazyCode404\laravelwebinstaller\controllers\SetupController;
use LazyCode404\laravelwebinstaller\controllers\AccountController;
use LazyCode404\laravelwebinstaller\controllers\ConfigurationController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('setup')->middleware(['custom'])->group(function ()  {
    Route::get('start', [SetupController::class, 'index'])->name('setup.index');
    Route::get('requirements', [SetupController::class, 'requirements'])->name('setup.requirements');
    Route::get('database', [SetupController::class, 'database'])->name('setup.database');
    Route::post('database-submit', [SetupController::class, 'databaseSubmit'])->name('setup.database.submit');
    Route::get('account', [AccountController::class, 'account'])->name('setup.account');
    Route::post('account-submit', [AccountController::class, 'accountSubmit'])->name('setup.account.submit');
    Route::get('configuration', [ConfigurationController::class, 'configuration'])->name('setup.configuration');
    Route::post('configuration-submit', [ConfigurationController::class, 'configurationSubmit'])->name('setup.configuration.submit');
    Route::get('complete', [SetupController::class, 'setupComplete'])->name('setup.complete');
});

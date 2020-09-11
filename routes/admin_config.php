<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::group(['prefix' => 'command'], function() {
    //DEV
    Route::get('update_permissions', function () {
        \Illuminate\Support\Facades\Artisan::call('permissions:update');
    });

    Route::get('migrate', function () {
        \Illuminate\Support\Facades\Artisan::call('migrate');

        echo 'migrated';
    });

    Route::get('config-clear', function () {
        \Illuminate\Support\Facades\Artisan::call('config:clear');

        echo 'config:clear';
    });

    Route::get('route-clear', function () {
        \Illuminate\Support\Facades\Artisan::call('route:clear');

        echo 'route:clear';
    });

    Route::get('cache-clear', function () {
        \Illuminate\Support\Facades\Artisan::call('cache:clear');

        echo 'cache:clear';
    });

    Route::get('config-cache', function () {
        \Illuminate\Support\Facades\Artisan::call('config:cache');

        echo 'config:cache';
    });

    Route::get('dump-autoload', function()
    {
        shell_exec('composer dump-autoload');
        echo 'composer dump-autoload complete';
    });

    Route::get('storage-link', function() {
        \Illuminate\Support\Facades\Artisan::call('storage:link');

        echo 'public/storage has been linked';
    });

    Route::get('update', function()
    {
        $out = shell_exec('composer update');
        echo $out;
    });

    Route::get('install', function()
    {
        $out = shell_exec('composer install');
        echo $out;
    });

    Route::get('npm-run-dev', function()
    {
        shell_exec('sudo /usr/bin/npm run dev');
        echo 'npm run dev updated';
    });

    Route::get('rollback', function () {
        \Illuminate\Support\Facades\Artisan::call('migrate:rollback');

        echo 'migrated';
    });

    Route::get('db-seed', function () {
        if( isset($_GET['class']) ) {
            \Illuminate\Support\Facades\Artisan::call('db:seed --class=' . $_GET['class']);
        } else {
            \Illuminate\Support\Facades\Artisan::call('db:seed');
        }

    });

    Route::get('git-pull', function() {
        // $out = shell_exec('sudo git pull origin develop');
        $out = shell_exec('sudo git pull');
        echo $out;
    });
});


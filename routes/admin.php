<?php

use function App\Helpers\getModules;

Route::prefix('admin')->group(function(){
    
    // Get all the modules
    $modules = getModules();

    foreach ($modules as $module) {
        try {
            $moduleClassPath = "App\Http\Controllers\\" . $module['module'] . "\\" . $module['version'] . '\Module';
            $moduleObj = new $moduleClassPath();
            $version = $moduleObj->getVersionPath(); // using in the module/routes.php
            $filePath = $moduleObj->getFilePath();
            $filePath = str_replace('\\', '/', "..\\" . $filePath . "\\Routes\\routes.php");

            if (file_exists(app_path($filePath))) {
                require_once app_path($filePath);
            }

        } catch (\Exception $e) {
            echo $module['module'] . "\\" . $module['version'] . ": Routes loading error [" . $e->getMessage() . "].";
            exit();
        }
    }
});
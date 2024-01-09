<?php

namespace App\Http\Controllers\Customers\v100;

use App\Base\BaseModule\BaseModuleRegister;

class Module implements BaseModuleRegister
{
    public function getVersion()
    {
        return "1.0.0";
    }

    public function getVersionPath()
    {
        return "v".str_replace(".", "", $this->getVersion());
    }

    public function getModuleName()
    {
        return "Customers Module";
    }

    public function getDescription()
    {
        return "This module will manage all the customers.";
    }

    public function getModuleSlug()
    {
        return "customers";
    }

    public function getClassPath()
    {
        return "App\BO\Customers\\".$this->getVersionPath();
    }

    public function getFilePath()
    {
        return "app\BO\Customers\\".$this->getVersionPath();
    }

    public function getViewsPath()
    {
        return "customers.".$this->getVersionPath();
    }
}
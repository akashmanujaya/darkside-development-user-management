<?php

namespace App\Http\Controllers\Customers\v100;

use App\Base\BaseModule\BaseModuleRegister;

/**
 * Module registration for Customers.
 *
 * This class provides information about the Customers module such as version,
 * paths, name, description, and other metadata. It implements the BaseModuleRegister
 * interface to ensure consistency and adherence to the required module structure.
 *
 * @package App\Http\Controllers\Customers\v100
 */
class Module implements BaseModuleRegister
{
    /**
     * Get the version of the module.
     *
     * @return string The version number of the module.
     */
    public function getVersion()
    {
        return "1.0.0";
    }

    /**
     * Get the version path for the module.
     *
     * This method formats the version number into a path string.
     *
     * @return string The version path for the module.
     */
    public function getVersionPath()
    {
        return "v".str_replace(".", "", $this->getVersion());
    }

    /**
     * Get the name of the module.
     *
     * @return string The name of the module.
     */
    public function getModuleName()
    {
        return "Customers Module";
    }

    /**
     * Get the description of the module.
     *
     * @return string A brief description of what the module does.
     */
    public function getDescription()
    {
        return "This module will manage all the customers.";
    }

     /**
     * Get the slug for the module.
     *
     * @return string The slug used for identifying the module.
     */
    public function getModuleSlug()
    {
        return "customers";
    }

    /**
     * Get the class path for the module.
     *
     * @return string The namespace path where the module's classes are located.
     */
    public function getClassPath()
    {
        return "App\BO\Customers\\".$this->getVersionPath();
    }

     /**
     * Get the file path for the module.
     *
     * @return string The file system path where the module's files are located.
     */
    public function getFilePath()
    {
        return "app\BO\Customers\\".$this->getVersionPath();
    }

    /**
     * Get the views path for the module.
     *
     * @return string The path where the module's views are located.
     */
    public function getViewsPath()
    {
        return "customers.".$this->getVersionPath();
    }
}
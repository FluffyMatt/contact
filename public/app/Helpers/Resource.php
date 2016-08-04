<?php

namespace App\Helpers;

class Resource
{
    // Location of css and js resources
    protected $_cssLocation = '/app/resources/css/';
    protected $_jsLocation = '/app/resources/js/';

    /**
     * Returns string of css files to load
     * @method css
     * @author Matt Stephens <matthewstephens@digidev.co.uk>
     * @param  array $files     array of files to load
     * @param  string $toLoad   string containg tags for html echo
     * @return string $toLoad   string of tags for html
     */
    public function css($files, $toLoad = '')
    {
        foreach ($files as $file) {
            $toLoad .= "<link rel='stylesheet' href='$this->_cssLocation$file' />\n";
        }
        return $toLoad;
    }

    /**
     * Returns string of js files to load
     * @method js
     * @author Matt Stephens <matthewstephens@digidev.co.uk>
     * @param  array $files     array of files to load
     * @param  string $toLoad   string containg tags for html echo
     * @return string $toLoad   string of tags for html
     */
    public function js($files, $toLoad = '')
    {
        foreach ($files as $file) {
            $toLoad .= "<script src='$this->_jsLocation$file'></script>\n";
        }
        return $toLoad;
    }

}

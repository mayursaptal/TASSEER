<?php
class MY_Loader extends CI_Loader
{
    public static $sitePath = '';

    function __construct()
    {
        parent::__construct();
        // i need the codeigniter super-object 
        // in all the functions
        $CI = &get_instance();
        if (self::getSitePath()) {
            $this->add_package_path(self::getSitePath());
        }
    }


    public static function getSitePath()
    {

        if (self::$sitePath) {
            return  self::$sitePath;
        }
        $uri = @$_SERVER['SCRIPT_FILENAME'];
        $path = 'index.php';
        $temp_path = str_replace($path, '', $uri);
        $temp_path = str_replace('/', DIRECTORY_SEPARATOR, $temp_path);
        if (is_dir($temp_path)) {
            return self::$sitePath  =  $temp_path;
        }
        return '';
    }
}

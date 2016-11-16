<?php

class Log {

    private $path;
    static $_instance;

    public function __construct() {
        $this->path = GENERAL_LOG_DIR;
  			if(!file_exists(GENERAL_LOG_DIR)){
  				mkdir(GENERAL_LOG_DIR, 0777);
  			}
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function add_log_general($text, $controller, $function) {
        $file = fopen($this->path, 'a');
        fwrite($file, date('d/m/y h:i:s A') . " | " . $text . " | " . $controller . " | " . $function . "\n");
        fclose($file);
    }

    public function add_log_products($msg, $products = "", $controller, $function) {
        $date = date('d.m.Y h:i:s');
        $log = $msg . " | " . $date . "  |  Product:  " . $products . " | " . $controller . " | " . $function . "\n";
        error_log($log, 3, PRODUCTS_LOG_DIR);
    }

}

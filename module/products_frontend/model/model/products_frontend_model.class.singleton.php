<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/';
define('SITE_ROOT', $path);
define('MODEL_PATH', SITE_ROOT . 'model/');
require(SITE_ROOT . "module/products_frontend/model/BLL/products_frontend_bll.class.singleton.php");

class products_frontend_model {

    private $bll;
    static $_instance;

    private function __construct() {
        $this->bll = products_frontend_bll::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function list_products() {
        return $this->bll->list_products_BLL();
    }

    public function details_products($id) {
        return $this->bll->details_products_BLL($id);
    }

}

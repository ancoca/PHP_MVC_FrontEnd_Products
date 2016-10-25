<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/';
define('SITE_ROOT', $path);
define('MODEL_PATH', SITE_ROOT . 'model/');
require(SITE_ROOT . "module/products/model/BLL/products_bll.class.singleton.php");

class products_model {

    private $bll;
    static $_instance;

    private function __construct() {
        $this->bll = products_bll::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function create_products($arrArgument) {
        return $this->bll->create_products_BLL($arrArgument);
    }

    public function list_products() {
        return $this->bll->list_products_BLL();
    }

    public function details_products($id) {
        return $this->bll->details_products_BLL($id);
    }

    public function obtain_paises($url) {
        return $this->bll->obtain_paises_BLL($url);
    }

    public function obtain_provincias() {
        return $this->bll->obtain_provincias_BLL();
    }

    public function obtain_poblaciones($arrArgument) {
        return $this->bll->obtain_poblaciones_BLL($arrArgument);
    }

}

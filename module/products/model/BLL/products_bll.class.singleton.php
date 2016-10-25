<?php

//$path = $_SERVER['DOCUMENT_ROOT'] . '/';
//define('SITE_ROOT', $path);
//define('MODEL_PATH', SITE_ROOT . 'model/');

require (MODEL_PATH . "Db.class.singleton.php");
require(SITE_ROOT . "module/products/model/DAO/products_dao.class.singleton.php");

class products_bll {

    private $dao;
    private $db;
    static $_instance;

    private function __construct() {
        $this->dao = productsDAO::getInstance();
        $this->db = Db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function create_products_BLL($arrArgument) {
        return $this->dao->create_products_DAO($this->db, $arrArgument);
    }

    public function create_user_BLL($arrArgument) {
        return $this->dao->create_user_DAO($this->db, $arrArgument);
    }

    public function obtain_paises_BLL($url) {
        return $this->dao->obtain_paises_DAO($url);
    }

    public function obtain_provincias_BLL() {
        return $this->dao->obtain_provincias_DAO();
    }

    public function obtain_poblaciones_BLL($arrArgument) {
        return $this->dao->obtain_poblaciones_DAO($arrArgument);
    }
    
}

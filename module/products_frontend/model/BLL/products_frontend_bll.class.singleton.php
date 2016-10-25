<?php

//$path = $_SERVER['DOCUMENT_ROOT'] . '/';
//define('SITE_ROOT', $path);
//define('MODEL_PATH', SITE_ROOT . 'model/');

require (MODEL_PATH . "Db.class.singleton.php");
require(SITE_ROOT . "module/products_frontend/model/DAO/products_frontend_dao.class.singleton.php");

class products_frontend_bll {

    private $dao;
    private $db;
    static $_instance;

    private function __construct() {
        $this->dao = products_frontendDAO::getInstance();
        $this->db = Db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function list_products_BLL() {
        return $this->dao->list_products_DAO($this->db);
    }

    public function details_products_BLL($id) {
        return $this->dao->details_products_DAO($this->db,$id);
    }

}

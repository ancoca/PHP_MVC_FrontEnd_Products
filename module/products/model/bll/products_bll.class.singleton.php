<?php
  //require (MODEL_PATH . "Db.class.singleton.php");
  //require(DAO_PRODUCTS_PATH . "products_dao.class.singleton.php");

  class products_bll {

      private $dao;
      private $db;
      static $_instance;

      private function __construct() {
          $this->dao = products_dao::getInstance();
          $this->db = db::getInstance();
      }

      public static function getInstance() {
          if (!(self::$_instance instanceof self))
              self::$_instance = new self();
          return self::$_instance;
      }

      public function create_products_bll($arrArgument) {
          return $this->dao->create_products_dao($this->db, $arrArgument);
      }

      public function create_user_bll($arrArgument) {
          return $this->dao->create_user_dao($this->db, $arrArgument);
      }

      public function obtain_paises_bll($url) {
          return $this->dao->obtain_paises_dao($url);
      }

      public function obtain_provincias_bll() {
          return $this->dao->obtain_provincias_dao();
      }

      public function obtain_poblaciones_bll($arrArgument) {
          return $this->dao->obtain_poblaciones_dao($arrArgument);
      }

      public function list_products_bll() {
          return $this->dao->list_products_dao($this->db);
      }

      public function details_products_bll($id) {
          return $this->dao->details_products_dao($this->db,$id);
      }

      public function page_products_bll($arrArgument) {
          return $this->dao->page_products_dao($this->db,$arrArgument);
      }

      public function total_products_bll() {
          return $this->dao->total_products_dao($this->db);
      }

      public function select_column_products_bll($arrArgument){
          return $this->dao->select_column_products_dao($this->db,$arrArgument);
      }

      public function select_like_products_bll($arrArgument){
          return $this->dao->select_like_products_dao($this->db,$arrArgument);
      }

      public function count_like_products_bll($arrArgument){
          return $this->dao->count_like_products_dao($this->db,$arrArgument);
      }

      public function select_like_limit_products_bll($arrArgument){
          return $this->dao->select_like_limit_products_dao($this->db,$arrArgument);
      }

  }

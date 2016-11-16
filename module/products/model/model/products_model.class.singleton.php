<?php
  //require(BLL_PRODUCTS_PATH . "products_bll.class.singleton.php");

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
          return $this->bll->create_products_bll($arrArgument);
      }

      public function obtain_paises($url) {
          return $this->bll->obtain_paises_bll($url);
      }

      public function obtain_provincias() {
          return $this->bll->obtain_provincias_bll();
      }

      public function obtain_poblaciones($arrArgument) {
          return $this->bll->obtain_poblaciones_bll($arrArgument);
      }

      public function list_products() {
          return $this->bll->list_products_bll();
      }

      public function details_products($id) {
          return $this->bll->details_products_bll($id);
      }

      public function page_products($arrArgument) {
          return $this->bll->page_products_bll($arrArgument);
      }

      public function total_products() {
          return $this->bll->total_products_bll();
      }

      public function select_column_products($arrArgument){
          return $this->bll->select_column_products_bll($arrArgument);
      }

      public function select_like_products($arrArgument){
          return $this->bll->select_like_products_bll($arrArgument);
      }

      public function count_like_products($arrArgument){
          return $this->bll->count_like_products_bll($arrArgument);
      }

      public function select_like_limit_products($arrArgument){
           return $this->bll->select_like_limit_products_bll($arrArgument);
      }

  }

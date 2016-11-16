<?php
    class controller_main {

        public function __construct() {
            include(UTILS_PATH . 'common.inc.php');
        }

        public function begin() {
          include_once("view/inc/top.php");
          include_once("view/inc/header.php");
          include_once("view/inc/menu.php");

          loadView('module/main/view/', 'main.php');

          include_once("view/inc/contact.php");
          include_once("view/inc/footer.php");
          include_once("view/inc/bottom.php");
        }
    }

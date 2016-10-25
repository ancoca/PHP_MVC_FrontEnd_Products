<?php
  session_start();
	include($_SERVER['DOCUMENT_ROOT'] . "/module/products_frontend/utils/utils_products_frontend.inc.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/utils/upload.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/utils/common.inc.php");

  if ($_GET["idProduct"]) {
      $id = $_GET["idProduct"];
      $path_model = $_SERVER['DOCUMENT_ROOT'] . '/module/products_frontend/model/model/';
      $arrValue = loadModel($path_model, "products_frontend_model", "details_products",$id);

      if ($arrValue[0]) {
          loadView('module/products_frontend/view/', 'details_products.php', $arrValue[0]);
      } else {
          $message = "NOT FOUND PRODUCT";
          loadView('view/inc/', '404.php', $message);
      }
  } else {
      $path_model = $_SERVER['DOCUMENT_ROOT'] . '/module/products_frontend/model/model/';
      $arrValue = loadModel($path_model, "products_frontend_model", "list_products", "");

      if ($arrValue) {
          loadView('module/products_frontend/view/', 'list_products.php', $arrValue);
      } else {
          $message = "NOT PRODUCTS";
          loadView('view/inc/', '404.php', $message);
      }
  }

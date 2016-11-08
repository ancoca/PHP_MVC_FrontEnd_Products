<?php
  session_start();

  $path = $_SERVER['DOCUMENT_ROOT'] . '/';
  define('SITE_ROOT', $path);

	include(SITE_ROOT . "module/products_frontend/utils/utils_products_frontend.inc.php");
	include(SITE_ROOT . "utils/upload.php");
	include(SITE_ROOT . "utils/common.inc.php");
	include(SITE_ROOT . "paths.php");
	include(SITE_ROOT . "classes/Log.class.singleton.php");
	include(SITE_ROOT . "utils/filters.inc.php");
	include(SITE_ROOT . "utils/response_code.inc.php");


  $_SESSION['module'] = "products";

  if ((isset($_GET["autocomplete"])) && ($_GET["autocomplete"] === "true")) {
      set_error_handler('ErrorHandler');
      $model_path = SITE_ROOT . 'module/products_frontend/model/model/';
      try {

          $nameProducts = loadModel($model_path, "products_frontend_model", "select_column_products", "name");
      } catch (Exception $e) {
          showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
      }
      restore_error_handler();

      if ($nameProducts) {
          $jsondata["nom_productos"] = $nameProducts;
          echo json_encode($jsondata);
          exit;
      } else {

          showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
      }
  }

  if (($_GET["nom_product"])) {
      //filtrar $_GET["nom_product"]

      $result = filter_string($_GET["nom_product"]);
      if ($result['resultado']) {
          $criteria = $result['datos'];
      } else {
          $criteria = '';
      }
      $model_path = SITE_ROOT . 'module/products_frontend/model/model/';
      set_error_handler('ErrorHandler');
      try {

          $arrArgument = array(
              "column" => "name",
              "like" => $criteria
          );
          $producto = loadModel($model_path, "products_frontend_model", "select_like_products", $arrArgument);


          //throw new Exception(); //que entre en el catch
      } catch (Exception $e) {
          showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
      }
      restore_error_handler();

      if ($producto) {
          $jsondata["product_autocomplete"] = $producto;
          echo json_encode($jsondata);
          exit;
      } else {
          //if($producto){{ //que lance error si no existe el producto
          showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
      }
  }
  ///////////////////mes parts////////////

  if (($_GET["count_product"])) {
      //filtrar $_GET["count_product"]
      $result = filter_string($_GET["count_product"]);
      if ($result['resultado']) {
          $criteria = $result['datos'];
      } else {
          $criteria = '';
      }
      $model_path = SITE_ROOT . 'module/products_frontend/model/model/';
      set_error_handler('ErrorHandler');
      try {

          $arrArgument = array(
              "column" => "name",
              "like" => $criteria
          );
          $total_rows = loadModel($model_path, "products_frontend_model", "count_like_products", $arrArgument);
          //throw new Exception(); //que entre en el catch
      } catch (Exception $e) {
          showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
      }
      restore_error_handler();

      if ($total_rows) {
          $jsondata["num_products"] = $total_rows[0]["total"];
          echo json_encode($jsondata);
          exit;
      } else {
          //if($total_rows){ //que lance error si no existe el producto
          showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
      }
  }

  //obtain num total pages
  if ((isset($_GET["num_pages"])) && ($_GET["num_pages"] === "true")) {
    //filtrar $_GET["keyword"]
    if (isset($_GET["keyword"])) {
        $result = filter_string($_GET["keyword"]);
        if ($result['resultado']) {
            $criteria = $result['datos'];
        } else {
            $criteria = ' ';
        }
    } else {
        $criteria = ' ';
    }
    $item_per_page = 3;
    $model_path = SITE_ROOT . 'module/products_frontend/model/model/';
    set_error_handler('ErrorHandler');
    try {
        //loadmodel
        if (isset($_GET["keyword"])) {
            $arrArgument = array(
                "column" => "name",
                "like" => $criteria
            );
            $resultado = loadModel($model_path, "products_frontend_model", "count_like_products", $arrArgument);
        } else {
            $resultado = loadModel($model_path, "products_frontend_model", "total_products", "");
        }

        $resultado = $resultado[0]["total"];
        $pages = ceil($resultado / $item_per_page); //break total records into pages
    } catch (Exception $e) {
        showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
    }
    restore_error_handler();

    if ($resultado) {
        $jsondata["pages"] = $pages;
        echo json_encode($jsondata);
        exit;
    } else {
        //if($get_total_rows){ //que lance error si no hay productos
        showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
    }
  }

  if ((isset($_GET["view_error"])) && ($_GET["view_error"] === "true")) {
      /* paint_template_error("ERROR BD");
        die(); */
      showErrorPage(0, "ERROR - 503 BD Unavailable", 503);
  }
  if ((isset($_GET["view_error"])) && ($_GET["view_error"] ==="false")) {
      //showErrorPage(0, "ERROR - 404 NO PRODUCTS");
      showErrorPage(3, "RESULTS NOT FOUND <br> Please, check over if you misspelled any letter of the search word");
  }

  if (isset($_GET["idProduct"])) {
      $arrValue = null;
      //filter if idProduct is a number
      $result = filter_num_int($_GET["idProduct"]);
      if ($result['resultado']) {
          $id = $result['datos'];
      } else {
          $id = 1;
      }

      set_error_handler('ErrorHandler');
      try {
          //throw new Exception();
          $path_model = SITE_ROOT . 'module/products_frontend/model/model/';
          $arrValue = loadModel($path_model, "products_frontend_model", "details_products", $id);
      } catch (Exception $e) {
          showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
      }
      restore_error_handler();

      if ($arrValue) {
          $jsondata["product"] = $arrValue[0];
  	echo json_encode($jsondata);
          exit;
      } else {
          showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
      }
  } else {

      $item_per_page = 3;

      //filter to $_POST["page_num"]
      if (isset($_POST["page_num"])) {
          $result = filter_num_int($_POST["page_num"]);
          if ($result['resultado']) {
              $page_number = $result['datos'];
          }
      } else {
          $page_number = 1;
      }

      if (isset($_GET["keyword"])) {
          $result = filter_string($_GET["keyword"]);
          if ($result['resultado']) {
              $criteria = $result['datos'];
          } else {
              $criteria = '';
          }
      } else {
          $criteria = '';
      }

      if (isset($_POST["keyword"])) {
          $result = filter_string($_POST["keyword"]);
          if ($result['resultado']) {
              $criteria = $result['datos'];
          } else {
              $criteria = '';
          }
      }

      $position = (($page_number - 1) * $item_per_page);
      $model_path = SITE_ROOT . 'module/products_frontend/model/model/';
      $limit = $item_per_page;
      $arrArgument = array(
          "column" => "name",
          "like" => $criteria,
          "position" => $position,
          "limit" => $limit
      );
      set_error_handler('ErrorHandler');
      try {
        
          $arrValue = loadModel($model_path, "products_frontend_model", "select_like_limit_products", $arrArgument);

          } catch (Exception $e) {
          /* paint_template_error("ERROR BD");
            die(); */

          showErrorPage(0, "ERROR - 503 BD Unavailable", 503);
      }
      restore_error_handler();

      if ($arrValue) {

          paint_template_products($arrValue);
      } else {
          //paint_template_error("NO PRODUCTS");

          showErrorPage(0, "ERROR - 404 NO PRODUCTS", 404);

      }
  }

<?php
    class controller_products {

        public function __construct() {
          include(UTILS_PATH . "common.inc.php");
        	include(UTILS_PRODUCTS_PATH . "utils_products.inc.php");
        	include(UTILS_PATH . "upload.php");
          include LOG_DIR;
          include(UTILS_PATH . "filters.inc.php");
          include(UTILS_PATH . "response_code.inc.php");

          $_SESSION['module'] = "products";
        }

        public function form_products() {
          include_once("view/inc/top.php");
          include_once("view/inc/header.php");
          include_once("view/inc/menu.php");

          loadView('module/products/view/', 'create_products.php');

          include_once("view/inc/contact.php");
          include_once("view/inc/footer.php");
          include_once("view/inc/bottom.php");
        }

        public function result_products() {
          include_once("view/inc/top.php");
          include_once("view/inc/header.php");
          include_once("view/inc/menu.php");

          loadView('module/products/view/', 'result_products.php');

          include_once("view/inc/contact.php");
          include_once("view/inc/footer.php");
          include_once("view/inc/bottom.php");
        }

        public function list_products() {
          include_once("view/inc/top.php");
          include_once("view/inc/header.php");
          include_once("view/inc/menu.php");

          loadView('module/products/view/', 'list_products.php');

          include_once("view/inc/contact.php");
          include_once("view/inc/footer.php");
          include_once("view/inc/bottom.php");
        }

        public function create_products(){
          //Si hay datos del formulario en el json enviado por el controlador de javascript
        	if(isset($_POST['create_products'])){
          //Validamos los datos correctamente
          //Si los datos estan correctos, los guardamos y devolvemos un json con el resultado
          //Silos datos no estan correctos, devolvemos el resultado y los errores en un json
        		$jsondata = array();
        		$productsJSON = json_decode($_POST["create_products"], true);

        		$result = validate_products($productsJSON); //Validamos los datos

        		if (empty($_SESSION['result_image'])){ //Comprobamos si hay imagen en el dropzone, sino utilizamos la de por defecto
        			$_SESSION['result_image'] = array('resultado' => true, 'error' =>"", 'datos' => 'media/default-products.png');
        		}

        		$result_image = $_SESSION['result_image'];

        		if ($result['resultado'] && $result_image['resultado']) { //Guardamos los datos si el resultado es positivo
        				$arrArgument = array(
        					'barcode' => $result['datos']['barcode'],
        					'name' => $result['datos']['name'],
        					'image' => $result_image['datos'],
        					'explain' => $result['datos']['explain'],
        					'cost' => $result['datos']['cost'],
        					'stock' => $result['datos']['stock'],
        					'made_in_country' => $result['datos']['made_in_country'],
        					'made_in_province' => $result['datos']['made_in_province'],
        					'made_in_city' => $result['datos']['made_in_city'],
        					'category' => $result['datos']['category'],
        					'promotion_start' => $result['datos']['promotion_start'],
        					'promotion_end' => $result['datos']['promotion_end'],
        				);

                /////////////////insert into BD////////////////////////
                $arrValue = false;
                $arrValue = loadModel(MODEL_PRODUCTS_PATH, "products_model", "create_products", $arrArgument);
                //echo json_encode($arrValue);
                //die();

                if ($arrValue)
                    $mensaje = "Su registro se ha efectuado correctamente, para finalizar compruebe que ha recibido un correo de validacion y siga sus instrucciones";
                else
                    $mensaje = "No se ha podido realizar su alta. Intentelo mas tarde";

        				//redirigir a otra pagina con los datos de $arrArgument y $mensaje
        				$_SESSION['products'] = $arrArgument;
        				$_SESSION['msje'] = $mensaje;
        				$callback="index.php?module=products&function=result_products";

        				$jsondata["success"] = true;
        				$jsondata["redirect"] = $callback;
        				echo json_encode($jsondata);
        				exit;
        		} else {  //Devolvemos los errores si el resultado es negativo
        				//$error = $result['error'];
        				//$error_image = $result_image['error'];
        				$jsondata["success"] = false;
        				$jsondata["error"] = $result['error'];
        				$jsondata["error_image"] = $result_image['error'];

        				$jsondata["success_image"] = false;
        				if ($result_image['resultado']) {
        						$jsondata["success_image"] = true;
        						$jsondata["img_products"] = $result_avatar['datos'];
        				}
        				header('HTTP/1.0 400 Bad error');
        				echo json_encode($jsondata);
        				exit;
        		}
        	}
        }

        public function upload_image_products() {
          //Subir imagen en dropzone.js
        	if(isset($_GET["upload"]) && $_GET["upload"] == true) {
        		$result_image = upload_files();
        		$_SESSION['result_image'] = $result_image;
        	}
        }

        public function delete_image_products() {
          //Eliminar imagen en dropzone.js
        	if (isset($_GET["delete"]) && $_GET["delete"] == true) {
        		$_SESSION['result_image'] = array();
        		$result = remove_files();
        		if ($result === true) {
        			echo json_encode(array("res" => true));
        		} else {
        			echo json_encode(array("res" => false));
        		}
        	}
        }

        //Cerramos sesiones para evitar robo de datos
        function close_session() {
          unset($_SESSION['products']);
          unset($_SESSION['msje']);
          $_SESSION = array();
          session_destroy();
        }

        public function load_result_products() {
          //Recuperamos los datos del formulario antes de cerrar sesion
        	if (isset($_GET["load"]) && $_GET["load"] == true) {
        		$jsondata = array();
        		if (isset($_SESSION['products'])) {
        			$jsondata['products'] = $_SESSION['products'];
        		}
        		if (isset($_SESSION['msje'])) {
        			$jsondata['msje'] = $_SESSION['msje'];
        		}

            unset($_SESSION['products']);
            unset($_SESSION['msje']);
            $_SESSION = array();
            session_destroy();
        		echo json_encode($jsondata);
        		exit;
        	}
        }

        public function load_data_products() {
          //Si hay datos en la sesion los pintamos en el formulario
          //Si no hay datos en la session, pintamos los datos por defecto
        	if (isset($_GET["load_data"]) && $_GET['load_data'] == true) {
        		$jsondata = array();

        		if (isset($_SESSION['products'])){
        			$jsondata['products'] = $_SESSION['products'];
        			echo json_encode($jsondata);
        			exit;
        		} else {
        			$jsondata['products'] = "";
        			echo json_encode($jsondata);
        			exit;
        		}
        	}
        }

        public function load_pais_products() {
        	if(  (isset($_GET["load_pais"])) && ($_GET["load_pais"] == true)  ){
        		$json = array();

            $url = 'http://www.oorsprong.org/websamples.countryinfo/CountryInfoService.wso/ListOfCountryNamesByName/JSON';

            $arrValue = loadModel(MODEL_PRODUCTS_PATH, "products_model", "obtain_paises", $url);

        		if($json){
        			echo $json;
        			exit;
        		}else{
        			$json = "error";
        			echo $json;
        			exit;
        		}
        	}
        }

        public function load_provincias_products() {
        	if(  (isset($_GET["load_provincias"])) && ($_GET["load_provincias"] == true)  ){
        		$jsondata = array();
            $json = array();

            $arrValue = loadModel(MODEL_PRODUCTS_PATH, "products_model", "obtain_provincias");

        		if($json){
        			$jsondata["provincias"] = $json;
        			echo json_encode($jsondata);
        			exit;
        		}else{
        			$jsondata["provincias"] = "error";
        			echo json_encode($jsondata);
        			exit;
        		}
        	}
        }

        public function load_poblacion_products() {
        	if(  isset($_POST['idPoblac']) ){
        	    $jsondata = array();
              $json = array();

              $arrValue = loadModel(MODEL_PRODUCTS_PATH, "products_model", "obtain_poblaciones", $_POST['idPoblac']);

        		if($json){
        			$jsondata["poblaciones"] = $json;
        			echo json_encode($jsondata);
        			exit;
        		}else{
        			$jsondata["poblaciones"] = "error";
        			echo json_encode($jsondata);
        			exit;
        		}
          }
        }

        public function autocomplete_products() {
          if ((isset($_GET["autocomplete"])) && ($_GET["autocomplete"] === "true")) {
              set_error_handler('ErrorHandler');
              try {
                  $nameProducts = loadModel(MODEL_PRODUCTS_PATH, "products_model", "select_column_products", "name");
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
        }

        public function nom_products() {
          if (($_GET["nom_product"])) {
              //filtrar $_GET["nom_product"]

              $result = filter_string($_GET["nom_product"]);
              if ($result['resultado']) {
                  $criteria = $result['datos'];
              } else {
                  $criteria = '';
              }
              set_error_handler('ErrorHandler');
              try {

                  $arrArgument = array(
                      "column" => "name",
                      "like" => $criteria
                  );
                  $producto = loadModel(MODEL_PRODUCTS_PATH, "products_model", "select_like_products", $arrArgument);


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
        }

        public function count_products() {
          if (($_GET["count_product"])) {
              //filtrar $_GET["count_product"]
              $result = filter_string($_GET["count_product"]);
              if ($result['resultado']) {
                  $criteria = $result['datos'];
              } else {
                  $criteria = '';
              }
              set_error_handler('ErrorHandler');
              try {

                  $arrArgument = array(
                      "column" => "name",
                      "like" => $criteria
                  );
                  $total_rows = loadModel(MODEL_PRODUCTS_PATH, "products_model", "count_like_products", $arrArgument);
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
        }

        public function num_pages_products() {
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
            set_error_handler('ErrorHandler');
            try {
                //loadmodel
                if (isset($_GET["keyword"])) {
                    $arrArgument = array(
                        "column" => "name",
                        "like" => $criteria
                    );
                    $resultado = loadModel(MODEL_PRODUCTS_PATH, "products_model", "count_like_products", $arrArgument);
                } else {
                    $resultado = loadModel(MODEL_PRODUCTS_PATH, "products_model", "total_products", "");
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
                showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
            }
          }
        }

        public function view_error_true() {
          if ((isset($_GET["view_error"])) && ($_GET["view_error"] === "true")) {
              /* paint_template_error("ERROR BD");
                die(); */
              showErrorPage(0, "ERROR - 503 BD Unavailable", 503);
          }
        }

        public function view_error_false() {
          if ((isset($_GET["view_error"])) && ($_GET["view_error"] ==="false")) {
              //showErrorPage(0, "ERROR - 404 NO PRODUCTS");
              showErrorPage(3, "RESULTS NOT FOUND <br> Please, check over if you misspelled any letter of the search word");
          }
        }

        public function list_details_products() {
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
                  $arrValue = loadModel(MODEL_PRODUCTS_PATH, "products_model", "details_products", $id);
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
              $limit = $item_per_page;
              $arrArgument = array(
                  "column" => "name",
                  "like" => $criteria,
                  "position" => $position,
                  "limit" => $limit
              );
              set_error_handler('ErrorHandler');
              try {

                  $arrValue = loadModel(MODEL_PRODUCTS_PATH, "products_model", "select_like_limit_products", $arrArgument);

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
        }
      }

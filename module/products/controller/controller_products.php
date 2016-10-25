<?php
  session_start();
	include($_SERVER['DOCUMENT_ROOT'] . "/module/products/utils/utils_products.inc.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/utils/upload.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/utils/common.inc.php");

  if ($_GET["idProduct"]) {
      $id = $_GET["idProduct"];
      $path_model = $_SERVER['DOCUMENT_ROOT'] . '/module/products/model/model/';
      $arrValue = loadModel($path_model, "products_model", "details_products",$id);

      if ($arrValue[0]) {
          loadView('module/products/view/', 'details_products.php', $arrValue[0]);
      } else {
          $message = "NOT FOUND PRODUCT";
          loadView('view/inc/', '404.php', $message);
      }
  } else {
      $path_model = $_SERVER['DOCUMENT_ROOT'] . '/module/products/model/model/';
      $arrValue = loadModel($path_model, "products_model", "list_products", "");

      if ($arrValue) {
          loadView('module/products/view/', 'list_products.php', $arrValue);
      } else {
          $message = "NOT PRODUCTS";
          loadView('view/inc/', '404.php', $message);
      }
  }

  //Si hay datos del formulario en el json enviado por el controlador de javascript
	if(isset($_POST['create_products'])){
		create_products();
	}

  //Validamos los datos correctamente
  //Si los datos estan correctos, los guardamos y devolvemos un json con el resultado
  //Silos datos no estan correctos, devolvemos el resultado y los errores en un json
	function create_products(){
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
        $path_model = $_SERVER['DOCUMENT_ROOT'] . '/module/products/model/model/';
        $arrValue = loadModel($path_model, "products_model", "create_products", $arrArgument);
        //echo json_encode($arrValue);
        //die();

        if ($arrValue)
            $mensaje = "Su registro se ha efectuado correctamente, para finalizar compruebe que ha recibido un correo de validacion y siga sus instrucciones";
        else
            $mensaje = "No se ha podido realizar su alta. Intentelo mas tarde";

				//redirigir a otra pagina con los datos de $arrArgument y $mensaje
				$_SESSION['products'] = $arrArgument;
				$_SESSION['msje'] = $mensaje;
				$callback="index.php?module=products&view=result";

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

  //Subir imagen en dropzone.js
	if(isset($_GET["upload"]) && $_GET["upload"] == true) {
		$result_image = upload_files();
		$_SESSION['result_image'] = $result_image;
	}

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

  //Cerramos sesiones para evitar robo de datos
	function close_session() {
		unset($_SESSION['products']);
		unset($_SESSION['msje']);
		$_SESSION = array();
		session_destroy();
	}

  //Recuperamos los datos del formulario antes de cerrar sesion
	if (isset($_GET["load"]) && $_GET["load"] == true) {
		$jsondata = array();
		if (isset($_SESSION['products'])) {
			$jsondata['products'] = $_SESSION['products'];
		}
		if (isset($_SESSION['msje'])) {
			$jsondata['msje'] = $_SESSION['msje'];
		}
		close_session();
		echo json_encode($jsondata);
		exit;
	}

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

	/////////////////////////////////////////////////// load_pais
	if(  (isset($_GET["load_pais"])) && ($_GET["load_pais"] == true)  ){
		$json = array();

    $url = 'http://www.oorsprong.org/websamples.countryinfo/CountryInfoService.wso/ListOfCountryNamesByName/JSON';

    $path_model = $_SERVER['DOCUMENT_ROOT'] . '/module/products/model/model/';
    $arrValue = loadModel($path_model, "products_model", "obtain_paises", $url);

		if($json){
			echo $json;
			exit;
		}else{
			$json = "error";
			echo $json;
			exit;
		}
	}

	/////////////////////////////////////////////////// load_provincias
	if(  (isset($_GET["load_provincias"])) && ($_GET["load_provincias"] == true)  ){
		$jsondata = array();
    $json = array();

    $path_model = $_SERVER['DOCUMENT_ROOT'] . '/module/products/model/model/';
    $arrValue = loadModel($path_model, "products_model", "obtain_provincias", "");

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

	/////////////////////////////////////////////////// load_poblaciones
	if(  isset($_POST['idPoblac']) ){
	    $jsondata = array();
      $json = array();

      $path_model = $_SERVER['DOCUMENT_ROOT'] . '/module/products/model/model/';
      $arrValue = loadModel($path_model, "products_model", "obtain_poblaciones", $_POST['idPoblac']);

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

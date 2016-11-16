<?php

  function validate_products($value) {
      $error = array();
      $valido = true;

      //FILTER
      //Valores que se pueden verificar con expresiones regulares
      $filtro = array(
          'barcode' => array(
              'filter' => FILTER_VALIDATE_REGEXP,
              'options' => array('regexp' => '/^[0-9]{2,20}$/')
          ),
          'name' => array(
              'filter' => FILTER_VALIDATE_REGEXP,
              'options' => array('regexp' => '/^[a-zA-Z]{4,50}$/')
          ),
          'explain' => array(
              'filter' => FILTER_VALIDATE_REGEXP,
              'options' => array('regexp' => '/^[a-zA-Z0-9?$@#()!,+\-=_:.&€£*%\s]+$/')
          ),
          'cost' => array(
              'filter' => FILTER_VALIDATE_REGEXP,
              'options' => array('regexp' => '/^[0-9]{1,20}.[0-9]{2}$/')
          ),
          'promotion_start' => array(
              'filter' => FILTER_VALIDATE_REGEXP,
              'options' => array('regexp' => '/^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/')
          ),
          'promotion_end' => array(
              'filter' => FILTER_VALIDATE_REGEXP,
              'options' => array('regexp' => '/^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/')
          ),
      );

      //Filtramos los datos con su expresion regular
      //return true or false
      $resultado = filter_var_array($value, $filtro);

      //NO FILTER
      //Valores qu no se pueden expresar con expresiones regulares
      $resultado['made_in_country'] = $value['made_in_country'];
      $resultado['made_in_province'] = $value['made_in_province'];
      $resultado['made_in_city'] = $value['made_in_city'];
      $resultado['stock'] = $value['stock'];
      $resultado['category'] = $value['category'];

      //RESULT
      //Si el resultado del valor es correcto, mantendremos el valor del resultado en true
      //Si el resultado del valor es incorrecto, asignamos un mensaje de error
      if ($resultado['promotion_start'] && $resultado['promotion_end']) {
          $date = compare_dates($resultado['promotion_start'], $resultado['promotion_end']);
          if (!$date){
              $error['promotion_start'] ="The promotion start date must be before the end date of promotion";
              $valido = false;
          }
      }

      if ($resultado['made_in_country'] === "select_country") {
          $error['made_in_country'] = "You must select a country";
          $valido = false;
      }

      if ($resultado['made_in_province'] === "select_province") {
          $error['made_in_province'] = "You must select a province";
          $valido = false;
      }

      if ($resultado['made_in_city'] === "select_city") {
          $error['made_in_ctiy'] = "You must select a city";
          $valido = false;
      }

      if ($resultado['stock'] === "") {
          $error['stock'] = "You must select if there are stock or no stock";
          $valido = false;
      }

      if (count($resultado['category']) < 1) {
          $error['category'] = "Select 1 or more.";
          $valido =  false;
      }

      if ($resultado != null && $resultado) {
          if (!$resultado['barcode']) {
              $error['barcode'] = 'Barcode must be 2 to 20 digits';
              $valido = false;
          }

          if (!$resultado['name']) {
              $error['name'] = 'Name must be 4 to 50 digits';
              $valido = false;
          }

          if (!$resultado['explain']) {
              $error['name'] = 'Only these symbols are allow: ?$@#()!,+\-=_:.&€£*%';
              $valido = false;
          }

          if (!$resultado['cost']) {
              $error['cost'] = 'Cost must be 1 to 20 digits and 2 decimals';
              $valido = false;
          }

          if (!$resultado['promotion_start']) {
              if ($resultado['promotion_start'] == "") {
                  $error['promotion_start'] = "This camp can't empty";
                  $valido = false;
              } else {
                  $error['promotion_start'] = 'Error format date (mm/dd/yyyy)';
                  $valido = false;
              }
          }

          if (!$resultado['promotion_end']) {
              if ($resultado['promotion_end'] == "") {
                  $error['promotion_end'] = "This camp can't empty";
                  $valido = false;
              } else {
                  $error['promotion_end'] = 'Error format date (mm/dd/yyyy)';
                  $valido = false;
              }
          }

      } else {
          $valido = false;
      };

      return $return = array('resultado' => $valido, 'error' => $error, 'datos' => $resultado);
  };

  //FUNCTIONS

  //Funcion de comparar dos fechas
  //La primera fecha debe ser anterior o igual a la segunda fecha
  function compare_dates($start_days, $dayslight) {

      $dia_one = substr($start_days, 0, 2);
      $mes_one = substr($start_days, 3, 2);
      $anio_one = substr($start_days, 6, 4);
      $dia_two = substr($dayslight, 0, 2);
      $mes_two = substr($dayslight, 3, 2);
      $anio_two = substr($dayslight, 6, 4);

      $dateOne = new DateTime($anio_one . "-" . $mes_one . "-" . $dia_one);
      $dateTwo = new DateTime($anio_two . "-" . $mes_two . "-" . $dia_two);

      if ($dateOne <= $dateTwo) {
          return true;
      }
      return false;
  }

  function paint_template_products($arrData) {
      print ("<script type='text/javascript' src='module/products/view/js/modal_products.js' ></script>");
      print ("<section");
        print ("<div class='container'>");
          print ("<div id='list_prod' class='row text-center pad-row'>");
            if (isset($arrData) && !empty($arrData)) {
              print("<div id='options'>");
                foreach ($arrData as $product) {
                    //echo $productos['id'] . " " . $productos['nombre'] . "</br>";
                    //echo $productos['descripcion'] . " " . $productos['precio'] . "</br>";
                    print ("<div class='prod' barcode='".$product['barcode']."'>");
                    print ("<img class='prodImg' src='" . $product['image'] . "'alt='product' >");
                    print ("<p>" . $product['name'] . "</p>");
                    print ("<p>" . $product['cost'] . "€</p>");
                    print ("</div>");
                }
              print ("</div>");
            }
          print ("</div>");
        print ("</div>");
      print ("</section>");
  }

  function paint_template_error($message) {
      $log = Log::getInstance();
      $log->add_log_general("error paint_template_error", "products", "response" . http_response_code()); //$text, $controller, $function
      $log->add_log_products("error paint_template_error", "", "products", "response" . http_response_code()); //$msg, $username = "", $controller, $function

      print( "<section id='error' class='container'>");
      print('<div id="page">');

      print('<div id="header" class="status' . http_response_code() . '>');

      if (isset($message) && !empty($message)) {
          print( '<h1>ERROR ' . http_response_code() . ' - ' . $message . '</h1>');
      }

      print('</div>');
      print('<div id="content">');
      print('<h2>The following error occurred:</h2>');
      print('<p>The requested URL was not found on this server.</p>');
      print('<P>Please check the URL or contact the webmaster.</p>');
      print('</div>');
      print('<div id="footererr">');
      print('<p>Powered by <a href="http://www.ispconfig.org">ISPConfig</a></p>');
      print('</div>');
      print('</div>');
      print('</section>');
  }

  function paint_template_search($message) {
      $log = Log::getInstance();
      $log->add_log_general("error paint_template_search", "products", "response " . http_response_code()); //$text, $controller, $function
      $log->add_log_products("error paint_template_search", "", "products", "response " . http_response_code()); //$msg, $username = "", $controller, $function

      print ("<section id='wrapper3'> \n");
      print ("<div class='container'> \n");
      print ("<div class='row text-center pad-row'> \n");

      print ("<h2>" . $message . "</h2> \n");
      print ("<br><br><br><br> \n");

      print ("</div> \n");
      print ("</div> \n");
      print ("</section> \n");
  }

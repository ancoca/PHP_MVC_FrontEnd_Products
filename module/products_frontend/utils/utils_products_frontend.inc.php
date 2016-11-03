<?php
function paint_template_error($message) {
    $log = Log::getInstance();
    $log->add_log_general("error paint_template_error", "products", "response" . http_response_code()); //$text, $controller, $function
    $log->add_log_user("error paint_template_error", "", "products", "response" . http_response_code()); //$msg, $username = "", $controller, $function

    $arrData = response_code(http_response_code());


    print ("<div id='page'>");
    print ("<br><br>");
    print ("<div id='header' class='status4xx'>");
    //https://es.wikipedia.org/wiki/Anexo:C%C3%B3digos_de_estado_HTTP
    print("<h1>" . $message . "</h1>");
    print("</div>");
    print ("<div id='content'>");
    print ("<h2>The following error occurred:</h2>");
    print ("<p>The requested URL was not found on this server.</p>");
    print ("<P>Please check the URL or contact the <!--WEBMASTER//-->webmaster<!--WEBMASTER//-->.</p>");
    print ("</div>");
    print ("<div id='footer'>");
    print ("<p>Powered by <a href='http://www.ispconfig.org'>ISPConfig</a></p>");
    print ("</div>");
    print("</div>");


    /*
      print ("<section id='error' class='container text-center'>");
      print ("<h1>404," . $message . "</h1>");
      print ("<p>The Page you are looking for doesn't exist or an other error occurred.</p>");
      print ("<a class='btn btn-primary' href='index.php'>GO BACK TO THE HOMEPAGE</a>");
      print ("</section><!--/#error-->"); */
}

function paint_template_products($arrData) {
    print ("<script type='text/javascript' src='module/products_frontend/view/js/modal_products.js' ></script>");
    print ("<div id='wrapper1'>");
     	print ("<div id='welcome' class='container'>");
     		print ("<div class='title'>");
     			print ("<h2>Products</h2>");
     		print ("</div>");
     	print ("</div>");
    print ("</div>");
    print ("<section id='wrapper3'>");
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
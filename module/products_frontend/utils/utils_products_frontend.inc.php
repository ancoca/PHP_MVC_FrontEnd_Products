<?php

function paint_template_products($arrData) {
    print ("<script type='text/javascript' src='module/products_frontend/view/js/modal_products.js' ></script>");
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

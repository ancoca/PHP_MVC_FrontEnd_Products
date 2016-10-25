<?php
    switch($_GET['module']) {
        case "home";
            include("module/home/controller/controller_home.php");
            break;
        case "products";
            switch($_GET['view']){
                case "controller";
                    include("module/products/controller/controller_products.php");
                    break;
                case "create";
                    include("module/products/view/create_products.php");
                    break;
                case "result";
                    include("module/products/view/result_products.php");
                    break;
                default;
                    include("module/products/view/create_products.php");
                    break;
            }
            break;
        case "products_frontend";
          include("module/products_frontend/controller/controller_products_frontend.php");
          break;
        default;
            include("module/home/controller/controller_home.php");
            break;
    }

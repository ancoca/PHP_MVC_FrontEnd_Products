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
        default;
            include("module/home/controller/controller_home.php");
            break;
    }

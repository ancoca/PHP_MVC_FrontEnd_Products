<?php
  //SITE ROOT
  $path = $_SERVER['DOCUMENT_ROOT'] . '/';
  define('SITE_ROOT', $path);

  //SITE PATH
  define('SITE_PATH', 'https://'.$_SERVER['HTTP_HOST'].'/');

  //LOG
  define('LOG_DIR', SITE_ROOT . 'classes/Log.class.singleton.php');
  define('GENERAL_LOG_DIR', $path . 'log/general/Site_General_errors.log');
  define('PRODUCTS_LOG_DIR', $path . 'log/products/Site_Products_errors.log');

  //PRODUCTION
  define('PRODUCTION', false);

  //MODEL
  define('MODEL_PATH', SITE_ROOT . 'model/');

  //RESOURCES
  define('RESOURCES_PATH', SITE_ROOT . 'resources/');

  //MEDIA
  define('MEDIA_PATH', SITE_ROOT . 'media/');

  //UTILS
  define('UTILS_PATH', SITE_ROOT . 'utils/');

  //VIEW
  define('CSS_PATH', SITE_ROOT . 'view/css/');
  define('INC_PATH', SITE_ROOT . 'view/inc/');
  define('IMAGES_PATH', SITE_ROOT . 'view/images/');

  //MODULES
  define('MODULES_PATH', SITE_ROOT . 'module/');

  //MODULE PRODUCTS
  define('CONTROLLER_PRODUCTS_PATH', MODULES_PATH . 'products/controller/');
  define('MODEL_PRODUCTS_PATH', MODULES_PATH . 'products/model/model/');
  define('BLL_PRODUCTS_PATH', MODULES_PATH . 'products/model/bll/');
  define('DAO_PRODUCTS_PATH', MODULES_PATH . 'products/model/bll/');
  define('UTILS_PRODUCTS_PATH', MODULES_PATH . 'products/utils/');
  define('JS_PRODUCTS_PATH', SITE_PATH . 'module/products/view/js/');
  define('CSS_PRODUCTS_PATH', SITE_PATH . 'module/products/view/css/');

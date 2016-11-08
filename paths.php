<?php

  $path = $_SERVER['DOCUMENT_ROOT'] . '/';
  define('PRODUCTS_LOG_DIR', $path . 'log/products/Site_Products_errors.log');
  define('GENERAL_LOG_DIR', $path . 'log/general/Site_General_errors.log');

  define('PRODUCTION', true);

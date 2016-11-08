<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : SweetCourse
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130919

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="shortcut icon" href="view/images/logo_GameBets.png" type="image/png">
    <title>GameBets | <?php if ($_GET['module']){
                                echo $_GET['module'];
                            } else {
                                echo "HOME";
                            } ?>
    </title>
    <meta charset="UTF-8">
    <meta name="keywords" content="" />
    <meta name="description" content="" />

    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
    <link href="view/css/default.css" rel="stylesheet" type="text/css" media="all" />
    <link href="view/css/fonts.css" rel="stylesheet" type="text/css" media="all" />

    <!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

    <!-- JQUERY datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0-rc.2/jquery-ui.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-rc1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0-rc.2/jquery-ui.js"></script>

</head>
<body>
<?php
  $_SESSION['module'] = "";
  $_SESSION['result_image'] = array();
	include("utils/utils.inc.php");
  include("paths.php");

  if (PRODUCTION) { //we are in production
      ini_set('display_errors', '1');
      ini_set('error_reporting', E_ERROR | E_WARNING | E_NOTICE); //error_reporting(E_ALL) ;
  } else {
      ini_set('display_errors', '0');
      ini_set('error_reporting', '0'); //error_reporting(0);
  }
?>

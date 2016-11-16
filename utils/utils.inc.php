<?php
    function debugPHP($array){
		echo "<pre>";
		print_r($array);
		echo "</pre><br>";
		//die(); no va
	}

	function redirect($url){
		die('<script>top.location.href="'.$url .'";</script>');
	}

	function close_session() {
		$_SESSION = array (); // Destruye todas las variables de la sesión
		session_destroy(); // Destruye la sesión
	}

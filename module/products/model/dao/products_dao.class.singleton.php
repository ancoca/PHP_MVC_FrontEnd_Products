<?php

class products_dao {

    static $_instance;

    private function __construct() {
      
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function create_products_dao($db, $arrArgument) {
        $barcode = $arrArgument['barcode'];
        $name = $arrArgument['name'];
        $image = $arrArgument['image'];
        $explain = $arrArgument['explain'];
        $cost = $arrArgument['cost'];
        $stock = $arrArgument['stock'];
        $stock_value = 0;
        if ($stock) {
          $stock_value = 1;
        } else {
          $stock_value = 0;
        }

        $made_in_country = $arrArgument['made_in_country'];
        $made_in_province = $arrArgument['made_in_province'];
        $made_in_city = $arrArgument['made_in_city'];
        $category = $arrArgument['category'];

        $electrodomestico = 0;
        $informatica = 0;
        $aire_acondicionado = 0;
        $cocina = 0;

        foreach ($category as $indice) {
            if ($indice === 'electrodomesticos')
                $electrodomestico = 1;
            if ($indice === 'informatica')
                $informatica = 1;
            if ($indice === 'aire acondicionado')
                $aire_acondicionado = 1;
            if ($indice === 'cocina')
                $cocina = 1;
        }

        $promotion_start = $arrArgument['promotion_start'];
        $promotion_end = $arrArgument['promotion_end'];

        $sql = "INSERT INTO products (barcode, name, image, explicacion, cost, stock,"
                . " made_in_country, made_in_province, made_in_city, electrodomestico,"
                . " informatica, aire_acondicionado, cocina , promotion_start, promotion_end"
                . " ) VALUES ('$barcode', '$name', '$image', '$explain', '$cost', '$stock_value',"
                . " '$made_in_country', '$made_in_province', '$made_in_city', '$electrodomestico',"
                . " '$informatica', '$aire_acondicionado', '$cocina', '$promotion_start', '$promotion_end')";

        return $db->ejecutar($sql);
    }

    public function obtain_paises_dao($url) {
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file_contents = curl_exec($ch);
        curl_close($ch);

        return ($file_contents) ? $file_contents : FALSE;
    }

    public function obtain_provincias_dao() {
        $json = array();
        $tmp = array();

        $provincias = simplexml_load_file("resources/provinciasypoblaciones.xml");
        $result = $provincias->xpath("/lista/provincia/nombre | /lista/provincia/@id");
        for ($i=0; $i<count($result); $i+=2) {
          $e=$i+1;
          $provincia=$result[$e];

          $tmp = array(
            'id' => (string) $result[$i], 'nombre' => (string) $provincia
          );
          array_push($json, $tmp);
        }
        return $json;
    }

    public function obtain_poblaciones_dao($arrArgument) {
        $json = array();
        $tmp = array();

        $filter = (string)$arrArgument;
        $xml = simplexml_load_file("resources/provinciasypoblaciones.xml");
        $result = $xml->xpath("/lista/provincia[@id='$filter']/localidades");

        for ($i=0; $i<count($result[0]); $i++) {
          $tmp = array('poblacion' => (string) $result[0]->localidad[$i]);
          array_push($json, $tmp);
        }
        return $json;
    }

    public function list_products_dao($db) {
        $sql = "SELECT * FROM products";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);

    }

    public function details_products_dao($db,$id) {
        $sql = "SELECT * FROM products WHERE barcode=".$id;
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);

    }

    public function page_products_dao($db,$arrArgument) {
        $position = $arrArgument['position'];
        $item_per_page = $arrArgument['item_per_page'];
        $sql = "SELECT * FROM products ORDER BY barcode ASC LIMIT ".$position." , ".$item_per_page;

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);

    }

    public function total_products_dao($db) {
        $sql = "SELECT COUNT(*) as total FROM products";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);

    }

    public function select_column_products_dao($db, $arrArgument) {
        $sql = "SELECT " . $arrArgument . " FROM products ORDER BY " . $arrArgument;

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function select_like_products_dao($db, $arrArgument) {
        $column = $arrArgument['column'];
        $like = $arrArgument['like'];
        $sql = "SELECT DISTINCT * FROM products WHERE " . $column . " like '%" . $like . "%'";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

     public function count_like_products_dao($db, $arrArgument) {
         $column = $arrArgument['column'];
         $like = $arrArgument['like'];
        $sql = "SELECT COUNT(*) as total FROM products WHERE " . $column . " like '%" . $like . "%'";

        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);
    }

    public function select_like_limit_products_dao($db, $arrArgument) {
        $column = $arrArgument['column'];
        $like = $arrArgument['like'];
        $position = $arrArgument['position'];
        $limit = $arrArgument['limit'];
        $sql="SELECT DISTINCT * FROM products WHERE ". $column ." like '%". $like . "%' ORDER BY barcode ASC LIMIT ". $position ." , ". $limit;

        $stmt=$db->ejecutar($sql);
        return $db->listar($stmt);
    }
}

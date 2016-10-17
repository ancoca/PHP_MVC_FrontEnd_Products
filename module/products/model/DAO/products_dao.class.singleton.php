<?php

class productsDAO {

    static $_instance;

    private function __construct() {

    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function create_products_DAO($db, $arrArgument) {
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

}

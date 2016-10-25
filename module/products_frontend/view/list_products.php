<section >
    <div id="wrapper3">
        <div id="list_prod" class="row text-center pad-row">
            <ol class="breadcrumb">
                <li class="active" >Products</li>
            </ol>
            <br>
            <br>
            <br>
            <br>
            <?php
            if (isset($arrData) && !empty($arrData)) {
                foreach ($arrData as $product) {
                    //echo $productos['id'] . " " . $productos['nombre'] . "</br>";
                    //echo $productos['descripcion'] . " " . $productos['precio'] . "</br>";
                    ?>
                    <a id="prod" href="index.php?module=products_frontend&idProduct=<?php echo $product['barcode'] ?>" >
                        <img class="prodImg" src=<?php echo $product['image'] ?> alt="product" >
                        <p><?php echo $product['name'] ?></p>
                        <p id="p2"><?php echo $product['cost'] ?>€</p>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>

<script type="text/javascript" src="module/products/view/js/jquery.bootpag.min.js"></script>
<script type="text/javascript" src="module/products/view/js/list_products.js" ></script>

<div id="wrapper1">
  <div id="welcome" class="container">
    <div class="title">
      <h2>Products</h2>
    </div>
  </div>
</div>

<div id="wrapper3">
<center style="margin-top: 2em;">
<form name="search_prod" id="search_prod" class="search_prod">
    <input type="text" value="" placeholder="Search Product ..." class="input_search" id="keyword" list="datalist">
    <!-- <div id="results_keyword"></div> -->
    <input name="Submit" id="Submit" class="button_search" type="button" />

</form>
</center>

<div id="results"></div>
</div>

<center>
    <div class="pagination_prods"></div>
</center>

<!-- modal window details_product -->
<section id="product">

    <div id="details_prod" hidden>

        <!--<ol class="breadcrumb">
            <li><a href="index.php?module=products">Products</a></li>
            <li class="active">Details Product</li>
        </ol>
        <br>
        <br>-->
        <div id="details">
            <div id="img_prod" class="prodImg"></div>

            <div id="container">

                <h4> <strong><div id="name_prod"></div></strong> </h4>
                <br />
                <p>
                <div id="description_prod"></div>
                </p>
                <p>
                <div id="titration_prod"></div>
                </p>
                <h2> <strong><div id="price_prod"></div></strong> </h5>

            </div>

        </div>

    </div>
</section>
</div>

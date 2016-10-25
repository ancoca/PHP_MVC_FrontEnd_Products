function load_users_ajax() {
    $.ajax({
        type: 'GET',
        url: "module/products/controller/controller_products.php?load=true",
        //dataType: 'json',
        async: false
    }).success(function (data) {
        var json = JSON.parse(data);

        //alert(json.user.usuario);

        mostrar_products(json);

    }).fail(function (xhr) {
        alert(xhr.responseText);
    });
}

////////////////////////////////////////////////////////////////
function load_users_get_v1() {
    $.get("module/products/controller/controller_products.php?load=true", function (data, status) {
        var json = JSON.parse(data);
        //$( "#content" ).html( json.msje );
        //alert("Data: " + json.user.usuario + "\nStatus: " + status);

        mostrar_products(json);
    });
}

////////////////////////////////////////////////////////////////
function load_users_get_v2() {
    var jqxhr = $.get("module/products/controller/controller_products.php?load=true", function (data) {
        var json = JSON.parse(data);
        //console.log(json.msje);
        mostrar_products(json);
        //alert( "success" );
    }).done(function () {
        //alert( "second success" );
    }).fail(function () {
        //alert( "error" );
    }).always(function () {
        //alert( "finished" );
    });

    jqxhr.always(function () {
        //alert( "second finished" );
    });
}

$(document).ready(function () {
    //load_users_ajax();
    //load_users_get_v1();
    load_users_get_v2();
});

function mostrar_products(data) {
  var content = document.getElementById("content");
  var div_products = document.createElement("div");
  var parrafo = document.createElement("p");

  //Preparamos los datos que queremos mostrar
  var msje = document.createElement("div");
  msje.innerHTML = "msje = ";
  msje.innerHTML += data.msje;

  var barcode = document.createElement("div");
  barcode.innerHTML = "Barcode = ";
  barcode.innerHTML += data.products.barcode;

  var name = document.createElement("div");
  name.innerHTML = "Name = ";
  name.innerHTML += data.products.name;

  var cad = data.products.image;
  var img = document.createElement("div");
  var html = '<img src="' + cad + '" height="75" width="75">';
  img.innerHTML = "Image = " + html;

  var explain = document.createElement("div");
  explain.innerHTML = "Explain = ";
  explain.innerHTML += data.products.explain;

  var cost = document.createElement("div");
  cost.innerHTML = "Cost = ";
  cost.innerHTML += data.products.cost;

  var stock = document.createElement("div");
  stock.innerHTML = "Stock = ";
  stock.innerHTML += data.products.stock;

  var made_in_country = document.createElement("div");
  made_in_country.innerHTML = "Made in Country = ";
  made_in_country.innerHTML += data.products.made_in_country;

  var made_in_province = document.createElement("div");
  made_in_province.innerHTML = "Made in Province = ";
  made_in_province.innerHTML += data.products.made_in_province;

  var made_in_city = document.createElement("div");
  made_in_city.innerHTML = "Made in City = ";
  made_in_city.innerHTML += data.products.made_in_city;

  var category = document.createElement("div");
  category.innerHTML = "Category = ";
  for (var i=0; i<data.products.category.length; i++){
    category.innerHTML += " " + i +". " + data.products.category[i];
  }

  var promotion_start = document.createElement("div");
  promotion_start.innerHTML = "Promotion start = ";
  promotion_start.innerHTML += data.products.promotion_start;

  var promotion_end = document.createElement("div");
  promotion_end.innerHTML = "Promotion end = ";
  promotion_end.innerHTML += data.products.promotion_end;

  //Pintamos los datos que hemos preparado antes
  content.appendChild(div_products);
  div_products.appendChild(parrafo);
  parrafo.appendChild(msje);
  parrafo.appendChild(barcode);
  parrafo.appendChild(name);
  parrafo.appendChild(img);
  parrafo.appendChild(explain);
  parrafo.appendChild(cost);
  parrafo.appendChild(stock);
  parrafo.appendChild(made_in_country);
  parrafo.appendChild(made_in_province);
  parrafo.appendChild(made_in_city);
  parrafo.appendChild(category);
  parrafo.appendChild(promotion_start);
  parrafo.appendChild(promotion_end);

}

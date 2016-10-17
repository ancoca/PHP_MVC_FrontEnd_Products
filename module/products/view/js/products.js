//JQUERY function focus and blur
//focus es si el usuario ha insertado el foco en ese valor
//blur es si el usuario ha retirado el foco de ese valor

jQuery.fn.fill_or_clean = function () {
    this.each(function () {
        if ($("#barcode").attr("value") === "") {
            $("#barcode").attr("value", "Insert barcode");
            $("#barcode").focus(function () {
                if ($("#barcode").attr("value") == "Insert barcode") {
                    $("#barcode").attr("value", "");
                }
            });
        }
        $("#barcode").blur(function () { //Onblur se activa cuando el usuario retira el foco
            if ($("#barcode").attr("value") === "") {
                $("#barcode").attr("value", "Insert barcode");
            }
        });

        if ($("#name").attr("value") === "") {
            $("#name").attr("value", "Insert name");
            $("#name").focus(function () {
                if ($("#name").attr("value") == "Insert name") {
                    $("#name").attr("value", "");
                }
            });
        }
        $("#name").blur(function () { //Onblur se activa cuando el usuario retira el foco
            if ($("#name").attr("value") === "") {
                $("#name").attr("value", "Insert name");
            }
        });

        if ($("#explain").attr("value") === "") {
            $("#explain").attr("value", "Insert explain");
            $("#explain").focus(function () {
                if ($("#explain").attr("value") == "Insert explain") {
                    $("#explain").attr("value", "");
                }
            });
        }
        $("#explain").blur(function () { //Onblur se activa cuando el usuario retira el foco
            if ($("#explain").attr("value") === "") {
                $("#explain").attr("value", "Insert explain");
            }
        });

        if ($("#cost").attr("value") === "") {
            $("#cost").attr("value", "Insert cost");
            $("#cost").focus(function () {
                if ($("#cost").attr("value") == "Insert cost") {
                    $("#cost").attr("value", "");
                }
            });
        }
        $("#cost").blur(function () { //Onblur se activa cuando el usuario retira el foco
            if ($("#cost").attr("value") === "") {
                $("#cost").attr("value", "Insert cost");
            }
        });

        if ($("#promotion_start").attr("value") === "") {
            $("#promotion_start").attr("value", "dd/mm/yyyy");
            $("#promotion_start").focus(function () {
                if ($("#promotion_start").attr("value") == "dd/mm/yyyy") {
                    $("#promotion_start").attr("value", "");
                }
            });
        }
        $("#promotion_start").blur(function () { //Onblur se activa cuando el usuario retira el foco
            if ($("#promotion_start").attr("value") === "") {
                $("#promotion_start").attr("value", "dd/mm/yyyy");
            }
        });

        if ($("#promotion_end").attr("value") === "") {
            $("#promotion_end").attr("value", "dd/mm/yyyy");
            $("#promotion_end").focus(function () {
                if ($("#promotion_end").attr("value") == "dd/mm/yyyy") {
                    $("#promotion_end").attr("value", "");
                }
            });
        }
        $("#promotion_end").blur(function () { //Onblur se activa cuando el usuario retira el foco
            if ($("#promotion_end").attr("value") === "") {
                $("#promotion_end").attr("value", "dd/mm/yyyy");
            }
        });
    });


    return this;
};

Dropzone.autoDiscover = false;
$(document).ready(function () {

  //Datepicker inicio promocion
	$('#promotion_start').datepicker({
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: true,
		yearRange: '1900:2100',
		onSelect: function(selectedDate) {
		}
	});

  //Datepicker fin promocion
	$('#promotion_end').datepicker({
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: true,
		yearRange: '1900:2100',
		onSelect: function(selectedDate) {
		}
	});

  $("#SubmitProducts").click(function () {
      validate_products();
  });

  //Control de seguridad para evitar que al volver atrás de la pantalla results a create, no nos imprima los datos
  $.get("module/products/controller/controller_products.php?load_data=true",
    function (response) {
      //alert(response.user);
      if (response.products === "") {
        $("#barcode").val('');
        $("#name").val('');
        $("#explain").val('');
        $("#cost").val('');
        var inputStock = document.getElementsByClassName('stock');
        for (var i = 0; i < inputStock.length; i++) {
          if (i === 0) {
            inputStock[i].checked = true;
          }
        }
        $("#made_in_country").val('select_country');
        $("#made_in_province").val('select_province');
        $("#made_in_city").val('select_city');
        var inputCategory = document.getElementsByClassName('category');
        for (var i = 0; i < inputCategory.length; i++) {
          if (inputCategory[i].checked) {
            inputCategory[i].checked = false;
          }
        }
        $("#promotion_start").val('');
        $("#promotion_end").val('');

        $(this).fill_or_clean();//siempre que creemos un plugin debemos llamarlo, sino no funcionará
      } else {
        $("#barcode").val( response.products.barcode);
        $("#name").val( response.products.name);
        $("#explain").val( response.products.explain);
        $("#cost").val( response.products.cost);
        var stock = response.products.stock;
        var inputStock = document.getElementsByClassName('stock');
        for (var i = 0; i < inputStock.length; i++) {
          if (inputStock[i].checked) {
            inputStock[i].checked = true;
          }
        }
        $("#made_in_country").val( response.products.made_in_country);
        $("#made_in_province").val( response.products.made_in_province);
        $("#made_in_city").val( response.products.made_in_city);
        var category = response.products.category;
        var inputCategory = document.getElementsByClassName('category');
        for (var i = 0; i < inputCategory.length; i++) {
          if (inputCategory[i].checked) {
            inputCategory[i].checked = true;
          }
        }
        $("#promotion_start").val( response.products.conf_email);
        $("#promotion_end").val( response.products.en_lvl);
      }
    }, "json");

	//Dropzone function
    $("#dropzone").dropzone({
        url: "module/products/controller/controller_products.php?upload=true",
        addRemoveLinks: true,
        maxFileSize: 1000,
        dictResponseError: "Ha ocurrido un error en el server",
        acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.rar,application/pdf,.psd',
        init: function () { //Subir imagen
            this.on("success", function (file, response) {
                //console.log(response);
                //alert(response);
                $("#progress").show();
                $("#bar").width('100%');
                $("#percent").html('100%');
                $('.msg').text('').removeClass('msg_error');
                $('.msg').text('Success Upload image!!').addClass('msg_ok').animate({'right': '300px'}, 300);
            });
        },
        complete: function (file) {
            //if(file.status == "success"){
            //alert("El archivo se ha subido correctamente: " + file.name);
            //}
        },
        error: function (file) {
            //alert("Error subiendo el archivo " + file.name);
        },
        removedfile: function (file, serverFileName) {  //Borrar imagen
            var name = file.name;
            $.ajax({
                type: "POST",
                url: "module/products/controller/controller_products.php?delete=true",
                data: "filename=" + name,
                success: function (data) {
                    //console.log(data);
                    $("#progress").hide();
                    $('.msg').text('').removeClass('msg_ok');
                    $('.msg').text('').removeClass('msg_error');
                    $("#e_avatar").html("");

                    var json = JSON.parse(data);
                    if (json.res === true) {
                        var element;
                        if ((element = file.previewElement) !== null) {
                            element.parentNode.removeChild(file.previewElement);
                            //alert("Imagen eliminada: " + name);
                        } else {
                            return false;
                        }
                    } else { //json.res == false, elimino la imagen también
                        var element;
                        if ((element = file.previewElement) !== null) {
                            element.parentNode.removeChild(file.previewElement);
                        } else {
                            return false;
                        }
                    }
                }
            });
        }
    });

    //Regular expressions
    var barcode_reg = /^[0-9]{2,20}$/;
    var name_reg = /^[a-zA-Z]{4,50}$/;
    var explain_reg = /^[a-zA-Z0-9?$@#()!,+\-=_:.&€£*%\s]+$/;
    var cost_reg = /^[0-9]{1,20}.[0-9]{2}$/;
    var promotion_start_reg = /^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/;
    var promotion_end_reg = /^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/;

    //Corregir error
    //Hasta que no introduzcamos un valor que acepte la expresion regular, no se borrara el error
    $("#barcode").keyup(function () {
        if ($(this).val() !== "" && barcode_reg.test($(this).val())) {
            $(".error_javascript").fadeOut();
            return false;
        }
    });

    $("#name").keyup(function () {
        if ($(this).val() !== "" && name_reg.test($(this).val())) {
            $(".error_javascript").fadeOut();
            return false;
        }
    });

    $("#explain").keyup(function () {
        if ($(this).val() !== "" && explain_reg.test($(this).val())) {
            $(".error_javascript").fadeOut();
            return false;
        }
    });

    $("#cost").keyup(function () {
        if ($(this).val() !== "" && cost_reg.test($(this).val())) {
            $(".error_javascript").fadeOut();
            return false;
        }
    });

    $("#promotion_start").keyup(function () {
        if ($(this).val() !== "" && promotion_start_reg.test($(this).val())) {
            $(".error_javascript").fadeOut();
            return false;
        }
    });

    $("#promotion_end").keyup(function () {
        if ($(this).val() !== "" && promotion_end_reg.test($(this).val())) {
            $(".error_javascript").fadeOut();
            return false;
        }
    });
});

//Validar y guardar datos
function validate_products() {

  var result = true;

  //Recogemos los valores del usuario
  var barcode = document.getElementById('barcode').value;
  var name = document.getElementById('name').value;
  var explain = document.getElementById('explain').value;
  var cost = document.getElementById('cost').value;
  var stock = "";
  var inputStock = document.getElementsByClassName('stock');
  for (var i = 0; i < inputStock.length; i++) {
      if (inputStock[i].checked) {
          stock = inputStock[i].value;
      }
  }
  var made_in_country = document.getElementById('made_in_country').value;
  var made_in_province = document.getElementById('made_in_province').value;
  var made_in_city = document.getElementById('made_in_city').value;
  var category = [];
  var inputCategory = document.getElementsByClassName('category');
  var j = 0;
  for (var i = 0; i < inputCategory.length; i++) {
      if (inputCategory[i].checked) {
          category[j] = inputCategory[i].value;
          j++;
      }
  }
  var promotion_start = document.getElementById('promotion_start').value;
  var promotion_end = document.getElementById('promotion_end').value;

  //Regular expressions
  var barcode_reg = /^[0-9]{2,20}$/;
  var name_reg = /^[a-zA-Z]{4,50}$/;
  var explain_reg = /^[a-zA-Z0-9?$@#()!,+\-=_:.&€£*%\s]+$/;
  var cost_reg = /^[0-9]{1,20}.[0-9]{2}$/;
  var promotion_start_reg = /^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/;
  var promotion_end_reg = /^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/;

  $(".error").remove();

  //Pintar los errores
  //Si no hemos insertado correctamente el valor, se nos mostrara el mensaje de error
  if ($("#barcode").val() === "" || $("#barcode").val() == "Insert barcode") {
      $("#barcode").focus().after("<span class='error_javascript'>Insert barcode</span>");
      result = false;
      return false;
  } else if (!barcode_reg.test($("#barcode").val())) {
      $("#barcode").focus().after("<span class='error_javascript'>Barcode must be 2 to 20 digits</span>");
      result = false;
      return false;
  }

  if ($("#name").val() === "" || $("#name").val() == "Insert name") {
      $("#name").focus().after("<span class='error_javascript'>Insert name</span>");
      result = false;
      return false;
  } else if (!name_reg.test($("#name").val())) {
      $("#name").focus().after("<span class='error_javascript'>Name must be 4 to 50 letters</span>");
      result = false;
      return false;
  }

  if ($("#explain").val() === "" || $("#explain").val() == "Insert explain") {
      $("#explain").focus().after("<span class='error_javascript'>Insert explain</span>");
      result = false;
      return false;
  } else if (!explain_reg.test($("#name").val())) {
      $("#explain").focus().after("<span class='error_javascript'>Only these symbols are allow: ?$@#()!,+\-=_:.&€£*%</span>");
      result = false;
      return false;
  }

  else if ($("#cost").val() === "" || $("#cost").val() == "Insert cost") {
      $("#cost").focus().after("<span class='error_javascript'>Insert name</span>");
      result = false;
      return false;
  } else if (!cost_reg.test($("#cost").val())) {
      $("#cost").focus().after("<span class='error_javascript'>Name must be 4 to 50 letters</span>");
      result = false;
      return false;
  }

  if ($("#promotion_start").val() === "" || $("#promotion_start").val() == "mm/dd/yyyy") {
      $("#promotion_start").focus().after("<span class='error_javascript'>Insert date</span>");
      result = false;
      return false;
  } else if (!promotion_start_reg.test($("#promotion_start").val())) {
      $("#promotion_start").focus().after("<span class='error_javascript'>error format date (mm/dd/yyyy)</span>");
      result = false;
      return false;
  }

  if ($("#promotion_end").val() === "" || $("#promotion_end").val() == "mm/dd/yyyy") {
      $("#promotion_end").focus().after("<span class='error_javascript'>Insert date</span>");
      result = false;
      return false;
  } else if (!promotion_end_reg.test($("#promotion_end").val())) {
      $("#promotion_end").focus().after("<span class='error_javascript'>error format date (mm/dd/yyyy)</span>");
      result = false;
      return false;
  }

  if (result) { //Si el resultado es positivo, cogemos todos los valores y se los enviamos al controlador de PHP  con un JSON
    var data = {"barcode": barcode, "name": name, "explain": explain, "cost": cost,
        "stock": stock, "made_in_country": made_in_country, "made_in_province": made_in_province,
        "made_in_city": made_in_city, "category": category, "promotion_start": promotion_start,
        "promotion_end": promotion_end};

    //Metemos todos los datos en un JSON
    var data_products_JSON = JSON.stringify(data);

    //Le enviamos el JSON al Controllador de PHP
    $.post('module/products/controller/controller_products.php',
            {create_products : data_products_JSON},
    function (response) { //Si la respuesta del controlador de PHP es positiva
      //console.log(response);
      if (response.success) {
        window.location.href =response.redirect;
      }
    }, "json").fail(function (xhr){
      //console.log(xhr.responseJSON);
      if (xhr.responseJSON.error.barcode){ //Si la respuesta del controlador de PHP es negativa, pintamos los errores
        $("#e_barcode").focus().after("<span class='error_javascript'>" + xhr.responseJSON.error.barcode + "</span>");
      }
      if (xhr.responseJSON.error.name){
        $("#e_name").focus().after("<span class='error_javascript'>" + xhr.responseJSON.error.name + "</span>");
      }
      if (xhr.responseJSON.success_image) {
          if (xhr.responseJSON.img_products !== "/media/default-avatar.png") {
              //$("#progress").show();
              //$("#bar").width('100%');
              //$("#percent").html('100%');
              //$('.msg').text('').removeClass('msg_error');
              //$('.msg').text('Success Upload image!!').addClass('msg_ok').animate({ 'right' : '300px' }, 300);
          }
      } else {
          $("#progress").hide();
          $('.msg').text('').removeClass('msg_ok');
          $('.msg').text('Error Upload image!!').addClass('msg_error').animate({'right': '300px'}, 300);
      }
      if (xhr.responseJSON.error.explain){
        $("#e_explain").focus().after("<span class='error_javascript'>" + xhr.responseJSON.error.explain + "</span>");
      }
      if (xhr.responseJSON.error.cost){
        $("#e_cost").focus().after("<span class='error_javascript'>" + xhr.responseJSON.error.cost + "</span>");
      }
      if (xhr.responseJSON.error.stock){
        $("#e_stock").focus().after("<span class='error_javascript'>" + xhr.responseJSON.error.stock + "</span>");
      }
      if (xhr.responseJSON.error.made_in_country){
        $("#e_made_in_country").focus().after("<span class='error_javascript'>" + xhr.responseJSON.error.made_in_country + "</span>");
      }
      if (xhr.responseJSON.error.made_in_province){
        $("#e_made_in_province").focus().after("<span class='error_javascript'>" + xhr.responseJSON.error.made_in_province + "</span>");
      }
      if (xhr.responseJSON.error.made_in_city){
        $("#e_made_in_city").focus().after("<span class='error_javascript'>" + xhr.responseJSON.error.made_in_city + "</span>");
      }
      if (xhr.responseJSON.error.category){
        $("#e_category").focus().after("<span class='error_javascript'>" + xhr.responseJSON.error.category + "</span>");
      }
      if (xhr.responseJSON.error.promotion_start){
        $("#e_promotion_start").focus().after("<span class='error_javascript'>" + xhr.responseJSON.error.promotion_start + "</span>");
      }
      if (xhr.responseJSON.error.promotion_end){
        $("#e_promotion_end").focus().after("<span class='error_javascript'>" + xhr.responseJSON.error.promotion_end + "</span>");
      }
    });
  }
}

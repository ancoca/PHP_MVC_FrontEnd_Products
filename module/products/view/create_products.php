<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css">
<script type="text/javascript" src="module/products/view/js/products.js" ></script>

 <div id="wrapper1">
	<div id="welcome" class="container">
		<div class="title">
			<h2>Insert the data of products</h2>
		</div>
	</div>
</div>
<div id="wrapper3">
	<div id="wrapper-blog" class="container">
		<form name="FormProducts" id="FormProducts">
		  	<table>

		  		<!-- Barcode -->
				<tr>
					<td width="24%">Barcode</td>
					<td width="76%"><input type="text" class="expand" name="barcode" id="barcode" value=""></td>
          <div id="e_name"></div>
				</tr>

				<!-- Name -->
				<tr>
					<td>Name</td>
					<td><input type="text" class="expand" name="name" id="name" value="<?php
					if (!isset($error['name'])) {
                        echo $_POST ? $_POST['name'] : "";
                    }
					?>"></td>
				</tr>

				<!-- Image -->
				<tr>
					<td>Image</td>
					<td>
						<div id="progress">
                  <div id="bar"></div>
                  <div id="percent">0%</div >
              </div>

              <div class="msg"></div>
              <div id="dropzone" class="dropzone"></div>
            </td>
				</tr>

				<!-- Explain -->
				<tr>
					<td>Explain</td>
					<td><textarea class="expand" name="explain" id="explain" value="<?php
					if (!isset($error['explain'])) {
                        echo $_POST ? $_POST['explain'] : "";
                    }
					?>"></textarea></td>
				</tr>

				<!-- Cost -->
				<tr>
					<td>Cost</td>
					<td><input type="text" class="expand" name="cost" id="cost" value="<?php
					if (!isset($error['cost'])) {
                        echo $_POST ? $_POST['cost'] : "";
                    }
					?>"></td>
				</tr>

				<!-- Stock -->
				<tr>
					<td>Stock </td>
					<td><input name="stock" type="radio" class="stock" value=true checked> Yes
						<input name="stock" type="radio" class="stock" value=false> No
					</td>
				</tr>

				<!-- Made in country -->
				<tr>
					<td>Made in</td>
					<td><select name="made_in_country" id="made_in_country">
						<option value="select_country">Select country</option>
						<option value="spain">España</option>
						<option value="france">Francia</option>
						<option value="united_kingdown">Reino Unido</option>
						<option value="china">China</option>
						<option value="EE.UU.">Estados Unidos</option>
					</select></td>
				</tr>

				<!-- Made in province -->
				<tr>
					<td></td>
					<td><select name="made_in_province" id="made_in_province">
						<option value="select_province">Select province</option>
						<option value="valencia">Valencia</option>
						<option value="castellon">Castellon</option>
						<option value="alicante">Alicante</option>
						<option value="madrid">Madrid</option>
						<option value="asturias">Asturias</option>
					</select></td>
				</tr>

				<!-- Made in city -->
				<tr>
					<td></td>
					<td><select name="made_in_city" id="made_in_city">
						<option value="select_city">Select city</option>
						<option value="ontinyent">Ontinyent</option>
						<option value="bocairent">Bocairent</option>
						<option value="valencia">Valencia</option>
						<option value="villena">Villena</option>
						<option value="fontanars dels alforins">Fontanars dels alforins</option>
					</select></td>
				</tr>

				<!-- Category -->
				<tr>
					<td>Category</td>
					<td>
						<input type="checkbox" name="category[]" class="category" value="electrodomesticos"> Electrodomesticos <br/>
						<input type="checkbox" name="category[]" class="category" value="informatica"> Informatica <br/>
						<input type="checkbox" name="category[]" class="category" value="aire acondicionado"> Aire acondicionado <br/>
						<input type="checkbox" name="category[]" class="category" value="cocina"> Cocina
					</td>
				</tr>

				<!-- Promotion start -->
				<tr>
					<td>Promotion Start</td>
					<td><input type="text" class="expand" name="promotion_start" id="promotion_start" value="<?php
					if (!isset($error['promotion_start'])) {
                        echo $_POST ? $_POST['promotion_start'] : "";
                    }
					?>"></td>
				</tr>

				<!-- Promotion end -->
				<tr>
					<td>Promotion End</td>
					<td><input type="text" class="expand" name="promotion_end" id="promotion_end" value="<?php
					if (!isset($error['promotion_end'])) {
                        echo $_POST ? $_POST['promotion_end'] : "";
                    }
					?>"></td>
				</tr>

				<!-- Submit -->
				<tr>
					<td></td>
					<td>&nbsp;</td>
				</tr>
			</table>
			<button type="button" class="submit" name="SubmitProducts" id="SubmitProducts" value="Submit">Submit</button>
		</form>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css">
<script type="text/javascript" src="module/products/view/js/create_products.js" ></script>

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
				</tr>
        <tr>
          <td width="24%"></td>
          <td width="76%"><div id="e_barcode"></div></td>
        </tr>

				<!-- Name -->
				<tr>
					<td>Name</td>
					<td><input type="text" class="expand" name="name" id="name" value=""></td>
				</tr>
        <tr>
          <td width="24%"></td>
          <td width="76%"><div id="e_name"></div></td>
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
        <tr>
          <td width="24%"></td>
          <td width="76%"><div id="e_image"></div></td>
        </tr>

				<!-- Explain -->
				<tr>
					<td>Explain</td>
					<td><textarea class="expand" name="explain" id="explain" value=""></textarea></td>
				</tr>
        <tr>
          <td width="24%"></td>
          <td width="76%"><div id="e_explain"></div></td>
        </tr>

				<!-- Cost -->
				<tr>
					<td>Cost</td>
					<td><input type="text" class="expand" name="cost" id="cost" value=""></td>
				</tr>
        <tr>
          <td width="24%"></td>
          <td width="76%"><div id="e_cost"></div></td>
        </tr>

				<!-- Stock -->
				<tr>
					<td>Stock </td>
					<td class="left"><input name="stock" type="radio" class="stock" value=true checked> Yes
						<input name="stock" type="radio" class="stock" value=false> No
					</td>
				</tr>
        <tr>
          <td width="24%"></td>
          <td width="76%"><div id="e_stock"></div></td>
        </tr>

				<!-- Made in country -->
				<tr>
					<td>Made in</td>
					<td><select name="made_in_country" id="made_in_country" class="expand">
					</select></td>
				</tr>
        <tr>
          <td width="24%"></td>
          <td width="76%"><div id="e_made_in_country"></div></td>
        </tr>

				<!-- Made in province -->
				<tr>
					<td></td>
					<td><select name="made_in_province" id="made_in_province" class="expand">
					</select></td>
				</tr>
        <tr>
          <td width="24%"></td>
          <td width="76%"><div id="e_made_in_province"></div></td>
        </tr>

				<!-- Made in city -->
				<tr>
					<td></td>
					<td><select name="made_in_city" id="made_in_city" class="expand">
					</select></td>
				</tr>
        <tr>
          <td width="24%"></td>
          <td width="76%"><div id="e_made_in_city"></div></td>
        </tr>

				<!-- Category -->
				<tr>
					<td>Category</td>
					<td class="left">
						<input type="checkbox" name="category[]" class="category" value="electrodomesticos"> Electrodomesticos <br/>
						<input type="checkbox" name="category[]" class="category" value="informatica"> Informatica <br/>
						<input type="checkbox" name="category[]" class="category" value="aire acondicionado"> Aire acondicionado <br/>
						<input type="checkbox" name="category[]" class="category" value="cocina"> Cocina
					</td>
				</tr>
        <tr>
          <td width="24%"></td>
          <td width="76%"><div id="e_category"></div></td>
        </tr>

				<!-- Promotion start -->
				<tr>
					<td>Promotion Start</td>
					<td><input type="text" class="expand" name="promotion_start" id="promotion_start" value=""></td>
				</tr>
        <tr>
          <td width="24%"></td>
          <td width="76%"><div id="e_promotion_start"></div></td>
        </tr>

				<!-- Promotion end -->
				<tr>
					<td>Promotion End</td>
					<td><input type="text" class="expand" name="promotion_end" id="promotion_end" value=""></td>
				</tr>
        <tr>
          <td width="24%"></td>
          <td width="76%"><div id="e_promotion_end"></div></td>
        </tr>
			</table>

			<!-- Submit -->
			<button type="button" class="submit" name="SubmitProducts" id="SubmitProducts" value="Submit">Submit</button>
		</form>
	</div>
</div>

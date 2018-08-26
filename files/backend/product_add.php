<?php
$error="";
if(isset($_POST['btnAddProduct'])){

	//filter/sanitization of data input by user

	$prodName=$_POST['txtProdName'];
	$prodName=filter_var($prodName, FILTER_SANITIZE_STRING);

	$prodRate=$_POST['txtProdRate'];
	$prodRate= filter_var($prodRate, FILTER_VALIDATE_INT);

	$prodCat=$_POST['ddCategory'];
	$prodCat=filter_var($prodCat, FILTER_SANITIZE_STRING);

	//check if user selected a file
	if (isset($_FILES['txtProdImg']['name']) && $_FILES['txtProdImg']['name']!="") {

		//call to image validator function
		$error=imageValidate();
		if($error==""){
			//call to image upload function
			$prodImg=imageUpload();

			$product=new Product();
			$result=$product->addProduct($prodName, $prodImg, $prodRate, $prodCat);

			if ($result===true) {
				//error messages
				$error="<div class='success'><i class='fa fa-green fa-exclamation-triangle'></i> Success! The product has been added.</div>";
			}else{
				$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! There was an error.</div>";
			}
		}
	}else{
		$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! There was an error.</div>";
	}
}
?>

<div class="row black admin-title-container">
	Product Add
</div>
<div class="row content">
	<form class="col s12" action="" method="post" enctype="multipart/form-data">
		<?php echo $error;?>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="prodName" required name="txtProdName" class="validate">
				<label for="prodName">Product Name</label>
			</div>
		</div>
		<div class="row">
			<div class="file-field input-field">
				<div class="btn">
					<span>Choose image</span>
					<input name="txtProdImg" required placeholder="Product Image" type="file">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input id="prodRate" name="txtProdRate" required type="number" class="validate">
				<label for="prodRate">Product Rate</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<select required name="ddCategory">
					<option>- - Select Category - -</option>
					<option value="Cakes">Cakes</option>
					<option value="Cookies">Cookies</option>
					<option value="Donuts">Donuts</option>
					<option value="Cupcakes">Cupcakes</option>
					<option value="Tarts">Tarts</option>
					<option value="Other">Other</option>
				</select>
			</div>
		</div>
		<button type="submit" name="btnAddProduct" class="btn waves-effect waves-light right">Add Product</button>

	</form>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('select').material_select();
});

</script>
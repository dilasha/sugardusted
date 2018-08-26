
<?php
$error="";
$pid=$_REQUEST['id'];
$product=new Product();
$result=$product->productDetails($pid);
$editProdImg=$result['prodImg'];
if(isset($_POST['btnEditProduct'])){

	//filter/sanitize user input

	$prodName=$_POST['txtProdName'];
	$prodName=filter_var($prodName, FILTER_SANITIZE_STRING);

	$prodRate=$_POST['txtProdRate'];
	$prodRate= filter_var($prodRate, FILTER_VALIDATE_INT);

	$prodCat=$_POST['ddCategory'];
	$prodCat=filter_var($prodCat, FILTER_SANITIZE_STRING);
	
	//check if file is selected
	if (isset($_FILES['txtProdImg']['name']) && $_FILES['txtProdImg']['name']!="") {

		//echo "<script>alert('".$_FILES['txtProdImg']['name']."')</script>";
		$error=imageValidate(); //call to image validator function
		if($error==""){
			$prodImg=imageUpload();//call to image upload function
		}
	}else{
		$prodImg=$editProdImg;
	}

	$product=new Product();
	$result=$product->editProduct($pid, $prodName, $prodImg, $prodRate, $prodCat);
	if ($result!=false) {
		//redirect if details were updated
		$error="<div class='success'><i class='fa fa-green fa-exclamation-triangle'></i> Success! The product has been edited.</div>";
		$url="admin_index.php?action=product_list";
		echo "<script>window.location='".$url."'</script>";		
	}else{
		$error="<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! There was an error.</div>";
	}
}
?>
<div class="row black admin-title-container">
	Product edit
</div>
<div class="row">
	<form class="col s12" action="" method="post" enctype="multipart/form-data">
		<?php echo $error;?>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="prodName" required value="<?php echo $result['prodName']; ?>" name="txtProdName" class="validate">
				<label for="prodName">Product Name</label>
			</div>
		</div>
		<div class="row">
			<div class="file-field input-field">
				<div class="btn">
					<span>Choose image</span>
					<input name="txtProdImg" placeholder="Product Image" type="file">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
				</div>
			</div>

			<img class="table-img" height=200 src="<?php echo $config['base_url']."uploads/".$result['prodImg']?>" />
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input id="prodRate" name="txtProdRate" required value="<?php echo $result['prodRate']; ?>" type="number" class="validate">
				<label for="prodRate">Product Rate</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<select required name="ddCategory">

					<!-- preselect option saved in db -->
					
					<option>- - Select Category - -</option>
					<option <?php if ($result['prodCat']=="Cakes") echo "selected"; ?> value="Cakes">Cakes</option>
					<option <?php if ($result['prodCat']=="Cookies") echo "selected"; ?> value="Cookies">Cookies</option>
					<option <?php if ($result['prodCat']=="Cupcakes") echo "selected"; ?> value="Cupcakes">Cupcakes</option>
					<option <?php if ($result['prodCat']=="Donuts") echo "selected"; ?> value="Donuts">Donuts</option>
					<option <?php if ($result['prodCat']=="Tarts") echo "selected"; ?> value="Tarts">Tarts</option>
					<option <?php if ($result['prodCat']=="Other") echo "selected"; ?> value="Other">Other</option>
				</select>
			</div>
		</div>
		<button type="submit" name="btnEditProduct" class="btn waves-effect waves-light right">Edit Product</button>

	</form>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('select').material_select();
});

</script>
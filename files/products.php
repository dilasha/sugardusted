<?php

$product=new Product();
$result=$product->listProduct();
$cat="";
$key="";
$sort="";

if (isset($_POST['btnFilter'])) {
	//search/filter/browse data (a subset of data in product able)
	if(isset($_POST['rdoCat'])){
		$cat=$_POST['rdoCat'];
	}
	if ($_POST['txtKey']) {
		$key=$_POST['txtKey'];
	}
	if ($_POST['ddSort']!="") {
		$sort=$_POST['ddSort'];
	}
}

$product=new Product();
$result=$product->browseProduct($cat, $key, $sort);


if (isset($_POST['btnAddList'])) {
	//add a product to user's list
	$userId=$_SESSION['uid'];
	$prodId=$_POST['txtProdId'];
	//echo "<script>alert('".$userId." and ".$prodId."')</script>";
	$prodL=new ProductList();
	$plAdd=$prodL->addToList($prodId, $userId);
}

?>

<div class="container">
	<div class="row black title-container">
		Our Products
		<p class="title-note">Feed your sugar cravings!</p>
	</div>
	<div class="row content white">
		<div class="content-side">
			<form action="" method="POST">
				<h6 class="black">Filter Products</h6>
				<div class="section group">
					<label class="left">Search by Category</label>
					<br />	
					<div class='col span_1_of_6'>
						<input class="with-gap rdo-filter" name="rdoCat" value="Cakes" type="radio" id="cat1"  />
						<label for="cat1">Cakes</label>
					</div>						
					<div class='col span_1_of_6'>
						<input class="with-gap rdo-filter" name="rdoCat" value="Cookies"  type="radio" id="cat2"  />
						<label for="cat2">Cookies</label>
					</div>						
					<div class='col span_1_of_6'>
						<input class="with-gap rdo-filter" name="rdoCat" value="Cupcakes"  type="radio" id="cat3"  />
						<label for="cat3">Cupcakes</label>
					</div>						
					<div class='col span_1_of_6'>
						<input class="with-gap rdo-filter" name="rdoCat" value="Donuts"  type="radio" id="cat4"  />
						<label for="cat4">Donuts</label>
					</div>						
					<div class='col span_1_of_6'>
						<input class="with-gap rdo-filter" name="rdoCat" value="Tarts" type="radio" id="cat5"  />
						<label for="cat5">Tarts</label>
					</div>						
					<div class='col span_1_of_6'>
						<input class="with-gap rdo-filter" name="rdoCat" value="Others"  type="radio" id="cat6"  />
						<label for="cat6">Others</label>
					</div>
				</div>

				<div class='col span_1_of_3'>
					<label class="left">Search by Keyword</label>
					<input type="text" name="txtKey">
				</div>
				<div class='col span_1_of_3'>
					<label class="left">Sort by</label>
					<select name="ddSort">
						<option value=""></option>
						<option value="nameA">Name (A -> Z)</option>
						<option value="nameZ">Name (Z -> A)</option>
						<option value="dateO">Date added (Old -> New)</option>
						<option value="dateN">Date added (New -> Old)</option>
					</select>
				</div>
				<div class='col span_1_of_3'>
					<button class="btn waves-effect waves-light btn-black" name="btnFilter" type="submit">Filter <i class="fa fa-sort"></i></button>
				</div>
			</div>	
		</form>
		<div class="content-side-p section group">
			<?php
			if($result===false){
				echo "<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> Oops! There were no products matching your search.</div>";
			}else{
				foreach ($result as $key => $value) {

					//DISPLAY products/details

					echo "<div class='col span_1_of_3 image-holder'>";
					$imgUrl=$config['base_url']."uploads/".$result[$key]['prodImg'];
					echo "<div class='row img-holder' style='background-image:url(".$imgUrl."); background-size:cover; background-repeat:no-repeat;'></div>";
					echo "<div class='row p-row'>".$result[$key]['prodName']."</div>";
					echo "<div class='row p-row'>Rs.".$result[$key]['prodRate']."</div>";
					
					//ONLY LOGGED IN USERS CAN ACCESS THE 'ADD TO LIST' functionality	
					if(isset($_SESSION['uid'])){
						echo "<div class='row'>";
						$productId=$result[$key]['prodId'];

						$list=new ProductList();
						$listResult=$list->checkList($productId);
						if ($listResult==0) {
							echo "<form method='post' action=''>";
							echo "<input hidden name='txtProdId' value='".$result[$key]['prodId']."' />";
							echo "<button class='btn-prod' name='btnAddList' type='submit'><i class='fa-white fa fa-plus'></i>    Add to list</button>";
						}else{
							echo "<button disabled class='btn-prod red lighten-4' type='submit'><i class='fa-white fa fa-check'></i>    Added to list</button>";
						}

						echo "</form>";
						echo "</div>";	
					}			
					echo "</div>";			
				}
			}
			?>	
		</div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	$('select').material_select();
});

</script>
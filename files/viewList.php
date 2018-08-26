<?php
include ("includes/session.php");
?>
<div class="container">
	<div class="row black title-container">
		Your list
		<p class="title-note">Bookmark your favorite products!</p>
	</div>
	<div class="row content white content-side">

		<div class="row">
			<table class="responsive-table bordered">
				<thead>
					<th>S.N</th>
					<th>Product</th>
					<th>Category</th>
					<th>Rate</th>
					<th>Remove</th>
				</thead>
				<?php
				$productList=new ProductList();
				$result=$productList->viewList();
				$c=1;
				$tbl="<tr nobr='true'><th><b>Product</b></th><th><b>Category</b></th><th><b>Rate</b></th></tr>";
				if($result===false){
					echo "<div class='error'><i class='fa fa-rose fa-exclamation-triangle'></i> You have not added any items to your list.</div>";
				}else{	
					foreach ($result as $key => $value) {
						$prodId= $result[$key]['prodId'];
						$product=new Product();
						$prodResult=$product->getList($prodId);
						if($prodResult===false){
						}else{	
							foreach ($prodResult as $key => $value) {
								//$tbl stores data to be used in the PDF
								$tbl.="<tr nobr='true'><td>".$prodResult[$key]['prodName']."</td><td>".$prodResult[$key]['prodCat']."</td><td>Rs.".$prodResult[$key]['prodRate']."</td></tr>";
								
								//display data in tabular form
								echo "<tr>";
								echo "<td>$c</td>";
								echo "<td>".$prodResult[$key]['prodName']."</td>";
								echo  "<td>".$prodResult[$key]['prodCat']."</td>";
								echo  "<td>"."Rs.".$prodResult[$key]['prodRate']."</td>";
								echo "<td><a href='index.php?action=removeProduct&id=$prodId'>Remove</a></td>";
								echo "</tr>";
								$c++;
							}	
						}
					}
				}
				?>
			</table>
		</div>
		<div class="row">

		<!--form action page opens in new tab -->
			<form method="POST" action="files/pdfCreate.php" target="_blank">
				<input  type="text" hidden value="<?php echo $tbl; ?>" name="txtTable" />
				<button type="submit" name="btnPdf" class="btn btn-black right">View as PDF</button>
			</form>
		</div>
	</div>
</div>


<div class="row black admin-title-container">
	List of products
</div>
<div class="row">
	<table class="responsive-table bordered">
		<thead>
			<th>S.N</th>
			<th>Product Name</th>
			<th>Image</th>
			<th>Rate</th>
			<th>Category</th>
			<th>Edit</th>
			<th>Delete</th>
		</thead>	
		<?php
		$product=new Product();
		$result=$product->listProduct();
		$c=0;
		//display details of all products in tabular form
		if ($result!=false) {
			
			foreach ($result as $key => $value) {
				$c++;
				echo "<tr>";
				echo "<td>$c</td>";
				echo "<td>".$result[$key]['prodName']."</td>";
				$imgUrl=$config['base_url']."uploads/".$result[$key]['prodImg'];
				echo "<td>"."<img class='table-img' height=200 src='".$imgUrl."' /'>"."</td>";
				echo "<td>".$result[$key]['prodRate']."</td>";
				echo "<td>".$result[$key]['prodCat']."</td>";
				echo "<td><a class='list-link' href='admin_index.php?action=product_edit&id=".$result[$key]['prodId']."'>Edit</a></td>";
				echo "<td><a class='list-link' href='admin_index.php?action=product_delete&id=".$result[$key]['prodId']."'>Delete</a></td>";
				echo "</tr>";
			}

		}else{
		}

		?>
	</table>
</div>

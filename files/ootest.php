<?php

//new objects of ITEM class

$cake=new Item();
$cake->setId(1);
$cake->setQuantity(1);
$cake->setCategory("Cakes");
$cake->setDetails("2 pound, Funfetti cake with birthday message for Emma");

$cookie=new Item();
$cookie->setId(2);
$cookie->setQuantity(15);
$cookie->setCategory("Cookies");
$cookie->setDetails("Cinnamon sugar cookies");

$cupcake=new Item();
$cupcake->setId(3);
$cupcake->setQuantity(9);
$cupcake->setCategory("Cupcakes");
$cupcake->setDetails("Chocolate cupcakes with vanilla icing");

$donut=new Item();
$donut->setId(4);
$donut->setQuantity(6);
$donut->setCategory("Donuts");
$donut->setDetails("Apple Cider donuts");

$macaron=new Item();
$macaron->setId(5);
$macaron->setQuantity(12);
$macaron->setCategory("Others");
$macaron->setDetails("Irish cream macarons");

$brownie=new Item();
$brownie->setId(6);
$brownie->setQuantity(1);
$brownie->setCategory("Others");
$brownie->setDetails("Triple chocolate brownies");

$tart=new Item();
$tart->setId(7);
$tart->setQuantity(2);
$tart->setCategory("Tarts");
$tart->setDetails("Mango tarts");

//add objects made to an array (collection of objects)

$items[0]=$cake;
$items[1]=$cookie;
$items[2]=$cupcake;
$items[3]=$donut;
$items[4]=$macaron;
$items[5]=$brownie;
$items[6]=$tart;

?>

<div class="container">
	<div class="row black title-container">
		OOTEST
		<p class="title-note">Object oriented </p>
	</div>
	<div class="row content white content-side">
		
		<div class="row content-side">
			<label>Note: Data in this table was added using Getters/Setters and displayed using a Collection array</label>
			<table class="">
				<thead>
					<th>Category</th>
					<th>Order Details</th>
					<th>Quantity</th>
				</thead>
				<?php
				//display/get objects in the collection
				foreach ($items as $key => $value) {
					echo "<tr><td>";
					echo $items[$key]->getCategory();
					echo "</td><td>";
					echo $items[$key]->getDetails();
					echo "</td><td>";
					echo $items[$key]->getQuantity();
					echo "</td></tr>";
				}
				?>
			</table>
		</div>
		<div class="row content-side">
			<label>Note: The multiple entries from the first table are deleted through in-memory functionalities.</label>
			<table class="">
				<thead>
					<th>Category</th>
					<th>Order Details</th>
					<th>Quantity</th>
				</thead>
				<?php

				//remove objects from collection(array)
				unset($items[0]);
				unset($items[3]);
				unset($items[6]);

				//display/get objects from collection
				foreach ($items as $key => $value) {
					echo "<tr><td>";
					echo $items[$key]->getCategory();
					echo "</td><td>";
					echo $items[$key]->getDetails();
					echo "</td><td>";
					echo $items[$key]->getQuantity();
					echo "</td></tr>";
				}

				?>
			</table>
		</div>
	</div>
</div>

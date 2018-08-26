<div class="container">
	<!-- static image slider-->
	<div class="slider">
		<ul class="slides">
			<li>
				<img class="slider-img" src="<?php echo $config['base_url'];?>assets/images/slider1.jpg">
			</li>
			<li>
				<img class="slider-img" src="<?php echo $config['base_url'];?>assets/images/slider2.jpg">
			</li>
			<li>
				<img class="slider-img" src="<?php echo $config['base_url'];?>assets/images/slider3.jpg">
			</li>
		</ul>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.slider').slider({full_width: true});
});
</script>
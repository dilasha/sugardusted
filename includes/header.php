
  <!-- div hidden on smaller screens -->
<div class="logo-container  hide-on-med-and-down">
  <a href="index.php?action=home" class="brand-logo center"><img class="logo" src="<?php echo $config['base_url']?>assets/images/fulllogo.png" /></a>
</div>
<nav class="nav z-depth-1">
  <div class="nav-wrapper white">
    <a href="index.php?action=home" class="brand-logo center hide-on-large-only"><img class="logo1" src="<?php echo $config['base_url']?>assets/images/logo1.png" /></a>
    <ul id="nav-mobile" class="hide-on-med-and-down">
      <li><a href="index.php?action=home">Home</a></li>
      <li><a href="index.php?action=about">About</a></li>
      <li><a href="index.php?action=products">Our Products</a></li>
      <li><a href="index.php?action=contact">Contact</a></li>
      <li><a href="index.php?action=ootest">OOTEST</a></li>
    </ul>
    <ul id="nav-mobile" class="hide-on-med-and-down right">
      <?php 
      //links shown depend on session
      if(isset($_SESSION['uid'])){
        echo "<li><a href='index.php?action=viewList'>".$_SESSION['user']."'s list</a></li>";
        echo "<li><a href='index.php?action=profile'>Profile</a></li>";
        echo "<li><a href='index.php?action=logout'>Logout</a></li>";
      }else{
        echo "<li><a href='index.php?action=login'>Login</a></li>"; 
        echo "<li><a href='index.php?action=register'>Register</a></li>"; 
      }
      ?>      
      <li>  <a href="#"><i class="fa fa-black fa-instagram"></i> </a></li>
      <li>  <a href="#"><i class="fa fa-black fa-pinterest-square"></i> </a></li>
      <li>  <a href="#"><i class="fa fa-black fa-bitbucket-square"></i></a> </li>
    </ul>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul class="side-nav" id="mobile-demo">
      <li><a href="index.php?action=home">Home</a></li>
      <li><a href="index.php?action=about">About</a></li>
      <li><a href="index.php?action=products">Our Products</a></li>
      <li><a href="index.php?action=contact">Contact</a></li>
      <li><a href="index.php?action=ootest">OOTEST</a></li>
      <?php 
      if(isset($_SESSION['uid'])){
        echo "<li><a href='index.php?action=viewList'>".$_SESSION['user']."'s list</a></li>";
        echo "<li><a href='index.php?action=profile'>Profile</a></li>";
        echo "<li><a href='index.php?action=logout'>Logout</a></li>";
      }else{
        echo "<li><a href='index.php?action=login'>Login</a></li>"; 
        echo "<li><a href='index.php?action=register'>Register</a></li>"; 
      }
      ?>
    </ul>
  </div>
  <div class="zigzag-bottom"></div>
</nav>
<script type="text/javascript">
//javascript for side nav toggle
$(document).ready(function(){
  $(".button-collapse").sideNav();
  //js for sticky navigation
  var stickyNavTop = $('.nav').offset().top;

  var stickyNav = function(){
    var scrollTop = $(window).scrollTop();

    if (scrollTop > stickyNavTop) { 
      $('.nav').addClass('sticky');
    } else {
      $('.nav').removeClass('sticky'); 
    }
  };

  stickyNav();

  $(window).scroll(function() {
    stickyNav();
  });
});
</script>
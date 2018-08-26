
  <!-- nav is hidden on large screens -->
<nav class="nav z-depth-1  hide-on-large-only black">
  <div class="nav-wrapper black">
    <a href="admin_index.php?action=dashboard" class="brand-logo"><img class="logo1" src="<?php echo $config['base_url']?>assets/images/logo1-w.png" /></a>
    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="fa fa-white fa-bars"></i></a>
    <ul class="side-nav" id="mobile-demo">
      <li><a class="collection-item" href="# ">Welcome, <?php echo $_SESSION['user']; ?>!</a></li>
      <li><a class="collection-item" href="admin_index.php?action=dashboard">Dashboard</a></li>
      <li>   <a class="collection-item" href="admin_index.php?action=user_add">Add user</a> </li>
      <li>   <a class="collection-item" href="admin_index.php?action=user_list">View users</a></li>
      <li>   <a class="collection-item" href="admin_index.php?action=product_add">Add products</a></li>
      <li>   <a class="collection-item" href="admin_index.php?action=product_list">View products</a></li>
      <li>  <a class="collection-item" href="admin_index.php?action=logout">Sign out</a></li>
    </ul>
  </div>
</nav>
<script type="text/javascript">
//javascript to toggle sidebar and make navbar fixed to top
$(document).ready(function(){
  $(".button-collapse").sideNav();
  var stickyNavTop = $('.nav').offset().top;

  var stickyNav = function(){
    var scrollTop = $(window).scrollTop();

    if (scrollTop > stickyNavTop) { 
      $('.nav').addClass('sticky');
    } else {
      $('.nav').removeClass('sticky'); 
    }
  };
  stickyNav();2

  $(window).scroll(function() {
    stickyNav();
  });
});
</script>

  <!-- this div is hidden on smaller screens -->
<div class="row hide-on-med-and-down">
  <div class="collection col s2">   
    <a class="collection-item disabled" href="admin_index.php?action=dashboard"><img class="admin-logo" src="<?php echo $config['base_url']?>assets/images/fulllogo.png" /></a>
    <a class="collection-item">Welcome, <?php echo $_SESSION['user']; ?>!</strong></a>
    <a class="collection-item" href="admin_index.php?action=dashboard">Dashboard</a>
    <a class="collection-item" href="admin_index.php?action=user_add">Add user</a> 
    <a class="collection-item" href="admin_index.php?action=user_list">View users</a>
    <a class="collection-item" href="admin_index.php?action=product_add">Add products</a>
    <a class="collection-item" href="admin_index.php?action=product_list">View products</a>
    <a class="collection-item" href="#"><i class="fa fa-black fa-instagram fa-3x"></i></a>
    <a class="collection-item" href="#"><i class="fa fa-black fa-pinterest-square fa-3x"></i></a>
    <a class="collection-item" href="#"><i class="fa fa-black fa-bitbucket-square fa-3x"></i></a>
    <a class="collection-item" href="admin_index.php?action=logout">Sign out <i class="fa fa-black fa-sign-out"></i></a>
  </div>
</div>
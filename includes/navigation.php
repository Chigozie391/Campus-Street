<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Campus Street</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a class="btn btn-default " href="sell.php">Sell</a></li>
        <li class="dropdown">
          <?php 
          if(is_logged_in()):?>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome 
            <?= $userData['first'];?> <span class="caret"></span></a>
          <?php endif; ?>
          <ul class="dropdown-menu">
            <li><a href="profile.php">Profile</a></li>
            <li><a href="#">Your Ads</a></li>
            <li role="separator" class="divider"></li>
            <?php if(is_admin()): ?>
             <li><a href="admin/index.php">Admin</a></li>
           <?php endif; ?>
           <li><a href="changepassword.php">Change Password</a></li>
           <li><a href="logout.php">Logout</a></li>
         </ul>
       </li>
     </ul>
   </div><!-- /.navbar-collapse -->
 </div><!-- /.container-fluid -->
</nav>
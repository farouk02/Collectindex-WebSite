<nav class="navbar navbar-default top-navbar" role="navigation">
  <div class="navbar-header">
    <a class="navbar-brand" href="index.php"> <strong><?php echo $_SESSION['fullname']; ?></strong> (<small><?php echo $_SESSION['is_admin'] ? 'admin' : 'user'; ?></small>)</a>
  </div>

  <ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
      <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
    </li>
    <!-- /.dropdown -->
  </ul>
</nav>
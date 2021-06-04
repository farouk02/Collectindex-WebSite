<nav class="navbar navbar-default top-navbar" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php"><strong><?php echo $_SESSION['fullname']; ?></strong></a>
  </div>

  <ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
      </a>
      <ul class="dropdown-menu dropdown-alerts">
        <li>
          <a href="#">
            <div>
              <i class="fa fa-comment fa-fw"></i> New Comment
              <span class="pull-right text-muted small">4 min</span>
            </div>
          </a>
        </li>
        <li class="divider"></li>
        <li>
          <a href="#">
            <div>
              <i class="fa fa-twitter fa-fw"></i> 3 New Followers
              <span class="pull-right text-muted small">12 min</span>
            </div>
          </a>
        </li>
        <li class="divider"></li>
        <li>
          <a href="#">
            <div>
              <i class="fa fa-envelope fa-fw"></i> Message Sent
              <span class="pull-right text-muted small">4 min</span>
            </div>
          </a>
        </li>
        <li class="divider"></li>
        <li>
          <a href="#">
            <div>
              <i class="fa fa-tasks fa-fw"></i> New Task
              <span class="pull-right text-muted small">4 min</span>
            </div>
          </a>
        </li>
        <li class="divider"></li>
        <li>
          <a href="#">
            <div>
              <i class="fa fa-upload fa-fw"></i> Server Rebooted
              <span class="pull-right text-muted small">4 min</span>
            </div>
          </a>
        </li>
        <li class="divider"></li>
        <li>
          <a class="text-center" href="#">
            <strong>See All Alerts</strong>
            <i class="fa fa-angle-right"></i>
          </a>
        </li>
      </ul>
      <!-- /.dropdown-alerts -->
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
      </a>
      <ul class="dropdown-menu dropdown-user">
        <li>
          <a href="/ade/changePassword.php"><i class="fa fa-key fa-fw"></i> Reset Password</a>
        </li>
        <li>
          <a href="/ade/settings.php"><i class="fa fa-gear fa-fw"></i> Parametre</a>
        </li>
        <li class="divider"></li>
        <li>
          <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
        </li>
      </ul>
      <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
  </ul>
</nav>
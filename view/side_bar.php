<nav class="navbar-default navbar-side" role="navigation">
  <div id="sideNav" href=""><i class="fa fa-caret-right"></i></div>
  <div class="sidebar-collapse">
    <ul class="nav" id="main-menu">

      <li>
        <a href="/ade/index.php"><i class="fa fa-desktop"></i> HOME</a>
      </li>
      <li>
        <a href="/ade/clients.php"><i class="fa fa-group"></i> CLIENTs</a>
      </li>
      <li>
        <a href="/ade/counters.php"><i class="fa fa-dashboard"></i> COMPTEURs</a>
      </li>
      <?php
      if ($isAdmin) {
        echo '<li><a href="/ade/users.php"><i class="fa fa-sitemap"></i> UTILISATEURs</a></li>';
        echo '<li><a href="/ade/periods.php"><i class="fa fa-clock-o"></i> COLLECT DATEs</a></li>';
      }
      ?>
    </ul>
  </div>
</nav>
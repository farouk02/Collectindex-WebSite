<nav class="navbar-default navbar-side" role="navigation">
  <div id="sideNav" href=""><i class="fa fa-caret-right"></i></div>
  <div class="sidebar-collapse">
    <ul class="nav" id="main-menu">

      <li>
        <a class="active-menu" href="/ade"><i class="fa fa-desktop"></i> HOME</a>
      </li>
      <li>
        <a href="/ade/clients.php"><i class="fa fa-group"></i> CLIENTs</a>
      </li>
      <li>
        <a href="/ade/counters.php"><i class="fa fa-dashboard"></i> COMPTEURs</a>
      </li>
      <?php
      if ($_SESSION['is_admin'] === "1") {
        echo '<li><a href="/ade/users.php"><i class="fa fa-sitemap"></i> UTILISATEURs</a></li>';
        echo '<li><a href="/ade/periods.php"><i class="fa fa-clock-o"></i> COLLECT DATEs</a></li>';
      }
      ?>
      <li>
        <a href="ui-elements.php"><i class="fa fa-clock-o"></i> UI Elements</a>
      </li>
      <li>
        <a href="chart.php"><i class="fa fa-bar-chart-o"></i> Charts</a>
      </li>
      <li>
        <a href="tab-panel.php"><i class="fa fa-qrcode"></i> Tabs & Panels</a>
      </li>

      <li>
        <a href="table.php"><i class="fa fa-table"></i> Responsive Tables</a>
      </li>
      <li>
        <a href="form.php"><i class="fa fa-edit"></i> Forms </a>
      </li>

      <li>
        <a href="#"><i class="fa fa-sitemap"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
          <li>
            <a href="#">Second Level Link</a>
          </li>
          <li>
            <a href="#">Second Level Link</a>
          </li>
          <li>
            <a href="#">Second Level Link<span class="fa arrow"></span></a>
            <ul class="nav nav-third-level">
              <li>
                <a href="#">Third Level Link</a>
              </li>
              <li>
                <a href="#">Third Level Link</a>
              </li>
              <li>
                <a href="#">Third Level Link</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a href="empty.php"><i class="fa fa-fw fa-file"></i> Empty Page</a>
      </li>
    </ul>
  </div>
</nav>
<aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href=""><img src="https://www.pngkey.com/png/full/114-1149847_avatar-unknown-dp.png" class="img-circle" width="80"></a></p>
          <h5 class="centered"><?php echo $_SESSION['SESS_REALNAME']; ?></h5>
          <li class="mt">
            <a class="active" href="index.php">
              <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
              </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-desktop"></i>
              <span>Permohonan</span>
              </a>
            <ul class="sub">
              <li><a href="permohonan.php">Buletin/Kursus</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-cogs"></i>
              <span>Institut</span>
              </a>
            <ul class="sub">
              <li><a href="u_list.php">Senarai</a></li>
              <li><a href="u_list.php">Kursus</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-book"></i>
              <span>Ahli ePIPK</span>
              </a>
            <ul class="sub">
              <li><a href="a_list.php">Senarai</a></li>
              <li><a href="404.html">404 Error</a></li>
              <li><a href="500.html">500 Error</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-tasks"></i>
              <span>eRekod</span>
              </a>
            <ul class="sub">
              <li><a href="s_list.php">Senarai</a></li>
            </ul>
          </li>

          <li>
            <a href="inbox.html">
              <i class="fa fa-envelope"></i>
              <span>Email Notifikasi</span>
              <span class="label label-theme pull-right mail-info">2</span>
              </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class=" fa fa-bar-chart-o"></i>
              <span>Analisis</span>
              </a>
            <ul class="sub">
              <li><a href="morris.html">Morris</a></li>
              <li><a href="chartjs.html">Chartjs</a></li>
              <li><a href="flot_chart.html">Flot Charts</a></li>
              <li><a href="xchart.html">xChart</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-comments-o"></i>
              <span>Live Chat</span>
              </a>
            <ul class="sub">
              <li><a href="lobby.html">Lobby</a></li>
              <li><a href="chat_room.html"> Chat Room</a></li>
            </ul>
          </li>
          <li>
            <a href="">
              <i class="fa fa-map-marker"></i>
              <span>ePIPK Details</span>
              </a>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
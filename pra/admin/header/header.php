 <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.php" class="logo"><b>e<span>PIPK</span></b></a>
      <!--logo end-->
      <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
          <!-- settings start -->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.php#">
              <i class="fa fa-tasks"></i>
              <span class="badge bg-theme"><?php echo $s_notify['buletin']; ?></span>
              </a>
            <ul class="dropdown-menu extended inbox">
              <div class="notify-arrow notify-arrow-green"></div>
              <li>
                <p class="green">ada <?php echo $s_notify['buletin']; ?> buletin</p>
              </li>

              <?php 

$b_mohons = mysqli_query($con,"select timstamp,u_code,SUBSTRING(b_tajuk,1,25) as b_tajuk from buletin um left join university u on u.ID=um.u_ID order by rand() limit 4");

WHILE($b_show=mysqli_fetch_array($b_mohons,MYSQLI_ASSOC)){
              ?>
<li>
                <a href="permohonan.php">
                  <span class="photo"><img alt="avatar" src="https://www.pngkey.com/png/full/114-1149847_avatar-unknown-dp.png"></span>
                  <span class="subject">
                  <span class="from"><?php echo $b_show['u_code']; ?></span>
                  <span class="time"><?php echo $a_show['timstamp']; ?></span>
                  </span>
                  <span class="message">
                  <?php echo $b_show['b_tajuk']; ?>
                  </span>
                  </a>
              </li>

            <?php } ?>
            <!--  <li>
                <a href="index.php#">
                  <div class="task-info">
                    <div class="desc">Database Update</div>
                    <div class="percent">60%</div>
                  </div>
                  <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                      <span class="sr-only">60% Complete (warning)</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="index.php#">
                  <div class="task-info">
                    <div class="desc">Product Development</div>
                    <div class="percent">80%</div>
                  </div>
                  <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                      <span class="sr-only">80% Complete</span>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="index.php#">
                  <div class="task-info">
                    <div class="desc">Payments Sent</div>
                    <div class="percent">70%</div>
                  </div>
                  <div class="progress progress-striped">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                      <span class="sr-only">70% Complete (Important)</span>
                    </div>
                  </div>
                </a>
              </li>
              <li class="external">
                <a href="#">See All Tasks</a>
              </li>-->
            </ul>
          </li>
          <!-- settings end -->
          <!-- inbox dropdown start-->
          <li id="header_inbox_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.php#">
              <i class="fa fa-envelope-o"></i>
              <span class="badge bg-theme"><?php echo $s_notify['a_mohon']; ?></span>
              </a>
            <ul class="dropdown-menu extended inbox">
              <div class="notify-arrow notify-arrow-green"></div>
              <li>
                <p class="green">ada <?php echo $s_notify['a_mohon']; ?> sekolah</p>
              </li>

              <?php 

$a_mohons = mysqli_query($con,"select b_out,um.KODSEKOLAH,u_code,SUBSTRING(b_tajuk,1,25) as b_tajuk from s_sekolah s,a_mohon um left join university u on u.ID=um.u_ID where s.KodSekolah=um.KODSEKOLAH order by rand() limit 4");

WHILE($a_show=mysqli_fetch_array($a_mohons,MYSQLI_ASSOC)){
              ?>

              <li>
                <a href="permohonan.php">
                  <span class="photo"><img alt="avatar" src="https://www.pngkey.com/png/full/114-1149847_avatar-unknown-dp.png"></span>
                  <span class="subject">
                  <span class="from"><?php echo $a_show['KODSEKOLAH']; ?></span>
                  <span class="time"><?php echo $a_show['b_out']; ?></span>
                  </span>
                  <span class="message">
                  <?php echo $a_show['b_tajuk']; ?>
                  </span>
                  </a>
              </li>
            <?php } ?>
            <!--  <li>
                <a href="index.php#">
                  <span class="photo"><img alt="avatar" src="img/ui-divya.jpg"></span>
                  <span class="subject">
                  <span class="from">Divya Manian</span>
                  <span class="time">40 mins.</span>
                  </span>
                  <span class="message">
                  Hi, I need your help with this.
                  </span>
                  </a>
              </li>
              <li>
                <a href="index.php#">
                  <span class="photo"><img alt="avatar" src="img/ui-danro.jpg"></span>
                  <span class="subject">
                  <span class="from">Dan Rogers</span>
                  <span class="time">2 hrs.</span>
                  </span>
                  <span class="message">
                  Love your new Dashboard.
                  </span>
                  </a>
              </li>
              <li>
                <a href="index.php#">
                  <span class="photo"><img alt="avatar" src="img/ui-sherman.jpg"></span>
                  <span class="subject">
                  <span class="from">Dj Sherman</span>
                  <span class="time">4 hrs.</span>
                  </span>
                  <span class="message">
                  Please, answer asap.
                  </span>
                  </a>
              </li>
              <li>
                <a href="index.php#">See all messages</a>
              </li>-->
            </ul>
          </li>
          <!-- inbox dropdown end -->
          <!-- notification dropdown start-->
          <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.php#">
              <i class="fa fa-bell-o"></i>
              <span class="badge bg-warning"><?php echo $s_notify['u_mohon']; ?></span>
              </a>
            <ul class="dropdown-menu extended notification">
              <div class="notify-arrow notify-arrow-yellow"></div>
              <li>
                <p class="yellow">Ada <?php echo $s_notify['u_mohon']; ?> permohonan ke institut</p>
              </li>
              <?php 

$u_mohons = mysqli_query($con,"select u_code,SUBSTRING(nama,1,25) as nama from u_mohon um,murid m,university u where u.ID=um.u_ID and m.no_kp=um.m_nokp order by rand() limit 7");

WHILE($s_show=mysqli_fetch_array($u_mohons,MYSQLI_ASSOC)){
              ?>
              <li>
                <a href="permohonan.php">
                
                  <?php echo $s_show['u_code']; ?>
                  <span class="small italic">oleh <?php echo $s_show['nama']; ?></span>
                  </a>
              </li>
              <?php } ?>
              <!--<li>
                <a href="index.php#">
                  <span class="label label-warning"><i class="fa fa-bell"></i></span>
                  Memory #2 Not Responding.
                  <span class="small italic">30 mins.</span>
                  </a>
              </li>
              <li>
                <a href="index.php#">
                  <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                  Disk Space Reached 85%.
                  <span class="small italic">2 hrs.</span>
                  </a>
              </li>
              <li>
                <a href="index.php#">
                  <span class="label label-success"><i class="fa fa-plus"></i></span>
                  New User Registered.
                  <span class="small italic">3 hrs.</span>
                  </a>
              </li>-->
              <li>
                <a href="index.php#">See all notifications</a>
              </li>
            </ul>
          </li>
          <!-- notification dropdown end -->
        </ul>
        <!--  notification end -->
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="../logout.php">Logout</a></li>
        </ul>
      </div>
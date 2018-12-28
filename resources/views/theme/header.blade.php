<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Call-Q Reporting Service</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/user.jpg" alt="..." class="img-circle profile_img">

              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php 
                  $user_info = Session::get('user_info');
                  echo $user_info->FirstName." ".$user_info->LastName;
                  ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu ">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ url('/my-home') }}" ><i class="fa fa-home"></i> Home </a>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Reports <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="{{ url('/exe-summary') }}">Executive Call Summary</a></li>
                        <li><a href="{{ url('/network-summary') }}">Network Call Summary</a></li>
                        <li><a href="{{ url('/statical-summary') }}" >Statistical History</a></li>
                        <li><a href="{{ url('/web-summary') }}">Website Summary</a></li>
                        <li><a href="{{ url('/top-cities') }}">Top Cities</a></li>
                        <li><a href="{{ url('/top-countries') }}">Top Countries </a></li>
                        <li><a href="{{ url('/stats-countries') }}">Country Station Breakdown</a></li>
                        <li><a href="{{ url('/top-prayers') }}">Top Prayers</a></li>
                        <li><a href="{{ url('/gender-break') }}">Gender Breakdown</a></li>
                        <li><a href="{{ url('/minute-log') }}">Minute Log </a></li>
                        <li><a href="{{ url('/hour-log') }}">Hourly Log</a></li>
                        <li><a href="{{ url('/map-calls') }}">Map Calls</a></li>
                        <li><a href="{{ url('/hourly168') }}">7 Day Call Comparison</a></li>
                        
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i> Call Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="general_elements.html">Download Data</a></li>
                      <li><a href="media_gallery.html">Call Recording </a></li>

                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> administrator <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Request Number </a></li>
                      <li><a href="tables_dynamic.html">Active  Number</a></li>
                    </ul>
                  </li>

                </ul>
              </div>


            </div>
            <!-- sidebar menu -->

            <!-- menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout"  href="/logout" >
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- menu footer buttons -->
          </div>
        </div>
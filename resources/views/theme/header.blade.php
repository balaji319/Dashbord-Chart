<!--
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Call-Q Reporting Service</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reports<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Executive Call Summary</a></li>
            <li><a href="#">Network Call Summary</a></li>
            <li><a href="#">Statistical History</a></li>
          </ul>
        </li>
         <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reports<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Executive Call Summary</a></li>
            <li><a href="#">Network Call Summary</a></li>
            <li><a href="#">Statistical History</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reports<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Executive Call Summary</a></li>
            <li><a href="#">Network Call Summary</a></li>
            <li><a href="#">Statistical History</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">


        <li><a href="/logout"><i class="glyphicon glyphicon-log-in"></i> Logout</a>

            </li>
      </ul>
    </div>
  </div>
<img src="images/PUFC1.jpeg" alt="..." class="img-circle profile_img">
 -->


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
                <h2>John Doe</h2>
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
                        <li><a href="#">Website Summary</a></li>
                        <li><a href="#">Top Cities</a></li>
                        <li><a href="#">Top Countries </a></li>
                        <li><a href="#">Country Station Breakdown</a></li>
                        <li><a href="#">Top Prayers</a></li>
                        <li><a href="#">Gender Breakdown</a></li>
                        <li><a href="#">Minute Log </a></li>
                        <li><a href="#">Hourly Log</a></li>
                        <li><a href="#">Map Calls</a></li>
                        <li><a href="#">7 Day Call Comparison</a></li>

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

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
              <nav>
                {{-- <div class="nav toggle">

                </div> --}}

                <ul class="nav navbar-nav ">
                    <li><a href="{{ url('/my-home') }}" ><i class="fa fa-home"></i> Home </a>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <b class="caret"></b></a>
                      <ul class="dropdown-menu">

                          <li><a href="{{ url('/exe-summary') }}">Executive Call Summary</a></li>
                          <li><a href="{{ url('/network-summary') }}">Network Call Summary</a></li>
                          <li><a href="{{ url('/statical-summary') }}" >Statistical History</a></li>
                          <li><a href="{{ url('/web-summary') }}">Website Summary</a></li>
                          <li><a href="{{ url('/topcities') }}">Top Cities</a></li>
                          <li><a href="{{ url('/topcountries') }}">Top Countries </a></li>
                          <li><a href="{{ url('/stats-countries') }}">Country Station Breakdown</a></li>
                          <li><a href="{{ url('/top-prayers') }}">Top Prayers</a></li>
                          <li><a href="{{ url('/gender-break') }}">Gender Breakdown</a></li>
                          <li><a href="{{ url('/minute-log') }}">Minute Log </a></li>
                          <li><a href="{{ url('/hour-log') }}">Hourly Log</a></li>
                          <li><a href="{{ url('/map-calls') }}">Map Calls</a></li>
                          <li><a href="{{ url('/hourly168') }}">7 Day Call Comparison</a></li>
                      </ul>
                  </li>
                  <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Call Data <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('downloaddata') }}">Download Data</a></li>
                        <li><a href="{{ url('callrecording') }}">Call Recording </a></li>
                      </ul>
                </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrator <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                      <li><a href="{{ url('requestnumber') }}">Request Number </a></li>
                      <li><a href="{{ url('activenumbers') }}">Active  Number</a></li>
                    </ul>
              </li>
                  <li class=""style="float: right;" >
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <img src="images/img.jpg" alt=""><?php
                      $user_info = Session::get('user_info');
                      echo $user_info->FirstName." ".$user_info->LastName;
                      ?>
                      <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">

                      <li><a href="javascript:;">Help</a></li>
                      <li><a href="/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                  </li>

                </ul>


              </nav>
            </div>
          </div>
          <!-- top navigation -->
          <style>
          .nav.navbar-nav>li>a{
            color: #ffffff!important;
          }
          .nav_menu {
    float: left;
    background: #39f;
    border-bottom: 1px solid #3697fa;
    margin-bottom: 10px;
    width: 100%;
    position: relative;
    color: white;}
          </style>
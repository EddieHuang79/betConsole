<header class="main-header">
<!-- Logo -->
<a href="/admin_index" class="logo">
  <b>{{ $txt['Site'] }}</b>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->
      <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-envelope-o"></i>
          <span class="label label-success">{{ $msg_cnt }}</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">{{ $txt["You_have"] }} {{ $msg_cnt }} {{ $txt["messages"] }}</li>
          <li>

            <ul class="menu">

              @if( $msg_cnt > 0 )
                @foreach($msg_list as $row)
                <li>
                  <a href="#">
                    <h4>
                      {{ $row->subject }}
                      <small><i class="fa fa-clock-o"></i> {{ $row->updated_at }} </small>
                    </h4>
                    <p>{{ $row->content }}</p>
                  </a>
                </li>
                @endforeach
              @else
                <li>
                  <a href="#">
                    <h4>{{ $txt["find_nothing"] }}</h4>
                  </a>
                </li>
              @endif

            </ul>
          </li>
          <li class="footer"><a href="/msg?type=1">See All Messages</a></li>
        </ul>
      </li>
      <!-- Notifications: style can be found in dropdown.less -->
      <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
          <span class="label label-warning">{{ $sys_msg_cnt }}</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">{{ $txt["You_have"] }} {{ $sys_msg_cnt }} {{ $txt["messages"] }}</li>
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">

              @if( $sys_msg_cnt > 0 )
                @foreach($sys_msg_list as $row)
                <li>
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> {{ $row->content }}
                  </a>
                </li>
                @endforeach
              @else
                <li>
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> {{ $txt["find_nothing"] }}
                  </a>
                </li>                
              @endif

            </ul>
          </li>
          <li class="footer"><a href="/msg?type=2">View all</a></li>
        </ul>
      </li>
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{ URL::asset($data->photo) }}" class="user-image" alt="User Image">
          <span class="hidden-xs">{{ $user['real_name'] }}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="{{ URL::asset($data->photo) }}" class="img-circle" alt="User Image">
            <p>
              {{ $user['real_name'] }}
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-right">
              <a href="/logout" class="btn btn-default btn-flat">{{ $txt['logout'] }}</a>
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
@if(!empty($popup_msg))
<div class="lightbox">
  <div class="subject">{{ $popup_msg["subject"] }} <label class="close_btn"> X </label> </div>
  <hr>
  <div class="content">{{ $popup_msg["content"] }} </div>
</div>
@endif
</header>
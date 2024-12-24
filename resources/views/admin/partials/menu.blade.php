  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('img/'. $page_setting->ikon)}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ $page_setting->page_name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION </li>
        <li class="treeview">
          <a href="{{ route('admin.dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        @if(session('user-menu'))
        @foreach(session('user-menu') as $menu)
        @if (!empty($menu['children']))
        <li class="treeview">
          <a href="#menu-{{ $menu['id'] }}">
            <i class="fa {{ $menu['icon'] }}"></i>
            <span>{{ $menu['name'] }}</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @foreach ($menu['children'] as $child)
            <li>
              <a href="{{ $child['route'] !== '#' ? route($child['route']) : '#' }}">
                <i class="fa fa-circle-o"></i> {{ $child['name'] }}
              </a>
            </li>
            @endforeach
          </ul>
        </li>
        @else
        <li>
          <a href="{{ $menu['route'] !== '#' ? route($menu['route']) : '#' }}">
            <i class="fa {{ $menu['icon'] }}"></i> <span>{{ $menu['name'] }}</span>
          </a>
        </li>
        @endif
        @endforeach
        @else
        <p>No menu available</p>
        @endif

        @if (auth()->user()->tipe == '99')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-gear"></i>
            <span>Setting</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="">
              <a href="{{ route('admin.banner')}}"><i class="fa fa-circle-o"></i> Banner</a>
            </li>
            <li class="">
              <a href="{{ route('admin.role')}}"><i class="fa fa-circle-o"></i> Userrole</a>
            </li>
            <li class=""><a href="{{ route('admin.usermanager')}}"><i class="fa fa-circle-o"></i> Usermanager</a></li>
            <li class=""><a href="{{ route('admin.menu')}}"><i class="fa fa-circle-o"></i> Menu</a></li>
            <li class=""><a href="{{ route('admin.title')}}"><i class="fa fa-circle-o"></i> Title</a></li>
            <li class=""><a href="{{ route('admin.permalink')}}"><i class="fa fa-circle-o"></i> Permalink</a></li>
            <li class=""><a href="{{ route('admin.limitberita')}}"><i class="fa fa-circle-o"></i> Limit Berita</a></li>
            <li class=""><a href="{{ route('admin.footer')}}"><i class="fa fa-circle-o"></i> Footer</a></li>
            <li class="">
              <a href="#"><i class="fa fa-circle-o"></i> Meta <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li class=""><a href="{{ route('admin.keyword')}}"><i class="fa fa-circle-o"></i> Keyword</a></li>
                <li class=""><a href="{{ route('admin.description')}}"><i class="fa fa-circle-o"></i> Description</a></li>
              </ul>
            </li>
          </ul>
        </li>
        @endif
    </section>
    <!-- /.sidebar -->
  </aside>
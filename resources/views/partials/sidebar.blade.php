<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('adminlte/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Letteria</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}"
                        class="nav-link {{ Request::url()==route('admin.home')?'active':'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            لوحة التحكم
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.reservation.index') }}"
                        class="nav-link {{ Request::url()==route('admin.reservation.index')?'active':'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            الحجوزات
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.interval.index') }}"
                        class="nav-link {{ Request::url()==route('admin.interval.index')?'active':'' }}">
                        <i class="nav-icon fas fa-calendar-week"></i>
                        <p>
                            فترات الحجز
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.setting.index') }}"
                        class="nav-link {{ Request::url()==route('admin.setting.index')?'active':'' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            الاعدادات
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.home_page_setting.index') }}"
                        class="nav-link {{ Request::url()==route('admin.home_page_setting.index')?'active':'' }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            اعدادات الصفحة الرئيسية
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

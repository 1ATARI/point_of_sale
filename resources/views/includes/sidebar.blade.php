<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard.welcome')}}" class="brand-link">
        <img src="{{asset('adminlte3/dist/img/point.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{trans('msite.point_of_sale')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{auth()->user()->image_path}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->first_name .' '. auth()->user()->last_name }}</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{route('dashboard.welcome')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{trans('msite.Dashboard')}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    @if(auth()->user()->hasPermission('categories_read'))
                        <a href="{{route('dashboard.categories.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                {{trans('msite.categories')}}
                            </p>
                        </a>
                    @endif
                </li>

                <li class="nav-item">
                    @if(auth()->user()->hasPermission('products_read'))
                        <a href="{{route('dashboard.products.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-tree"></i>
                            <p>
                                {{trans('msite.products')}}
                            </p>
                        </a>
                    @endif
                </li>



                <li class="nav-item">
                    @if(auth()->user()->hasPermission('clients_read'))
                        <a href="{{route('dashboard.clients.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                {{trans('msite.clients')}}
                            </p>
                        </a>
                    @endif
                </li>


                <li class="nav-item">
                    @if(auth()->user()->hasPermission('orders_read'))
                        <a href="{{route('dashboard.orders.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-person-booth"></i>
                            <p>
                                {{trans('msite.orders')}}
                            </p>
                        </a>
                    @endif
                </li>




                <li class="nav-item">
                    @if(auth()->user()->hasPermission('users_read'))
                        <a href="{{route('dashboard.users.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                {{trans('msite.users')}}
                            </p>
                        </a>
                    @endif
                </li>




            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

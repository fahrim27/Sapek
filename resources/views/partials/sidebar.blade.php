@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>

            
            @can('category_access')
            <li class="{{ $request->segment(2) == 'category' ? 'active' : '' }}">
                <a href="{{ route('admin.category.index') }}">
                    <i class="fa fa-list-alt"></i>
                    <span class="title">@lang('Category')</span>
                </a>
            </li>
            @endcan
            
            @can('celoteh_access')
            <li class="{{ $request->segment(2) == 'celoteh' ? 'active' : '' }}">
                <a href="{{ route('admin.celoteh.index') }}">
                    <i class="fa fa-product-hunt"></i>
                    <span class="title">@lang('Product')</span>
                </a>
            </li>
            @endcan

            @can('celoteh_access')
            <li class="{{ $request->segment(2) == 'list' ? 'active' : '' }}">
                <a href="{{ route('admin.list.index') }}">
                    <i class="fa fa-percent"></i>
                    <span class="title">@lang('Discount')</span>
                </a>
            </li>
            @endcan
            
            @can('payment_access')
            <li class="{{ $request->segment(2) == 'payments' ? 'active' : '' }}">
                <a href="">
                    <i class="fa fa-credit-card"></i>
                    <span class="title">@lang('quickadmin.payments.title')</span>
                </a>
            </li>
            @endcan


            @can('blog_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="title">@lang('Blog Management')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('tags_access')
                <li class="{{ $request->segment(2) == 'tags' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.tags.index') }}">
                            <i class="fa fa-tag"></i>
                            <span class="title">
                                @lang('Blog Tags')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('blog_access')
                <li class="{{ $request->segment(2) == 'blog' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.blog.index') }}">
                            <i class="fa fa-sticky-note-o"></i>
                            <span class="title">
                                @lang('Posts')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan

            
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan

            

            

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Change password</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('quickadmin.logout')</button>
{!! Form::close() !!}

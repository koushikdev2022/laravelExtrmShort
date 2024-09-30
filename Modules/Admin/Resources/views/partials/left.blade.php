<ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false"
    data-auto-scroll="true" data-slide-speed="200">
    <li class="nav-item {{ Request::route()->getName() === 'admin-dashboard' ? 'active' : '' }}">
        <a href="{{ Route('admin-dashboard') }}" class="nav-link nav-toggle">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
    </li>


    <li class="nav-item {{ Request::route()->getName() === 'admin-myprofile' ? 'active' : '' }}">
        <a href="{{ Route('admin-myprofile') }}" class="nav-link nav-toggle">
            <i class="icon-wrench"></i>
            <span class="title">Account Settings</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>

    {{-- <li class="nav-item {{ (Request::route()->getName() === 'admin-payment') ? 'active' : '' }}">
        <a href="{{ Route('admin-payment') }}" class="nav-link nav-toggle">
            <i class="icon-wrench"></i>
            <span class="title">Payment Reqests</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li> --}}

    {{-- <li class="nav-item {{ (Request::route()->getName() === 'admin-report') ? 'active' : '' }}">
        <a href="{{ Route('admin-report') }}" class="nav-link nav-toggle">
            <i class="icon-wrench"></i>
            <span class="title">Inappropriate Reports</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li> --}}

    {{-- <li class="nav-item {{ (Request::route()->getName() === 'review') ? 'active' : '' }}">
        <a href="{{ Route('reivew') }}" class="nav-link nav-toggle">
            <i class="icon-wrench"></i>
            <span class="title">Review</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li> --}}
    {{-- <li class="nav-item {{ (Request::route()->getName() === 'admin-support') ? 'active' : '' }}">
        <a href="{{ Route('admin-support') }}" class="nav-link nav-toggle">
            <i class="icon-wrench"></i>
            <span class="title">Support</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li> --}}

   
    <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin-category','admin-category-create','admin-subcategory','admin-category-edit']) ? 'active' : '' }}">
        <a href="{{ Route('admin-category') }}" class="nav-link nav-toggle">
            <i class="fa fa-sitemap" aria-hidden="true"></i>
            <span class="title">Category Management</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>

    <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin-blog','admin-addblog','admin-editblog']) ? 'active' : '' }}">
        <a href="{{ Route('admin-blog') }}" class="nav-link nav-toggle">
            <i class="fa fa-sitemap" aria-hidden="true"></i>
            <span class="title">Blog Management</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    {{-- <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-subscriptionplan','admin-plan-list-datatable','admin-addsunscriptionplan','admin-editsunscriptionplan'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-subscriptionplan') }}" class="nav-link nav-toggle">
            <i class="fa fa-hand-peace-o" aria-hidden="true"></i>
            <span class="title">Subscription Plan Mangement</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li> --}}
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-contact', 'admin-viewcontact'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-contact') }}" class="nav-link nav-toggle">
            <i class="fa fa-phone"></i>
            <span class="title">Contact Us</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>

    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-career', 'admin-viewcareer'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-career') }}" class="nav-link nav-toggle">
            <i class="fa fa-graduation-cap"></i>
            <span class="title">Careers</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>

   
    <li
        class="nav-item {{ in_array(Route::currentRouteName(), ['admin-video', 'admin-viewvideo']) ? 'active' : '' }}">
        <a href="{{ Route('admin-video') }}" class="nav-link nav-toggle">
            <i class="fa fa-suitcase"></i>
            <span class="title">Video Management</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>

    <li
        class="nav-item {{ in_array(Route::currentRouteName(), ['admin-keyword','admin-addkeyword', 'admin-editkeyword']) ? 'active' : '' }}">
        <a href="{{ Route('admin-keyword') }}" class="nav-link nav-toggle">
            <i class="fa fa-suitcase"></i>
            <span class="title">Keyword Management</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li
        class="nav-item {{ in_array(Route::currentRouteName(), ['admin-order','admin-vieworder']) ? 'active' : '' }}">
        <a href="{{ Route('admin-order') }}" class="nav-link nav-toggle">
            <i class="fa fa-suitcase"></i>
            <span class="title">Order Management</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li
        class="nav-item {{ in_array(Route::currentRouteName(), ['admin-commission', 'admin-viewcommission','admin-addcommission','admin-addcommission']) ? 'active' : '' }}">
        <a href="{{ Route('admin-commission') }}" class="nav-link nav-toggle">
            <i class="fa fa-suitcase"></i>
            <span class="title">Commission Management</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li
        class="nav-item {{ in_array(Route::currentRouteName(), ['admin-requested-amount', 'admin-viewrequested-amount']) ? 'active' : '' }}">
        <a href="{{ Route('admin-requested-amount') }}" class="nav-link nav-toggle">
            <i class="fa fa-suitcase"></i>
            <span class="title">Requested Fund Management</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-testimonial', 'admin-addtestimonial', 'admin-edittestimonial'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-testimonial') }}" class="nav-link nav-toggle">
            <i class="fa fa-graduation-cap"></i>
            <span class="title">Testimonial</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-producing_with_us', 'admin-addproducing_with_us', 'admin-editproducing_with_us'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-producing_with_us') }}" class="nav-link nav-toggle">
            <i class="fa fa-graduation-cap"></i>
            <span class="title">Producing With Us</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li
        class="nav-item {{ in_array(Route::currentRouteName(), ['admin-transaction', 'admin-viewtransaction']) ? 'active' : '' }}">
        <a href="{{ Route('admin-transaction') }}" class="nav-link nav-toggle">
            <i class="fa fa-suitcase"></i>
            <span class="title">Transaction Management</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-cms', 'admin-viewcms', 'admin-updatecms'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-cms') }}" class="nav-link nav-toggle">
            <i class="fa fa-picture-o"></i>
            <span class="title">CMS</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-user','admin-adduser','admin-user-list-datatable','admin-updateuser','admin-viewuser'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-user') }}" class="nav-link nav-toggle">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span class="title">Users</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>

    <li
        class="nav-item {{ in_array(Route::currentRouteName(), ['admin-reports-user', 'admin-reports-order','admin-reports-payments']) ? 'active' : '' }}">
        <a href="javascript:void(0)" class="nav-link nav-toggle">
            <i class="fa fa-suitcase"></i>
            <span class="title">Reports</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item {{ in_array(Route::currentRouteName(), ['admin-reports-user']) ? 'active' : '' }}">
                <a href="{{ route('admin-reports-user') }}" class="nav-link">
                    <i class="fa fa-user"></i>
                    <span class="title">User</span>
                </a>
            </li>
            <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-reports-order'])) ? 'active' : '' }}">
                <a href="{{route('admin-reports-order')}}" class="nav-link">
                    <i class="fa fa-suitcase"></i>
                    <span class="title">Orders</span>
                </a>
            </li>
            <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-reports-payments'])) ? 'active' : '' }}">
                <a href="{{route('admin-reports-payments')}}" class="nav-link">
                    <i class="fa fa-user"></i>
                    <span class="title">Payments</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-faqs', 'admin-createfaq', 'admin-viewfaq', 'admin-updatefaq'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-faqs') }}" class="nav-link nav-toggle">
            <i class="fa fa-question"></i>
            <span class="title">Faqs</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li
        class="nav-item {{ in_array(Route::currentRouteName(), ['admin-emails', 'admin-viewemail', 'admin-updateemail']) ? 'active' : '' }}">
        <a href="{{ Route('admin-emails') }}" class="nav-link nav-toggle">
            <i class="icon-envelope"></i>
            <span class="title">Emails</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (Request::route()->getName() === 'admin-settings') ? 'active' : '' }}">
        <a href="{{ Route('admin-settings') }}" class="nav-link nav-toggle">
            <i class="fa fa-cog"></i>
            <span class="title">Global Settings</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    {{-- <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-seo', 'admin-viewseo', 'admin-updateseo'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-seo') }}" class="nav-link nav-toggle">
            <i class="icon-list"></i>
            <span class="title">SEO</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li> --}}

</ul>

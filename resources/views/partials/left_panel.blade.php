<!--MOBILE MENU START-->
<div class="offcanvas offcanvas-start mobile-menu" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" />
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i class="icofont-close"></i></button>
    </div>
    <div class="offcanvas-body">
        <div class="container-fluid pt-3 pb-3 border-bottom">
        <div class="row mx-0">
                @if (!Auth::guard('frontend')->check())
                <div class="col-4 px-1">
                    <a class="btnOutlineSignup" href="{{ Route('login') }}">Log In</a>
                </div>
                <div class="col-4 px-1">
                    <a class="btnFillSignup" href="{{ Route('signup') }}">Sign Up</a>
                </div>
                <div class="col-4 px-1">
                    <a class="btnFillSignup" href="{{ Route('project-create') }}"><i class="icofont-upload-alt iconposition me-1"></i>Upload</a>
                </div>
                 @elseif (Auth::guard('frontend')->check())
               
           <div class="col-4 px-1">
               <a class="btnOutlineSignup" href="{{ Route('logout') }}">Logout</a>
           </div>
           <div class="col-4 px-1">
                    <a class="btnFillSignup" href="{{ Route('dashboard') }}">Dashboard</a>  
                </div>
                <div class="col-4 px-1">
                    <a class="btnFillSignup" href="{{ Route('project-create') }}"><i class="icofont-upload-alt iconposition me-1"></i>Upload</a>
                </div>
                  @endif
        </div>
            </div>
        <ul class="menu">
            <li><a href="{{ Route('about-us') }}">About US</a></li>
            <li><a href="{{ Route('contact-us') }}">Contact Us</a></li>
            <li><a href="{{ Route('how_it_works') }}">How It Works</a></li>
            <li><a href="{{ Route('blog') }}">Blog</a></li>
            <!-- <li class="m-has-submenu">
                <a data-bs-toggle="collapse" href="#dpdn1" role="button" aria-expanded="false">Footage</a>
                <ul class="collapse" id="dpdn1">
                    <li><a href="#">Footage 1</a></li>
                    <li><a href="#">Footage 2</a></li>
                    <li><a href="#">Footage 3</a></li>
                </ul>
            </li> -->
            <li class="m-has-submenu">
                <a data-bs-toggle="collapse" href="#dpdn2" role="button" aria-expanded="false">Categories</a>
                <ul class="collapse" id="dpdn2">
                    <!-- <li><a href="#">Category 1</a></li>
                    <li><a href="#">Category 2</a></li>
                    <li><a href="#">Category 3</a></li> -->
                    @if (isset($categories[0]))
                    @foreach ($categories as $cat)
                    <li><a href="{{ Route('listing') }}">{{ $cat->category_name }}</a></li>
                    @endforeach
                    @else
                    <li><a href="#">No Category Found</a></li>
                    @endif
                </ul>
            </li>
            <li><a href="{{ Route('priceChart')}}">Prices</a></li>
<!--            @if (!Auth::guard('frontend')->check())
            <li class="signup"><a href="{{ Route('signup') }}">Sign up</a></li>
            <li class="login"><a href="{{ Route('login') }}">Log in</a></li>

            @elseif (Auth::guard('frontend')->check())
            <li><a href="{{ Route('dashboard') }}">Dashboard</a></li>
            <li><a href="{{ Route('logout') }}">Logout</a></li>

            @endif-->
        </ul>
    </div>
</div>

<!--MOBILE MENU END-->
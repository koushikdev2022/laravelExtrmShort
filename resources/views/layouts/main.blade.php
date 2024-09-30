<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name')}}</title>
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('public/frontend/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/dashboard/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/dashboard/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/dashboard/css/icofont.css') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/dashboard/css/font-awesome.min.css') }}" />
    <link href="{{ URL::asset('public/frontend/dashboard/css/select2.min.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/dashboard/css/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/dashboard/css/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/dashboard/css/dashboard_responsive.css') }}" />

    <link rel="stylesheet" href="{{ URL::asset('public/frontend/dashboard/css/newcss.css') }}" />
    <link rel="stylesheet" href="{{URL::asset('public/frontend/css/notie.min.css')}}" />

    @yield('css')
    <script type="text/javascript">
        var full_path = '<?= url('/') . '/'; ?>';
        var logged_in = '<?= (Auth()->guard('frontend')->guest()) ? false : true; ?>';
        var currentroute = '{{Request::route()->getName()}}';
    </script>
</head>

<body>
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- Show Video Modal -->
    <div class="modal cuustomfont videomodal fade" id="showVideo" tabindex="-1" role="dialog" aria-labelledby="showVideoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showVideoLabel">Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icofont-close-circled"></i></span>
                    </button>
                </div>
                <div class="modal-body" id="videoPlayer">

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn cmnbtnnw videoPlayerdetails">View Details</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end of dashboard right section -->
    <a href="#" class="scroll_top" id="scroll_top" style="display: none;"><i class="icofont-long-arrow-up"></i></a>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('public/frontend/dashboard/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/dashboard/js/bootstrap-select.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/dashboard/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/dashboard/js/jquery.nicescroll.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('public/frontend/js/script.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('public/frontend/js/notie.min.js') }}"></script>

    <script type="text/javascript">
        var $ = jQuery;
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('#scroll_top').show();
                } else {
                    $('#scroll_top').hide();
                }
            });
            $('#scroll_top').click(function() {
                $("html, body").animate({
                    scrollTop: 0
                }, 1500);
                return false;
            });
        });
        $("#sidebarToggle").on('click', function(e) {
            e.preventDefault();
            $("body").toggleClass("sidebar-toggled");
            $(".user-dash-right").toggleClass("slide-right-side");
            $(".user-left-side").toggleClass("toggled");
        });
        $("#MobilesidebarToggle").click(function() {
            $(".mobile-menu-link").toggle('2000');
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        //VIDEO PLAY HOVER
        $('.dash_grid_box').on('mouseover mouseout', function(e) {
            const evt = e.type;
            if (evt === 'mouseover') {
                $(this).find('.grid_video').children("video").trigger('play');
            }
            if (evt === 'mouseout') {
                $(this).find('.grid_video').children("video").trigger('pause');
            }
        });

        //GRID VIEW LIST VIEW
        $('.view_gropad a.list_icon').on('click', function() {
            $('.view_gropad a').removeClass('active');
            $(this).addClass('active');
            $('.view-box').removeClass('view-as-grid');
            $('.view-box').addClass('view-as-list');
        });
        $('.view_gropad a.grid_icon').on('click', function() {
            $('.view_gropad a').removeClass('active');
            $(this).addClass('active');
            $('.view-box').removeClass('view-as-list');
            $('.view-box').addClass('view-as-grid');
        });
    </script>
    <script>
        function toggleIcon(e) {
            $(e.target).prev('.panel-heading').find(".more-less").toggleClass('icofont-simple-down icofont-simple-up');
        }
        $('.panel-group').on('hidden.bs.collapse', toggleIcon);
        $('.panel-group').on('shown.bs.collapse', toggleIcon);
    </script>
    @yield('js')
</body>

</html>
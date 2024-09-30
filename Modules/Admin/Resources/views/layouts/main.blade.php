<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript">
        var full_path = '<?= url('/') . '/admin/'; ?>';
        var base_path = '<?= url('/') . ''; ?>';
    </script>
    <meta charset="UTF-8">
    <title>{{env('PROJECT_NAME', 'Xtremelongshot Admin')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="{{ URL::asset('//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('storage/backend/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('storage/backend/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('storage/backend/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('storage/backend/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('storage/backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('storage/backend/assets/global/css/components.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('storage/backend/assets/global/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('storage/backend/assets/layouts/layout2/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('storage/backend/assets/layouts/layout2/css/themes/blue.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('storage/backend/assets/layouts/layout2/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('storage/backend/assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('storage/backend/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('storage/backend/custom/lobibox/lobibox.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('storage/backend/css/jquery-confirm.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('storage/backend/custom/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{URL::asset('storage/backend/custom/select2/select2.min.css')}}" />
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <link href="{{ URL::asset('storage/backend/assets/global/plugins/loader/loading.css') }}" type="text/css">
    <link rel="shortcut icon" href="{{ URL::asset('public/frontend/images/favicon.ico') }}">
    <!-- <link rel="shortcut icon" href="{{ URL::asset('storage/frontend/images/fav-icon.png') }}"> -->
    <script defer src="{{URL::asset('storage/frontend/js/alpine.min.js')}}" type="text/javascript"></script>

    @yield('css')
    @if (in_array(Request::route()->getName(),['admin-updateuser','admin-project.edit']))
    @livewireStyles
    <link rel="stylesheet" href="{{URL::asset('storage/frontend/dashboard/plugins/drag-drop-upload-zone/dist/css/simpledropit.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('storage/frontend/dashboard/css/dashboard.css')}}" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('storage/frontend/dashboard/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('storage/frontend/dashboard/css/icofont.css')}}" />

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> -->
    <!-- <script src="{{URL::asset('storage/frontend/dashboard/js/bootstrap-select.js')}}"></script> -->
    <script src="{{URL::asset('storage/frontend/dashboard/js/jquery.nicescroll.js')}}"></script>
    <script defer src="{{URL::asset('storage/frontend/js/alpine.min.js')}}" type="text/javascript"></script>

    <script src="{{URL::asset('storage/frontend/dashboard/plugins/drag-drop-upload-zone/dist/js/simpledropit.js')}}"></script>
    @livewireScripts
    @stack('head')
    @endif
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid" style="background-color: #26344B;font-family: 'Open Sans',sans-serif;">
    <!-- BEGIN HEADER -->
    @include('admin::partials.header')
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- END SIDEBAR -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                @include('admin::partials.left')
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <ul class="breadcrumb">
                    <li><i class="icon-home"></i> <a href="{{ Route('admin-dashboard') }}">Home</a></li>
                    @yield('breadcrumb')
                </ul>
                @if(Session::has('success'))
                <div class="alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <span>{{ Session::get('success') }}</span>
                </div>
                @endif
                @if(Session::has('danger'))
                <div class="alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <span>{{ Session::get('danger') }}</span>
                </div>
                @endif
                @yield('content')
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
        <!-- BEGIN QUICK SIDEBAR -->
        @include('admin::partials.sidebar')
        <!-- END QUICK SIDEBAR -->
    </div>
    <!-- BEGIN FOOTER -->
    @include('admin::partials.footer')
    <!-- END FOOTER -->
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/layouts/layout2/scripts/layout.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/pages/scripts/dashboard.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/assets/global/plugins/loader/loadingoverlay.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('storage/backend/custom/lobibox/lobibox.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('storage/backend/js/jquery-confirm.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/custom/js/script.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('storage/backend/custom/js/custom.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('public/frontend/js/notie.min.js') }}"></script>

    <script type="text/javascript" src="{{URL::asset('storage/backend/custom/select2/select2.full.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYkbQ15PD6imqraR2tLcK6h4PM8oQDYjI&libraries=places&callback=initMap" async defer></script>
    @yield('js')
    @if(Session::has('success'))
    <input type="hidden" id="success_msg" value="{{ Session::get('success') }}" />
    <script>
        var success_msg = $('#success_msg').val();
        notie.alert({
            type: 'success',
            text: '<i class="fa fa-check"></i> ' + success_msg,
            time: 3
        });
    </script>
    @endif
    @if(Session::has('error'))
    <input type="hidden" id="error_msg" value="{{ Session::get('error') }}" />
    <script>
        var error_msg = $('#error_msg').val();
        notie.alert({
            type: 'error',
            text: '<i class="fa fa-times"></i> ' + error_msg,
            time: 4
        });

      
    </script>
    @endif
    <script>
        function changeNotificationStatus(id) {
            ajaxindicatorstart();
            $.ajax({
                type: "GET",
                url: full_path + "changeNotificationStatus/" + id,

                success: function(response) {
                    window.location.reload();
                    ajaxindicatorstop();
                },
                error: function(response) {
                    ajaxindicatorstop();
                },
            });
        }
    </script>
    @include('admin::partials.flashMsg')
</body>

</html>
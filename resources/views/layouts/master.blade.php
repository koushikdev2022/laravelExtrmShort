<!DOCTYPE html>
<html lang="en" class="mmenu-open-fade">

<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('public/frontend/images/favicon.ico') }}">

    <!--    <link rel="shortcut icon" type="image/x-icon" href="images/fav.png">-->
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/icofont.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('public/frontend/jquery-ui/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/jquery-ui/jquery-ui.theme.css') }}">

    <link href="{{ URL::asset('public/frontend/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/css/notie.min.css') }}" />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css'>
    <!-- zuck css -->
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/dist/zuck.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/dist/skins/snapgram.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/dist/skins/vemdezap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/dist/skins/facesnap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('public/frontend/dist/skins/snapssenger.css') }}">
    <!-- zuck css -->

    @php
    $routeArray = app('request')->route()->getAction();
    $controllerAction = class_basename($routeArray['controller']);
    list($controller, $action) = explode('@', $controllerAction);

    $insideDashboard=['UserController'];
    $outsideDashboard=['SiteController'];
    @endphp

    @yield('css')
    <script type="text/javascript">
        var full_path = '<?= url('/') . '/'; ?>';
        var logged_in = '<?= (Auth()->guard('frontend')->guest()) ? false : true; ?>';
        var currentroute = '{{Request::route()->getName()}}';
    </script>
</head>

<body>
    @include('partials.header')
    @include('partials.left_panel')
    <main>
        @yield('content')
    </main>
    @include('partials.footer')

    <!-- Playlist Modal -->
    <div class="modal fade" id="ReportModal" tabindex="-1" role="dialog" aria-labelledby="ReportModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ReportModalLabel">Add New</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icofont-close-circled"></i></span>
                    </button>
                </div>
                <form id="ReportRequest" action="{{ Route('report') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Enter Message</label>
                            <input class="form-control" type="text" name="description" placeholder="Enter Message" />
                            <div class=" text-danger help-block text-danger"></div>
                        </div>
                    </div>
                    <input type="hidden" name="project_id" id="report_project_id">
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn dash_btn_green">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Show Video Modal -->
    <div class="modal cuustomfont videomodal fade" id="showVideo" tabindex="-1" role="dialog" aria-labelledby="showVideoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showVideoLabel">Video</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icofont-close-circled"></i></span>
                    </button> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="videoPlayer">

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn cmnbtnnw videoPlayerdetails">View Details</button>
                </div>
            </div>
        </div>
    </div>

    <!--MODAL START-->
    <!--<div class="modal topic-nodal" id="topic" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">welcome to Xtreme long shot</h5>
                <p>Choose your favourite topic</p>
            </div>
            <div class="modal-body">
                <ul class="d-flex flex-wrap topic-list justify-content-center">
                    <li>
                        <input type="checkbox" id="top1" checked/>
                        <label for="top1">Family</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top2"/>
                        <label for="top2">Drone</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top3"/>
                        <label for="top3">Medical</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top4"/>
                        <label for="top4">News</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top5"/>
                        <label for="top5">Politics</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top6"/>
                        <label for="top6">Social</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top7"/>
                        <label for="top7">Food</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top8"/>
                        <label for="top8">Celebration</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top9"/>
                        <label for="top9">Security</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top10"/>
                        <label for="top10">War</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top11"/>
                        <label for="top11">Terror</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top12"/>
                        <label for="top12">Religion</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top13"/>
                        <label for="top13">Education</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top14"/>
                        <label for="top14">Science</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top15"/>
                        <label for="top15">Entertainment</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top16"/>
                        <label for="top16">Culture</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top17"/>
                        <label for="top17">Sport</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top18"/>
                        <label for="top18">Matches</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top19"/>
                        <label for="top19">Players</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top20"/>
                        <label for="top20">Funs</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top21"/>
                        <label for="top21">Technology</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top22"/>
                        <label for="top22">City</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top23"/>
                        <label for="top23">Landscape</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top24"/>
                        <label for="top24">Nature</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top25"/>
                        <label for="top25">Animals</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top26"/>
                        <label for="top26">Travels</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top27"/>
                        <label for="top27">Transports</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top28"/>
                        <label for="top28">Vehicules</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top29"/>
                        <label for="top29">Roads</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top30"/>
                        <label for="top30">Archival</label>
                    </li>
                    <li>
                        <input type="checkbox" id="top31"/>
                        <label for="top31">Trending</label>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-action" data-bs-dismiss="modal">Next</button>
            </div>
        </div>
    </div>
</div>-->
    <!--MODAL END-->
    <script src="{{ URL::asset('public/frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="{{ URL::asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/js/basicZack.min.js')}}"></script>

    <script src="{{ URL::asset('public/frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/jquery-ui/jquery-ui.js') }}"></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js'></script>
    <script src="{{ URL::asset('public/frontend/js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('public/frontend/js/notie.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('public/frontend/js/script.js') }}"></script>
    <script src="{{ URL::asset('public/frontend/dist/zuck.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

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
        $('.shortvideo').owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            slideSpeed: 100,
            singleItem: true,
            dots: false,
            autoPlay: false,
            navText: ["<i class='icofont-rounded-left'></i>", "<i class='icofont-rounded-right'></i>"],
            responsive: {
                0: {
                    items: 4
                },
                600: {
                    items: 8
                },
                1000: {
                    items: 10
                }
            }
        });
    </script>
    <script>
        $(document).on("click", ".browse", function() {
            var file = $(this)
                .parent()
                .parent()
                .parent()
                .find(".file");
            file.trigger("click");
        });
        $(document).on("change", ".file", function() {
            $(this).parent().find(".form-control").val($(this).val().replace(/C:\\fakepath\\/i, ""));
        });

        $('.video-box').on('mouseover mouseout', function(e) {
            const evt = e.type;
            if (evt === 'mouseover') {
                $(this).find('.video-link').children("video").trigger('play');
            }
            if (evt === 'mouseout') {
                $(this).find('.video-link').children("video").trigger('pause');
            }
        });
    </script>
    <script>
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 100,
            values: [0, 75],
            slide: function(event, ui) {
                $("#amount").val(ui.values[0]);
                $("#amount2").val(ui.values[1]);
            }
        });
        $("#amount").change(function() {
            $("#slider-range").slider('values', 0, $(this).val());
        });
        $("#amount2").change(function() {
            $("#slider-range").slider('values', 1, $(this).val());
        });
    </script>
</body>

</html>
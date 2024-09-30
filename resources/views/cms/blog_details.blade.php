@extends('layouts.master')
@section('content')
<!-- page header title banner  -->

<section class="py-0">
    <div class="loginHead staticnwarea">
        <div class="loginImg pageTitle">
            <div class="container text-center">
                <h1 class="heading">{{__('Blog Details')}}</h1>
            </div>
        </div>
    </div>
</section>


<section class="storiesDES_sec static_page">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="storiesDES_box">
                    <h4 class="bigheading">{{ $model->title }}</h4>
                    <ul>
                        <li><i class="icofont-pencil-alt-2"></i>{{ $model->written_by }}</li>
                        <li><i class="icofont-calendar"></i>{{ date("F d, Y", strtotime($model->created_at)) }}</li>
                        <li><a href="javascript:void(0)" onclick="sharingLink('{{ base64_encode($model->id) }}')"><i class="icofont-share"></i>Share</a></li>
                    </ul>
                    <div class="storiesDES_img">
                        <img src="{{ URL::asset('public/uploads/frontend/Blog/original/'.$model->image) }}">
                    </div>
                    <div class="stories_para">
                        {!! $model->description !!}
                    </div>
                    <!-- <div class="stories_para">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed arcu tellus, congue sit amet nisl at, sodales congue nisi. Aliquam quis pulvinar ex. Integer enim sem, accumsan vitae porta vel, gravida at magna. Mauris posuere tincidunt mi id facilisis. Etiam euismod velit leo, nec egestas enim cursus sit amet. Proin tellus sapien, pulvinar a ante eu, lacinia rutrum sapien. Duis consequat nisi orci.</p>
                            <p>Quisque molestie fermentum tellus et fermentum. Praesent dui mauris, volutpat id quam nec, vehicula pulvinar erat. Vivamus at vulputate purus. Morbi placerat enim sollicitudin pharetra dapibus.</p>
                            <p>Curabitur ac nunc leo. Ut rutrum sapien erat, dictum vestibulum nisl pulvinar ac. Aliquam pretium nibh ante, vitae efficitur augue placerat a. Morbi eu enim erat. Phasellus mattis eleifend magna a euismod. Pellentesque consectetur nulla vitae lorem tempus sagittis. Aenean ac mi vitae ligula placerat dictum. Curabitur maximus malesuada lorem vitae ultricies. Fusce tristique turpis neque, id facilisis libero mollis eget. Nunc libero arcu, eros. </p>
                        </div>
                        <div class="sample_heading">
                            <h5 class="heading">Sample Heading</h5>
                            <p>Praesent dui mauris, volutpat id quam nec, vehicula pulvinar erat. Vivamus at vulputate purus. Morbi placerat enim sollicitudin pharetra dapibus.</p>
                            <p>Curabitur ac nunc leo. Ut rutrum sapien erat, dictum vestibulum nisl pulvinar ac. Aliquam pretium nibh ante, vitae efficitur augue placerat a. Morbi eu enim erat. Phasellus mattis eleifend magna a euismod. Pellentesque consectetur nulla vitae lorem tempus sagittis. Aenean ac mi vitae ligula placerat dictum. Curabitur maximus malesuada lorem vitae ultricies.</p>
                            <p>Cras sit amet lacus justo. Quisque vulputate id felis vel euismod. Sed eu porttitor sem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla ultrices purus at magna malesuada.</p>
                        </div>
                        <div class="sample_heading">
                            <h5 class="heading">Sample Heading</h5>
                            <p>Cras sit amet lacus justo. Quisque vulputate id felis vel euismod. Sed eu porttitor sem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla ultrices purus at magna malesuada, eu congue est feugiat. Donec lectus nulla, molestie vitae interdum id, euismod non velit. Aliquam in varius orci. In non nisl felis. Donec lorem erat, sagittis eget tincidunt varius, congue in velit. Ut efficitur consequat eros vitae condimentum. Nulla non turpis id magna elementum vulputate eget et libero.</p>
                            <p>Aliquam odio ipsum, ullamcorper a mauris eu, commodo dignissim quam. Aliquam non ex justo. In at euismod elit, at congue felis. Etiam fermentum ipsum a lorem tincidunt, sed placerat ante luctus. Quisque sodales tincidunt elit vitae finibus. Maecenas viverra neque a arcu porttitor, et pulvinar felis</p>
                        </div>
                        <div class="sample_heading">
                            <h5 class="heading">Sample Heading</h5>
                            <ul>
                                <li><i class="icofont-square"></i>Hang artwork/photography on the walls</li>
                                <li><i class="icofont-square"></i>Add extra pillows and throws on the couch</li>
                                <li><i class="icofont-square"></i>Have vases on hand for flowers</li>
                                <li><i class="icofont-square"></i>Tour guides or books if your home.</li>
                            </ul>
                        </div>
                        <div class="sample_heading">
                            <h5 class="heading">Sample Heading</h5>
                            <p>While renters often eat out, and often, while they are on vacation, most will take full advantage of a well stocked kitchen and many meals will be prepared and enjoyed in your rental property. </p>
                        </div>
                        <div class="share_social">
                            <ul class="p-0 m-0">
                                <li>Share</li>
                                <li>
                                    <a href="#" target="_blank"><i class="icofont-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="icofont-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="icofont-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="#" target="_blank"><i class="icofont-youtube-play"></i></a>
                                </li>
                            </ul>
                        </div> -->
                </div>
            </div>
            <div class="col-md-4">
                <div class="stickyss">
                    <form id="searchPost" action="{{ Route('loadPost') }}" method="GET">
                        @csrf
                        <input type="search" placeholder="Search..." name="search" id="searchPosts">
                        <i class="icofont-search"></i>
                    </form>
                    <div class="postcontent">
                    </div>
                    <!-- <ul class="recent_post d-flex align-items-start flex-wrap">
                        <li>
                            <h4 class="smlheading">Recent Posts</h4>
                        </li>
                        <div class="postcontent">
                        </div>
                        <li>
                            <a href="">
                                <img src="https://newtestserver.com/dev/sevenfifty/html/images/stories/1.png">
                                <p>Phasellus in purus semper, luctus neque non porttitor sapien vitae luctus.</p>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="https://newtestserver.com/dev/sevenfifty/html/images/stories/1.png">
                                <p>Maecenas cursus porttitor sapien vitae luctus.</p>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="https://newtestserver.com/dev/sevenfifty/html/images/stories/1.png">
                                <p>Lorem ipsum dolor sit amet, consec adipiscing elit.</p>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="https://newtestserver.com/dev/sevenfifty/html/images/stories/1.png">
                                <p>Duis cursus nulla ut lorem sagittis, ut varius justo dictum maecenas cursus porttitor sapien vitae luctus.</p>
                            </a>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="sharingModal" tabindex="-1" role="dialog" aria-labelledby="sharingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sharingModalLabel">Share</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icofont-close-circled"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" id="blogid" readonly/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@section('js')
<script>
    $(document).ready(function() {
        var data = '';
        loadPosts(data);
    });

    function sharingLink(blogid){
        $('#blogid').val(full_path+"blog_details/"+blogid)
        $('#sharingModal').modal('show');
    }

    function loadPosts(search) {
        $.ajax({
            url: full_path + "loadPost",
            data:{search:search},
            success: function(response) {
                $('.postcontent').html('');
                $('.postcontent').append(response.content);
            }
        });
    }

    $("#searchPosts").on("keyup", function() {
        var item = $("#searchPosts").val();
        loadPosts(item);
    });
</script>
@stop
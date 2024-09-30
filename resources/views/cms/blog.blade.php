@extends('layouts.master')
@section('content')
<!-- page header title banner  -->

<section class="py-0">
    <div class="loginHead staticnwarea">
        <div class="loginImg pageTitle">
            <div class="container text-center">
                <h1 class="heading">{{__('Blog')}}</h1>
            </div>
        </div>
    </div>
</section>


<section class="stories_sec static_page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs mb-0" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="allpost-tab" data-bs-toggle="tab" data-bs-target="#allpost" type="button" role="tab" aria-controls="allpost" aria-selected="true">All Posts</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="recentpost-tab" data-bs-toggle="tab" data-bs-target="#recentpost" type="button" role="tab" aria-controls="recentpost" aria-selected="false">Recent Posts</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="allpost" role="tabpanel" aria-labelledby="allpost-tab">
                        <div class="row">
                            @forelse($model as $m)
                            <div class="col-md-4">
                                <a href="{{ Route('blog_details',base64_encode($m->id)) }}" class="story_box">
                                    <img src="{{ URL::asset('public/uploads/frontend/Blog/preview/'.$m->image) }}">
                                    <div class="story_overlay">
                                        <span><i class="icofont-ui-calendar"></i> {{ date("F d, Y", strtotime($m->created_at)) }}</span>
                                        <h4>{{ \Illuminate\Support\Str::limit($m->title,35) }}</h4>
                                    </div>
                                </a>
                            </div>
                            @empty
                            @endforelse
                        </div>
                        {!! $model->links() !!}
                    </div>
                    <div class="tab-pane fade" id="recentpost" role="tabpanel" aria-labelledby="recentpost-tab">
                        <div class="row">
                            @forelse($latest as $l)
                            <div class="col-md-4">
                                <a href="{{ Route('blog_details',base64_encode($l->id)) }}" class="story_box">
                                    <img src="{{ URL::asset('public/uploads/frontend/Blog/preview/'.$l->image) }}">
                                    <div class="story_overlay">
                                        <span><i class="icofont-ui-calendar"></i> {{ date("F d, Y", strtotime($l->created_at)) }}</span>
                                        <h4>{{ \Illuminate\Support\Str::limit($l->title,35) }}</h4>
                                    </div>
                                </a>
                            </div>
                            @empty
                            @endforelse
                           
                        </div>
                        {!! $latest->links() !!}
                    </div>
                    <!-- <div class="col-md-12 text-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true"><</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
@stop
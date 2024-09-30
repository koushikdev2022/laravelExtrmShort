@extends('layouts.main')
@section('css')
@stop
@section('content')


<section class="mt-5 mb-5">
    <div class="container">
        <h2>To create a task first choose a category</h2>

        <div id="columns">
            @foreach ($categories as $category)
            <figure>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>{{$category->translation_cat->category_name}}</h5>
                    </div>
                    <div class="CatIcon">
                        <img src="{{$category->image}}">
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    @php
                        $subcategories=App\Models\Category::where('parent_id',$category->id)->where('status','1')->get();
                    @endphp
                    @forelse ($subcategories as $subcategory)
                    <a href="{{route('create-task-subcategory',base64_encode($subcategory->id))}}" class="list-group-item">{{$subcategory->translation_cat->category_name}}</a>
                    @empty
                        
                    @endforelse
                  </ul>
            </figure>
            @endforeach
            

            {{-- <figure>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Courier services</h5>
                    </div>
                    <div class="CatIcon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                  </ul>
            </figure>

            <figure>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Courier services</h5>
                    </div>
                    <div class="CatIcon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                  </ul>
            </figure>

            <figure>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Courier services</h5>
                    </div>
                    <div class="CatIcon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                  </ul>
            </figure>

            <figure>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Courier services</h5>
                    </div>
                    <div class="CatIcon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                  </ul>
            </figure>

            <figure>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Courier services</h5>
                    </div>
                    <div class="CatIcon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                  </ul>
            </figure>

            <figure>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Courier services</h5>
                    </div>
                    <div class="CatIcon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                  </ul>
            </figure>

            <figure>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Courier services</h5>
                    </div>
                    <div class="CatIcon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                  </ul>
            </figure>

            <figure>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Courier services</h5>
                    </div>
                    <div class="CatIcon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                  </ul>
            </figure>

            <figure>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Courier services</h5>
                    </div>
                    <div class="CatIcon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                  </ul>
            </figure>

            <figure>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Courier services</h5>
                    </div>
                    <div class="CatIcon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">An item</a>
                  </ul>
            </figure>

            <figure>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Courier services</h5>
                    </div>
                    <div class="CatIcon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                  </ul>
            </figure>

            <figure>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Courier services</h5>
                    </div>
                    <div class="CatIcon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <a href="#" class="list-group-item">An item</a>
                    <a href="#" class="list-group-item">A second item</a>
                    <a href="#" class="list-group-item">A third item</a>
                    <a href="#" class="list-group-item">A fourth item</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                    <a href="#" class="list-group-item">And a fifth one</a>
                  </ul>
            </figure> --}}

        </div>
    </div>
</section>

@stop
@section('js')

@stop
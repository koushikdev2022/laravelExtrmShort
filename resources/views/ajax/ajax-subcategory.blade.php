
@foreach ($categories as $category)
@if(!empty($category->translation_cat->category_name))
<div class="col-6 col-md-6 col-xl-4">
    <div class="catBox d-flex align-items-stretch">
        <div class="catIcon">
            <img src="{{$category->image}}" alt="">
        </div>
        <div class="flex-fill">
            <h5>{{$category->translation_cat->category_name}} </h5>
            @if(!empty($category->parent_id))
            <a href="{{route('create-task-subcategory',base64_encode($category->id))}}" class="btnSelect">Select</a>
            @else
            <a href="javascript:void(0)" onclick="select_cat({{$category->id}})" class="btnSelect">Select</a>
            @endif
            {{-- <a href="javascript:void(0)" onclick="select_cat({{$category->id}})" class="btnSelect">Select</a> --}}
        </div>
    </div>
</div>
@endif
@endforeach

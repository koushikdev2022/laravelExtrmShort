@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{route('admin-category')}}">Category Management</a></li>
@isset($parent_model)
<li class="active">{{optional($parent_model->translation)->category_name}}</li>
@endisset

@stop


@section('content')
<h3 class="page-title">Category Management @isset($parent_model) of
    <strong>{{optional($parent_model->translation)->category_name}}</strong>
    @endisset
    <small>Manage all the categories of the site from here</small>
</h3>
<div>
    <div class="row">
     <div class="col-md-3">
      
     </div>
    </div>
  </div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list-ul" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">@isset($parent_model) Sub @endisset Categories</span>
                </div>
                
                    <div class="row pull-right">
                    {{-- <div class="col-md-7">
                        <select class="form-control" name="type" id="type">
                          <option value="0">Select Parent Category</option>
                          @foreach($categories as $category)
                          @if(empty($category->parent_id))
                          <option value="{{$category->id}}">{{!empty($category->translation_cat->category_name) ? $category->translation_cat->category_name : ''}}</option>
                          @endif
                          @endforeach
                        </select>
                    </div> --}}
                    <div class="col-md-2">
                        <a class="btn btn-success" href="{{ Route('admin-category-create') }}?pid={{$pid}}"><i class="fa fa-plus" aria-hidden="true"></i> Create New</a>&nbsp;
                    </div>
                    
                    </div>
              
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover datatable" width="100%"
                        id="Category-table" data-pid="{{$pid}}">
                        <thead>
                            <tr>
                                <th class="bold"> # </th>
                                {{-- <th class="bold"> Parent Category</th> --}}
                                <th class="bold"> Category</th>
                                <th class="bold"> Created On </th>
                                <th class="bold"> Status </th>
                                <th class="bold"> Actions </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

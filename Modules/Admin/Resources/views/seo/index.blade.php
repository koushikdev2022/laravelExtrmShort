@extends('admin::layouts.main')

@section('breadcrumb')
<li class="active">SEO</li>
@stop

@section('content')
<h3 class="page-title">SEO
    <small>Manage all the seo of the site from here</small>
</h3>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-list font-green-haze" aria-hidden="true"></i>
                    <span class="caption-subject font-green-haze bold uppercase">SEO</span>
                </div>
                <div class="pull-right">
                    <a class="btn btn-info" href="javascript:;" onclick="$('#search_filter').toggle();"><i class="fa fa-search" aria-hidden="true"></i> Filter</a>&nbsp;
                    <a class="btn btn-info" href="{{ Route('admin-seo') }}"><i class="glyphicon glyphicon-repeat"></i></i> Reset</a>
                </div>
            </div>
            <div class="portlet-body form" id="search_filter" style="display: {{ ($search_filter == 1) ? 'block;' : 'none;' }}">
                <!-- BEGIN FORM-->
                <form class="form-horizontal" action="" method="GET">
                    <input type="hidden" name="search_filter" value="1"/>
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Route</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="route" placeholder="Route" value="{{ (isset($route) && $route != '') ? $route : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Title</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="title" placeholder="Title" value="{{ (isset($title) && $title != '') ? $title : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Keyword</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="keyword" placeholder="Keyword" value="{{ (isset($keyword) && $keyword != '') ? $keyword : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn green">Search</button>               
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                            <tr>
                                <th class="bold"> # </th>
                                <th class="bold"> Route </th>
                                <th class="bold"> Title </th>
                                <th class="bold"> Keyword </th>
                                <th class="bold"> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($model as $key => $val)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td> {{ (isset($val->route) && $val->route != '') ? $val->route : "Not Given" }} </td>
                                <td> {{ (isset($val->title) && $val->title != '') ? $val->title : "Not Given" }} </td>
                                <td> {{ (isset($val->keyword) && $val->keyword != '') ? $val->keyword : "Not Given" }} </td>
                                <td>
                                    <a href="{{ Route('admin-viewseo', ['id' => $val->id]) }}" class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="{{ Route('admin-updateseo', ['id' => $val->id]) }}" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center;">No Record Found!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $model->appends(request()->all())->render() }}
            </div>
        </div>
    </div>
</div>
@stop
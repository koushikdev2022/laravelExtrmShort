@extends('layouts.main')
@include('partials.dashboard.header')
@section('content')
<div class="user-dash-right">
    @include('partials.dashboard.topright')
    <div class="clearfix">
        <div class="dash-bottom-part pb-0">
            <div class="justify-content-center">
                <div class="col-md-12">
                    <div class="main_dashbord_area">
                        <div class="earings_box">
                            <div class="earning_txt">
                                <h4 class="text_uppercase mb-0">My {{ $name }} list</h4>
                            </div>
                            <div class="view_gropad">
                               <!-- <a href="{{ Route('addBank') }}" class="page_btn">Add Bank Details</a>  -->
                                <p>View As:</p>
                                <a href="javascipr:void(0)" class="list_icon active"><i class="fa fa-list" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="view-box view-as-grid">
                            <div class="dashboard_grid dashborad_listbx">
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th >First Name</th>
                                                <th >Last Name</th>
                                                <th >Email</th>
                                                <th>Amount</th>
                                                <th>Status</th>

                                                <th >Gateway</th>
                                                <th >Transaction Id</th>
                                                <th >Order</th>
                                                <th>Creation Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($data) > 0)
                                            @forelse($data as $d)
                                            <tr>
                                                <td >{{ ucFirst($d->first_name) }}</td>
                                                <td >{{ ucFirst($d->last_name) }}</td>
                                                <td>{{ $d->email }}</td>

                                                <td >${{ $d->amount }}</td>
                                                <td>{{ $d->status }}</td>
                                                <td>{{ $d->payment_gateway }}</td>
                                                <td>{{ $d->transaction_id }}</td>
                                                @php
                                                    $order = \App\Models\Checkout::where(['id'=>$d->order_id])->first();
                                                    $project = \App\Models\Project::where(['id'=>$order->project_id])->first();
                                                @endphp
                                                <td>@if($project != ''){{ $project->title }} @endif</td>
                                                <td>{{ date("F d, Y", strtotime($d->created_at)) }}</td>
                                                
                                            </tr>
                                            @empty
                                            @endforelse
                                            @else
                                            <div class="alert alert-danger" role="alert">
                                                Nothing Found
                                            </div>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- col-lg-12 end -->
            </div>
        </div>
    </div>
</div>
@stop
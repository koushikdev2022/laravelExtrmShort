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
                                                <th colspan="2">User Name</th>
                                                <th>Follower Name</th>
                                                <th>Creation Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($data) > 0)
                                            @forelse($data as $d)
                                            <tr>
                                                @php
                                                    $user = \App\Models\UserMaster::where(['id'=>$d->user_id])->first();
                                                @endphp
                                                <td colspan="2">{{ $user->name }}</td>
                                                @php
                                                    $follower = \App\Models\UserMaster::where(['id'=>$d->following_user_id])->first();
                                                @endphp
                                                <td>{{ $follower->name }}</td>
                                                <td>{{ date("F d, Y", strtotime($d->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ Route('user.viewprofile',base64_encode($d->following_user_id))}}" class="btn_tble editdlt"><i class="icofont-eye"></i></a>
                                                    <a href="javascript:void(0)" onclick="followUser('{{ $d->user_id }}')" class="btn_tble editdlt"><i class="icofont-ban"></i></a>
                                                </td>
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
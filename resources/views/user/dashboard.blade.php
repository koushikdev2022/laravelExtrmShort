@extends('layouts.main')
@section('content')
@include('partials.dashboard.header')
<div class="user-dash-right">
    @include('partials.dashboard.topright')
    <div class="clearfix">
        <div class="dash-bottom-part pb-0">
            <div class="justify-content-center">
                <div class="col-md-12">
                    <div class="dboar_listbox_arera listnwstl">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 dsh_lstbx">
                                <a href="javascript:void(0)">
                                    <div class="list_box">
                                        <div class="list_txt">
                                            @php
                                            $loginUser = Auth()->guard('frontend')->user();
                                            $project = \App\Models\Project::where(['user_id'=>$loginUser->id])->get();
                                            @endphp
                                            <h4>{{ count($project) }}</h4>
                                            <h5>videos uploaded</h5>
                                        </div>
                                        <div class="list_icon">

                                            <i class="icofont-upload-alt"></i>

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 dsh_lstbx">
                                <a href="javascript:void(0)">
                                    <div class="list_box">
                                        <div class="list_txt">
                                            @php
                                            $loginUser = Auth()->guard('frontend')->user();
                                            $downloaded = \App\Models\Payments::where(['user_id'=>$loginUser->id])->get();
                                            @endphp
                                            <h4>{{ count($downloaded) }}</h4>
                                            <h5>videos downloaded</h5>
                                        </div>
                                        <div class="list_icon">

                                            <i class="icofont-download"></i>

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 dsh_lstbx">
                                <a href="javascript:void(0)">
                                    <div class="list_box">
                                        <div class="list_txt">
                                            @php
                                            $loginUser = Auth()->guard('frontend')->user();
                                            $followers = \App\Models\UserFollower::where(['user_id'=>$loginUser->id])->get();
                                            @endphp
                                            <h4>{{ count($followers)}}</h4>
                                            <h5>FOLLOWERS</h5>
                                        </div>
                                        <div class="list_icon">

                                            <i class="icofont-users-social"></i>

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 dsh_lstbx">
                                <a href="javascript:void(0)">
                                    <div class="list_box">
                                        <div class="list_txt">
                                            @php
                                            $loginUser = Auth()->guard('frontend')->user();
                                            $following = \App\Models\UserFollower::where(['following_user_id'=>$loginUser->id])->get();
                                            @endphp
                                            <h4>{{ count($following)}}</h4>
                                            <h5>Following</h5>
                                        </div>
                                        <div class="list_icon">

                                            <i class="icofont-star"></i>

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 dsh_lstbx">
                                <a href="javascript:void(0)">
                                    <div class="list_box">
                                        <div class="list_txt">
                                            @php
                                            $total = '0';
                                            $pays = \App\Models\Payments::where(['user_id'=>$loginUser->id,'status'=>'approved'])->get();
                                            if(count($pays) > 0){
                                            foreach($pays as $p){
                                            $total += $p->amount;
                                            }
                                            }

                                            @endphp
                                            <h4>$ {{$total}} </h4>
                                            <h5>TOTAL EARNING</h5>
                                        </div>
                                        <div class="list_icon">

                                            <i class="icofont-money-bag"></i>

                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 dsh_lstbx">
                                <a href="javascript:void(0)">
                                    <div class="list_box">
                                        <div class="list_txt">
                                            <h4>$ 0</h4>
                                            <h5>Total spend</h5>
                                        </div>
                                        <div class="list_icon">

                                            <i class="icofont-coins"></i>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="main_dashbord_area">
                        <div class="earings_box">
                            <div class="earning_txt">
                                <h4>RECENT EARNINGS</h4>
                                <h5><a href="{{ Route('earning') }}">View All Earnings <i class="icofont-double-right"></i></a></h5>
                            </div>
                            <div class="view_gropad">
                                <p>View As:</p>
                                <a href="javascipr:void(0)" class="list_icon"><i class="fa fa-list" aria-hidden="true"></i></a>
                                <a href="javascipr:void(0)" class="grid_icon active"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="view-box view-as-grid">
                            <div class="dashboard_grid pdsmalnw">
                                @if(count($data) > 0)
                                <div class="row">
                                    @forelse($data as $d)
                                    <div class="col-lg-4 col-md-6 dsh_bx">
                                        <div class="dash_grid_box">

                                            <a href="javascript:void(0)" onclick="showVideo({{ $d->id }})">
                                                <div class="grid_video">
                                                    <video poster="{{ URL::asset('public/uploads/frontend/project/img_preview/'.$d->image) }}" muted>
                                                        <source src="{{ URL::asset('public/uploads/frontend/project/video/'.$d->video) }}" type="video/mp4">
                                                    </video>
                                                    @if($d->is_exclusive == '1')
                                                    <span class="videoextab">Exclusive</span>
                                                    @endif
                                                </div>
                                            </a>

                                            <div class="dsh_bx_body">

                                                @php
                                                $lang = session()->get('locale');
                                                $category = \App\Models\TranslationCategory::where(['category_id'=>$d->category])->where('lang_code', '=', $lang)->first();
                                                @endphp

                                                <a href="javascript:void(0)">
                                                    <h5>{{ \Illuminate\Support\Str::limit(ucfirst($d->title),150) }}</h5>
                                                </a>
                                                @if($d->category != '')
                                                <a href="javascript:void(0)" class="grid_tags">{{ ucfirst($category->category_name) }}</a>
                                                @endif
                                                <ul>
                                                    @if(count($d->info) > 0)
                                                    @forelse($d->info as $key =>$i)
                                                    @if($key < 1 ) <li><span class="title_lft">quality</span><span class="descrb">@if($i->quality == '1') HD @else 4K @endif</span></li>
                                                        <li><span class="title_lft">Licence</span><span class="descrb">@if($i->licence_for == '1') For Internet Use Only @else For Other UseOnly @endif</span></li>
                                                        <li><span class="title_lft">Rental Period</span><span class="descrb">12 Months</span></li>
                                                        @else
                                                        @endif
                                                        @empty
                                                        @endforelse
                                                        @endif
                                                </ul>
                                                <div class="row amountbx">
                                                    <div class="col-md-6 amnt_bx">
                                                        <h4>{{ date("F d, Y", strtotime($d->created_at)) }}</h4>
                                                        <h5>{{ date("h:i A", strtotime($d->created_at)) }}</h5>
                                                    </div>
                                                    <div class="col-md-6 amnt_bx">
                                                        <h4>amount received</h4>
                                                        @php
                                                        $total = '0';
                                                        $pays = \App\Models\Payments::where(['user_id'=>$d->user->id,'project_id'=>$d->id,'status'=>'approved'])->get();
                                                        if(count($pays) > 0){
                                                        foreach($pays as $p){
                                                        $total += $p->amount;
                                                        }
                                                        }

                                                        @endphp

                                                        <h5>${{ $total }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="thumnel_edit">
                                                <a href="{{ Route('editUpload',base64_encode($d->id))}}" class="grid_btn"><i class="icofont-pencil-alt-2"></i>Edit</a>
                                                <a href="javascript:void(0)" class="grid_btn" onclick="deleteVideo({{ $d->id }})"><i class="icofont-trash"></i>Delete</a>
                                            </div>
                                        </div>
                                    </div>

                                    @empty
                                    @endforelse
                                </div>
                                <div class="d-flex justify-content-center">
                                    {!! $data->links() !!}
                                </div>
                                @else
                                <div class="alert alert-danger" role="alert">
                                    Nothing Found
                                </div>
                                @endif
                            </div>
                            <div class="dashborad_listbx">
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="2">Video title</th>
                                                <th>Category</th>
                                                <th>quality</th>
                                                <th>license</th>
                                                <th>Rental Period</th>
                                                <th>DATE & Time</th>
                                                <th>AMOUNT</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($data) > 0)
                                            @forelse($data as $d)
                                            <tr>
                                                <td onclick="showVideo({{ $d->id }})"><i class="icofont-file-video"></i></td>
                                                <td onclick="showVideo({{ $d->id }})">
                                                    <a href="javascript:void(0)">
                                                        <h5>{{ \Illuminate\Support\Str::limit( ucfirst($d->title),30 ) }}</h5>
                                                    </a>
                                                </td>
                                                @php
                                                $lang = session()->get('locale');
                                                $category = \App\Models\TranslationCategory::where(['category_id'=>$d->category])->where('lang_code', '=', $lang)->first();
                                                @endphp

                                                <td onclick="showVideo({{ $d->id }})">@if($d->category != '')<a href="javascript:void(0)" class="btn_tble tagarea">{{ ucfirst($category->category_name) }}</a>@endif</td>

                                                <td onclick="showVideo({{ $d->id }})">@if(count($d->info) > 0)
                                                    @forelse($d->info as $i)
                                                    @if($i->quality == '1') HD <br>@else 4K <br>@endif
                                                    @empty
                                                    @endforelse
                                                    @endif
                                                </td>

                                                <td onclick="showVideo({{ $d->id }})">@if(count($d->info) > 0)
                                                    @forelse($d->info as $i)
                                                    @if($i->licence_for == '1') For Internet Use Only <br>@else For Other UseOnly <br>@endif
                                                    @empty
                                                    @endforelse
                                                    @endif
                                                </td>
                                                <td onclick="showVideo({{ $d->id }})">12 Months</td>
                                                <td onclick="showVideo({{ $d->id }})">{{ date("F d, Y", strtotime($d->created_at)) }} <br> {{ date("h:i A", strtotime($d->created_at)) }}</td>
                                                <td onclick="showVideo({{ $d->id }})">$ {{ $total }}</td>
                                                <td onclick="showVideo({{ $d->id }})">
                                                    <a href="{{ Route('editUpload',base64_encode($d->id))}}" class="btn_tble editdlt"><i class="icofont-pencil-alt-2"></i></a>
                                                    <a href="javascript:void(0)" onclick="deleteVideo({{ $d->id }})" class="btn_tble editdlt"><i class="icofont-trash"></i></a>
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
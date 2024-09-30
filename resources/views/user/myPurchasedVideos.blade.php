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
                                <h4 class="text_uppercase mb-0">My Purchased Videos</h4>
                            </div>
                            <div class="view_gropad">
                                <p>View As:</p>
                                <a href="javascipr:void(0)" class="list_icon"><i class="fa fa-list" aria-hidden="true"></i></a>
                                <a href="javascipr:void(0)" class="grid_icon active"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="view-box view-as-grid">
                            <div class="dashboard_grid">
                                @if(count($data) > 0)
                                <div class="row">
                                    @forelse($data as $d)
                                    <div class="col-lg-4 col-md-6 dsh_bx" onclick="showVideo({{ $d->projects->id }})">
                                        <div class="dash_grid_box">

                                            <a href="javascript:void(0)">
                                                <div class="grid_video">
                                                    <video poster="{{ URL::asset('public/uploads/frontend/project/img_preview/'.$d->projects->image) }}" muted>
                                                        <source src="{{ URL::asset('public/uploads/frontend/project/video/'.$d->projects->video) }}" type="video/mp4">
                                                    </video>
                                                    @if($d->projects->is_exclusive == '1')
                                                    <span class="videoextab">Exclusive</span>
                                                    @endif
                                                </div>
                                            </a>

                                            @php
                                            $lang = session()->get('locale');
                                            $category = \App\Models\TranslationCategory::where(['category_id'=>$d->projects->category])->where('lang_code', '=', $lang)->first();
                                            @endphp

                                            <a href="javascript:void(0)">
                                                <h5>{{ \Illuminate\Support\Str::limit(ucfirst($d->title),150) }}</h5>
                                            </a>
                                            @if($d->category != '')
                                            <a href="javascript:void(0)" class="grid_btn">{{ ucfirst($category->category_name) }}</a>
                                            @endif
                                            <ul>
                                                @php
                                                $info = \App\Models\ProjectInfo::where(['project_id'=>$d->project_id])->get();
                                                @endphp
                                                @if(count($info) > 0)
                                                @forelse($info as $key=>$i)
                                                    @if($key < 1)
                                                    <li><span class="title_lft">quality</span><span class="descrb">@if($i->quality == '1') HD @else 4K @endif</span></li>
                                                    <li><span class="title_lft">Licence</span><span class="descrb">@if($i->licence_for == '1') For Internet Use Only @else For Other UseOnly @endif</span></li>
                                                    <li><span class="title_lft">Rental Period</span><span class="descrb">12 Months</span></li>
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
                                            <div class="thumnel_edit">
                                                <a href="{{ Route('editUpload',base64_encode($d->id))}}" class="grid_btn"><i class="icofont-pencil-alt-2"></i>Edit</a>
                                                <a href="javascript:void(0)" class="grid_btn" onclick="deleteVideo({{ $d->id }})"><i class="icofont-trash"></i>Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    @endforelse
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
                                                <th>licence</th>
                                                <th>Rental Period</th>
                                                <th>DATE & Time</th>
                                                <th>AMOUNT</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @if(count($data) > 0)
                                                @forelse($data as $d)
                                                <td onclick="showVideo({{ $d->projects->id }})"><i class="icofont-file-video"></i></td>
                                                <td onclick="showVideo({{ $d->projects->id }})">
                                                    <a href="javascript:void(0)">
                                                        <h5>{{ \Illuminate\Support\Str::limit( ucfirst($d->title),30 ) }}</h5>
                                                    </a>
                                                </td>
                                                @php
                                                $lang = session()->get('locale');
                                                $category = \App\Models\TranslationCategory::where(['category_id'=>$d->category])->where('lang_code', '=', $lang)->first();
                                                @endphp

                                                <td onclick="showVideo({{ $d->projects->id }})">@if($d->category != '')<a href="javascript:void(0)" class="btn_tble">{{ ucfirst($category->category_name) }}</a>@endif</td>

                                                <td onclick="showVideo({{ $d->projects->id }})">@if(count($info) > 0)
                                                    @forelse($info as $i)
                                                    @if($i->quality == '1') HD <br>@else 4K <br>@endif
                                                    @empty
                                                    @endforelse
                                                    @endif
                                                </td>

                                                <td onclick="showVideo({{ $d->projects->id }})">@if(count($info) > 0)
                                                    @forelse($info as $i)
                                                    @if($i->licence_for == '1') For Internet Use Only <br>@else For Other UseOnly <br>@endif
                                                    @empty
                                                    @endforelse
                                                    @endif
                                                </td>
                                                <td onclick="showVideo({{ $d->projects->id }})">12 Months</td>
                                                <td onclick="showVideo({{ $d->projects->id }})">{{ date("F d, Y", strtotime($d->created_at)) }} <br> {{ date("h:i A", strtotime($d->created_at)) }}</td>
                                                <td onclick="showVideo({{ $d->projects->id }})">$200</td>
                                                <td onclick="showVideo({{ $d->projects->id }})">
                                                    <a href="{{ Route('editUpload',base64_encode($d->projects->id))}}" class="btn_tble editdlt"><i class="icofont-pencil-alt-2"></i></a>
                                                    <a href="javascript:void(0)" onclick="deleteVideo({{ $d->projects->id }})" class="btn_tble editdlt"><i class="icofont-trash"></i></a>
                                                </td>
                                                @empty
                                                @endforelse
                                                @else
                                                <div class="alert alert-danger" role="alert">
                                                    Nothing Found
                                                </div>
                                                @endif
                                            </tr>
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
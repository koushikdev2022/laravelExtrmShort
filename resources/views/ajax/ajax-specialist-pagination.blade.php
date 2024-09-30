{{-- @php
dd($data);
@endphp --}}
@forelse($data as $val)

<div class="membarCard">
    <div class="d-flex mHeader">
        <div class="memberProfileImg">
            <img src="{{($val['user']['profile_picture'] != '') ? asset('storage/uploads/frontend/profile_picture/original/'.$val['user']['profile_picture']) : URL::asset('storage/frontend/dashboard/images/profile_user.png')}}" alt="">
        </div>
        <div class="memberProfileName">
            <h5>{{$val['user']['name']}}</h5>
            @php
            $avg_review=App\Models\Review::where('client_id',$val['user']['id'])->where('status','1')->avg('score');
            // $count_review=App\Models\Review::where('client_id',$val['user']['id'])->where('status','1')->count();
            @endphp
            <p class="exReview">
                @for($i=1;$i<=$avg_review;$i++)
                <i class="fa fa-star" aria-hidden="true"></i>
                @endfor
                @for($i=$avg_review;$i<5;$i++)
                <i class="fa fa-star" style="color:gray" aria-hidden="true"></i>
                @endfor
                {{-- <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i> --}}
                ({{!empty($avg_review) ? round($avg_review,1) : 'N/A'}})
            </p>
            {{-- <p class="u-online"><i class="fa-solid fa-circle"></i> Online</p> --}}
            <!-- for offline -->
            <!-- <p class="u-offline"><i class="fa-solid fa-circle"></i> Offline</p>  -->

        </div>
    </div>
    <div class="memberCardBody">
        {{-- <h5>Adipiscing elit curabitur commodo malesuada felis a rutrum pellentesque</h5> --}}
        <p>{{$val['user']['about_me']}}</p>
    </div>
    <div class="memberCardFooter">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <p><i class="icofont-location-pin"></i> {{!empty($val['user']['address_line1']) ? $val['user']['address_line1'] : 'N/A'}}</p>
            </div>
            <div class="col-md-12 col-lg-6 membarButton">
                <a class="btn-site btn-normal-outline me-2" href="{{route('user.messages',base64_encode($val['user']['id']))}}">Message</a>
                <a class="btn-site btn-normal" href="{{route('user-profile', [base64_encode($val['user']['id'])])}}">View Profile</a>
            </div>
        </div>
    </div>
</div>
@endforeach
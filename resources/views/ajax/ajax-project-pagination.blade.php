@forelse($data as $val)
<div class="taskListBox">
    <div class="taskListBody">
        <h4>{{$val['title']}}</h4>
        <h5><i class="icofont-pencil-alt-2"></i> {{'Posted '.Carbon\Carbon::parse($val['created_at'])->diffForHumans()}} <span><i class="icofont-eye-alt"></i> 15 views</span></h5>
        <h6><i class="icofont-wallet"></i> Budget: ${{ $val['budget']}}</h6>
        <p>{{Str::limit($val['description'], 175)}}</p>
    </div>
    <div class="taskListFooter">
        <div class="d-flex justify-content-between align-items-end">
            <div class="d-flex align-item-center">
                <div>
                    <img src="{{($val['user']['profile_picture'] != '') ? asset('storage/uploads/frontend/profile_picture/original/'.$val['user']['profile_picture']) : URL::asset('storage/frontend/dashboard/images/profile_user.png')}}" alt="profile image">
                </div>
                <div>
                    <h5>{{$val['user']['name'] ? $val['user']['name']: ''}}</h5>
                    <h6>Member since {{ date('Y', strtotime($val['user']['created_at'])) }}</h6>
                    <p><i class="fa fa-star" aria-hidden="true"></i>5.0 <span>(200)</span></p>
                </div>
            </div>
            <div>
                <a class="btn-site btn-normal" href="{{ Route('task_details',base64_encode($val['id'])) }}">View Task Details</a>
            </div>
        </div>
    </div>
</div>
@empty
<div class="jobBox">
    <div class="row">
        {{ 'No data' }}

    </div>
</div>
@endforelse
<!-- end job listing -->


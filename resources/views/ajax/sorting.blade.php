@if(count($videolist) > 0)
<div class="video-list-wrapper">
    @forelse($videolist as $v)
    <div class="video-holder">
        <div class="video-box">
            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" /></figure>
            <a href="#" class="video-link">
                <video poster="{{ URL::asset('public/frontend/images/ftg4.png') }}" muted>
                    <source src="{{ URL::asset('public/frontend/images/video.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <span>Sports</span>
            </a>
            <div class="video-box-footer">
                <span><i class="icofont-clock-time"></i>00.30</span>
                <span>quality 4k</span>
            </div>
        </div>
    </div>
    <div class="video-holder">
        <div class="video-box">
            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" />
            </figure>

            <a href="{{ Route('details',base64_encode($v->id) ) }}" class="video-link">

                <video poster="{{ URL::asset('public/uploads/frontend/project/img_preview/'.$v->image) }}" muted>
                    <source src="{{ URL::asset('public/uploads/frontend/project/video/'.$v->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                @php
                $lang = session()->get('locale');
                $category = \App\Models\TranslationCategory::where(['category_id'=>$v->category])->where('lang_code', '=', $lang)->first();
                @endphp
                <span>@if($v->category != '') {{ ucfirst($category->category_name) }} @endif</span>
            </a>
            <div class="video-box-footer">
                <span><i class="icofont-clock-time"></i>00.30</span>
                @if(count($v->info) > 0)
                @forelse($v->info as $i)
                <span>quality @if($i->quality == '1') HD @else 4K @endif</span>
                @empty
                @endforelse
                @endif
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
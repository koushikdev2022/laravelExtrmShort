@if(count($videolist) > 0)
<div class="video-list-wrapper">
    @forelse($videolist as $v)
    <div class="video-holder" >
        <div class="video-box" onclick="showVideo({{ $v->id }})">
            <figure><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" />
            </figure>

            <a href="javascript:void(0)" class="video-link">
                <video poster="{{ URL::asset('public/uploads/frontend/project/img_preview/'.$v->image) }}" muted>
                    <source src="{{ URL::asset('public/uploads/frontend/project/video/'.$v->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                @php
                $lang = session()->get('locale');
                $category = \App\Models\TranslationCategory::where(['category_id'=>$v->category])->where('lang_code', '=', $lang)->first();
                @endphp
                <span>@if($v->category != '') {{ ucfirst($category->category_name) }} @endif</span>
                @if($v->is_exclusive == '1')
                <span class="videoextab">Exclusive</span>
                @endif
            </a>
            <div class="video-box-footer">
                <span><i class="icofont-clock-time"></i>00.60</span>
                <span> @if(count($v->info) > 0)
                            @forelse($v->info as $key=>$i)
                            @if($key < 1)
                            quality @if($i->quality == '1') HD <br>@else 4K <br> @endif
                            @else
                            @endif
                            @empty
                            @endforelse
                        @endif
                </span>
            </div>
            <div class="likebookmark tppenw">

                @if($v->bookmark != '')
                    @if($v->bookmark->like_status == '1')
                    <a href="javascript:void(0)" class="iconancher active"><i class="icofont-book-mark"  onclick="saveProject( {{$v->id}} )"></i></a>
                    @elseif($v->bookmark->like_status == '0')
                    <a href="javascript:void(0)" class="iconancher"><i class="icofont-book-mark"  onclick="saveProject( {{$v->id}} )"></i></a>
                    @endif
                @else
                <a href="javascript:void(0)" class="iconancher"><i class="icofont-book-mark"  onclick="saveProject( {{$v->id}} )"></i></a>
                @endif

                @if($v->likes != '')
                    @if($v->likes->like_status == '1')
                    <a href="javascript:void(0)" class="iconancher active"><i class="icofont-heart"  onclick="likeProject( {{$v->id}} )"></i></a>
                    @elseif($v->likes->like_status == '0')
                    <a href="javascript:void(0)" class="iconancher"><i class="icofont-heart"  onclick="likeProject( {{$v->id}} )"></i></a>
                    @endif
                @else
                <a href="javascript:void(0)" class="iconancher"><i class="icofont-heart"  onclick="likeProject( {{$v->id}} )"></i></a>
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
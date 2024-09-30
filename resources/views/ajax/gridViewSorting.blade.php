@if(count($videolist) > 0)
<div class="videodifarent_view">
    <div class="row">
        @forelse($videolist as $v)
        <div class="col-lg-6 dsh_bx">
            <div class="videogrid_box" onclick="showVideo({{ $v->id }})">
                <div class="grid_video">
                    <a href="{{ Route('details',base64_encode($v->id) ) }}">
                        <video poster="{{ URL::asset('public/uploads/frontend/project/img_preview/'.$v->image) }}" muted>
                            <source src="{{ URL::asset('public/uploads/frontend/project/video/'.$v->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>

                        <div class="likebookmark">
                            @if($v->bookmark != '')
                            @if($v->bookmark->like_status == '1')
                            <a href="javascript:void(0)" class="iconancher active"><i class="icofont-book-mark" onclick="saveProject( {{$v->id}} )"></i></a>
                            @elseif($v->bookmark->like_status == '0')
                            <a href="javascript:void(0)" class="iconancher"><i class="icofont-book-mark" onclick="saveProject( {{$v->id}} )"></i></a>
                            @endif
                            @else
                            <a href="javascript:void(0)" class="iconancher"><i class="icofont-book-mark" onclick="saveProject( {{$v->id}} )"></i></a>
                            @endif

                            @if($v->likes != '')
                            @if($v->likes->like_status == '1')
                            <a href="javascript:void(0)" class="iconancher active"><i class="icofont-heart" onclick="likeProject( {{$v->id}} )"></i></a>
                            @elseif($v->likes->like_status == '0')
                            <a href="javascript:void(0)" class="iconancher"><i class="icofont-heart" onclick="likeProject( {{$v->id}} )"></i></a>
                            @endif
                            @else
                            <a href="javascript:void(0)" class="iconancher"><i class="icofont-heart" onclick="likeProject( {{$v->id}} )"></i></a>
                            @endif
                        </div>
                    </a>
                </div>
                <div class="dashgrdbtm">
                    @if($v->is_exclusive == '1')
                    <span class="videoextab">Exclusive</span>
                    @endif
                    <h5 class="heading"><a href="{{ Route('details',base64_encode($v->id) ) }}">{{ \Illuminate\Support\Str::limit( ucfirst($v->title),30 ) }}</a></h5>
                    @php
                    $lang = session()->get('locale');
                    $category = \App\Models\TranslationCategory::where(['category_id'=>$v->category])->where('lang_code', '=', $lang)->first();
                    @endphp
                    <a href="javascript:void(0)" class="grid_btn">@if($v->category != ''){{ ucfirst($category->category_name) }} @endif</a>
                    <ul>
                        <li><span class="title_lft">By</span><span class="descrb"><a href="#">{{ ucfirst($v->user->name) }}</a></span></li>
                        <li><span class="title_lft">quality</span>
                            @if(count($v->info) > 0)
                                @forelse($v->info as $key=>$i)
                                    @if($key < 1)
                                        <span class="descrb">@if($i->quality == '1') HD ,@else 4K ,@endif</span>
                                    @else
                                    @endif
                                @empty
                                @endforelse
                            @endif
                        </li>
                        <li><span class="title_lft">Clip length:</span><span class="descrb">00:45</span></li>
                        <li><span class="title_lft">Footage ID:</span><span class="descrb">#{{$v->footage_code}}</span></li>
                    </ul>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>
</div>
@else
<div class="alert alert-danger" role="alert">
    Nothing Found
</div>
@endif
@if(count($posts) > 0)
<ul class="recent_post d-flex align-items-start flex-wrap">
    <li>
        <h4 class="smlheading">Recent Posts</h4>
    </li>
    @forelse($posts as $p)
    <li>
        <a href="{{ Route('blog_details',base64_encode($p->id)) }}">
            <img src="{{ URL::asset('public/uploads/frontend/Blog/thumb/'.$p->image) }}">
            <p>{{ \Illuminate\Support\Str::limit($p->title,35) }}</p>
        </a>
    </li>
    @empty
    @endforelse
</ul>
@else
<div class="alert alert-danger" role="alert">
    No Data Found
</div>
@endif
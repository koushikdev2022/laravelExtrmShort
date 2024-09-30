<select class="form-control" name="playlist" id="exampleFormControlSelect1">
    <option value="">Select</option>
    @forelse($playlist as $p)
    <option value={{ $p->id }}>{{ $p->name}}</option>
    @empty
    @endforelse
</select>

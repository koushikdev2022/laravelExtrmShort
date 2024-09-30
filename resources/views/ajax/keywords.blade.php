@forelse($keyword as $k)
<input type="checkbox" name="keywords[]" value="{{ $k->id }}" id="{{ $k->id }}">
<label class="checkbox-alias" for="{{ $k->id }}"><i class="icofont-plus"></i> {{ $k->name }}</label>
@empty
@endforelse

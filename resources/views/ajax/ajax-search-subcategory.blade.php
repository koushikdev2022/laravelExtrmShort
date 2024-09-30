<option value="">Select Subcategory</option>
@forelse ($categories as $key=>$categorie)
    {{-- <p style="display: none;" id="cat-type{{ $key+1 }}">{{ $categorie->category_type }}</p> --}}
<option value="{{$categorie->id}}">{{optional($categorie->translation)->category_name}}</option>
@empty
@endforelse
@error('user_skills')
<span class="help-block">{{ $message }}</span>
@enderror

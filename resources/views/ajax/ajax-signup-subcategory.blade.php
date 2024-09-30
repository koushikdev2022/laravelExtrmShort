
{{-- @foreach ($values as $value)
    @php
        // dd($value);
    @endphp
@endforeach --}}

@forelse ($categories as $categorie)
<option value="{{$categorie->id}}" {{(!empty($values) && in_array($categorie->id,$values))?"selected":""}}>{{optional($categorie->translation)->category_name}}</option>
@empty
@endforelse
@error('user_skills')
<span class="help-block">{{ $message }}</span>
@enderror
{{-- {{(in_array($categorie->id,$value))?"selected":""}} --}}
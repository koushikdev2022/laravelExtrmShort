<div class="common-section-box-content">
    <form action="" method="POST" wire:submit.prevent="store">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Update Profile Picture</label>
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' id="imageUpload" wire:model.defer="profile_picture"
                                        accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    @if ($profile_picture)
                                    <div id="imagePreview"
                                        style="background-image: url('{{ $profile_picture->temporaryUrl() }}');">
                                    </div>
                                    @else
                                    <div id="imagePreview" style="background-image: url('{{$this->user->avatar}}');">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @error('profile_picture')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" wire:model.defer="profileform.first_name" class="form-control" placeholder="">
                    @error('profileform.first_name')
                    <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" wire:model.defer="profileform.last_name" class="form-control" placeholder="">
                    @error('profileform.last_name')
                    <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" wire:model.defer="profileform.email" class="form-control" placeholder="" readonly>
                    @error('profileform.email')
                    <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" wire:model.defer="profileform.phone" class="form-control" placeholder="">
                    @error('profileform.phone')
                    <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="usr">Date of Birth</label>
                    <input type="date" wire:model.defer="profileform.dob" max="{{date('Y-m-d')}}" class="form-control"
                        placeholder="">
                    @error('profileform.dob')
                    <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- @else
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="usr">Company  Name</label>
                    <input type="text" wire:model.defer="profileform.client_company_name" class="form-control"
                        placeholder="">
                    @error('profileform.company_name')
                    <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            @endif --}}

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="usr">Country</label>
                    <select class="form-control" name="country" wire:model.defer="profileform.country">
                        <option value="">Select Country</option>
                        @forelse ($countries as $country)
                        <option value="{{$country->id}}" {{ $profileform['country']==$country->id?'selected':'' }}>
                            {{$country->country_name}}
                        </option>
                        @empty

                        @endforelse
                    </select>
                    @error('profileform.country')
                    <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            {{-- @if(!empty($user) && $user->type_id=='3')
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="usr">Freelancer Status :</label>
                    </div>
                
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="check1" onclick="myFunction()" name="individual_freelancer" wire:model.defer="profileform.individual_freelancer" value="1">
                    <label class="form-check-label" for="check1">Individual Freelancer</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input company_employee" id="check2" onclick="myFunction()" name="company_employee" wire:model.defer="profileform.company_employee" value="1">
                    <label class="form-check-label" for="check2">Company Employee</label>
                </div>
            </div>
            <div class="col-sm-6 company_employee_show" {{!empty($profileform['company_employee']) && !empty($profileform['employee_company_name']) ? '' : 'style=display:none'}}>
                <div class="form-group">
                    <label>Company Name (If Company employee)</label>
                    <input type="text" class="form-control" wire:model.defer="profileform.employee_company_name" placeholder="Company Name">
                </div>  
            </div>
            <div class="col-md-12 company_employee_show" {{!empty($profileform['company_employee']) && !empty($profileform['employee_company_logo']) ? '' : 'style=display:none'}}>
                @if ($employee_company_logo)
                    Photo Preview:<br>
                    <img src="{{ $employee_company_logo->temporaryUrl() }}" style="width:100px; height:100px;border-radius:50%">
                @elseif(!empty($profileform['employee_company_logo']))
                    <img src="{{asset('storage/uploads/frontend/company_logo/thumb/'.$profileform['employee_company_logo'])}}" style="width:100px; height:100px; border-radius:50%">
                @endif
                <div class="form-group">
                    <label>Upload Company Logo</label>
                    <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" wire:model.defer="employee_company_logo" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                    </div>
                    </div>
                </div> 
            </div>
            @endif --}}
            
            <div class="col-sm-6" wire:ignore>
                <div class="form-group">
                    <label for="usr">Availablity</label>
                    {{-- @php
                        dd($availablity);
                    @endphp --}}
                    <select multiple="multiple" class="js-example-placeholder-multiple availablity form-control cast-slet" data-placeholder="Select Availablity">
                        <option value="" >Select Availablity</option>
                        <option value="1" {{ is_array($availablity) && in_array("1",$availablity)?'selected':'' }}>Monday</option>
                        <option value="2" {{ is_array($availablity) && in_array("2",$availablity)?'selected':'' }}>Tuesday</option>
                        <option value="3" {{ is_array($availablity) && in_array("3",$availablity)?'selected':'' }}>Wednesday</option>
                        <option value="4" {{ is_array($availablity) && in_array("4",$availablity)?'selected':'' }}>Thursday</option>
                        <option value="5" {{ is_array($availablity) && in_array("5",$availablity)?'selected':'' }}>Friday</option>
                        <option value="6" {{ is_array($availablity) && in_array("6",$availablity)?'selected':'' }}>Saturday</option>
                        <option value="7" {{ is_array($availablity) && in_array("7",$availablity)?'selected':'' }}>Sunday</option>
                    </select>
                    @error('availablity')
                    <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-sm-12" wire:ignore>
                <div class="form-group">
                    <label for="usr">Language Known</label>
                    <select multiple="multiple" class="js-example-placeholder-multiple languages form-control cast-slet"
                        data-placeholder="Pick Languages">
                        @forelse ($languages as $language)
                        <option value="{{$language->id}}"
                            {{ is_array($detailform['languages']) && in_array($language->id,$detailform['languages'])?'selected':'' }}>
                            {{$language->Language}}
                        </option>
                        @empty

                        @endforelse

                    </select>
                    @error('detailform.languages')
                    <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label for="usr">Address</label>
                    {{-- <textarea class="form-control" placeholder="" wire:model.defer="profileform.address_line1"></textarea> --}}
                    <input id="searchMapInput" placeholder="Enter your address"  wire:model.defer="address_line1" type="text" class="form-control mapControls searchMapInput">
                    <input id="location-snap" placeholder="Enter your address" name="address_line2" value="hello" wire:model.defer="address_line2" type="hidden" class="form-control mapControls location-snap">
                    <input id="lat-span" placeholder="Enter your address" wire:model.defer="latitude" type="hidden" class="form-control mapControls">
                    <input id="lon-span" placeholder="Enter your address" wire:model.defer="longitude" type="hidden" class="form-control mapControls">
                    @error('profileform.address_line1')
                    <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label for="usr">Short description about yourself</label>
                    <textarea class="form-control"
                        placeholder="Please add a brief description that makes you or your business to stand out"
                        wire:model.defer="detailform.about"></textarea>
                    @error('detailform.about')
                    <span class="help-block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
{{-- 
        @if(!empty($user) && $user->type_id=='3')
        <div class="card mt-2">
            <div class="card-header">
                <strong>Work Experience</strong>
            </div>
            <div class="card-body">
                <div class="col-sm-12">
                    <div class="form-group mb-0">
                        @foreach($detailform['educations'] as $key => $edu)
                       
                        <div class=" add-input" wire:key="education_{{$key}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Job Title"
                                            wire:model.defer="detailform.educations.{{ $key }}.lavel">
                                        @error('detailform.educations.'.$key.'.lavel')
                                        <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="customRadioInline{{$key+1}}" onclick="is_present({{$key+1}})" name="check_category" wire:model.defer="detailform.educations.{{ $key }}.is_present" value="1" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInline{{$key+1}}">I currently work here</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="date" class="form-control" placeholder="Years"
                                            wire:model.defer="detailform.educations.{{ $key }}.from_date">
                                        @error('detailform.educations.'.$key.'.from_date')
                                        <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6 {{(!empty($edu['is_present']) && $edu['is_present']==1) ? 'd-none':''}}" id="to_date{{$key+1}}">
                                    <div class="form-group">
                                        <input type="date" class="form-control" placeholder="Years"
                                            wire:model.defer="detailform.educations.{{ $key }}.to_date">
                                        @error('detailform.educations.'.$key.'.to_date')
                                        <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea type="date" class="form-control" placeholder="description"
                                            wire:model.defer="detailform.educations.{{ $key }}.description"></textarea>
                                        @error('detailform.educations.'.$key.'.description')
                                        <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if($key===0)
                                <div class="col-md-2">
                                    <button class="common-btn green" wire:loading.class="d-none"
                                        wire:click.prevent="add('education')" wire:target="add('education')">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    <button class="common-btn green custloading" type="button" wire:loading
                                        wire:target="add('education')" disabled>
                                        <i class="fa fa-circle-o-notch fa-spin"></i>
                                    </button>
                                </div>
                                @else
                                <div class="col-md-2">
                                    <button class="common-btn btn btn-danger" wire:loading.class="d-none"
                                        wire:click.prevent="remove('education','{{$key}}')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <button class="common-btn btn btn-danger custloading" type="button" wire:loading
                                        wire:target="remove('education','{{$key}}')" disabled>
                                        <i class="fa fa-circle-o-notch fa-spin"></i>
                                    </button>
                                </div>
                                @endif

                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-header">
                <strong>Education</strong>
            </div>
            <div class="card-body">
                <div class="col-sm-12">
                    <div class="form-group mb-0">

                        @foreach($detailform['edus'] as $k => $ed)
                        <div class=" add-input" wire:key="ed_{{$k}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Level of Education"
                                            wire:model.defer="detailform.edus.{{ $k }}.lavel_of_education">
                                        @error('detailform.edus.'.$k.'.lavel_of_education')
                                        <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="School"
                                            wire:model.defer="detailform.edus.{{ $k }}.school">
                                        @error('detailform.edus.'.$k.'.school')
                                        <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="School location"
                                            wire:model.defer="detailform.edus.{{ $k }}.school_location">
                                        @error('detailform.edus.'.$k.'.school_location')
                                        <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" id="customRadioInlines{{$k+1}}" onclick="is_edu_present({{$k+1}})" wire:model.defer="detailform.edus.{{ $k }}.is_edu_present" value="1" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadioInlines{{$k+1}}">I currently work here</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="date" class="form-control" placeholder="Years"
                                            wire:model.defer="detailform.edus.{{ $k }}.from_edu_date">
                                        @error('detailform.edus.'.$k.'.from_edu_date')
                                        <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6 {{(!empty($ed->is_edu_present) && $ed->is_edu_present || !empty($ed['is_edu_present']) && $ed['is_edu_present']==1) ? 'd-none':''}}" id="to_edu_date{{$k+1}}">
                                    <div class="form-group">
                                        <input type="date" class="form-control" placeholder="Years"
                                            wire:model.defer="detailform.edus.{{ $k }}.to_edu_date">
                                        @error('detailform.edus.'.$k.'.to_edu_date')
                                        <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if($k===0)
                                <div class="col-md-2">
                                    <button class="common-btn green" wire:loading.class="d-none"
                                        wire:click.prevent="add('ed')" wire:target="add('ed')">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                    <button class="common-btn green custloading" type="button" wire:loading
                                        wire:target="add('ed')" disabled>
                                        <i class="fa fa-circle-o-notch fa-spin"></i>
                                    </button>
                                </div>
                                @else
                                <div class="col-md-2">
                                    <button class="common-btn btn btn-danger" wire:loading.class="d-none"
                                        wire:click.prevent="remove('ed','{{$k}}')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    <button class="common-btn btn btn-danger custloading" type="button" wire:loading
                                        wire:target="remove('ed','{{$k}}')" disabled>
                                        <i class="fa fa-circle-o-notch fa-spin"></i>
                                    </button>
                                </div>
                                @endif

                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        @endif --}}
        @if(!empty($user) && $user->type_id=='3')
        <div class="card mt-2">
            <div class="card-header">
                <strong>Categories</strong>
            </div>
            <div class="card-body">
                <div class="col-sm-12">
                    <div class="form-group mb-0">
                        <select multiple="multiple"
                            class="js-example-placeholder-multiple-categories form-control cast-slet"
                            data-placeholder="Pick Categories" data-limit="3">
                            @forelse ($categories as $category)
                            <option value="{{$category->id}}"
                                {{ is_array($user_categories) && in_array($category->id, $user_categories) ? 'selected' : ''}}>
                                {{optional($category->translation)->category_name}}
                            </option>
                            @empty

                            @endforelse
                        </select>
                        @error('user_categories')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-2">
            <div class="card-header">
                <strong>Sub Categories</strong>
            </div>
            <div class="card-body">
                <div class="col-sm-12">
                    <div class="form-group mb-0">
                        <select multiple="multiple"
                            class="js-example-placeholder-multiple-skills form-control cast-slet"
                            data-placeholder="Pick Skills" data-limit="10">
                            @forelse ($skills as $skill)
                            <option value="{{$skill->id}}"
                                {{ is_array($user_skills) && in_array($skill->id, $user_skills) ? 'selected' : ''}}>
                                {{optional($skill->translation)->category_name}}
                            </option>
                            @empty

                            @endforelse
                        </select>
                        @error('user_skills')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        @endif
      
        <div class="text-center save mb-3 dash_btnwrp mt-2">
            <button type="submit" class="common-btn green" wire:loading.class="d-none">Save</button>
            <button class="common-btn green custloading" type="button" wire:loading wire:target="store" disabled>
                <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
            </button>
        </div>
    </form>

    @push('head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        Livewire.hook('message.processed', (el, component) => {
            $('.js-example-placeholder-multiple-skills').select2({
                maximumSelectionLength: 10
            });
            $('.js-example-placeholder-multiple-categories').select2({
                maximumSelectionLength: 3
            });
        });

        $('.js-example-placeholder-multiple').on('change', function(e) {
            if ($(e.target).hasClass('languages')) {
                var data = $('.js-example-placeholder-multiple.languages').select2().val();
                @this.set('detailform.languages', data);
            }
        });
        
        $('.js-example-placeholder-multiple-skills').on('change', function(e) {
            var data = $('.js-example-placeholder-multiple-skills').select2().val();
            @this.set('user_skills', data);
        });
        $('.js-example-placeholder-multiple-categories').on('change', function(e) {
            var data = $('.js-example-placeholder-multiple-categories').select2().val();
            @this.set('user_categories', data);
        });
    });
    </script>

    <script type="text/javascript">
        function myFunction()
        {
            if($('.company_employee').is(":checked"))   
                $(".company_employee_show").show();
            else
                $(".company_employee_show").hide();
        }
    </script>
    @endpush
</div>
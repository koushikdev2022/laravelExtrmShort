@extends('layouts.main')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">
@stop
@section('content')

    <section>
        <div class="loginHead">
            <div class="loginImg"></div>
            <!--background-->
        </div>
        <style>
            .select2-container--default .select2-results__option--selected {
                background-color: #d5d5d5 !important;
                color: #2a2a2a;
            }
        </style>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="taskBox">
                        <div class="taskHeader">
                            <h2>{{__('site.Create a task')}}</h2>
                        </div>
                        <form id="projectRequest" action="{{ Route('store_project') }}" method="post" enctype="multipart/form-data">
<div class="accordion accordiannwbx" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        English(EN)
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
       <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Company Name<span class="red">*</span></label>
      </div>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
       Hebrew(HE)
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
       <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Company Name<span class="red">*</span></label>
      </div>
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Russian(RU)
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
       <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Company Name<span class="red">*</span></label>
      </div>
      </div>
    </div>
  </div>
</div>
                            
                            
                            
                            
                            
                            @csrf

                            <div class="panel-group" id="accordion">
                                @forelse($langs as $language)
                                <div class="panel panel-default">
                                    <div class="panel-heading containerof-{{$language->lang_code}}">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$loop->iteration}}">
                                                <span class="glyphicon glyphicon-file"></span>{{ucfirst($language->lang).' ('.$language->lang_code.')'}}</a>
                                        </h4>
                                    </div>
                                    <div id="collapse{{$loop->iteration}}"
                                        class="panel-collapse collapse {{$loop->iteration===1?'in':''}}">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Category Name <span
                                                        class="required">*</span></label>
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control"
                                                        name="{{$language->lang_code}}[category_name]" value=""
                                                        placeholder="Category Name">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @empty

                                @endforelse
                            </div>
                            <div class="taskBody">
                                <div class="form-group form-floating mb-3">
                                    <input type="text" class="form-control" name="title"
                                        value="{{ old('title') != '' ? old('title') : '' }}" id="floatingInput"
                                        placeholder="Enter Title" aria-required="true" required>
                                    <label for="floatingInput">{{__('site.Task title')}} <b class="text-danger">*</b></label>
                                    <div class="help-block text-danger"></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-floating mb-3">
                                            <select multiple="multiple" class="js-example-basic-multiple form-control"
                                                data-placeholder="{{__('site.Pick Categories')}}" data-limit="3" id="category_id"
                                                name="categories[]" required>
                                                {{-- <option selected disabled>Select Category</option> --}}
                                                @forelse ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ !empty($cat_detail->parent_id) && $category->id == $cat_detail->parent_id ? 'selected' : '' }}
                                                        {{ !empty($cat_detail->id) && $category->id == $cat_detail->id ? 'selected' : '' }}
                                                        {{ !empty($cat->id) && $category->id == $cat->id ? 'selected' : '' }}
                                                        {{ !empty($subcat->parent_id) && $category->id == $subcat->parent_id ? 'selected' : '' }}>
                                                        {{ optional($category->translation)->category_name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group form-floating mb-3">
                                            <select multiple="multiple"
                                                class="js-example-basic-multiple-subcategory form-control cast-slet"
                                                data-placeholder="{{__('site.Pick Sub Category')}}" id="show-signup-subcategory"
                                                name="sub_categories[]" data-limit="10">
                                                @forelse ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}"
                                                        {{ !empty($cat_detail->id) && $subcategory->id == $cat_detail->id ? 'selected' : '' }}
                                                        {{ !empty($subcat->id) && $subcategory->id == $subcat->id ? 'selected' : '' }}>
                                                        {{ optional($subcategory->translation)->category_name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="labelMain">{{__('site.Add task description')}}<b class="text-danger">*</b></label>
                                </div>
                                <div class="form-group form-floating mb-3">
                                    <textarea class="form-control" onkeyup="textAreaAdjust(this)" name="description" style="overflow:hidden"
                                        placeholder="Leave a comment here" id="floatingTextarea" required></textarea>
                                    <label for="floatingTextarea">{{__('site.Write here')}}</label>
                                    <div class="help-block text-danger"></div>
                                </div>

                                {{-- <div class="col-md-12">
                                <h1 class="text-center">Drag and Drop File Upload Using Dropzone JS in Laravel 8 - Techsolutionstuff</h1><br>
                                <form action="{{route('bundle-photo')}}" method="post" name="image" files="true" enctype="multipart/form-data" class="dropzone" id="image-upload">
                            @csrf
                            <div>
                                <h3 class="text-center">Upload Multiple Images</h3>
                            </div>
                </div> --}}
                                {{-- <div class="sd-box sd-advanced-upload mb-3">
                                <div class="sd-box-wrapper">
                                    <div class="sd-label-wrapper sd-label">
                                        <span class="sd-box-dragndrop">drag or</span>
                                        <span class="sd-box-file-name"></span>
                                        <label class="sd-label">uplaod <span class="sd-box-browse-file">File</span></label>
                                        <span class="sd-box-dragndrop">file</span>
                                        <input type="file" name="files[]" id="uploadInput" multiple="">
                                    </div>
                                </div>
                            </div> --}}
                                {{-- <div>
                                <h3>Upload Multiple Image By Click On Box</h3>
                            </div>
                            <div class="form-group allim">
                                <label>Bundle Files</label>
                                <div class="input-group">
                                    <input type="hidden" name="AllImages[is_default]" id="is_default" value="0">
                                    <div class="product-image"></div>
                                    <div class="image_upload_div" style="display: none;">
                                        <form action="" method="post" class="dropzone" id="my-dropzone">
                                            @csrf
                                        </form>
                                    </div>

                                    <div class="image_upload_div" style="width: 100%;">
                                        <form action="{{ Route('bundle-photo') }}" method="post" class="dropzone" id="my-dropzone">
                @csrf
            </div>

        </div>
        <span class="help-block text-danger help-allimgaes"></span>
    </div> --}}
                                <div class="row" style="clear: both;margin-top: 18px;">
                                    <div class="col-12">
                                        <div class="dropzone" id="file-dropzone"></div>
                                    </div>
                                </div>

                                <div class="lineDivider"></div>
                                {{-- <div>
                                    <label class="labelMain">Also needed</label>
                                </div>
                                <div class="form-group ans_checkbox">
                                    @forelse ($categories as $category)
                                        <input type="checkbox" name="services[]" value="{{ $category->id }}"
                                            id="r{{ $category->id }}">
                                        <label class="checkbox-alias" for="r{{ $category->id }}"><i
                                                class="icofont-plus"></i>
                                            {{ optional($category->translation)->category_name }}</label>
                                    @empty
                                    @endforelse
                                    <div class="help-block text-danger"></div>
                                </div>


                                <div class="lineDivider"></div> --}}

                                <div>
                                    <label class="labelMain">{{__('site.Date and time')}}</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-md-xl-5">
                                        <div class="form-group form-floating resMb-3">
                                            <select multiple="multiple"
                                                class="js-example-placeholder-multiple-availablity  form-control cast-slet"
                                                name="avl_date[]" data-placeholder="{{__('site.Select Availablity')}}">
                                                <option value="">{{__('site.Select Availablity')}}</option>
                                                <option value="1">{{__('site.Monday')}}</option>
                                                <option value="2">{{__('site.Tuesday')}}</option>
                                                <option value="3">{{__('site.Wednesday')}}</option>
                                                <option value="4">{{__('site.Thursday')}}</option>
                                                <option value="5">{{__('site.Friday')}}</option>
                                                <option value="6">{{__('site.Saturday')}}</option>
                                                <option value="7">{{__('site.Sunday')}}</option>
                                            </select>
                                            <div class="help-block text-danger"></div>
                                        </div>

                                    </div>
                                    <div class="col-md-7 col-md-xl-7">
                                        <div class="input-group">
                                            <div class="form-group form-floating w-70">
                                                <input type="date" class="form-control form-floating-left"
                                                    id="floatingInput" name="begin_date" placeholder="name@example.com"
                                                    required>
                                                <label for="floatingInput">{{__('site.Beginning')}} <b class="text-danger">*</b></label>
                                                <div class="help-block text-danger"></div>
                                            </div>
                                            <div class="form-group form-floating w-30">
                                                <input type="time" class="form-control form-floating-right"
                                                    id="floatingInput" name="begin_time" placeholder="name@example.com">
                                                <label for="floatingInput">{{__('site.Time')}}</label>
                                                <div class="help-block text-danger"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="lineDivider"></div>

                                <div>
                                    <label class="labelMain">{{__('site.Start address')}} <b class="text-danger">*</b></label>
                                </div>

                                <div class="form-group form-floating input-group mb-3">
                                    <input id="searchMapInput" placeholder="Street, house No., floor, apartment"
                                        name="start_address" type="text" class="form-control mapControls" required>
                                    {{-- <input id="searchMapInput" class="mapControls" type="text" placeholder="Enter a location"> --}}
                                    <input id="location-snap" placeholder="Enter your address" name="address_line1"
                                        type="hidden" class="form-control mapControls">
                                    <input id="lat-span" placeholder="Enter your address" name="latitude"
                                        type="hidden" class="form-control mapControls">
                                    <input id="lon-span" placeholder="Enter your address" name="longitude"
                                        type="hidden" class="form-control mapControls">

                                    {{-- <input type="text" class="form-control" name="code1" placeholder="Street, house No., floor, apartment "> --}}
                                    <label for="code1">{{__('site.Street, house No., floor, apartment')}} </label>
                                    <span class="input-group-text inputGroupWhite"><i
                                            class="icofont-location-pin"></i></span>
                                </div>
                                <div class="help-block text-danger"></div>

                                <span id="finishAddress" class="d-none">
                                <div>
                                    <label class="labelMain">{{__('site.Finish address')}}</label>
                                </div>
                                <div class="d-flex align-items-center mb-3" >
                                    <div class="flex-fill">
                                        <div class="form-group form-floating input-group ">
                                            <input id="searchMapInput1" placeholder="Street, house No., floor, apartment"
                                                name="final_address[]" type="text" class="form-control mapControls">
                                            {{-- <input id="searchMapInput" class="mapControls" type="text" placeholder="Enter a location"> --}}
                                            <input id="location-snap1" placeholder="Enter your address"
                                                name="address_line2[]" type="hidden" class="form-control mapControls">
                                            <input id="lat-span1" placeholder="Enter your address"
                                                name="final_latitude[]" type="hidden" class="form-control mapControls">
                                            <input id="lon-span1" placeholder="Enter your address"
                                                name="final_longitude[]" type="hidden" class="form-control mapControls">

                                            <label for="code1">{{__('site.Street, house No., floor, apartment')}} </label>
                                            <span class="input-group-text inputGroupWhite"><i
                                                    class="icofont-location-pin"></i></span>
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="wraper">
                                </div>
                                <div>
                                    <button class="addAddress btn add_icon">{{__('site.Add address')}}</button>
                                </div>
                                </span>


                                <div class="form-group form-check form-check-muted mb-3 d-none" id="chk-hide">
                                    <input class="form-check-input" type="checkbox" value="1" name="ck_comp_point"
                                        id="flexCheckDefault1">
                                    <label class="form-check-label" for="flexCheckDefault1">
                                        {{__('site.Return to the first point after completion')}}
                                    </label>
                                    <div class="help-block text-danger"></div>
                                </div>



                                <div>
                                    <label class="labelMain">{{__('site.Phone number')}} <b class="text-danger">*</b></label>
                                </div>

                                <div class="form-group input-group mb-3 igLeftIcon">
                                    <span class="input-group-text">
                                        <img src="{{ asset('storage/frontend/assets/images/icons/flag.svg') }}">
                                    </span>
                                    <input type="text" class="form-control simpleFormControl" name="phone"
                                        value="+972" required>
                                    <div class="help-block text-danger"></div>
                                </div>

                                <p class="infoTitle">{{__('site.To receive quotes from specialists, please, provide valid phone number.')}}</p>


                            </div>
                            <div class="taskBody">
                                <div>
                                    <label class="labelMain">{{__('site.Your task budget?')}} <b class="text-danger">*</b></label>
                                </div>

                                <div class="form-group form-check input-group mb-3 igLeftIcon">
                                    <span class="input-group-text pe-2">
                                        ₪
                                    </span>
                                    <input type="number" class="form-control simpleFormControl ps-0" name="budget"
                                        placeholder="{{__('site.Your budget')}} " required>
                                </div>
                                <div class="help-block text-danger"></div>


                                <div class="form-group form-check form-check-custom">
                                    <input class="form-check-input" type="checkbox" value="1" name="ck_estimate"
                                        id="flexCheckDefault2">
                                    <label class="form-check-label" for="flexCheckDefault2">
                                        {{__('site.Get Estimate')}}
                                    </label>
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="taskBody">
                                <div>
                                    <label class="labelMain labelMainBig">{{__('site.Notifications')}}</label>
                                </div>
                                <div class="form-group form-check form-check-muted mb-2">
                                    <input class="form-check-input" type="checkbox" value="1"
                                        name="notifications_1_option" id="flexCheckDefault3">
                                    <label class="form-check-label" for="flexCheckDefault3">
                                        {{__('site.Notify me of new proposals to the task by e-mail')}}
                                    </label>
                                </div>
                                <div class="form-group form-check form-check-muted mb-2">
                                    <input class="form-check-input" type="checkbox" value="1"
                                        name="notifications_2_option" id="flexCheckDefault4">
                                    <label class="form-check-label" for="flexCheckDefault4">
                                        {{__('site.Notify me of new proposals to the task by')}} <img
                                            src="{{ asset('storage/frontend/images/viber.svg') }}"
                                            style="height:20px;width:20px"> {{__('site.Viber')}}
                                    </label>
                                </div>
                                <div class="help-block text-danger">
                                </div>

                                <div class="lineDivider"></div>

                                <div>
                                    <label class="labelMain labelMainBig">{{__('site.Visibility settings')}}</label>
                                </div>
                                <div class="form-group form-check form-check-muted mb-2">
                                    <input class="form-check-input" type="checkbox" value="1"
                                        name="visibility_1_option" id="flexCheckDefault5">
                                    <label class="form-check-label" for="flexCheckDefault5">
                                        {{__('site.Show my task only to specialists')}}
                                    </label>
                                </div>

                                <div class="form-group form-check form-check-muted mb-2">
                                    <input class="form-check-input" type="checkbox" value="1"
                                        name="visibility_2_option" id="flexCheckDefault6">
                                    <label class="form-check-label" for="flexCheckDefault6">
                                        {{__('site.I want to receive proposals only from proven specialists')}}
                                    </label>
                                </div>
                                <div class="help-block text-danger"></div>
                            </div>
                            @if (empty(Auth()->guard('frontend')->user()
                            ))
                                <div class="taskBody">
                                    <div>
                                        <label class="labelMain labelMainBig">{{__('site.My contacts')}}</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-floating mb-3">
                                                <input type="text" class="form-control" name="last_name"
                                                    value="" id="floatingInput" placeholder="Enter Title">
                                                <label for="floatingInput">{{__('site.Your surname')}}</label>
                                                <div class="help-block text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-floating mb-3">
                                                <input type="text" class="form-control" name="name" value=""
                                                    id="floatingInput" placeholder="Enter Title">
                                                <label for="floatingInput">{{__('site.Your name')}}</label>
                                                <div class="help-block text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-floating mb-3">
                                                <input type="text" class="form-control" name="email" value=""
                                                    id="floatingInput" placeholder="Enter Title">
                                                <label for="floatingInput">{{__('site.Insert your e-mail')}}</label>
                                                <div class="help-block text-danger"></div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                <div class="form-group input-group mb-3 igLeftIcon">
                    <span class="input-group-text">
                        <img src="{{asset('storage/frontend/assets/images/icons/flag.svg')}}">
                    </span>
                    <input type="text" class="form-control simpleFormControl" name="phone" value="" placeholder="Your phone number">
                    <div class="help-block text-danger"></div>
                </div>
            </div> --}}
                                    </div>
                                    <div class="row align-items-end">
                                        <div class="col-md-8">
                                        </div>
                                        {{-- <div class="col-md-8">
                <p class="infoTitle">To receive quotes from specialists, please, provide valid information.</p>
                <div class="form-group form-check form-check-muted mb-2">
                <input class="form-check-input" type="checkbox" value="1" name="visibility_1_option" id="flexCheckDefault51">
                <label class="form-check-label" for="flexCheckDefault51">
                I accept the <a class="alink" href="#">terms of service</a>
                </label>
            </div>

            <div class="form-group form-check form-check-muted mb-2">
                <input class="form-check-input" type="checkbox" value="1" name="visibility_2_option" id="flexCheckDefault61">
                <label class="form-check-label" for="flexCheckDefault61">
                I accept the <a class="alink" href="#">privacy policy</a>
                </label>
            </div>
            </div> --}}
                                        <div class="col-md-4 text-center">
                                            <a class="linkRegister" href="{{ route('login') }}"><i
                                                    class="fa fa-long-arrow-right" aria-hidden="true"></i> {{__('site.I am already registered')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="taskFooter">
                                <button class="btn-site btn-block" type="submit"> {{__('site.Publish')}} </button>
                            </div>
                        </form>
                    </div>
                    <div class="pageFooter">
                        <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat ac
                            turpis quis tempus. Praesent at velit neque. Class aptent taciti sociosqu ad litora torquent per
                            conubia nostra, per inceptos himenaeos. In pellentesque,
                            turpis quis eleifend pellentesque, lacus arcu dignissim orci, sit amet condimentum nibh arcu
                            vitae mauris. Donec eu dictum risus, nec lobortis eros. Nullam nec dui vel ligula posuere
                            maximus. Praesent tempus dui ac diam facilisis
                            scelerisque.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.fileDropzone = {
            url: '{{ route('file-store') }}',
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            maxFilesize: 8,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            removedfile: function(file) {
                var name = file.upload.filename;
                $.ajax({
                    type: 'POST',
                    url: '{{ route('file-remove') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        name: name
                    },
                    success: function(data) {
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
            success: function(file, response) {
                console.log(file);
            },
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            $('.js-example-basic-multiple-subcategory').select2();
            $('.js-example-basic-multiple-language').select2();
            $('.js-example-placeholder-multiple-availablity').select2();
        });
    </script>
    <script>
        $(document).ready(function() {

            $(".commentbo").focus();

            var max = 5; //maximum input boxes allowed
            var container = $(".wraper");
            var add = $(".add_icon"); //Plus sign id

            var x = 1; //input field count intially
            $(add).click(function(e) {
                e.preventDefault();
                if (x < max) { //maximum number of input field allowed
                    x++; //input field increment
                    var html = '';

                    html += '<div class="hide-div d-flex align-items-center mb-3">';
                    html += '<div class="flex-fill">';
                    html += '<div class="form-floating input-group">';
                    html += '<input id="searchMapInput' + x +
                        '" placeholder="Street, house No., floor, apartment" name="final_address[]" type="text" class="form-control mapControls searchMapInput1">';

                    html += '<input id="location-snap' + x +
                        '" placeholder="Enter your address" name="address_line2[]" type="hidden" class="form-control mapControls">';
                    html += '<input id="lat-span' + x +
                        '" placeholder="Enter your address" name="final_latitude[]" type="hidden" class="form-control mapControls">';
                    html += '<input id="lon-span' + x +
                        '" placeholder="Enter your address" name="final_longitude[]" type="hidden" class="form-control mapControls">';

                    html += '<label for="code1">Street, house No., floor, apartment</label>';
                    html += '<span class="input-group-text inputGroupWhite">';
                    html += '<i class="icofont-location-pin">';
                    html += '</i>';
                    html += '</span>';
                    html += '</div>',
                        html += '</div>',
                        html += '<div>';
                    html += '<button class="removeItem" type="button">';
                    html += '<i class="icofont-minus-circle">',
                        html += '</i>',
                        html += '</button>';
                    html += '</div>',
                        html += '</div>';

                    $(container).append(html); //adding new input field
                    // $(container).append('<div class="form-group"><div class="input-group nwfrmstl"><input type="text" class="form-control w-auto" name="listed_responsibility[]" placeholder="Listed Responsibility/Award/Placement"/> <div class="input-group-append"><a href="#" class="delete buttonfx mt-2 smallbtnremov red rounded slideleft bouncein" data-toggle="tooltip" title="Delete"><span><i class="icofont-trash"></i></span></a></div></div></div>'); //adding new input field
                    initMap();
                }

            });


        });

        $(document).on("click", '.removeItem', function(e) { //user click on remove text
            e.preventDefault();
            $(this).closest('.hide-div').remove();
        });

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#projectRequest').on('submit', function(e) {
                e.preventDefault();
                let formdata = new FormData($("#projectRequest")[0]);
                ajaxindicatorstart();
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: formdata,
                    dataType: "json",
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        ajaxindicatorstop();
                        if (data.success == 200) {
                            notie.alert({
                                type: 'success',
                                text: '<i class="fa fa-check"></i> ' + data.message,
                                time: 8
                            });
                        } else {
                            notie.alert({
                                type: 'error',
                                text: '<i class="fa fa-times-circle-o"></i> ' + data
                                    .message,
                                time: 8
                            });
                        }
                        window.location = data.link;
                    },
                    error: function(response) {
                        ajaxindicatorstop();

                        $.each(response.responseJSON.errors, function(key, val) {
                            $("#projectRequest").find('[name="' + key + '"]').closest(
                                ".form-group").find(".help-block").html(val[0]);
                            $("#projectRequest").find('[name="' + key + '"]').closest(
                                ".form-group").addClass("has-error");
                        });
                    }
                });
            });
        });
    </script>
@stop

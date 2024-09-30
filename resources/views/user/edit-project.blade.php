@extends('layouts.master')

@section('content')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css"> --}}
<link href="{{asset('storage/frontend/custom/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
<style>

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <form id="project_store_form" action="{{ Route('user.store-project') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="taskBox">
                <div class="taskHeader">
                    <h2>Create a task</h2>
                </div>
                    <div class="taskBody">
                        <div class="form-group form-floating mb-3">
                            <input type="hidden" name="bid" value="{{$project->id}}" />
                            <input type="text" class="form-control" name="title" value="{{$project->title}}" placeholder="Enter title" id="floatingInput" >
                            <label for="floatingInput">Task title</label>
                            <div class="help-block text-danger"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-floatingx mb-3">
                                    <select multiple="multiple" class="js-example-basic-multiple form-control" data-placeholder="Pick Categories" data-limit="3" id="category_id" name="categories[]">
                                        @php
                                            $cats= explode(",",$project->categories);
                                        @endphp
                                        @forelse ($categories as $category)
                                        <option value="{{$category->id}}" {{(in_array($category->id,$cats))?"selected":""}}>{{optional($category->translation)->category_name}}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @php
                                    $subcats= explode(",",$project->sub_categories);
                                @endphp
                                <div class="form-group form-floatingx mb-3">
                                    <select multiple="multiple" class="js-example-basic-multiple-subcategory form-control cast-slet" data-placeholder="Pick Sub Category" id="show-signup-subcategory" name="sub_categories[]" data-limit="10">
                                        @forelse ($subcategories as $subcategory)
                                        <option value="{{$subcategory->id}}" {{(in_array($subcategory->id,$subcats))?"selected":""}}>{{optional($subcategory->translation)->category_name}}</option>
                                        @empty
                
                                        @endforelse
                                    </select>
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="labelMain">Add task description</label>
                        </div>
                        <div class="form-group form-floating mb-3">
                            <textarea class="form-control" onkeyup="textAreaAdjust(this)" name="description" style="overflow:hidden" placeholder="Leave a comment here" id="floatingTextarea">{{$project->description}}</textarea>
                            <label for="floatingTextarea">Write here</label>
                            <div class="help-block text-danger"></div>
                        </div>

                        {{-- <div class="col-md-12">
                            <h1 class="text-center">Drag and Drop File Upload Using Dropzone JS in Laravel 8 - Techsolutionstuff</h1><br>
                            <form action="{{route('bundle-photo')}}" method="post" name="image" files="true" enctype="multipart/form-data" class="dropzone" id="image-upload">
                        @csrf
                        <div>
                            <h3 class="text-center">Upload Multiple Images</h3>
                        </div>
                </form>
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
            </form>
        </div>

    </div>
    <span class="help-block text-danger help-allimgaes"></span>
</div> --}}
{{-- <div class="row" style="clear: both;margin-top: 18px;">
    <div class="col-12">
        <div class="dropzone" id="file-dropzone"></div>
    </div>
</div> --}}
<div class="form-group allim">
    <label>Upload file</label>
    <div class="input-group">
        <input type="hidden" name="AllImages[is_default]" id="is_default" value="0">
        <div class="product-image"></div>
        <div class="image_upload_div" style="display: none;">
            <form action="" method="post" class="dropzone" id="my-dropzone">
                @csrf
            </form>
        </div>

        <div class="image_upload_div" style="width: 100%;">
            <form action="{{ Route('user.project-photo') }}" method="post" class="dropzone" id="my-dropzone">
                @csrf
            </form>
        </div>

    </div>
    <span class="help-block help-allimgaes"></span>
</div>

<div class="lineDivider"></div>
<div>
    <label class="labelMain">Also needed</label>
</div>
<div class="ans_checkbox">
    @php
        $servs= explode(",",$project->services);
    @endphp
    @forelse ($categories as $category)
    <input type="checkbox" name="services[]" value="{{$category->id}}" id="r{{$category->id}}" {{(in_array($category->id,$cats))?"checked":""}}>
    <label class="checkbox-alias" for="r{{$category->id}}"><i class="icofont-plus"></i> {{optional($category->translation)->category_name}}</label>
    @empty

    @endforelse
</div>
@if ($errors->has('services'))
<div class="help-block text-danger">{{ $errors->first('services') }}</div>
@endif

<div class="lineDivider"></div>

<div>
    <label class="labelMain">Date and time</label>
</div>
<div class="row">
    <div class="col-md-5 col-md-xl-5">
        <div class="form-group form-floating resMb-3">
            @php
                $avl_dates= explode(",",$project->avl_date);
            @endphp
            <select multiple="multiple" class="js-example-placeholder-multiple-availablity  form-control cast-slet" name="avl_date[]" data-placeholder="Select Availablity">
                <option value="">Select Availablity</option>
                <option value="1" {{(in_array(1,$avl_dates))?"selected":""}}>Monday</option>
                <option value="2" {{(in_array(2,$avl_dates))?"selected":""}}>Tuesday</option>
                <option value="3" {{(in_array(3,$avl_dates))?"selected":""}}>Wednesday</option>
                <option value="4" {{(in_array(4,$avl_dates))?"selected":""}}>Thursday</option>
                <option value="5" {{(in_array(5,$avl_dates))?"selected":""}}>Friday</option>
                <option value="6" {{(in_array(6,$avl_dates))?"selected":""}}>Saturday</option>
                <option value="7" {{(in_array(7,$avl_dates))?"selected":""}}>Sunday</option>
            </select>
            <div class="help-block text-danger"></div>
        </div>
        @if ($errors->has('availablity'))
        <div class="help-block text-danger">{{ $errors->first('availablity') }}</div>
        @endif
    </div>
    <div class="col-md-7 col-md-xl-7">
        <div class="input-group">
            <div class="form-group form-floating w-70">
                <input type="date" class="form-control form-floating-left" value="{{$project->begin_date}}" id="floatingInput" name="begin_date" placeholder="name@example.com">
                <label for="floatingInput">Beginning</label>
                <div class="help-block text-danger"></div>
            </div>
            <div class="form-group form-floating w-30">
                <input type="time" class="form-control form-floating-right" value="{{$project->begin_time}}" id="floatingInput" name="begin_time" placeholder="name@example.com">
                <label for="floatingInput">Time</label>
                <div class="help-block text-danger"></div>
            </div>
        </div>
    </div>
</div>

<div class="lineDivider"></div>

<div>
    <label class="labelMain">Start address</label>
</div>

<div class="form-group form-floating input-group mb-3">
    <input id="searchMapInput" placeholder="Street, house No., floor, apartment" name="start_address" type="text" value="{{$project->start_address}}" class="form-control mapControls searchMapInput">
    {{-- <input id="searchMapInput" class="mapControls" type="text" placeholder="Enter a location"> --}}
    <input id="location-snap" placeholder="Enter your address" name="address_line1" type="hidden" value="{{$project->address_line1}}" class="form-control mapControls location-snap">
    <input id="lat-span" placeholder="Enter your address" name="latitude" type="hidden" value="{{$project->latitude}}" class="form-control mapControls lat-span">
    <input id="lon-span" placeholder="Enter your address" name="longitude" type="hidden" value="{{$project->longitude}}" class="form-control mapControls lon-span">

    {{-- <input type="text" class="form-control" name="code1" placeholder="Street, house No., floor, apartment "> --}}
    <label for="code1">Street, house No., floor, apartment </label>
    <span class="input-group-text inputGroupWhite"><i class="icofont-location-pin"></i></span>
    <div class="help-block text-danger"></div>
</div>


<div>
    <label class="labelMain">Finish address</label>
</div>
<div class="form-group d-flex align-items-center mb-3" id="">
    <div class="flex-fill">
        @php
            $project_addresses=App\Models\ProjectAddress::where('project_id',$project->id)->where('status','<>','3')->get();
        @endphp
        @foreach ($project_addresses as $key=>$project_address)
        <div class="form-floating input-group " id="id{{$project_address->id}}">
            <input id="searchMapInput{{$key+1}}" placeholder="Street, house No., floor, apartment" name="final_address[]" value="{{$project_address->final_address}}" type="text" class="form-control mapControls searchMapInput1">
            {{-- <input id="searchMapInput" class="mapControls" type="text" placeholder="Enter a location"> --}}
            <input id="location-snap{{$key+1}}" placeholder="Enter your address" name="address_line2[]" value="{{$project_address->address_line2}}" type="hidden" class="form-control mapControls location-snap">
            <input id="lat-span{{$key+1}}" placeholder="Enter your address" name="final_latitude[]" value="{{$project_address->final_latitude}}" type="hidden" class="form-control mapControls lat-span">
            <input id="lon-span{{$key+1}}" placeholder="Enter your address" name="final_longitude[]" value="{{$project_address->final_longitude}}" type="hidden" class="form-control mapControls lon-span"> 
            <label for="code1">Street, house No., floor, apartment </label>
            <span class="input-group-text inputGroupWhite"><a href="javascript:void(0);" data-tbl="location"   data-href="{{Route('user.location-delete', [base64_encode($project_address->id)])}}" data-title="Location" onclick="deleteObject(this);" title="Delete"><i class="icofont-trash" style="color: red"></i></a></span>
        </div><br>
        @endforeach
    </div>
</div>
<div class="wraper">
</div>
@if(!empty($project_addresses) && ($project_addresses->count()<=4))
<div>
    <button class="addAddress btn add_icon">Add address</button>
</div>
@endif
<div class="form-group form-check form-check-muted mb-3">
    <input class="form-check-input" type="checkbox" value="1" name="ck_comp_point" {{($project->ck_comp_point==1) ? 'checked':''}} id="flexCheckDefault1">
    <label class="form-check-label" for="flexCheckDefault1">
        Return to the first point after completion
    </label>
    <div class="help-block text-danger"></div>
</div>


<div>
    <label class="labelMain">Phone number</label>
</div>

<div class="form-group input-group mb-3 igLeftIcon">
    <span class="input-group-text">
        <img src="{{asset('storage/frontend/assets/images/icons/flag.svg')}}">
    </span>
    <input type="text" class="form-control simpleFormControl" name="phone" value="{{$project->phone}}">
    <div class="help-block text-danger"></div>
</div>

<p class="infoTitle">To receive quotes from specialists, please, provide valid phone number.</p>


</div>
<div class="taskBody">
    <div>
        <label class="labelMain">Your task budget?</label>
    </div>

    <div class="form-group input-group mb-3 igLeftIcon">
        <span class="input-group-text pe-2">
            {{-- <i class="icofont-dollar"></i> --}}
            ₪
        </span>
        <input type="number" class="form-control simpleFormControl ps-0" name="budget" value="{{$project->budget}}" placeholder="Your budget ">
        <div class="help-block text-danger"></div>
    </div>
    <div class="form-group form-check form-check-custom">
        <input class="form-check-input" type="checkbox" value="1" name="ck_estimate" {{($project->ck_estimate==1) ? 'checked':''}}  id="flexCheckDefault2">
        <label class="form-check-label" for="flexCheckDefault2">
            Get Estimate
        </label>
        <div class="help-block text-danger"></div>
    </div>
</div>
<div class="taskBody">
    <div>
        <label class="labelMain labelMainBig">Notifications</label>
    </div>
    <div class="form-check form-check-muted mb-2">
        <input class="form-check-input" type="checkbox" value="1" name="notifications_1_option" {{($project->notifications_1_option==1) ? 'checked':''}} id="flexCheckDefault3">
        <label class="form-check-label" for="flexCheckDefault3">
            Notify me of new proposals to the task by e-mail
        </label>
    </div>

    <div class="form-check form-check-muted mb-2">
        <input class="form-check-input" type="checkbox" value="1" name="notifications_2_option" {{($project->notifications_2_option==1) ? 'checked':''}} id="flexCheckDefault4">
        <label class="form-check-label" for="flexCheckDefault4">
            Notify me of new proposals to the task by <img src="{{asset('storage/frontend/images/viber.svg')}}" style="height:20px;width:20px">  Viber
        </label>

    </div>
   

    <div class="lineDivider"></div>

    <div>
        <label class="labelMain labelMainBig">Visibility settings</label>
    </div>
    <div class="form-check form-check-muted mb-2">
        <input class="form-check-input" type="checkbox" value="1" name="visibility_1_option" {{($project->visibility_1_option==1) ? 'checked':''}} id="flexCheckDefault5">
        <label class="form-check-label" for="flexCheckDefault5">
            Show my task only to specialists
        </label>
    </div>

    <div class="form-check form-check-muted mb-2">
        <input class="form-check-input" type="checkbox" value="1" name="visibility_2_option" {{($project->visibility_2_option==1) ? 'checked':''}} id="flexCheckDefault6">
        <label class="form-check-label" for="flexCheckDefault6">
            I want to receive proposals only from proven specialists
        </label>
    </div>
</div>
<div class="taskFooter">
    <button class="btn-site btn-block" id="t_project_store_btn" type="submit"> Update </button>
</div>
</form>
</div>
<div class="pageFooter">
    <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat ac turpis quis tempus. Praesent at velit neque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In pellentesque,
        turpis quis eleifend pellentesque, lacus arcu dignissim orci, sit amet condimentum nibh arcu vitae mauris. Donec eu dictum risus, nec lobortis eros. Nullam nec dui vel ligula posuere maximus. Praesent tempus dui ac diam facilisis
        scelerisque.</p>
</div>
</div>
</div>
</div>
<input type="hidden" value="{{(!empty($project_addresses) ? $project_addresses->count():'')}}" id="location_count">
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script> --}}
<script type="text/javascript" src="{{asset('storage/frontend/custom/dropzone/dropzone.js') }}"></script>
<script>
    Dropzone.options.fileDropzone = {
        url: 'http://127.0.0.1:8000/files',
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        maxFilesize: 8,
        headers: {
            'X-CSRF-TOKEN': "ESeOa3cJyO5lf9eQIS73RFdiPZn3nmvoqhRDCwaM"
        },
        removedfile: function(file) {
            var name = file.upload.filename;
            $.ajax({
                type: 'POST',
                url: 'http://127.0.0.1:8000/files/remove',
                data: {
                    "_token": "ESeOa3cJyO5lf9eQIS73RFdiPZn3nmvoqhRDCwaM",
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

        var x = $('#location_count').val(); //input field count intially
        $(add).click(function(e) {
            e.preventDefault();
            if (x < max) { //maximum number of input field allowed
                x++; //input field increment
                var html = '';

                html += '<div class="hide-div d-flex align-items-center mb-3">';
                html += '<div class="flex-fill">';
                html += '<div class="form-floating input-group">';
                html += '<input id="searchMapInput'+x+'" placeholder="Street, house No., floor, apartment" name="final_address[]" type="text" class="form-control mapControls searchMapInput1">';

                html += '<input id="location-snap" placeholder="Enter your address" name="address_line2[]" type="hidden" class="form-control mapControls location-snap">';
                html += '<input id="lat-span" placeholder="Enter your address" name="final_latitude[]" type="hidden" class="form-control mapControls lat-span">';
                html +='<input id="lon-span" placeholder="Enter your address" name="final_longitude[]" type="hidden" class="form-control mapControls lon-span">';

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

    $(document).on("click",'.removeItem', function(e) { //user click on remove text
        e.preventDefault();
        $(this).closest('.hide-div').remove();
    });
</script>
<script>

function removehidden(id) {
    var csrf_token = $('meta[name=csrf-token]').attr('content');
    var r_file_name = $("#image_" + id).val();
    $("#image_" + id).remove();
    if ($('.product-image').html() === '' || $('#img_' + id).is(":checked")) {
        $('#is_default').val('0');
    }
    $('.side-images').find('#is_side_' + id).remove();
    $.ajax({
        url: full_path + 'user/remove-project-photo',
        headers: {'X-CSRF-TOKEN': csrf_token},
        type: 'POST',
        dataType: 'json',
        data: {file_name: r_file_name},
        success: function (resp) {}
    });
}



if ($('[name="bid"]').val() != "" && $('#my-dropzone').length > 0) {
    var a = 0;
    Dropzone.options.myDropzone = {
        init: function () {
            thisDropzone = this;
            if (a == 0) {
                $.ajax({
                    type: 'GET',
                    url: full_path + 'user/show-project-images',
                    dataType: 'json',
                    data: {bid: $('[name="bid"]').val()},
                    success: function (data) {
                        if (data.res == 1) {
                            $.each(data.images, function (key, value) {
                                var mockFile = {name: value.name, size: value.size};
                                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, (full_path + 'storage/uploads/frontend/project/') + value.name);
                                
                                thisDropzone.emit("complete", mockFile);
                                var html = '<input type="hidden" name="AllImages[image][]" id="image_' + key + '" value=' + value.name + '><input type="hidden" name="AllImages[filetype_][]" id="filetype_' + key + '" value=' + value.file_type + '>';
                                $('.product-image').append(html);
                                if (value.is_default == 1) {
                                    $('#img_' + key).attr("checked", true);
                                    $('#side_img_' + key).prop("checked", false).attr('disabled', true);
                                    $('#is_default').val(key);
                                }
                            });
                        }
                    }
                });
                a = 1;
            }
        }
    };
}
</script>
@stop
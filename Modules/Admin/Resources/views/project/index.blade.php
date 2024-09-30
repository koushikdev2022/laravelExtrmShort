@extends('admin::layouts.main')

@section('page_css')
<style>
    .table>thead:first-child>tr:first-child>th {
        vertical-align: middle;
        text-align: center;
    }

    .table>tbody>tr>td {
        vertical-align: middle;
        text-align: center;
    }

    .dataTables_filter input {
        height: 34px;
        padding: 6px 12px;
        border: 1px solid #c2cad8;
    }
</style>
@endsection
@section('breadcrumb')
<li>
    <span class="active">Projects</span>
</li>
@stop

@section('content')


<div class="alert alert-danger" id='error'>
    <ul id='errordata'>
    </ul>
</div>
<div class="alert alert-success" id='success'>
    <ul id='successdata'>
    </ul>
</div>
<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer"></i>
            Projects
        </div>
        {{-- <div class="pull-right"><a href="{{route('admin-addsunscriptionplan')}}" class="btn btn-success"
                style="position: relative; top: 3px;"><i class="fa fa-plus"></i> Add New</a></div> --}}
    </div>
    <div class="portlet-body ">
        <div class="clearfix">
            <div class="table-scrollable" style="border: none;">
                <table class="ui celled table table-bordered" cellspacing="0" width="100%" id="project-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Sub Categories</th>
                            <th>Rigister Date</th>
                            <th>Expire Date</th>
                            <th>Status</th>
                            <th>Offer</th>
                            <th>Accepted</th>
                            <th style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">

<link rel="stylesheet" href="http://127.0.0.1:8000/storage/backend/custom/select2/select2.min.css" />
<script type="text/javascript" src="http://127.0.0.1:8000/storage/backend/custom/select2/select2.full.min.js"></script>


<div class="taskBox">
    <div class="taskHeader">
        <h2>Create a task</h2>
    </div>
    <div class="taskBody">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="title" id="floatingInput" placeholder="Enter Title">
            <label for="floatingInput">Task title</label>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-floatingx mb-3">
                    <select multiple="multiple" class="js-example-basic-multiple form-control"
                        data-placeholder="Pick Categories" data-limit="3" id="category_id" name="categories[]">
                        <option value="7">Appliance Repair and Installation</option>
                        <option value="13">Test</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floatingx mb-3">
                    <select multiple="multiple" class="js-example-basic-multiple-subcategory form-control cast-slet"
                        data-placeholder="Pick Sub Category" id="show-signup-subcategory" name="sub_categories[]"
                        data-limit="10">
                    </select>
                </div>
            </div>
        </div>

        <div>
            <label class="labelMain">Add task description</label>
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" onkeyup="textAreaAdjust(this)" name="description" style="overflow:hidden"
                placeholder="Leave a comment here" id="floatingTextarea"></textarea>
            <label for="floatingTextarea">Write here</label>
        </div>






        <div class="dropzone" id="file-dropzone"></div>



        <div class="lineDivider"></div>
        <div>
            <label class="labelMain">Also needed</label>
        </div>
        <div class="ans_checkbox">
            <input type="checkbox" name="services[]" value="7" id="r7">
            <label class="checkbox-alias" for="r7"><i class="icofont-plus"></i> Appliance Repair and
                Installation</label>
            <input type="checkbox" name="services[]" value="13" id="r13">
            <label class="checkbox-alias" for="r13"><i class="icofont-plus"></i> Test</label>
        </div>

        <div class="lineDivider"></div>

        <div>
            <label class="labelMain">Date and time</label>
        </div>
        <div class="row">
            <div class="col-md-5 col-md-xl-5">
                <div class="form-floatingx resMb-3">
                    <select multiple="multiple"
                        class="js-example-placeholder-multiple-availablity  form-control cast-slet" name="availablity[]"
                        data-placeholder="Select Availablity">
                        <option value="">Select Availablity</option>
                        <option value="1">Monday</option>
                        <option value="2">Tuesday</option>
                        <option value="3">Wednesday</option>
                        <option value="4">Thursday</option>
                        <option value="5">Friday</option>
                        <option value="6">Saturday</option>
                        <option value="7">Sunday</option>
                    </select>
                </div>
            </div>
            <div class="col-md-7 col-md-xl-7">
                <div class="input-group">
                    <div class="form-floating w-70">
                        <input type="date" class="form-control form-floating-left" id="floatingInput" name="start_from"
                            placeholder="name@example.com">
                        <label for="floatingInput">Beginning</label>
                    </div>
                    <div class="form-floating w-30">
                        <input type="time" class="form-control form-floating-right" id="floatingInput" name="start_time"
                            placeholder="name@example.com">
                        <label for="floatingInput">Time</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="lineDivider"></div>

        <div>
            <label class="labelMain">Start address</label>
        </div>

        <div class="form-floating input-location input-group mb-3">
            <input id="searchMapInput" placeholder="Street, house No., floor, apartment" name="start_address"
                type="text" class="form-control mapControls searchMapInput">

            <input id="location-snap" placeholder="Enter your address" name="address_line1" type="hidden"
                class="form-control mapControls location-snap">
            <input id="lat-span" placeholder="Enter your address" name="latitude" type="hidden"
                class="form-control mapControls lat-span">
            <input id="lon-span" placeholder="Enter your address" name="longitude" type="hidden"
                class="form-control mapControls lon-span">


            <label for="code1">Street, house No., floor, apartment </label>
            <span class="input-group-text inputGroupWhite"><i class="fa fa-map-marker" aria-hidden="true"></i></span>

        </div>

        <div>
            <label class="labelMain">Finish address</label>
        </div>
        <div class="d-flex align-items-center mb-3" id="">
            <div class="flex-fill">
                <div class="form-floating input-location input-group ">
                    <input id="searchMapInput1" placeholder="Street, house No., floor, apartment" name="final_address[]"
                        type="text" class="form-control mapControls searchMapInput1">

                    <input id="location-snap" placeholder="Enter your address" name="address_line2[]" type="hidden"
                        class="form-control mapControls location-snap">
                    <input id="lat-span" placeholder="Enter your address" name="final_latitude[]" type="hidden"
                        class="form-control mapControls lat-span">
                    <input id="lon-span" placeholder="Enter your address" name="final_longitude[]" type="hidden"
                        class="form-control mapControls lon-span">

                    <label for="code1">Street, house No., floor, apartment </label>
                    <span class="input-group-text inputGroupWhite"><i class="fa fa-map-marker" aria-hidden="true"></i></span>

                </div>
            </div>

        </div>
        <div class="wraper">
        </div>
        <div>
            <button class="addAddress btn add_icon">Add address</button>
        </div>
        <div class="form-check form-check-muted mb-3">
            <input class="form-check-input" type="checkbox" value="1" name="ck_comp_point" id="flexCheckDefault1">
            <label class="form-check-label" for="flexCheckDefault1">
                Return to the first point after completion
            </label>
        </div>


        <div>
            <label class="labelMain">Phone number</label>
        </div>

        <div class="input-group mb-3 igLeftIcon">
            <span class="input-group-text">
                <img src="http://127.0.0.1:8000/storage/frontend/assets/images/icons/flag.svg">
            </span>
            <input type="text" class="form-control simpleFormControl" name="phone" value="+972">
        </div>

        <p class="infoTitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat ac turpis quis
            tempus.</p>


    </div>
    <div class="taskBody">
        <div>
            <label class="labelMain">Your task budget?</label>
        </div>

        <div class="input-group mb-3 igLeftIcon">
            <span class="input-group-text pe-2">
                <i class="fa fa-usd" aria-hidden="true"></i>
            </span>
            <input type="number" class="form-control simpleFormControl ps-0" name="budget" placeholder="Your budget ">

        </div>
                <div class="form-check form-check-custom">
            <input class="form-check-input" type="checkbox" value="1" name="ck_estimate" id="flexCheckDefault2">
            <label class="form-check-label" for="flexCheckDefault2">
                Get Estimate
            </label>
                    </div>
    </div>
    <div class="taskBody">
        <div>
            <label class="labelMain labelMainBig">Notifications</label>
        </div>
        <div class="form-check form-check-muted mb-2">
            <input class="form-check-input" type="radio" value="1" name="ck_notify" id="flexCheckDefault3">
            <label class="form-check-label" for="flexCheckDefault3">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat ac turpis quis tempus.
            </label>

        </div>

        <div class="form-check form-check-muted mb-2">
            <input class="form-check-input" type="radio" value="0" name="ck_notify" id="flexCheckDefault4">
            <label class="form-check-label" for="flexCheckDefault4">
                Donec eu dictum risus, nec lobortis eros nullam nec dui vel ligula.
            </label>

        </div>
        
        <div class="lineDivider"></div>

        <div>
            <label class="labelMain labelMainBig">Visibility settings</label>
        </div>
        <div class="form-check form-check-muted mb-2">
            <input class="form-check-input" type="radio" value="1" name="ck_visibility" id="flexCheckDefault5">
            <label class="form-check-label" for="flexCheckDefault5">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed placerat ac turpis quis tempus.
            </label>
        </div>

        <div class="form-check form-check-muted mb-2">
            <input class="form-check-input" type="radio" value="0" name="ck_visibility" id="flexCheckDefault6">
            <label class="form-check-label" for="flexCheckDefault6">
                Donec eu dictum risus, nec lobortis eros nullam nec dui vel ligula.
            </label>
        </div>
            </div>
    <div class="taskFooter">
        <button class="btn-site btn-block" type="submit"> Publish </button>
    </div> --}}


</div>
<!-- end of page  -->

<style>
    #error {
        display: none;
    }

    #success {
        display: none;
    }
</style>
@stop

@section('js')

<script>
    $(function () {
        $('#project-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: '{{ Route("admin-project-list-datatable") }}',
            order: [[3, "desc"]],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'name', name: 'name' },
                { data: 'categories', name: 'categories' },
                { data: 'sub_categories', name: 'sub_categories' },
                { data: 'created_at', name: 'created_at' },
                { data: 'begin_date', name: 'begin_date' },
                {
                    data: 'status', name: 'status', render: function (data, type, row) {
                        if (data == '0') {
                            return '<span class="label label-sm label-warning">Inactive</span>';
                        } else if (data == '1') {
                            return '<span class="label label-sm label-success">Active</span>';
                        } else if (data == '2') {
                            return '<span class="label label-sm label-info">Awarded</span>';
                        } else if (data == '3') {
                            return '<span class="label label-sm label-danger">Delete</span>';
                        } else {
                            return '';
                        }
                    }
                },
                { data: 'offer', name: 'offer' },
                { data: 'accepted', name: 'accepted' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@stop
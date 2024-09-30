@extends('layouts.main')
@section('content')
<section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-3">

                    <!-- filter for mobile device  -->
                    <!-- for mobile device -->

                    <div class="accordion-item forMobile filterAccordion">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <b>{{__('site.Filter')}}</b>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="proLeft bg-white mb-4">
                                <div class="filterSection pt-4">
                                    <h5 class="proTitle">{{__('site.Filter by:')}}</h5>
                                    <div class="input-group searchGroup mb-3 igLeftIcon">
                                        <span class="input-group-text pe-2">
                                            <i class="icofont-search-1"></i>
                                        </span>
                                        <input type="text" class="form-control simpleFormControl ps-0 search_keywords" name="code1"
                                            placeholder="Search by keywords " >
                                    </div>

                                    <div class="form-floatFix form-Flabel mb-3">
                                        <label>{{__('site.City, address, metro station, district...')}} </label>
                                        <span><i class="icofont-location-pin"></i></span>
                                        <input type="text" value="4445 Gnatty Creek Road Hicksville, NY 11612">
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                            <option selected="">{{__('site.Appliance Repair and Installation')}}</option>
                                            <option value="1">{{__('site.One')}}</option>
                                            <option value="2">{{__('site.Two')}}</option>
                                            <option value="3">{{__('site.Three')}}</option>
                                        </select>
                                        <label for="floatingSelect">{{__('site.Category')}}</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                            <option selected="">{{__('site.Refrigerators And Freezers')}} </option>
                                            <option value="1">{{__('site.One')}}</option>
                                            <option value="2">{{__('site.Two')}}</option>
                                            <option value="3">{{__('site.Three')}}</option>
                                        </select>
                                        <label for="floatingSelect">{{__('site.Subcategory')}}</label>
                                    </div>

                                    <div>
                                        <label class="labelMain">{{__('site.Budget')}}</label>
                                    </div>

                                    <div class="d-flex">
                                        <div class="form-floatFix mb-3">
                                            <label>{{__('site.Min')}}</label>
                                            <span><i class="icofont-dollar"></i></span>
                                            <input type="number">
                                        </div>
                                        <div class="rangeTo">
                                            <p class="m-0">{{__('site.to')}}</p>
                                        </div>
                                        <div class="form-floatFix mb-3">
                                            <label>{{__('site.Max')}}</label>
                                            <span><i class="icofont-dollar"></i></span>
                                            <input type="number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- end filter for mobile device  -->

                <!-- filter for computer  -->
                <div class="proLeft bg-white mb-4 forComputer">
                    <div class="filterSection pt-4">
                        <h5 class="proTitle">{{__('site.Filter by:')}}</h5>
                        <div class="input-group searchGroup mb-3 igLeftIcon">
                            <span class="input-group-text pe-2">
                                <i class="icofont-search-1"></i>
                            </span>
                            <input type="text" class="form-control simpleFormControl ps-0" name="code1"
                                placeholder="Search by keywords " value="{{$keyword}}" id="search_keywords">
                        </div>

                        <div class="form-floatFix form-Flabel mb-3">
                            <label>{{__('site.City, address, metro station, district...')}} </label>
                            <span><i class="icofont-location-pin"></i></span>
                            <input id="searchMapInput" placeholder="Enter your address" name="address_line1" type="text" class="form-control mapControls">
                            {{-- <input id="searchMapInput" class="mapControls" type="text" placeholder="Enter a location"> --}}
                            <input id="location-snap" placeholder="Enter your address" name="address_line2" type="hidden" class="form-control mapControls location-snap">
                            <input id="lat-span" placeholder="Enter your address" name="latitude" type="hidden" class="form-control mapControls lat-span">
                            <input id="lon-span" placeholder="Enter your address" name="longitude" type="hidden" class="form-control mapControls lon-span">
                            {{-- <input type="text" value="4445 Gnatty Creek Road Hicksville, NY 11612"> --}}
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select category_search" id="searh_category" name="category" aria-label="Floating label select example" data-type="1">
                                <option value="">{{__('site.Select Category')}}</option>
                                {{-- @php
                                    $cats=explode(",",$project->categories)
                                @endphp --}}
                                @forelse ($categories as $category)
                                @if(!empty($category->translation->category_name))
                                <option value="{{$category->id}}">{{optional($category->translation)->category_name}}</option>
                                @endif
                                @empty

                                @endforelse
                            </select>
                            <label for="floatingSelect">{{__('site.Category')}}</label>
                        </div>

                        <div class="form-floating mb-3">
                            {{-- @php
                                $subcats= explode(",",$project->sub_categories);
                            @endphp --}}
                            <select class="form-select skill_search" id="searh-show-subcategory" name="skill_id" aria-label="Floating label select example">
                                <option value="">{{__('site.Select Sub Category')}}</option>
                                {{-- @forelse ($subcategories as $subcategory)
                                        <option value="{{$subcategory->id}}" {{(in_array($subcategory->id,$subcats))?"selected":""}}>{{optional($subcategory->translation)->category_name}}</option>
                                @empty

                                @endforelse --}}
                            </select>
                            <label for="floatingSelect">{{__('site.Subcategory')}}</label>
                        </div>

                        <div>
                            <label class="labelMain">{{__('site.Budget')}}</label>
                        </div>

                        <div class="d-flex">
                            <div class="form-floatFix mb-3">
                                <label>{{__('site.Mix')}}</label>
                                <span><i class="icofont-dollar"></i></span>
                                <input type="text" id="amount" class="giControl" value="" data-type="1">
                            </div>
                            <div class="rangeTo">
                                <p class="m-0">{{__('site.to')}}</p>
                            </div>
                            <div class="form-floatFix mb-3">
                                <label>{{__('site.Max')}}</label>
                                <span><i class="icofont-dollar"></i></span>
                                <input type="text" id="amount2" class="giControl" value="" data-type="1">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end filter for computer  -->
            </div>
            <div class="col-md-12 col-lg-9">
                <div class="taskListShort d-flex align-items-center justify-content-between">
                    <div>
                        <h4 id="total_job">0 {{__('site.tasks found')}} </h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="sortText">{{__('site.Sort:')}}</p>
                        </div>
                        <select class="form-select giControl giSortInput" id="sort_search" data-type="1" aria-label="Default select example">
                            <option value="1">{{__('site.Newest first')}}</option>
                            <option value="2">{{__('site.Oldest first')}}</option>
                        </select>
                    </div>
                </div>

                <!-- loop  -->
                <div id="tag_container">


                </div>

                {{-- <div class="taskListBox">
                    <div class="taskListBody">
                        <h4>Task title lorem ipsum dolor sit adipiscing elit.</h4>
                        <h5><i class="icofont-pencil-alt-2"></i> Posted 6 minutes ago <span><i
                                    class="icofont-eye-alt"></i> 15 views</span></h5>
                        <h6><i class="icofont-wallet"></i> Budget: $500</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet fermentum <br> dapibus.
                            Proin sodales quis felis et aliquet. Sed malesuada eros odio….<b>More</b></p>
                    </div>
                    <div class="taskListFooter">
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="d-flex align-item-center">
                                <div>
                                    <img src="{{ URL::asset('storage/frontend/assets/images/profile/pro4.jpg') }}" alt="">
                                </div>
                                <div>
                                    <h5>James</h5>
                                    <h6>Member since 2020</h6>
                                    <p><i class="fa fa-star" aria-hidden="true"></i>5.0 <span>(200)</span></p>
                                </div>
                            </div>
                            <div>
                                <a class="btn-site btn-normal" href="{{ Route('task_details') }}">View Task Details</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="taskListBox">
                    <div class="taskListBody">
                        <h4>Task title lorem ipsum dolor sit adipiscing elit.</h4>
                        <h5><i class="icofont-pencil-alt-2"></i> Posted 6 minutes ago <span><i
                                    class="icofont-eye-alt"></i> 15 views</span></h5>
                        <h6><i class="icofont-wallet"></i> Budget: $500</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet fermentum <br> dapibus.
                            Proin sodales quis felis et aliquet. Sed malesuada eros odio….<b>More</b></p>
                    </div>
                    <div class="taskListFooter">
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="d-flex align-item-center">
                                <div>
                                    <img src="{{ URL::asset('storage/frontend/assets/images/profile/pro4.jpg') }}" alt="">
                                </div>
                                <div>
                                    <h5>James</h5>
                                    <h6>Member since 2020</h6>
                                    <p><i class="fa fa-star" aria-hidden="true"></i>5.0 <span>(200)</span></p>
                                </div>
                            </div>
                            <div>
                                <a class="btn-site btn-normal" href="{{ Route('task_details') }}">View Task Details</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="taskListBox">
                    <div class="taskListBody">
                        <h4>Task title lorem ipsum dolor sit adipiscing elit.</h4>
                        <h5><i class="icofont-pencil-alt-2"></i> Posted 6 minutes ago <span><i
                                    class="icofont-eye-alt"></i> 15 views</span></h5>
                        <h6><i class="icofont-wallet"></i> Budget: $500</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis aliquet fermentum <br> dapibus.
                            Proin sodales quis felis et aliquet. Sed malesuada eros odio….<b>More</b></p>
                    </div>
                    <div class="taskListFooter">
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="d-flex align-item-center">
                                <div>
                                    <img src="{{ URL::asset('storage/frontend/assets/images/profile/pro4.jpg') }}" alt="">
                                </div>
                                <div>
                                    <h5>James</h5>
                                    <h6>Member since 2020</h6>
                                    <p><i class="fa fa-star" aria-hidden="true"></i>5.0 <span>(200)</span></p>
                                </div>
                            </div>
                            <div>
                                <a class="btn-site btn-normal" href="{{ Route('task_details') }}">View Task Details</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- end loop  -->

                {{-- <nav aria-label="Page navigation example" class="listPagination">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&lt;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&gt;</span>
                            </a>
                        </li>
                    </ul>
                </nav> --}}
            </div>
        </div>
        </div>


    </section>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        $('.js-example-basic-multiple-subcategory').select2();
        $('.js-example-basic-multiple-language').select2();
        $('.js-example-placeholder-multiple-availablity').select2();
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        fetch_search_data(1,$(this).data('type'));

        // $(document).on('click', '.pagination a', function(event){
        // event.preventDefault();

        // var page = $(this).attr('href').split('page=')[1];
        // var type = $(this).data("type");
        //     console.log(type);
        //      fetch_search_data(page,type)
        // });
        $('body').on('change','.category_search',function(){

            var type = $(this).data('type');

            fetch_search_data(1,type);
        });
        $('body').on('change','#sort_search',function(){
            var type = $(this).data('type');
            fetch_search_data(1,type);
        });

        $('body').on('change','.skill_search',function(){
            var type = $(this).data("type");
            fetch_search_data(1,type);
        });
        $("#amount,#amount2").on("keyup", function(e) {
            var type = $(this).data('type');
            fetch_search_data(1,type);
        });

        $('#searchMapInput').on("keyup", function(e) {
            var type = $(this).data("type");
            fetch_search_data(1,type);
        });
        $('#search_keywords').on("keyup", function(e) {
            var type = $(this).data("type");
            fetch_search_data(1,type);
        });

        function fetch_search_data(page=1,type=null)
        {
            console.log(page,type)
            //var searchUrl = $(document).find('.searchUrl').val();
            if(type==1){
                var category_id = $('select.category_search option:selected').val();
                var sub_category = $('select.skill_search option:selected').val();
                var map_data = $('#searchMapInput').val();
                var optionvalue = $('select#sort_search option:selected').val();
                var min = $('#amount').val();
                var max = $('#amount2').val();
                var keywords = $('#search_keywords').val();
            }else{
                var category_id = $('select#cat_mob option:selected').val();
                var sub_category = $('select.skill_search option:selected').val();
                var map_data = $('#searchMapInput').val();
                var optionvalue = $('select#sort_search option:selected').val();
                var min = $('#amountm').val();
                var max = $('#amountm2').val();
                var keywords = $('#search_keywords').val();
            }

            ajaxindicatorstart();
            $.ajax({
            url: full_path+ 'searchUrl?page='+page,
            data: {keywords:keywords,optionvalue:optionvalue,category_id:category_id,page:page,min:min,max:max,type:type,map_data:map_data,sub_category:sub_category},
            success:function(resp)
                {
                    $('#tag_container').html('');
                    $('#tag_container').append(resp.content);
                    $('#total_job').html('');
                    $('#total_job').append(resp.countjobs+" tasks found");
                    ajaxindicatorstop();
                }
            });
        }
    });
</script>
@stop

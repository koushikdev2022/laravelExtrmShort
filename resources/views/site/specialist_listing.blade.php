@extends('layouts.main')

@section('content')

<section>
    <div class="loginHead">
        <div class="loginImg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 searchBanner">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="dExperts"> <img src="{{ URL::asset('storage/frontend/assets/images/icons/expert.svg') }}" alt=""> Find Specialists
                                </div>
                            </div>
                            <div class="col-md-4  paddingR">
                                <div class="bannerInput btl-0">
                                    <div>
                                        <label for="exampleFormControlInput1" class="form-label">Your
                                            Location</label>

                                        <div class="d-flex">
                                            <div><i class="icofont-location-pin"></i></div>
                                            <div>
                                                <input type="email"  class="form-control mapControls" id="searchMapInput" placeholder="Type here">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4  paddingL paddingR">
                                <div class="bannerInput">
                                    <div>
                                        <label for="exampleFormControlInput1" class="form-label">Task
                                            Category</label>
                                        <select class="form-select category_search" id="searh_category" name="category" aria-label="Default select example">
                                            <option value="">Select Category</option>
                                            @forelse ($categories as $category)
                                            @if(!empty($category->translation->category_name))
                                            <option value="{{$category->id}}">{{optional($category->translation)->category_name}}</option>
                                            @endif
                                            @empty

                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4  paddingL">
                                <div class="bannerInput">
                                    <div>
                                        <label for="exampleFormControlInput1" class="form-label">Subcategory</label>
                                        <select class="form-select skill_search" id="searh-show-subcategory" name="skill_id" aria-label="Default select example">
                                            <option value="">Select Subcategory</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!--background-->
    </div>


    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="filterSort">
                    <div class="d-flex align-items-center">
                        <div class="flex-fill">
                            <h2 id="total_specialist">500 Specialists Available </h2>
                        </div>

                        <div>
                            <p class="sortText m-0">Sort:</p>
                        </div>
                        <div>
                            <select class="form-select giControl giSortInput" id="sort_search" data-type="1" aria-label="Default select example">
                                <option value="1">Newest first</option>
                                <option value="2">Oldest first</option>
                            </select>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            

            <div class="col-md-10">
                <!-- loop  -->
                <div id="tag_container">

                </div>
                <!-- end loop  -->

                {{-- <div class="text-center">
                    <img class="waiting fa-spin" src="{{ URL::asset('storage/frontend/assets/images/icons/waiting.svg') }}" alt="">
                </div> --}}

            </div>
        </div>
    </div>
</section>

@stop
@section('js')
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
        // $("#amount,#amount2").on("keyup", function(e) {
        //     var type = $(this).data('type');
        //     fetch_search_data(1,type);
        // });
        
        $('#searchMapInput').on("keyup", function(e) {
            var type = $(this).data("type");
            fetch_search_data(1,type);
        });
        // $('#search_keywords').on("keyup", function(e) {
        //     var type = $(this).data("type");
        //     fetch_search_data(1,type);
        // });
       
        function fetch_search_data(page=1,type=null)
        {
            console.log(page,type)
            //var searchUrl = $(document).find('.searchUrl').val();
            if(type==1){
                var category_id = $('select.category_search option:selected').val();
                var sub_category = $('select.skill_search option:selected').val();
                var map_data = $('#searchMapInput').val();
                var optionvalue = $('select#sort_search option:selected').val();
                // var min = $('#amount').val();
                // var max = $('#amount2').val();
                // var keywords = $('#search_keywords').val();
            }else{
                var category_id = $('select#cat_mob option:selected').val();
                var sub_category = $('select.skill_search option:selected').val();
                var map_data = $('#searchMapInput').val();
                var optionvalue = $('select#sort_search option:selected').val();
                // var min = $('#amountm').val();
                // var max = $('#amountm2').val();
                // var keywords = $('#search_keywords').val();
                
            }        
            
            ajaxindicatorstart();
            $.ajax({
            url: full_path+ 'searchSpecialistUrl?page='+page,
            data: {optionvalue:optionvalue,category_id:category_id,page:page,map_data:map_data,sub_category:sub_category},
            success:function(resp)
                {
                    $('#tag_container').html('');
                    $('#tag_container').append(resp.content);
                    $('#total_specialist').html('');
                    $('#total_specialist').append(resp.countspecialists+" Specialists found");
                    ajaxindicatorstop();
                }
            });
        }
    });
</script>
@stop
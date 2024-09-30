@extends('layouts.master')

@section('content')
<div class="clearfix">
    @if(Session::has('message'))
	<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
	@endif
    <div class="dash-bottom-part pb-0">
        <div class="justify-content-center">
            <div class="col-md-12">
                <div class="bottom-part-1 mt-40">
                    <div class="table_bx">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead class="thead-dark">
                                    <tr>
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
                                <tbody>
                                    {{-- {{ json_encode($projects) }} --}}
                                    @forelse ($projects as $project)
                                    {{-- {{ $project }} --}}
                                    <tr id="id{{$project->id}}">
                                        <td data-label="Name">
                                           {{$project->title}}
                                        </td>
                                        <td data-label="Category">
                                            <?php
                                                $cats = explode(",", $project->categories);

                                                foreach ($cats as $cat) {
                                                    $cat_name = \App\Models\Category::with('translation')->whereNull('parent_id')->where('id', '=', $cat)->where('status', '=', '1')->first();
                                                ?>
                                                    {{ $cat_name->translation->category_name}},
                                                <?php
                                                }
                                            ?>
                                        </td>
                                        <td data-label="Sub Categories">
                                            <?php
                                                $sub_cat = explode(",", $project->sub_categories);

                                                foreach ($sub_cat as $subc) {
                                                    $sub_cats = \App\Models\TranslationCategory::where('category_id', '=', $subc)->where('status', '=', '1')->first();
                                                ?>
                                                    {{ $sub_cats->category_name}},
                                                <?php
                                                }
                                            ?>
                                        </td>
                                        <td data-label="Rigister Date">
                                            {{$project->created_at}}
                                        </td>
                                        <td data-label="Expire Date">
                                            {{$project->begin_date}}
                                        </td>
                                        <td data-label="Status">
                                           @if($project->status=='1')
                                           Y
                                           @elseif($project->status=='3')
                                           N
                                           @endif
                                        </td>
                                        <td data-label="Offer">
                                            @php
                                             $bid_count_offer=App\Models\Bid::where('project_id',$project->id)->where('status','0')->count();
                                             $bid_count_accept=App\Models\Bid::where('project_id',$project->id)->where('status','1')->count();
                                            @endphp
                                            {{$bid_count_offer}}
                                        </td>
                                        <td data-label="Accepted">

                                            {{$bid_count_accept}}
                                        </td>
                                        @php
                                            $bid=App\Models\Bid::where('project_id',$project->id)->where('status','1')->first();
                                        @endphp
                                        {{-- <td data-label="Action" class="text-center actionBtn">
                                            
                                            @if(empty($bid))

                                            @if ($project->bidStatus == 1 && $project->bidsContractorStatus == 1)
                                                Bid Accpted by Contractor
                                            @elseif($project->bidStatus == 1 && $project->bidsContractorStatus == 0)
                                                Awareded
                                            @else
                                                N/A
                                            @endif
                                        </td> --}}
                                        <td data-label="Action" class="text-center actionBtn">
                                            @if (empty($bid))
                                            <a href="{{route('user.edit-project',base64_encode($project->id))}}" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="icofont-edit"></i></a>
                                            @endif
                                            {{-- @if ($project->status=='3')
                                            <a class="btn btn-info" data-toggle="modal" data-target="#add-review" onclick="add_review({{$project->id}})" data-title="Write A Review" href="javascript:void(0)" title="Write A Review"><i class="fa fa-star" aria-hidden="true"></i></a>
                                            @endif --}}
                                            <a href="javascript:void(0);" data-tbl="project"   data-href="{{Route('user.project-delete', [base64_encode($project->id)])}}" data-title="Project" onclick="deleteObject(this);" class="btn btn-danger" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            <!-- <a href="#" class="common-btn nw_color"><i class="icofont-edit"></i></a> -->
                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9">
                                            <div class="text-center">
                                                {{-- <img src="{{asset('storage/frontend/images/transaction-icon.png')}}" height="120"
                                                    alt="transaction image" /> --}}
                                                <p class="font-weight-bold text-center">No project found.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $projects->links() }}
                        {{-- {{ $wallet_logs->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rating {
    display: inline-block;
    position: relative;
    height: 50px;
    line-height: 50px;
    font-size: 50px;
    }

    .rating label {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    cursor: pointer;
    }

    .rating label:last-child {
    position: static;
    }

    .rating label:nth-child(1) {
    z-index: 5;
    }

    .rating label:nth-child(2) {
    z-index: 4;
    }

    .rating label:nth-child(3) {
    z-index: 3;
    }

    .rating label:nth-child(4) {
    z-index: 2;
    }

    .rating label:nth-child(5) {
    z-index: 1;
    }

    .rating label input {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    }

    .rating label .icon {
    float: left;
    color: transparent;
    }

    .rating label:last-child .icon {
    color: #000;
    }

    .rating:not(:hover) label input:checked ~ .icon,
    .rating:hover label:hover input ~ .icon {
    color: #09f;
    }

    .rating label input:focus:not(:checked) ~ .icon:last-child {
    color: #000;
    text-shadow: 0 0 5px #09f;
    }
</style>
<script>
    $(':radio').change(function() {
  console.log('New star rating: ' + this.value);
});
</script>
<!--Start Add Recommendation Model-->
<div class="modal fade" id="add-review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered addChatModal">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="">Write A Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="">
                <h6>Review</h6>
                {{-- id="add-review-form" --}}
                <form class="mt-2 space-y-6 c-form "  action="{{route('user.add_review')}}" method="post">
                    @csrf
                    <div class="rating">
                        <label>
                            <input type="radio" name="score" value="1" />
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="score" value="2" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="score" value="3" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="score" value="4" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="score" value="5" />
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                    </div>
                    <input type="hidden" name="project_id" id="review_value" value="{{ $project->id }}">
                    <div class="form-floating mb-3 form-group">
                    <!-- <label for="floatingInput">Review</label> -->
                        <div id="rating-star"></div>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-floating mb-3 form-group">
                        <textarea onkeyup="textAreaAdjust(this)" style="overflow:hidden; height:120px" rows="5" type="text" name="message" class="form-control search-input" placeholder="Write a review.."></textarea>
                        <label  for="floatingInput">Message</label>
                        <span class="help-block"></span>
                    </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn-site btn-normal form-login-action" type="submit">Submit</button>
                    </div>
                </form>



        </div>
    </div>
</div>

@stop

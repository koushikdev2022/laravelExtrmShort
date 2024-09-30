@extends('layouts.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('stroage/frontend/custom/raty-3.1.0/lib/jquery.raty.css') }}">
<style>.functions .demo {
  margin-bottom: 10px;
}

.functions .item {
  background-color: #FEFEFE;
  border-radius: 4px;
  display: inline-block;
  margin-bottom: 5px;
  padding: 5px 10px;
}

.functions .item a {
  border: 1px solid #CCC;
  margin-left: 10px;
  padding: 5px;
  text-decoration: none;
}

.functions .item input {
  display: inline-block;
  margin-left: 2px;
  padding: 5px 6px;
  width: 120px;
}

.functions .item label {
  display: inline-block;
  font-size: 1.1em;
  font-weight: bold;
}

.hint {
  font-size: 16px;
  padding: 5px 10px;
  text-align: center;
  width: 160px;
}

div.hint {
  margin-top: 10px;
}
</style>
<style>.functions .demo {
    margin-bottom: 10px;
  }
  
  .functions .item {
    background-color: #FEFEFE;
    border-radius: 4px;
    display: inline-block;
    margin-bottom: 5px;
    padding: 5px 10px;
  }
  
  .functions .item a {
    border: 1px solid #CCC;
    margin-left: 10px;
    padding: 5px;
    text-decoration: none;
  }
  
  .functions .item input {
    display: inline-block;
    margin-left: 2px;
    padding: 5px 6px;
    width: 120px;
  }
  
  .functions .item label {
    display: inline-block;
    font-size: 1.1em;
    font-weight: bold;
  }
  
  .hint {
    font-size: 16px;
    padding: 5px 10px;
    text-align: center;
    width: 160px;
  }
  
  div.hint {
    margin-top: 10px;
  }
</style>
@stop
@section('content')
<div class="clearfix">
    <div class="dash-bottom-part">
        <div class="col-sm-12">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="bottom-part-2">
                        {{-- <div class="dash_headingbx">
                            <h2 class="dash_heading pl-0">Awareded Bids</h2>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-8">
                                <div class="dash_headingbx nwstl">
                                    <h2 class="dash_heading pl-0">Awarded Bids</h2>
                                </div>
                            </div>
                            <div class="col-md-4 text-right">
                                <!-- <div class="input-group search mb-3">
                            <input type="text" class="form-control" wire:model.defer="title" placeholder="" aria-label="Title"
                                   aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" wire:click.prevent="render" wire:target="render"
                                        wire:loading.class="d-none" type="button"><i class="icofont-search-1"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary" wire:loading wire:target="render">
                                    <i class="fa fa-circle-o-notch fa-spin"></i>
                                </button>
                            </div> -->
                                <button type="submit" class="common-btn green" id="showfilter"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
                            </div>
                        </div>
                        <form action="" method="GET">
                        <input type="hidden" name="search_filter" value="1"/>
                        <div class="row ml-2 mt-4 mb-4 filter d-none">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Agree Amount</label>
                                    <input type="text" name="agree_amount" class="form-control" value="{{ (isset($agree_amount) && $agree_amount != '') ? $agree_amount : '' }}" placeholder="Agree Amount">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Agree deadline</label>
                                    <input type="date" name="agree_deadline" value="{{ (isset($agree_deadline) && $agree_deadline != '') ? $agree_deadline : '' }}" class="form-control">
                                </div>
                            </div>
                            
                            <div class="text-right mt-2">
                                <br>
                                <button class="common-btn green" wire:click.prevent="render" wire:target="render"
                                    wire:loading.class="d-none" type="submit">Search
                                </button>
                                {{-- <button type="submit" class="common-btn green">Search</button> --}}
                            </div>
                                
                        
                        </div>
                        </form>

                        <div wire:id="ou1ICwV2ycgtHxxouxtl" class="dash-bottom-part">
                            <div class="col-lg-12">

                            <div class="white_contentbx customnw">
                                <div class="dashtab_area">
                                    <div class="table_bx">
                                        <div class="table-responsive">
                                            {{-- {{ $data }} --}}
                                            <table class="table common_nwtable table-striped mb-0">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">Project</th>
                                                        <th scope="col">Budget Amount</th>
                                                        <th scope="col">Agreed Amount</th>
                                                        <th scope="col">Agreed Deadline</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Specialist Status</th>
                                                        <th scope="col" class="action_bx text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                {{-- {{ $data }} --}}
                                                <tbody>
                                                    @foreach ($data as $bids)
                                                    <tr>
                                                        <td data-label="Project"><a href="{{route('task_details',base64_encode($bids->project_id))}}">{{ $bids->title }}</a></td>
                                                        <td data-label="name">{{ $bids->budget }}</td>
                                                        <td data-label="name">{{ $bids->billable_target }}</td>
                                                        <td data-label="Deadline">{{ $bids->deadline }} </td>
                                                        <td data-label="Status"><span class="badge @if($bids->status == 0) badge-warning @else {{ ($bids->status == 1 ? 'badge-success' : 'badge-danger')  }} @endif  mb-0 even-larger-badge">@if($bids->status == 0) Pending @else {{ ($bids->status == 1 ? 'Awarded' : 'Rejected')  }} @endif</span></td>
                                                        <td data-label="Telent Status"><span class="badge @if($bids->talent_status == 0) badge-warning @else {{ ($bids->talent_status == 1 ? 'badge-success' : 'badge-danger')  }} @endif  mb-0 even-larger-badge">@if($bids->talent_status == 0) Pending @else {{ ($bids->talent_status == 1 ? 'Approved' : 'Rejected')  }} @endif</span></td>
                                                        <td data-label="Action" class="text-center actionBtn">
                                                            @if ($bids->withdrow_status == 0)
                                                                <a href="{{route('user.make_bids_payment',base64_encode($bids->id))}}?idu={{ base64_encode($bids->user_id) }}"
                                                                    onclick="return confirm('Are you sure you want to Make Complete Payment?')" class="btn btn-small btn-success">Make Payment</i></a>
                                                            @else
                                                            <a class="btn btn-small btn-success" data-toggle="modal" data-target="#add-review" onclick="add_review({{$bids->user_id}})" href="javascript:void(0)">Write A Review</a>
                                                            {{-- <span class="badge badge-warning mb-0 even-larger-badge">Payment done</span> --}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="pagintaion bottom-pagination">


                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Start Add Recommendation Model-->
<div class="modal fade" id="add-review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered addChatModal">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="">Write A Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="">
                <h6>Rating</h6>
                <form class="mt-2 space-y-6 c-form" id="add-review-form" action="{{route('user.add-review')}}" method="post"> 
                    <input type="hidden" name="talent_id" id="review_value">
                    <div class="form-floating mb-3 form-group">
                    <!-- <label for="floatingInput">Review</label> -->
                        <div id="rating-star"></div>
                        
                        <span class="help-block"></span>
                    </div>
                    <div class="form-floating mb-3 form-group">
                        <textarea onkeyup="textAreaAdjust(this)" style="overflow:hidden; height:120px" rows="5" type="text" name="message" class="form-control search-input" placeholder="Write Review"></textarea>
                        <label  for="floatingInput">Write Review</label>
                        <span class="help-block"></span>
                    </div>
                    </div>
                   
                    <div class="modal-footer">
                        <button type="submit" class="btn postBtn btnSuccess form-login-action" type="submit">Submit</button>
                    </div>
                </form>

            

        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{URL::asset('storage/frontend/custom/raty-3.1.0/lib/jquery.raty.js')}}"></script>
<script>
    $('#rating-star').raty({ score: 3 });

//     function textAreaAdjust(element) {
//   element.style.height = "1px";
//   element.style.height = (64+element.scrollHeight)+"px";
// }
function add_review(review_value)
{
    $('#review_value').val(review_value);
}
</script>
@stop

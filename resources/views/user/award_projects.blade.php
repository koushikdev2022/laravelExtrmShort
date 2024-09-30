@extends('layouts.master')
@section('content')
<div class="clearfix">
    <div class="dash-bottom-part">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="bottom-part-2">
                        {{-- <div class="dash_headingbx">
                            <h2 class="dash_heading pl-0">Awareded Bids</h2>
                        </div>
                        @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif --}}
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
                                                        <td data-label="Status"><span class="badge @if($bids->talent_status == 0) badge-warning @else {{ ($bids->talent_status == 1 ? 'badge-success' : 'badge-danger')  }} @endif  mb-0 even-larger-badge">@if($bids->talent_status == 0) Pending @else {{ ($bids->talent_status == 1 ? 'Approved' : 'Rejected')  }} @endif</span></td>
                                                        <td data-label="Action" class="text-center actionBtn">
                                                            @if($bids->talent_status == 0)
                                                                <a href="{{route('user.awareded_bids_status',base64_encode($bids->id))}}?status=approve" class="btn btn-small btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>

                                                                <a onclick="confirm('Are you sure you want to reject this bid?')"
                                                                href="{{route('user.awareded_bids_status',base64_encode($bids->id))}}?status=reject" class="btn btn-small btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                            {{-- @elseif ($bids->talent_status == 1)
                                                            <a href="?details">View Details</a> --}}

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
@endsection

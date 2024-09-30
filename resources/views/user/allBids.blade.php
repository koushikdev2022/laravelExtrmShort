@extends('layouts.master')
@section('content')
<div class="clearfix">
    <div class="dash-bottom-part">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-sm-12">

                    @if (isset($_GET['viewDetails']))

                        {{-- {{ json_encode($data[$_GET['key']]) }} --}}
                    <h3 class="p-2">Bid Detail</h3>

                        <div class="wallet_leftbx walletBoxx white_contentbx flexNone mb-4">
                            <p>PROJECT NAME :- {{ $data[$_GET['key']]->title }}</p>
                            <p>BUDGET AMOUNT :- $ {{ $data[$_GET['key']]->budget }}</p>
                            <p>AGREED AMOUNT :- $ {{ $data[$_GET['key']]->billable_target }}</p>
                            <p>AGREED DEADLINE :- {{ $data[$_GET['key']]->deadline }}</p>
                            <p>PROPOSAL :- {{ $data[$_GET['key']]->proposal }}</p>

                            <img src="{{ URL::asset('storage/uploads/frontend/proposal/'.$data[$_GET['key']]->file.'') }}" alt="" style="max-width: 25%;">
                            <br>
                            <hr>
                            @php
                            $project=App\Models\Project::where('id',$data[$_GET['key']]->project_id)->where('status','!=','3')->first();
                            @endphp
                            <a href="/task_details/{{ base64_encode($data[$_GET['key']]->project_id) }}" class="btn {{!empty($project) ? '':'disabled'}}">View Project Details</a>
                        </div>


                    @else

                        <div class="bottom-part-2">
                            <div class="dash_headingbx">
                                <h2 class="dash_heading pl-0">All Bids</h2>
                            </div>

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
                                                            <th scope="col">Bid Status</th>
                                                            {{-- <th scope="col">Status</th> --}}
                                                            <th scope="col" class="action_bx text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $key=>$bids)
                                                        <tr>
                                                            <td data-label="Project"><a href="{{route('task_details',base64_encode($bids->project_id))}}">{{ $bids->title }}</a></td>
                                                            <td data-label="name">{{ $bids->budget }}</td>
                                                            <td data-label="name">{{ $bids->billable_target }}</td>
                                                            <td data-label="Deadline">{{ $bids->deadline }} </td>
                                                            <td data-label="Status"><span class="badge @if($bids->status == 0) badge-warning @else {{ ($bids->status == 1 ? 'badge-success' : 'badge-danger')  }} @endif  mb-0 even-larger-badge">@if($bids->status == 0) Pending @else {{ ($bids->status == 1 ? 'Awareded' : 'Rejected')  }} @endif</span></td>
                                                            <td data-label="Action" class="text-center actionBtn">
                                                                @if($bids->status == 1 && $bids->talent_status == 0)
                                                                    <a href="{{route('user.awareded_bids_status',base64_encode($bids->id))}}?status=approve" class="btn btn-small btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>

                                                                    <a onclick="confirm('Are you sure you want to reject this bid?')"
                                                                        href="{{route('user.awareded_bids_status',base64_encode($bids->id))}}?status=reject" class="btn btn-small btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                                @endif

                                                                <a class="btn" href="?viewDetails&key={{ $key  }}"> View Detail</a>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

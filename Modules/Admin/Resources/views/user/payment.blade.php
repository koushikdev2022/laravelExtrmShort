@extends('admin::layouts.main')

@section('breadcrumb')
    <li class="active">Payment Requests</li>
@stop

@section('content')
    <h3 class="page-title">Payment Requests
        <small>View all Payment Request</small>
    </h3>

    @if (Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif


{{-- {{ json_encode($data[0]) }} --}}

    @if (isset($_GET['DebitReq']))

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-envelope font-green-haze" aria-hidden="true"></i>
                        <span class="caption-subject font-green-haze bold uppercase">Payments</span>
                    </div>
                </div>
                    {{-- {{ json_encode($commission) }} --}}
                    <p>Name :- {{ $data[$_GET['key']]->name }}</p>
                    <p>email :- {{ $data[$_GET['key']]->email }}</p>
                    <hr>
                    <p>Account Name :- {{ $data[$_GET['key']]->Name }}</p>
                    <p>account_no :- {{ $data[$_GET['key']]->account_no }}</p>
                    <p>IBAN_No :- {{ $data[$_GET['key']]->IBAN_No }}</p>
                    @if ($data[$_GET['key']]->user_type_id == 2)

                        <p>Req Amount :- ${{ $data[$_GET['key']]->debit_amount }} </p>
                    @else

                        <p>Req Amount :- ${{ $data[$_GET['key']]->debit_amount }} -
                            <span style="color: red;font-weight: bold;"> ${{ $com = ($data[$_GET['key']]->debit_amount/100)*$commission->value }}  ({{ $commission->value }}% Commission)</span></p>
                        <p style="color: green;font-weight: bold;">Final Deposit Amount :- ${{ $data[$_GET['key']]->debit_amount - $com }}</p>

                    @endif
                        <hr>
                        <p>Status :-
                        @if ($data[$_GET['key']]->status == 'completed')
                            <span class="badge badge-success">Successfully Transferred</span>
                        @elseif ($data[$_GET['key']]->status == 'decline')
                            <span class="badge badge-danger">decline</span>
                        @else
                            <span class="badge badge-warning">Pending</span>
                            <hr>
                            @if ($data[$_GET['key']]->user_type_id == 2)

                                <a href="paymentStatusUpdate/{{ base64_encode($data[$_GET['key']]->id) }}?s=1&u={{ base64_encode($data[$_GET['key']]->user_id) }}&db={{ base64_encode($data[$_GET['key']]->debit_amount) }}" class="btn btn-outline btn-circle btn-sm purple"
                                data-toggle="tooltip" title="Approve"><i class="fa fa-check"></i></a>

                            @else
                                <form action="specialist_withdraw_req" method="post" style="float: left;margin-right: 15px;">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ $data[$_GET['key']]->name }}">
                                    <input type="hidden" name="email" value="{{ $data[$_GET['key']]->email }}">
                                    <input type="hidden" name="id" value="{{ $data[$_GET['key']]->id }}">
                                    <input type="hidden" name="user_type" value="{{ $data[$_GET['key']]->id }}">
                                    <input type="hidden" name="user_id" value="{{ $data[$_GET['key']]->user_id }}">
                                    <input type="hidden" name="debit_amount" value="{{ $data[$_GET['key']]->debit_amount }}">
                                    <input type="hidden" name="final_deposit_Amount" value="{{ $data[$_GET['key']]->debit_amount - $com  }}">
                                    <input type="submit" class="btn btn-outline btn-circle btn-sm green" name="status" value="Transferred">
                                </form>
                            @endif
                            <form action="specialist_withdraw_req" method="post" style="float: left;margin-right: 15px;">
                                @csrf
                                <input type="hidden" name="name" value="{{ $data[$_GET['key']]->name }}">
                                <input type="hidden" name="email" value="{{ $data[$_GET['key']]->email }}">
                                <input type="hidden" name="id" value="{{ $data[$_GET['key']]->id }}">
                                <input type="hidden" name="user_type" value="{{ $data[$_GET['key']]->id }}">
                                <input type="hidden" name="user_id" value="{{ $data[$_GET['key']]->user_id }}">
                                <input type="hidden" name="debit_amount" value="{{ $data[$_GET['key']]->debit_amount }}">
                                <input type="hidden" name="final_deposit_Amount" value="{{ $data[$_GET['key']]->debit_amount - $com  }}">
                                <input type="submit" class="btn btn-outline btn-circle btn-sm red" name="status" value="Cancel">
                            </form>
                            <br>
                                {{-- <a href="paymentStatusUpdate/{{ base64_encode($data[$_GET['key']]->id) }}?s=3" class="btn btn-outline btn-circle btn-sm red"
                                data-toggle="tooltip" title="Reject"><i class="fa fa-times"></i></a> --}}
                        @endif
                    </p>
            </div>
        </div>
    </div>



    @else
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN SAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-envelope font-green-haze" aria-hidden="true"></i>
                            <span class="caption-subject font-green-haze bold uppercase">Payments</span>
                        </div>
                        <div style="float: right;">
                            <a href="?" class="btn btn-info">All</a>
                            <a href="?filter=pending" class="btn btn-info">Pending</a>
                            <a href="?filter=completed" class="btn btn-info">Completed</a>
                            <a href="?filter=decline" class="btn btn-info">Rejected</a>
                        </div>
                    </div>

                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead>
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">UserType</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    @foreach ($data as $key => $trns)
                                        <tr>
                                            <td data-label="Type">{{ $key + 1 }}</td>
                                            <td data-label="Type">{{ $trns->name }}</td>
                                            <td data-label="Type">{{ $trns->type_id == 2 ? 'Client' : 'Specialist' }}</td>
                                            <td data-label="Type">
                                                {{ $trns->credit_amount == null ? $trns->debit_amount : $trns->credit_amount }}
                                            </td>
                                            <td data-label="Description">
                                                {{ $trns->credit_amount == null ? 'Debit Request' : 'credit Request' }}
                                            </td>
                                            <td data-label="Date">
                                                {{ $trns->created_at }}
                                            </td>
                                            <td data-label="Status">
                                                @if ($trns->debit_amount !=null)
                                                    @if ($trns->status == 'completed')
                                                        <span class="badge badge-success">Success</span>
                                                        {{-- @elseif ($trns->status == 'processing')
                                                        <span class="badge badge-warning">processing</span> --}}
                                                    @elseif ($trns->status == 'decline')
                                                        <span class="badge badge-danger">decline</span>
                                                    @else
                                                        <span class="badge badge-warning">Pending</span>
                                                    @endif
                                                    <a href="?DebitReq&key={{ $key }}">View & Update</a>
                                                @else
                                                    @if ($trns->status == 'completed')
                                                        <span class="badge badge-success">Success</span>
                                                        {{-- @elseif ($trns->status == 'processing')
                                                        <span class="badge badge-warning">processing</span> --}}
                                                    @elseif ($trns->status == 'decline')
                                                        <span class="badge badge-danger">decline</span>
                                                    @else
                                                        <span class="badge badge-warning">Pending</span>
                                                        <a href="paymentStatusUpdate/{{ base64_encode($trns->id) }}?s=1&u={{ base64_encode($trns->user_id) }}&cb={{ base64_encode($trns->credit_amount) }}"
                                                            class="btn btn-outline btn-circle btn-sm purple"
                                                            data-toggle="tooltip" title="Approve"><i
                                                                class="fa fa-check"></i></a>
                                                        <a href="paymentStatusUpdate/{{ base64_encode($trns->id) }}?s=3"
                                                            class="btn btn-outline btn-circle btn-sm red"
                                                            data-toggle="tooltip" title="Reject"><i
                                                                class="fa fa-times"></i></a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    @endif



@stop

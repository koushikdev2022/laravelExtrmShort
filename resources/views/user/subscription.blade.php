@extends('layouts.master')
@section('content')
<div class="clearfix">
    <div class="dash-bottom-part pb-0">
        <div class="justify-content-center">
            <div class="col-md-12">
                <div class="bottom-part-1 mt-40">
                    <div class="topheading_bx">
                        <h1 class="dash_heading">Subscription</h1>
                    </div>
                    <div class="row justify-content-center">
                        @foreach($subscriptions as $key=>$subscription)
                        <div class="col-md-6 col-lg-4">
                            <div class="planPackage planTwo">
                                <div class="pHeader">
                                    <h4>{{$subscription->name}}</h4>
                                    <p>Subscription</p>
                                </div>
                                <div class="pPrice">
                                    <h1><span>$</span>{{$subscription->amount}}</h1>
                                    <p>{{$subscription->duration}}</p>
                                </div>
                                <div class="pBody">
                                    {!!$subscription->plan_text!!}
                                </div>
                                <div class="pFooter">
                                    @if($key==0)
                                    <a href="#" class="planSubscribe planCurrent planActive">Current Plan</a>
                                    @else
                                    @php
                                        $user = auth()->guard('frontend')->user();
                                        $model=App\Models\ExtendExpireDate::where('user_id',$user->id)->orderBy('id','DESC')->where('status','1')->first();
                                    
                                    @endphp
                                    <a href="javascript:void(0)" onclick="upgrade_plan({{$subscription->id}})" class="planSubscribe planCurrent {{!empty($model) ? 'planActive':''}}">UPGRADE</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{-- <div class="col-md-6 col-lg-4">
                            <div class="planPackage planThree">
                                <div class="pHeader">
                                    <h4>Upgraded</h4>
                                    <p>Subscription</p>
                                </div>
                                <div class="pPrice">
                                    <h1><span>$</span>15</h1>
                                    <p>Per month</p>
                                </div>
                                <div class="pBody">
                                    <ul class="fa-ul">
                                        <li class="clrPink"><span class="fa-li"><i class="icofont-check-circled"></i></span>All from Upgraded, plus...</li>
                                        <li class="clrYellow"><span class="fa-li"><i class="icofont-check-circled"></i></span>Curabitur rhoncus magna augue</li>
                                        <li class="clrYellow"><span class="fa-li"><i class="icofont-check-circled"></i></span>Pellentesque sed orci</li>
                                        <li class="clrYellow"><span class="fa-li"><i class="icofont-check-circled"></i></span>ipsum porta, vestibulum nibh ut varius magna</li>
                                        <li class="clrYellow"><span class="fa-li"><i class="icofont-check-circled"></i></span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                    </ul>

                                </div>
                                <div class="pFooter">
                                    <a href="#" class="planSubscribe planCurrent">UPGRADE</a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="table_bx">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Subscription Name</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">End Date</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($user_subscriptions as $user_subscription)
                                    <tr>
                                        <td data-label="Subscription Name">
                                           {{$user_subscription->subscription->name}}
                                        </td>
                                        <td data-label="Amount">
                                            ${{$user_subscription->amount}}
                                        </td>
                                        <td data-label="Start Date">
                                            {{$user_subscription->start_date}}
                                        </td>
                                        <td data-label="End Date">
                                            {{$user_subscription->end_date}}
                                        </td>
                                        <td data-label="Status">
                                           @if($user_subscription->status=='1')
                                           Running
                                           @else
                                           End
                                           @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">
                                            <div class="text-center">
                                                <img src="{{asset('storage/frontend/images/transaction-icon.png')}}" height="120"
                                                    alt="transaction image" />
                                                <p class="font-weight-bold text-center">No Subscription found.
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
                        {{ $user_subscriptions->links() }}
                        {{-- {{ $wallet_logs->links() }} --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

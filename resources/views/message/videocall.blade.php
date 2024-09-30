@extends('layouts.main') 
@section('css')

<style>
    #subscriber {
        width: 450px;
        height: 400px;
        border: 3px solid white;
        border-radius: 3px;
    }

    #publisher {
        width: 450px;
        height: 400px;
        border: 3px solid white;
        border-radius: 3px;
    }
</style>
@stop
@section('content')
@include('partials.header')
<div class="dashboard">
    <div class="dash-body" style="min-height: 119px;">
        <div class="container">
                @include('partials.profile-left-panel')
                <div class="dash-right">
                        <div class="dash-bottom-part">
                            <div class="bottom-part-2">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-sm-12">
                                            <div class="left_bx common-section-box mb-3">
                                                <div class="common-section-box-heading">
                                                    <h2>CALL IS GOING ON</h2> <a href="javascript:;" onclick="disconnectAndReloadCall();" class="btn btn-danger">Disconnect</a>
                                                </div>
                                                <div class="common-section-box-content">
                                                    <div class="common-dash-form">
                                                        <div class="dash-bottom-part pt-0">
                                                            <div class="bottom-part-2">
                                                                <div class="row btmcont">
                                                                    <div class="col-lg-6 col-md-6">
                                                                        <div id="subscriber"></div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6">
                                                                        <div id="publisher"></div>
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
                </div>
<div class="clearfix"></div>
        </div>

    </div>
</div><!-- end of dashboard right section -->
</div>
@include('partials.footer')
@stop

@section('js')
<script type="text/javascript" src="//static.opentok.com/v2/js/opentok.min.js"></script>
{!!script_version('/frontend/custom/js/chat.js') !!}
<script type="text/javascript">
// replace these values with those generated in your TokBox Account
                                                        var apiKey = "<?php echo $api_key; ?>";
                                                        var sessionId = "<?php echo $sessionId; ?>";
                                                        var token = "<?php echo $token; ?>";

// Handling all of our errors here by alerting them
                                                        function handleError(error) {
                                                            if (error) {
                                                                alert(error.message);
                                                            }
                                                        }

// (optional) add server code here
                                                        initializeSession();

                                                        function initializeSession() {
                                                            var session = OT.initSession(apiKey, sessionId);

                                                            // Subscribe to a newly created stream
                                                            session.on('streamCreated', function (event) {
                                                                session.subscribe(event.stream, 'subscriber', {
                                                                    insertMode: 'append',
                                                                    width: '100%',
                                                                    height: '100%'
                                                                }, handleError);
                                                            });

                                                            // Create a publisher
                                                            var publisher = OT.initPublisher('publisher', {
                                                                insertMode: 'append',
                                                                width: '100%',
                                                                height: '100%'
                                                            }, handleError);

                                                            // Connect to the session
                                                            session.connect(token, function (error) {
                                                                // If the connection is successful, initialize a publisher and publish to the session
                                                                if (error) {
                                                                    handleError(error);
                                                                } else {
                                                                    session.publish(publisher, handleError);
                                                                }
                                                            });
                                                        }

                                                        $(document).ready(function () {
                                                            checkDisconnectOrNotVar = setInterval(function () {
                                                                checkDisconnectOrNot();
                                                            }, 3000);

                                                            clearInterval(CallComingOrNot);
                                                            setInterval(function () {
                                                            }, 3000);

                                                            if ($('#subscriber').is(':empty')) {
                                                                //$('#subscriber').css('height', '0px');
                                                            }
                                                        });
</script>
@stop
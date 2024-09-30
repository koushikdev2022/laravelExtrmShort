<div class="modal cust_modal verification_modal fade" id="verification_modalmsg" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="icofont-close-line-circled"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-form">
                    <p class="modal-form-paragraph"></p>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="common-btn mx-auto" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@if(Session::has('success'))
<input type="hidden" id="success_msg" value="{{ Session::get('success') }}" />
@php
Session::forget('success');
@endphp
<script>
var success_msg = $('#success_msg').val();
$(window).load(function() {
    notie.alert({
        type: 'success',
        text: '<i class="fa fa-check"></i> ' + success_msg,
        time: 6
    });
});
</script>

@endif

@if(Session::has('error'))
<input type="hidden" id="error_msg" value="{{ Session::get('error') }}" />
@php
Session::forget('error');
@endphp
<script>
var error_msg = $('#error_msg').val();
$(window).load(function() {
    notie.alert({
        type: 'error',
        text: '<i class="fa fa-times"></i> ' + error_msg,
        time: 6
    });
});
</script>

@endif

<script type="text/javascript">
window.addEventListener('livealert', event => {
               Lobibox.notify(event.detail.type, {
                    continueDelayOnInactiveTab: false,
                    position: 'bottom right',
                    delayIndicator: false,
                    msg: event.detail.message
                });
    
});
</script>
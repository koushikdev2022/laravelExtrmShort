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

{{-- <div class="modal cust_modal verification_modal fade" id="project_publish_modalmsg" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
         
            <div class="modal-body">
                <div class="modal-form text-center">
                    <img src="{{asset('storage/frontend/images/tick.png')}}" style="height:80px; width:80px;">
                    <h5 class="modal-title-project mb-2"></h5>
                    <p class="modal-form-paragraph-project"></p>
                </div>
            </div>
            <div class="modal-footer text-center" style="justify-content: center;">
                <a href="{{route('user.projects')}}" class="common-btn green">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div> --}}


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
    if (event.detail.hidemodal) {
        $('.modal').modal('hide');
    }
    var defaultNotieTime = event.detail.showtime ? event.detail.showtime : 5;
    if (event.detail.showmodalmsg) {
        $('#verification_modalmsg .modal-title').html(event.detail.modaltitle);
        $('#verification_modalmsg .modal-form-paragraph').html(event.detail.modaldetail);
        $('#verification_modalmsg').modal('show');
    }else if (event.detail.showprojectmodalmsg) {
        $('#project_publish_modalmsg .modal-title-project').html(event.detail.modalprojecttitle);
        $('#project_publish_modalmsg .modal-form-paragraph-project').html(event.detail.modalprojectdetail);
        $('#project_publish_modalmsg').modal('show');
    } else {
        notie.alert({
            type: event.detail.type,
            text: (event.detail.type === 'success' ? '<i class="fa fa-check"></i> ' :
                '<i class="fa fa-times"></i> ') + event.detail.message,
            time: defaultNotieTime
        });
    }

    if (event.detail.redirect) {
        setTimeout(function() {
            window.location.href = event.detail.redirect;
        }, defaultNotieTime * 1000);
    }
    if (event.detail.reload) {
        window.location.reload(true);
    }
    if (event.detail.stoploader) {
        ajaxindicatorstop();
    }
    if (event.detail.resetRecaptcha) {
        grecaptcha.reset();
    }
    if (event.detail.thumb) {
        $('.profile-thumb').attr('src', event.detail.thumb);
    }
    if (event.detail.avatar) {
        $('.profile-avatar').attr('src', event.detail.avatar);
    }
});
</script>
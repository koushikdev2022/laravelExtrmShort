            
            @php
              $bid=App\Models\Bid::where('project_id',!empty($project->id) ? $project->id : '')->where('user_id',Auth()->guard('frontend')->user()->id)->where('status','<>','3')->first();
              $bid_budget=App\Models\BidBudget::where('bid_id',!empty($bid->id) ? $bid->id : '')->first();
              $bid_files=App\Models\BidFile::where('bid_id',!empty($bid->id) ? $bid->id : '')->where('status','1')->get();
            @endphp
            
            <div class="modal-body">
            <div class="d-flex justify-content-around">
                <div>
                    <h5>Budget</h5>
                    <h6 class="text-muted mt-3">${{!empty($project->budget) ? $project->budget : ''}}</h6>

                </div>
                <div>
                    <h5>Bid Amount</h5>
                    <div class="input-group mb-3 form-group">
                      <span class="input-group-text" id="basic-addon1">$</span>
                      <input style="max-width: 100px;" name="project_id" type="hidden" value="{{!empty($project->id) ? $project->id : ''}}" class="form-control">
                      <input style="max-width: 100px;" name="author_id" type="hidden" value="{{!empty($project->user_id) ? $project->user_id : ''}}" class="form-control">
                      <input style="max-width: 100px;" name="billable_target" value="{{!empty($bid_budget->billable_target) ? $bid_budget->billable_target : ''}}" type="text" class="form-control">
                      <span class="help-block"><span>
                    </div>
                </div>
                {{-- <div>
                    <h5>Place Bid</h5>
                    <div class="input-group mb-3 form-group">
                      <span class="input-group-text" id="basic-addon1">$</span>
                      <input style="max-width: 100px;" name="budget_amount" type="text" value="{{!empty($bid_budget->budget_amount) ? $bid_budget->budget_amount : ''}}" class="form-control">
                      <span class="help-block"><span>
                    </div>
                </div> --}}
                
            </div>

            <div class="border-top mt-2 p-3 ">
                <div class="mb-3 form-group">
              <label for="exampleFormControlInput1" class="form-label">Deadline</label>
              <input type="date" class="form-control" name="deadline" value="{{!empty($bid->deadline) ? $bid->deadline : ''}}" id="exampleFormControlInput1" placeholder="name@example.com">
              <span class="help-block"><span>
            </div>
            <div class="mt-2  form-group">
              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">File Upload</label>
                  <input class="form-control inputUpload" name="upload_file_names[]" type="file" id="mySendFiles" multiple>
                  <div id="upload-2-queue" class="queue"></div>
                  <a class="control-button btn btn-link" style="display: none"
                  href="javascript:$.fileup('upload-2', 'upload', '*')">Upload all</a>
                  <a class="control-button btn btn-link" style="display: none"
                  href="javascript:$.fileup('upload-2', 'remove', '*')">Remove all</a>
              </div>
            </div>
            <div class="mt-2  form-group">
              <div class="mb-3 d-flex fwrap">
                  @foreach ($bid_files as $bid_file)

                   

                    @php
                      $file_t=explode(".",$bid_file->file);
                      $file_type=end($file_t);
                    @endphp
                    @if($file_type=='png' || $file_type=='jpeg' || $file_type=='jpg' || $file_type=='gif')

                    <div class="dltImg" id="edit-file-content_{{$bid_file->id}}">
                        <img src="{{asset('storage/uploads/frontend/proposal/'.$bid_file->file)}}">
                        <a onclick="file_delete({{$bid_file->id}})"><i class="fa-solid fa-xmark"></i></a>
                    </div>
                    @else
                    <div class="dltImg" id="edit-file-content_{{$bid_file->id}}">
                        <img src="{{asset('storage/frontend/images/file.png')}}">

                        <a onclick="file_delete({{$bid_file->id}})"><i class="fa-solid fa-xmark"></i></a>
                    </div>
                    @endif

                  @endforeach
              </div>
            </div>

            <div class="mb-3 form-group">
              <label for="exampleFormControlTextarea1" class="form-label">Proposal</label>
              <textarea class="form-control" name="proposal" id="exampleFormControlTextarea1" rows="4">{{!empty($bid->proposal) ? $bid->proposal : ''}}</textarea>
              <span class="help-block"><span>
            </div>
            @if($project->job_type=='IT Projects' || $project->job_type=='Business & Robotics Automation' || $project->job_type=='Website, Mobile & Software Development')
            <div class="mb-3 form-group">
                <label for="exampleFormControlTextarea1" class="form-label">Describe your recent & relevant experience with similar projects :</label>
                <textarea class="form-control" name="describe_recent_project" id="exampleFormControlTextarea1" rows="4">{{!empty($bid->describe_recent_project) ? $bid->describe_recent_project : ''}}</textarea>
                {{-- <span class="help-block"><span> --}}
            </div>
            <div class="mb-3 form-group">
              <label for="exampleFormControlTextarea1" class="form-label">Include a link to your profile and/or website (separate with (,))</label>
              <textarea class="form-control" name="project_link" id="exampleFormControlTextarea1" rows="4">{{!empty($bid->project_link) ? $bid->project_link : ''}}</textarea>
              {{-- <span class="help-block"><span> --}}
            </div>
            <div class="mb-3 form-group">
                <label for="exampleFormControlTextarea1" class="form-label">Describe your approach to development, testing and improving QA :</label>
                <textarea class="form-control" name="describe_qa" id="exampleFormControlTextarea1" rows="4">{{!empty($bid->describe_qa) ? $bid->describe_qa : ''}}</textarea>
                {{-- <span class="help-block"><span> --}}
            </div>
            @endif
            </div>

            </div>
<script>
    $(document).ready(function() {
        $.fileup({
            url: full_path + 'fileuploadforbid',
            inputID: 'mySendFiles',
            dropzoneID: 'upload-2-dropzone',
            queueID: 'upload-2-queue',
            filesLimit: 5,
            autostart: true,
            onSelect: function(file) {
                $('#multiple .control-button').show();
                setTimeout(() => {
                    $('.file-upload-wrapper').attr('data-text', 'Upload Here');
                }, 100);
            },
            onRemove: function(file, total) {
                if (file === '*' || total === 1) {
                    $('#multiple .control-button').hide();
                }
            },
            onSuccess: function(response, file_number, file) {
                var result = JSON.parse(response);
                var options = this.fileup.options;
                $('#fileup-' + options.inputID + '-' + file_number).append(
                    '<input type="hidden" name="upload_file_names[]" value="' + result.name + '">');
                $.growl.notice({
                    title: "Upload success!",
                    message: file.name
                });
            },
            onError: function(event, file, file_number, response) {
                var result = JSON.parse(response);
                var message = result.errors.filedata[0];
                var options = this.fileup.options;
                $.growl.error({
                    message: message
                });
            }
        });
    });

function file_delete(file_id) {
    if (file_id) {
        var url = full_path + "delete-proposal-file";
        var csrf_token = $('meta[name="csrf-token"]').attr("content");
        var data = { file_id: file_id };
        ajaxindicatorstart();
        $.ajax({
            url: url,
            headers: { "X-CSRF-TOKEN": csrf_token },
            type: "POST",
            dataType: "json",
            //processData: false,
            //contentType: false,
            data: data,
            success: function (resp) {
                ajaxindicatorstop();
                if (resp.status == "success") {
                    // notie.alert({
                    //     type: "success",
                    //     text: '<i class="fa fa-check"></i> ' + resp.message,
                    //     time: 3,
                    // });
                    // $('#model-title').text('Edit Education');
                    $("#edit-file-content_" + resp.id).addClass("d-none");
                    // openModalPopup('add-education');
                    // getUploadContentWrapper();
                } else {
                    console.log(resp);
                    notie.alert({
                        type: "error",
                        text: '<i class="fa fa-times"></i> ' + resp.errors,
                        time: 3,
                    });
                }
            },
        });
    }
}
</script>       
         
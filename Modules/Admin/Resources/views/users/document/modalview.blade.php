 @if(!empty($identity_document))
 <div class="modal cust_modal fade" id="viewmodal_{{$identity_document->id}}" tabindex="-1" role="dialog"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Document Preview</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <i class="icofont-close-line-circled"></i>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="image_prevnw">
                     @if ($showphoto)
                     <img src="{{asset('storage/uploads/frontend/documents/'.$identity_document->file_name)}}"
                         class="img-responsive">
                     @endif
                     <p>{{ $identity_document->file_name }}</p>
                     <a href="{{asset('storage/uploads/frontend/documents/'.$identity_document->file_name)}}"
                         download="{{ $identity_document->file_name }}" class="btn green"><i class="fa fa-download"
                             aria-hidden="true"></i>Download
                     </a>
                 </div>
             </div>
         </div>
     </div>
 </div>
 @endif
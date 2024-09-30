<div class="col-lg-12 dashboard-right">
    <div class="dash-bottom-part">
        <div class="bottom-part-2">
            <div class="dash_headingbx">
                <h2 class="dash_heading pl-0">Account Verification</h2>
            </div>
            <div class="white_contentbx">
                <div class="tab-content">
                    <div class="tab-pane active" id="home-h" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="vrification-list veryfication_nwbx about-client">
                                    <ul>
                                        @if ($verification_model->identity==='1')
                                        <li class="complted">
                                            <a href="#" class="ml-4">User Identity
                                            </a>
                                            <a href="#" wire:ignore.self class="question_bx" data-toggle="tooltip"
                                                data-placement="top" title=''><i class="icofont-question-circle"></i>
                                            </a>
                                        </li>
                                        @else
                                        <li class="">
                                            <a href="#" class="ml-4" wire:click.prevent="triggershowIdentityFrm"
                                                wire:target="triggershowIdentityFrm">User Identity
                                                verified
                                            </a>
                                            <a href="#" wire:ignore.self class="question_bx" data-toggle="tooltip"
                                                data-placement="top" title=''><i class="icofont-question-circle"></i>
                                            </a>
                                            &nbsp; &nbsp;
                                            <span class=custloading" type="button" wire:loading
                                                wire:target="triggershowIdentityFrm" disabled>
                                                <i class="fa fa-circle-o-notch fa-spin"></i> Loading...
                                            </span>
                                        </li>
                                        @endif

                                        @if($showIdentityFrm)
                                        {{-- <li class="details_bx d-block"> --}}
                                            @if ($showIdentityFrmFirst)
                                            <div class="cmnverfiction_bx id_uploadbx">
                                                <form wire:submit.prevent="savefirstfrm" enctype="multipart/form-data">
                                                    <h1 class="heading">ID Upload and Verification</h1>
                                                    <p class="heading_para">You have selected Estonia as your country.
                                                        Your
                                                        ID document should be ID-kaart /National ID Card</p>
                                                    <div class="upload_separatebx">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-6 col-sm-6"
                                                                x-data="{ isFrontUploading: false, progress: 0 }"
                                                                x-on:livewire-upload-start="isFrontUploading = true"
                                                                x-on:livewire-upload-finish="isFrontUploading = false"
                                                                x-on:livewire-upload-error="isFrontUploading = false"
                                                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                                <div class="separatebxnw">
                                                                    <h1 class="heading_nw">National Identification
                                                                        Document<br>(Front Side)or Passport</h1>
                                                                    <p>Please upload a photo of the <span
                                                                            class="smibold">front</span> side of the
                                                                        official document which is used as a National
                                                                        Identification Document of your country or a
                                                                        photo
                                                                        of your passport identification page.</p>
                                                                    <a href="#" class="acceptbale_document">ACCEPTABLE
                                                                        DOCUMENTS PER COUNTRY LIST</a>
                                                                </div>
                                                                @if ($front_photo)
                                                                    Photo Preview:<br>
                                                                    <img src="{{ $front_photo->temporaryUrl() }}" style="width:200px; height:150px;">
                                                                @endif
                                                                <div class="input_btnwrp">
                                                                    <input type="file" id="frontfile-upload"
                                                                        name="front_photo"
                                                                        wire:model.defer="front_photo" required />
                                                                    <label for="frontfile-upload"
                                                                        class="common-btn">Upload</label>
                                                                    <div id="frontfile-uploadname"></div>
                                                                </div>
                                                                <div x-show="isFrontUploading" class="mt-3">
                                                                    <progress max="100" class="text-center"
                                                                        x-bind:value="progress"></progress>
                                                                </div>
                                                                @error('front_photo')
                                                                <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-6 col-sm-6"
                                                                x-data="{ isBackUploading: false, progress: 0 }"
                                                                x-on:livewire-upload-start="isBackUploading = true"
                                                                x-on:livewire-upload-finish="isBackUploading = false"
                                                                x-on:livewire-upload-error="isBackUploading = false"
                                                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                                <div class="separatebxnw">
                                                                    <h1 class="heading_nw">National Identification
                                                                        Document<br>(Rear Side)</h1>
                                                                    <p>Please upload a photo of the <span
                                                                            class="smibold">rear</span> side of the
                                                                        official document which is used as a National
                                                                        Identification Document of your country. No
                                                                        second photo of the passport is required.</p>
                                                                    <a href="#" class="acceptbale_document">ACCEPTABLE
                                                                        DOCUMENTS PER COUNTRY LIST</a>
                                                                </div>
                                                                @if ($back_photo)
                                                                    Photo Preview:<br>
                                                                    <img src="{{ $back_photo->temporaryUrl() }}" style="width:200px; height:150px;">
                                                                @endif
                                                                <div class="input_btnwrp">
                                                                    <input type="file" id="file-upload2"
                                                                        name="back_photo" wire:model.defer="back_photo"
                                                                        required />
                                                                    <label for="file-upload2"
                                                                        class="common-btn">Upload</label>
                                                                    <div id="file-upload-filename2"></div>
                                                                </div>
                                                                <div x-show="isBackUploading" class="mt-3">
                                                                    <progress max="100" class="text-center"
                                                                        x-bind:value="progress"></progress>
                                                                </div>
                                                                @error('back_photo')
                                                                <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="bottom_infobx">
                                                        <h1 class="small_heading">Please ensure your identification
                                                            document
                                                            is clearly visible to avoid the document being rejected.
                                                        </h1>
                                                        <p>The photo or scanned document in order to be accepted must
                                                        </p>
                                                        <ul class="small_point">
                                                            <li><span class="ml-2">be clearly Visible</span></li>
                                                            <li><span class="ml-2">have adequate light</span></li>
                                                            <li><span class="ml-2">clearly show the face of the person</span></li>
                                                            <li><span class="ml-2">clearly show the identification number and issue date
                                                            </span></li>
                                                            <li><span class="ml-2">not have any damage that prevents the number and text
                                                                from
                                                                being seen</span></li>
                                                            <li><span class="ml-2">not have any missing pieces or being torn</span></li>
                                                            <li><span class="ml-2">not be a photocopy</span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="btn_wrp">
                                                        <button type="button"
                                                            wire:click.prevent="triggershowIdentityFrm"
                                                            wire:target="triggershowIdentityFrm"
                                                            wire:loading.class="d-none"
                                                            class="common-btn bdr mx-1">Cancel</button>
                                                        <button class="common-btn mx-1 green custloading" type="button"
                                                            wire:loading wire:target="triggershowIdentityFrm" disabled>
                                                            <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
                                                        </button>

                                                        <button button="submit" class="common-btn mx-1 green"
                                                            wire:target="savefirstfrm"
                                                            wire:loading.class="d-none">Next</button>
                                                        <button class="common-btn mx-1 green custloading" type="button"
                                                            wire:loading wire:target="savefirstfrm" disabled>
                                                            <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            @else
                                            <div class="cmnverfiction_bx id_uploadbx">
                                                <form wire:submit.prevent="savefinalfrm" enctype="multipart/form-data">
                                                    <h1 class="heading">Photo Verification</h1>
                                                    <p class="heading_para">Please upload a photo of yourself holding
                                                        the
                                                        submitted ID document</p>
                                                    <div class="upload_separatebx">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-5 col-sm-6"
                                                                x-data="{ isPhotoUploading: false, progress: 0 }"
                                                                x-on:livewire-upload-start="isPhotoUploading = true"
                                                                x-on:livewire-upload-finish="isPhotoUploading = false"
                                                                x-on:livewire-upload-error="isPhotoUploading = false"
                                                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                                <div class="separatebxnw">
                                                                    <h1 class="heading_nw">Verification Photo Upload
                                                                    </h1>
                                                                    <p>Please upload a photo of yourself (selfie)
                                                                        holding
                                                                        the submitted ID document. The photo must
                                                                        clearly show your face and the document
                                                                        together within the same photo.</p>
                                                                    <a href="#" class="acceptbale_document"
                                                                        data-toggle="modal"
                                                                        data-target="#verifiactionphoto">VERIFICATION
                                                                        PHOTO
                                                                        EXAMPLES</a>
                                                                </div>
                                                                @if ($photo)
                                                                    Photo Preview:<br>
                                                                    <img src="{{ $photo->temporaryUrl() }}" style="width:200px; height:150px;">
                                                                @endif
                                                                <div class="input_btnwrp">
                                                                    <input type="file" id="photofile-upload"
                                                                        wire:model.defer="photo"
                                                                        wire:target="savefinalfrm" required />
                                                                    <label for="photofile-upload"
                                                                        class="common-btn">Upload</label>
                                                                    <div id="photofile-upload-filename"></div>
                                                                </div>
                                                                <div x-show="isPhotoUploading" class="mt-3">
                                                                    <progress max="100" class="text-center"
                                                                        x-bind:value="progress"></progress>
                                                                </div>
                                                                @error('photo')
                                                                <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="bottom_infobx">
                                                        <h1 class="small_heading">Please ensure the verification photo
                                                            is
                                                            clearly visible to avoid the photo being rejected.</h1>
                                                        <p>The verification photo in order to be accepted must</p>
                                                        <ul class="small_point">
                                                            <li><span class="ml-2">have your full face visible</span></li>
                                                            <li><span class="ml-2">have adequate light</span></li>
                                                            <li><span class="ml-2">be the same person as the one in the uploaded document
                                                            </span></li>
                                                            <li><span class="ml-2">have the person holding the same document uploaded</span></li>
                                                            <li><span class="ml-2">include your photo selfie) and the document within the
                                                                same
                                                                picture</span></li>
                                                            <li><span class="ml-2">not have any missing pieces or being torn</span></li>
                                                            <li><span class="ml-2">not have your face covered (ie wearing sunglasses, hat,
                                                                mask, etc)</span></li>
                                                            <li><span class="ml-2">not be a photocopy</span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="btn_wrp">
                                                        <button type="button" wire:click.prevent="showfirstfrm"
                                                            wire:target="showfirstfrm" wire:loading.class="d-none"
                                                            class="common-btn bdr mx-1">Back</button>
                                                        <button class="common-btn mx-1 green custloading" type="button"
                                                            wire:loading wire:target="showfirstfrm" disabled>
                                                            <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
                                                        </button>

                                                        <button button="submit" class="common-btn mx-1 green"
                                                            wire:loading.class="d-none">Submit Photo</button>
                                                        <button class="common-btn mx-1 green custloading" type="button"
                                                            wire:loading disabled>
                                                            <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            @endif
                                        {{-- </li> --}}
                                        @endif
                                        
                                        {{-- <li class="{{$verification_model->payment_method==='1'?'complted':''}}"><a
                                                href="#">Payment method verified</a></li> --}}
                                        <!-- <li class="{{$verification_model->deposite_made==='1'?'complted':''}}"><a
                                                href="#">Deposit made</a></li> -->
                                        <!-- <li class="{{$verification_model->email_address=='1'?'complted':''}}">
                                            <a href="{{route('user.settings')}}">Email address
                                                verified</a>
                                        </li> -->
                                        {{-- <li class="{{$verification_model->payment_method==='1'?'complted':''}}">
                                            <a href="{{route('user.settings')}}" class="ml-4">Payment mode verified
                                            </a>
                                        </li> --}}
                                        <li class="{{$verification_model->email_address==='1'?'complted':''}}">
                                            <a href="{{route('user.settings')}}" class="ml-4">Email address verified</a>
                                        </li>




                                        @if ($verification_model->documents==='1')
                                        <li class="{{$verification_model->documents==='1'?'complted':''}}">
                                            <a href="#" class="ml-4">Documents submission
                                            </a>
                                            <a href="#" wire:ignore.self class="question_bx" data-toggle="tooltip"
                                                data-placement="top" title=''><i class="icofont-question-circle"></i>
                                            </a>
                                        </li>
                                        @else
                                        <li class="{{$verification_model->documents==='1'?'complted':''}}">
                                            <a href="#" class="ml-4" wire:click.prevent="triggershowDocumentFrm"
                                                wire:target="triggershowDocumentFrm">Documents submission
                                                verified
                                            </a>
                                            <a href="#" wire:ignore.self class="question_bx" data-toggle="tooltip"
                                                data-placement="top" title=''><i class="icofont-question-circle"></i>
                                            </a>
                                            &nbsp; &nbsp;
                                            <span class=custloading" type="button" wire:loading
                                                wire:target="triggershowDocumentFrm" disabled>
                                                <i class="fa fa-circle-o-notch fa-spin"></i> Loading...
                                            </span>
                                        </li>
                                        @endif

                                        @if($showDocumentFrm)
                                        {{-- <li class="details_bx d-block"> --}}
                                            @if ($showDocumentFrmFirst)
                                            <div class="cmnverfiction_bx id_uploadbx">
                                                <form wire:submit.prevent="savefirstDocumentfrm" enctype="multipart/form-data">
                                                    <h1 class="heading">Doument Upload and Verification</h1>
                                                    <p class="heading_para">You have selected Estonia as your country.</p>
                                                    <div class="upload_separatebx">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-6 col-sm-6"
                                                                x-data="{ isCvUploading: false, progress: 0 }"
                                                                x-on:livewire-upload-start="isCvUploading = true"
                                                                x-on:livewire-upload-finish="isCvUploading = false"
                                                                x-on:livewire-upload-error="isCvUploading = false"
                                                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                                <div class="separatebxnw">
                                                                    <h1 class="heading_nw">Curriculum Vitae
                                                                        Document<br>(CV & Resume)</h1>
                                                                    <p>Please upload a Document of the 
                                                                        official document which is used as a National
                                                                        Document of your country</p>
                                                                    <a href="#" class="acceptbale_document">ACCEPTABLE
                                                                        DOCUMENTS PER COUNTRY LIST</a>
                                                                </div>
                                                                @if ($cv_doc)
                                                                    Preview:<br>
                                                                    <img src="{{ asset('storage/frontend/images/file.png') }}" alt="" style="width:200px; height:150px;">
                                                                @endif
                                                                <div class="input_btnwrp">
                                                                    <input type="file" id="cv_doc-upload"
                                                                        name="cv_doc"
                                                                        wire:model.defer="cv_doc" required />
                                                                    <label for="cv_doc-upload"
                                                                        class="common-btn">Upload</label>
                                                                    <div id="cv_doc-uploadname"></div>
                                                                </div>
                                                                <div x-show="isCvUploading" class="mt-3">
                                                                    <progress max="100" class="text-center"
                                                                        x-bind:value="progress"></progress>
                                                                </div>
                                                                @error('cv_doc')
                                                                <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-6 col-sm-6"
                                                                x-data="{ isQualificationCertificateUploading: false, progress: 0 }"
                                                                x-on:livewire-upload-start="isQualificationCertificateUploading = true"
                                                                x-on:livewire-upload-finish="isQualificationCertificateUploading = false"
                                                                x-on:livewire-upload-error="isQualificationCertificateUploading = false"
                                                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                                <div class="separatebxnw">
                                                                    <h1 class="heading_nw">Qualification Certificate Document</h1>
                                                                    <p>Please upload a Document of the 
                                                                        official document which is used as a National
                                                                        Document of your country</p>
                                                                    <a href="#" class="acceptbale_document">ACCEPTABLE
                                                                        DOCUMENTS PER COUNTRY LIST</a>
                                                                </div>
                                                                @if ($qualification_certificate)
                                                                     Preview:<br>
                                                                    <img src="{{ asset('storage/frontend/images/file.png') }}" alt="" style="width:200px; height:150px;">
                                                                @endif
                                                                <div class="input_btnwrp">
                                                                    <input type="file" id="qualification-certificate"
                                                                        name="qualification_certificate" wire:model.defer="qualification_certificate"
                                                                        required />
                                                                    <label for="qualification-certificate"
                                                                        class="common-btn">Upload</label>
                                                                    <div id="file-upload-qualification-certificate"></div>
                                                                </div>
                                                                <div x-show="isQualificationCertificateUploading" class="mt-3">
                                                                    <progress max="100" class="text-center"
                                                                        x-bind:value="progress"></progress>
                                                                </div>
                                                                @error('qualification_certificate')
                                                                <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="upload_separatebx">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-5 col-sm-6"
                                                                x-data="{ isExperienceCertificateUploading: false, progress: 0 }"
                                                                x-on:livewire-upload-start="isExperienceCertificateUploading = true"
                                                                x-on:livewire-upload-finish="isExperienceCertificateUploading = false"
                                                                x-on:livewire-upload-error="isExperienceCertificateUploading = false"
                                                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                                <div class="separatebxnw">
                                                                    <h1 class="heading_nw">Experience Certificate Upload
                                                                    </h1>
                                                                    <p>Please upload a Document of the 
                                                                        official document which is used as a National
                                                                        Document of your country</p>
                                                                    <a href="#" class="acceptbale_document"
                                                                        data-toggle="modal"
                                                                        data-target="#verifiactionphoto">VERIFICATION
                                                                        PHOTO
                                                                        EXAMPLES</a>
                                                                </div>
                                                                @if ($experience_certificate)
                                                                    Preview:<br>
                                                                    <img src="{{ asset('storage/frontend/images/file.png') }}" alt="" style="width:200px; height:150px;">
                                                                @endif
                                                                <div class="input_btnwrp">
                                                                    <input type="file" id="experience-certificate"
                                                                        wire:model.defer="experience_certificate"
                                                                        wire:target="savefinalfrm" required />
                                                                    <label for="experience-certificate"
                                                                        class="common-btn">Upload</label>
                                                                    <div id="experience_certificate-filename"></div>
                                                                </div>
                                                                <div x-show="isExperienceCertificateUploading" class="mt-3">
                                                                    <progress max="100" class="text-center"
                                                                        x-bind:value="progress"></progress>
                                                                </div>
                                                                @error('experience_certificate')
                                                                <span class="help-block">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="bottom_infobx">
                                                        <h1 class="small_heading">Please ensure your 
                                                            documents
                                                            is clearly visible to avoid the document being rejected.
                                                        </h1>
                                                        <p>The scanned document in order to be accepted must
                                                        </p>
                                                        <ul class="small_point">
                                                            <li><span class="ml-2">be clearly Visible</span></li>
                                                            <li><span class="ml-2">have adequate light</span></li>
                                                            <li><span class="ml-2">clearly show the identification number and issue date
                                                            </span></li>
                                                            <li><span class="ml-2">not have any damage that prevents the number and text
                                                                from
                                                                being seen</span></li>
                                                            <li><span class="ml-2">not have any missing pieces or being torn</span></li>
                                                            <li><span class="ml-2">not be a photocopy</span></li>
                                                        </ul>
                                                    </div>
                                                    <div class="btn_wrp">
                                                        <button type="button" wire:click.prevent="showfirstfrm"
                                                            wire:target="showfirstfrm" wire:loading.class="d-none"
                                                            class="common-btn bdr mx-1">Back</button>
                                                        <button class="common-btn mx-1 green custloading" type="button"
                                                            wire:loading wire:target="showfirstfrm" disabled>
                                                            <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
                                                        </button>

                                                        <button button="submit" class="common-btn mx-1 green"
                                                            wire:loading.class="d-none">Submit</button>
                                                        <button class="common-btn mx-1 green custloading" type="button"
                                                            wire:loading disabled>
                                                            <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            @endif
                                        {{-- </li> --}}
                                        @endif


                                        <li class="{{$verification_model->profile==='1'?'complted':''}}">
                                            <a href="{{route('user.settings')}}" class="ml-4">Profile
                                                completed</a>
                                        </li>
                                        
                                        {{-- <li class="{{$verification_model->phone_number==='1'?'complted':''}}">
                                            <a href="{{route('user.settings')}}">Phone number
                                                verified</a>
                                        </li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="dash_headingbx mt-3">
                <h2 class="dash_heading pl-0">Account Verification</h2>
            </div> --}}
            {{-- <div class="white_contentbx mt-3">
                <div class="tab-content">
                    <div class="tab-pane active" id="home-h" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="vrification-list veryfication_nwbx about-client">
                                    <ul>
                                        <li class="">
                                            <a href="{{route('user.qualified-test')}}" class="ml-4">Take a qualified test</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                     --}}
        </div>

    </div>

    {{-- <livewire:user.business-verification /> --}}
    {{-- <livewire:user.certificate-verification /> --}}
    {{-- <livewire:user.business-audit-verification /> --}}



    <div class="modal cust_modal verification_modal fade" id="verifiactionphoto" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verification Photo Examples</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="icofont-close-line-circled"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="photo_toparea">
                        <div class="row">
                            <div class="col-lg-5 col-sm-6 col-6">
                                <div class="left_img">
                                    <img src="{{asset('storage/frontend/images/pexels-ficky-2364514.jpg')}}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                            <div class="col-lg-7 col-sm-6">
                                <div class="text_right">
                                    <h1 class="small_heading text-left">ACCEPTABLE PHOTO EXAMPLE</h1>
                                    <ul>
                                        <li>The face is fully shown</li>
                                        <li>The face in the document is clearly visible</li>
                                        <li>The lighting is adequate and correct</li>
                                        <li>The ID document is matching the uploaded document</li>
                                        <li>The text in the ID is visible</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="photo_bottomarea">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6 col-6">
                                <div class="thum_img">
                                    <img src="{{asset('storage/frontend/images/pexels-ficky-2364514.jpg')}}" alt=""
                                        class="img-fluid">
                                    <h1><span class="iconarea"><i class="fa fa-times-circle"
                                                aria-hidden="true"></i></span>Face not fully visible</h1>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-6">
                                <div class="thum_img">
                                    <img src="{{asset('storage/frontend/images/pexels-ficky-2364514.jpg')}}" alt=""
                                        class="img-fluid">
                                    <h1><span class="iconarea"><i class="fa fa-times-circle"
                                                aria-hidden="true"></i></span>Photo too dark</h1>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-6">
                                <div class="thum_img">
                                    <img src="{{asset('storage/frontend/images/pexels-ficky-2364514.jpg')}}" alt=""
                                        class="img-fluid">
                                    <h1><span class="iconarea"><i class="fa fa-times-circle"
                                                aria-hidden="true"></i></span>Photo too bright</h1>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-6">
                                <div class="thum_img">
                                    <img src="{{asset('storage/frontend/images/pexels-ficky-2364514.jpg')}}" alt=""
                                        class="img-fluid">
                                    <h1><span class="iconarea"><i class="fa fa-times-circle"
                                                aria-hidden="true"></i></span>The ID photo is covered</h1>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-6">
                                <div class="thum_img">
                                    <img src="{{asset('storage/frontend/images/pexels-ficky-2364514.jpg')}}" alt=""
                                        class="img-fluid">
                                    <h1><span class="iconarea"><i class="fa fa-times-circle"
                                                aria-hidden="true"></i></span>The face is covered</h1>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-6">
                                <div class="thum_img">
                                    <img src="{{asset('storage/frontend/images/pexels-ficky-2364514.jpg')}}" alt=""
                                        class="img-fluid">
                                    <h1><span class="iconarea"><i class="fa fa-times-circle"
                                                aria-hidden="true"></i></span>The photo is blurry</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>
var input = document.getElementById('file-upload');
var infoArea = document.getElementById('file-upload-filename');

input.addEventListener('change', showFileName);

function showFileName(event) {

    // the change event gives us the input it occurred in 
    var input = event.srcElement;

    // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
    var fileName = input.files[0].name;

    // use fileName however fits your app best, i.e. add it into a div
    infoArea.textContent = 'File name: ' + fileName;
}
</script> -->
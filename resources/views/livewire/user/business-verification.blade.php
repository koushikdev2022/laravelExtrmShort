<div class="dash-bottom-part pt-0">
    <div class="bottom-part-2">
        <div class="dash_headingbx">
            <h2 class="dash_heading d-block pl-0">Business Verification (For Service Providers)
                <a href="#" wire:ignore.self class="question_bx" data-toggle="tooltip" data-placement="top"
                    title="The business identification assists in the confidence of clients and service providers to work with each other. The information is not compulsory and does not restrict you from using the website and all of its functions, but for beginners with no work history, it will decrease the confidence in doing business. The uploaded information will be kept confidential and will not be shared with any clients or service providers. "><i
                        class="icofont-question-circle"></i>
                </a>
            </h2>
        </div>
        <div class="white_contentbx">
            <div class="tab-content">
                <div class="tab-pane active" id="home-h" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="vrification-list veryfication_nwbx about-client">
                                <ul>
                                    <li
                                        class="{{$verification_model->business_registration==='1'?'complted':(isset($document_upload_reg->status) && $document_upload_reg->status==='0'?'arrowup':'')}}">
                                        <a href="#" wire:click.prevent="triggershow(6)"
                                            wire:target="triggershow(6)">Business Registration and
                                            Ownership
                                            {{isset($document_upload_reg->status) && $document_upload_reg->status==='0'?'(Under Review)':''}}
                                        </a>
                                        &nbsp; &nbsp;
                                        <span class=custloading" type="button" wire:loading wire:target="triggershow(6)"
                                            disabled>
                                            <i class="fa fa-circle-o-notch fa-spin"></i> Loading...
                                        </span>
                                    </li>
                                    @if($showBusisnessReg)
                                    <div class="row">

                                        <div class="col-lg-8">
                                            @if(empty($document_upload_reg))
                                            <form wire:submit.prevent="save('6')" action="" method="post"
                                                enctype="multipart/form-data">
                                                <div class="cmnverfiction_bx mb-3 id_uploadbx"
                                                    x-data="{ isBusinessRegUploading: false, isBusinessRegUploadingprogress: 0 }"
                                                    x-on:livewire-upload-start="isBusinessRegUploading = true"
                                                    x-on:livewire-upload-finish="isBusinessRegUploading = false"
                                                    x-on:livewire-upload-error="isBusinessRegUploading = false"
                                                    x-on:livewire-upload-progress="isBusinessRegUploadingprogress = $event.detail.progress">
                                                    <h1 class="heading">Business Registration</h1>
                                                    <p class="heading_para">Please upload your business registration
                                                        document or document that might prove the ownership of
                                                        the business or your direct Involvement with the business. The
                                                        document is for the verification
                                                        process only, no information will be shared publicly and the
                                                        document will be discarded after a three months period</p>
                                                    <div class="input_btnwrp">
                                                        <div id="isBusinessRegUploadingfile-upload-filename"></div>
                                                        <input type="file" id="isBusinessRegUploadingfile-upload"
                                                            wire:model.defer="photo" required />
                                                        <label for="isBusinessRegUploadingfile-upload"
                                                            class="common-btn w-100">Upload</label>
                                                        <p class="file_accepttext">Acceptable file formats (PDF, DOC)
                                                            Max File size:10Mb</p>
                                                        <div x-show="isBusinessRegUploading" class="mt-3">
                                                            <progress max="100" class="text-center"
                                                                x-bind:value="isBusinessRegUploadingprogress"></progress>
                                                        </div>
                                                        @error('photo')
                                                        <span class="help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="btn_wrp">
                                                        <button type="button" wire:click.prevent="triggershow(6)"
                                                            wire:target="triggershow(6)" wire:loading.class="d-none"
                                                            class="common-btn bdr mx-1">Cancel</button>
                                                        <button class="common-btn mx-1 green custloading" type="button"
                                                            wire:loading wire:target="triggershow(6)" disabled>
                                                            <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
                                                        </button>


                                                        <button button="submit" class="common-btn mx-1 green"
                                                            wire:loading.class="d-none">Confirm</button>
                                                        <button class="common-btn mx-1 green custloading" type="button"
                                                            wire:loading wire:target="save('6')" disabled>
                                                            <i class="fa fa-circle-o-notch fa-spin"></i>
                                                            Processing...
                                                        </button>

                                                    </div>
                                                </div>
                                            </form>
                                            @else
                                            <div class="cmnverfiction_bx uploded_doc id_uploadbx mb-3">
                                                <label>Document download</label>
                                                <ul class="filename_bx">
                                                    <li
                                                        class="{{$verification_model->business_registration==='1'?'complted':(isset($document_upload_reg->status) && $document_upload_reg->status==='0'?'arrowup':'')}}">
                                                        <a href="{{ asset('storage/uploads/frontend/documents/'.$document_upload_reg->file_name) }}"
                                                            download="{{$document_upload_reg->file_name}}">{{$document_upload_reg->file_name}}</a>
                                                    </li>
                                                </ul>
                                                <div class="status_bx">
                                                    <span class="badge badge-success w-50"><i
                                                            class="icofont-check-circled"></i>
                                                        @if ($document_upload_reg->status==='1')
                                                        Document verified
                                                        @else
                                                        Under Verification
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                    </div>
                                    @endif
                                    <li
                                        class="{{$verification_model->premises_photo==='1'?'complted':(isset($document_upload_premises->status) && $document_upload_premises->status==='0'?'arrowup':'')}}">
                                        <a href="#" wire:click.prevent="triggershow(7)"
                                            wire:target="triggershow(7)">Premises Photos
                                            {{isset($document_upload_premises->status) && $document_upload_premises->status==='0'?'(Under Review)':''}}
                                        </a>
                                        &nbsp; &nbsp;
                                        <span class=custloading" type="button" wire:loading wire:target="triggershow(7)"
                                            disabled>
                                            <i class="fa fa-circle-o-notch fa-spin"></i> Loading...
                                        </span>
                                    </li>
                                    @if($showPremisesPhoto)
                                    <div class="row">

                                        <div class="col-lg-8">
                                            @if(empty($document_upload_premises))
                                            <form wire:submit.prevent="save('7')" action="" method="post"
                                                enctype="multipart/form-data">
                                                <div class="cmnverfiction_bx mb-3 id_uploadbx"
                                                    x-data="{ isPremisesPhotoUploading: false, PremisesPhotoprogress: 0 }"
                                                    x-on:livewire-upload-start="isPremisesPhotoUploading = true"
                                                    x-on:livewire-upload-finish="isPremisesPhotoUploading = false"
                                                    x-on:livewire-upload-error="isPremisesPhotoUploading = false"
                                                    x-on:livewire-upload-progress="PremisesPhotoprogress = $event.detail.progress">
                                                    <h1 class="heading">Premises Photos</h1>
                                                    <p class="heading_para">Please upload photos of your business
                                                        showing
                                                        your workspace or any other space of your
                                                        facilities that you think might increase the confidence of the
                                                        client that their project is taking place in a well-organized
                                                        space.
                                                    </p>
                                                    <div class="input_btnwrp">
                                                        <div id="PremisesPhotofile-upload-filename"></div>
                                                        <input type="file" id="PremisesPhotofile-upload"
                                                            wire:model.defer="photo" required />
                                                        <label for="PremisesPhotofile-upload"
                                                            class="common-btn w-100">Upload</label>
                                                        <p class="file_accepttext">Acceptable file formats (JPG, JPEG,
                                                            BMP)
                                                            Max Filesize:3Mb</p>
                                                        <div x-show="isPremisesPhotoUploading" class="mt-3">
                                                            <progress max="100" class="text-center"
                                                                x-bind:value="PremisesPhotoprogress"></progress>
                                                        </div>
                                                        @error('photo')
                                                        <span class="help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="btn_wrp">
                                                        <button type="button" wire:click.prevent="triggershow(7)"
                                                            wire:target="triggershow(7)" wire:loading.class="d-none"
                                                            class="common-btn bdr mx-1">Cancel</button>
                                                        <button class="common-btn mx-1 green custloading" type="button"
                                                            wire:loading wire:target="triggershow(7)" disabled>
                                                            <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
                                                        </button>


                                                        <button button="submit" class="common-btn mx-1 green"
                                                            wire:loading.class="d-none">Confirm</button>
                                                        <button class="common-btn mx-1 green custloading" type="button"
                                                            wire:loading wire:target="save('7')" disabled>
                                                            <i class="fa fa-circle-o-notch fa-spin"></i>
                                                            Processing...
                                                        </button>

                                                    </div>
                                                </div>
                                            </form>
                                            @else
                                            <div class="cmnverfiction_bx uploded_doc id_uploadbx mb-3">
                                                <label>Document download</label>
                                                <ul class="filename_bx">
                                                    <li
                                                        class="{{$verification_model->premises_photo==='1'?'complted':(isset($document_upload_premises->status) && $document_upload_premises->status==='0'?'arrowup':'')}}">
                                                        <a href="{{ asset('storage/uploads/frontend/documents/'.$document_upload_premises->file_name) }}"
                                                            download="{{$document_upload_premises->file_name}}">{{$document_upload_premises->file_name}}</a>
                                                    </li>
                                                </ul>
                                                <div class="status_bx">
                                                    <span class="badge badge-success w-50"><i
                                                            class="icofont-check-circled"></i>
                                                        @if ($document_upload_premises->status==='1')
                                                        Document verified
                                                        @else
                                                        Under Verification
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                    </div>
                                    @endif
                                    <li
                                        class="{{$verification_model->internet_speed==='1'?'complted':(isset($document_upload_internet->status) && $document_upload_internet->status==='0'?'arrowup':'')}}">
                                        <a href="#" wire:click.prevent="triggershow(8)"
                                            wire:target="triggershow(8)">Interner Speed and IP Address
                                            {{isset($document_upload_internet->status) && $document_upload_internet->status==='0'?'(Under Review)':''}}
                                        </a>
                                        <a href="#" wire:ignore.self class="question_bx" data-toggle="tooltip"
                                            data-placement="top"
                                            title="The internet speed verification helps the clients picking BPO companies who will meet their demands where constant, reliable and high internet speed is required, eg high volume live calls."><i
                                                class="icofont-question-circle"></i>
                                        </a>
                                        &nbsp; &nbsp;
                                        <span class=custloading" type="button" wire:loading wire:target="triggershow(8)"
                                            disabled>
                                            <i class="fa fa-circle-o-notch fa-spin"></i> Loading...
                                        </span>
                                    </li>
                                    @if($showInternet)
                                    <div class="row">

                                        <div class="col-lg-8">
                                            @if(empty($document_upload_internet))
                                            <form wire:submit.prevent="save('8')" action="" method="post"
                                                enctype="multipart/form-data">
                                                <div class="cmnverfiction_bx mb-3 id_uploadbx"
                                                    x-data="{ isshowInternetUploading: false, showInternetprogress: 0 }"
                                                    x-on:livewire-upload-start="isshowInternetUploading = true"
                                                    x-on:livewire-upload-finish="isshowInternetUploading = false"
                                                    x-on:livewire-upload-error="isshowInternetUploading = false"
                                                    x-on:livewire-upload-progress="showInternetprogress = $event.detail.progress">
                                                    <h1 class="heading">Internet Speed and IP Address</h1>
                                                    <p class="heading_para">Please upload a screenshot of a speed test
                                                        showing your download and upload speeds together with your IP
                                                        address.</p>
                                                    <div class="input_btnwrp">
                                                        <div id="showInternetfile-upload-filename"></div>
                                                        <input type="file" id="showInternetfile-upload"
                                                            wire:model.defer="photo" required />
                                                        <label for="showInternetfile-upload"
                                                            class="common-btn w-100">Upload</label>
                                                        <p class="file_accepttext">Acceptable file formats (PDF, JPG,
                                                            JPEG,
                                                            BMP) Max file size:3Mb</p>
                                                        <div x-show="isshowInternetUploading" class="mt-3">
                                                            <progress max="100" class="text-center"
                                                                x-bind:value="showInternetprogress"></progress>
                                                        </div>
                                                        @error('photo')
                                                        <span class="help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="btn_wrp">
                                                        <button type="button" wire:click.prevent="triggershow(8)"
                                                            wire:target="triggershow(8)" wire:loading.class="d-none"
                                                            class="common-btn bdr mx-1">Cancel</button>
                                                        <button class="common-btn mx-1 green custloading" type="button"
                                                            wire:loading wire:target="triggershow(8)" disabled>
                                                            <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
                                                        </button>


                                                        <button button="submit" class="common-btn mx-1 green"
                                                            wire:loading.class="d-none">Confirm</button>
                                                        <button class="common-btn mx-1 green custloading" type="button"
                                                            wire:loading wire:target="save('8')" disabled>
                                                            <i class="fa fa-circle-o-notch fa-spin"></i>
                                                            Processing...
                                                        </button>

                                                    </div>
                                                </div>
                                            </form>
                                            @else
                                            <div class="cmnverfiction_bx uploded_doc id_uploadbx mb-3">
                                                <label>Document download</label>
                                                <ul class="filename_bx">
                                                    <li
                                                        class="{{$verification_model->internet_speed==='1'?'complted':(isset($document_upload_internet->status) && $document_upload_internet->status==='0'?'arrowup':'')}}">
                                                        <a href="{{ asset('storage/uploads/frontend/documents/'.$document_upload_internet->file_name) }}"
                                                            download="{{$document_upload_internet->file_name}}">{{$document_upload_internet->file_name}}</a>
                                                    </li>
                                                </ul>

                                                <div class="status_bx">
                                                    <span class="badge badge-success w-50"><i
                                                            class="icofont-check-circled"></i>
                                                        @if ($document_upload_internet->status==='1')
                                                        Document verified
                                                        @else
                                                        Under Verification
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                    </div>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
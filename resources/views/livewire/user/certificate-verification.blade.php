<div class="dash-bottom-part pt-0">
    <div class="bottom-part-2">
        <div class="dash_headingbx">
            <h2 class="dash_heading d-block pl-0">Certificates Verification (For Service Providers)
                <a href="#" wire:ignore.self class="question_bx" data-toggle="tooltip" data-placement="top"
                    title="You can upload any certificates that you think are relevant in increasing your reliability and reputation. For BPO companies that can be security or management certificates, etc. And for Freelancers, it can be certificates related to their skills, knowledge or experience. All the certificates will be reviewed by our team for verification. If we are unable to verify the document, it will only be shown as provided but not verified."><i
                        class="icofont-question-circle"></i></a>
            </h2>
        </div>
        <div class="white_contentbx">
            <div class="tab-content">
                <div class="tab-pane active" id="home-h" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="vrification-list veryfication_nwbx about-client">
                                <ul>
                                    @forelse ($certificates as $certificate)
                                    <li
                                        class="{{$certificate->status==='1'?'complted':(isset($certificate->status) && $certificate->status==='0'?'arrowup':'')}}">
                                        <a href="#" title="{{ $certificate->document_title }}">
                                            {{ Str::limit($certificate->document_title,50) }}
                                            {{$certificate->status==='0'?'(Under Review)':''}}
                                        </a>
                                    </li>
                                    @empty

                                    @endforelse
                                    <li class="">
                                        <a href="#" wire:click.prevent="triggershow" wire:target="triggershow">Upload
                                            {{sizeof($certificates)>0?'Next':''}} Certificate
                                        </a>
                                        &nbsp; &nbsp;
                                        <span class=custloading" type="button" wire:loading wire:target="triggershow"
                                            disabled>
                                            <i class="fa fa-circle-o-notch fa-spin"></i> Loading...
                                        </span>
                                    </li>
                                    @if($showInternet)
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <form wire:submit.prevent="save" action="" method="post"
                                                enctype="multipart/form-data">
                                                <div class="cmnverfiction_bx mb-3 id_uploadbx"
                                                    x-data="{ isCertificateUploading: false, isCertificateprogress: 0 }"
                                                    x-on:livewire-upload-start="isCertificateUploading = true"
                                                    x-on:livewire-upload-finish="isCertificateUploading = false"
                                                    x-on:livewire-upload-error="isCertificateUploading = false"
                                                    x-on:livewire-upload-progress="isCertificateprogress = $event.detail.progress">
                                                    <h1 class="heading">Certificates Upload</h1>
                                                    <div class="form-group">
                                                        <label>Certificate Title</label>
                                                        <input class="form-control"
                                                            placeholder="Please enter the official title of the certificate as it will appear in your public profile"
                                                            type="text" wire:model.defer="document_title"
                                                            maxlength="250" required>
                                                        @error('document_title')
                                                        <p class="text-sm mt-2 text-red-500">
                                                            {{ $message }}
                                                        </p>
                                                        @enderror
                                                    </div>
                                                    <div class="input_btnwrp">
                                                        <div id="isCertificateUploadingfile-upload-filename"></div>
                                                        <input type="file" id="isCertificateUploadingfile-upload"
                                                            wire:model.defer="photo" required />
                                                        <label for="isCertificateUploadingfile-upload"
                                                            class="common-btn w-100">Upload</label>
                                                        <p class="file_accepttext">Acceptable file formats (PDF, JPG,
                                                            JPEG, BMP) Max file size:3Mb</p>
                                                        <div x-show="isCertificateUploading" class="mt-3">
                                                            <progress max="100" class="text-center"
                                                                x-bind:value="isCertificateprogress"></progress>
                                                        </div>
                                                        @error('photo')
                                                        <span class="help-block">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="btn_wrp">
                                                        <button type="button" wire:click.prevent="triggershow"
                                                            wire:target="triggershow" wire:loading.class="d-none"
                                                            class="common-btn bdr mx-1">Back</button>
                                                        <button class="common-btn bdr mx-1 green custloading"
                                                            type="button" wire:loading wire:target="triggershow"
                                                            disabled>
                                                            <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
                                                        </button>

                                                        <button button="submit" class="common-btn green"
                                                            wire:loading.class="d-none">Save</button>
                                                        <button class="common-btn green custloading" type="button"
                                                            wire:loading wire:target="save" disabled>
                                                            <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
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
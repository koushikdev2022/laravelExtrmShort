<form action="" method="POST" wire:submit.prevent="store">
    <div class="card">
        <div class="card-header">
            <strong>Portfolio Details</strong>
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                @foreach($portfolios as $key => $portfolio)
                <div class="media row" wire:key="portfolio_{{$key}}">
                    <div class="col-sm-4">
                        <div class="form-group" x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' id="imageUpload{{$key}}"
                                        wire:model.defer="images.{{ $key }}.image" accept=".png, .jpg, .jpeg" />
                                    <label for="imageUpload{{$key}}"></label>
                                </div>
                                <div class="avatar-preview">
                                    @if ($images[$key]['image'])
                                    <div id="imagePreview{{$key}}"
                                        style="background-image: url('{{ $images[$key]['image']->temporaryUrl() }}');">
                                    </div>
                                    @else
                                    @php
                                    $imgfile=!empty($portfolios[$key]['image_show'])?$portfolios[$key]['image_show']:'/storage/frontend/images/img_placeholder.jpg';
                                    @endphp
                                    <div id="imagePreview{{$key}}" style="background-image: url('{{$imgfile}}');">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @error('images.'.$key.'image')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                            <div x-show="isUploading" class="mt-3">
                                <progress max="100" class="text-center" x-bind:value="progress"></progress>
                            </div>
                        </div>
                    </div>
                    <div class="media-body col-sm-8">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="title"
                                        wire:model.defer="portfolios.{{ $key }}.title">
                                    @error('portfolios.'.$key.'.title')
                                    <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @if($key===0)
                            <div class="col-md-2">
                                <button class="common-btn green" wire:loading.class="d-none" wire:click.prevent="add"
                                    wire:target="add">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <button class="common-btn green custloading" type="button" wire:loading
                                    wire:target="add" disabled>
                                    <i class="fa fa-circle-o-notch fa-spin"></i>
                                </button>
                            </div>
                            @else
                            <div class="col-md-2">
                                <button class="common-btn btn btn-danger" wire:loading.class="d-none"
                                    wire:click.prevent="remove({{$key}})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="common-btn btn btn-danger custloading" type="button" wire:loading
                                    wire:target="remove({{$key}})" disabled>
                                    <i class="fa fa-circle-o-notch fa-spin"></i>
                                </button>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea type="text" rows="10" class="form-control" placeholder="Description"
                                        wire:model.defer="portfolios.{{ $key }}.description">
                                    </textarea>
                                    @error('portfolios.'.$key.'.description')
                                    <span class="text-danger error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="text-center save mb-3 dash_btnwrp mt-2">
        <button type="submit" class="common-btn green" wire:loading.class="d-none">Save</button>
        <button class="common-btn green custloading" type="button" wire:loading wire:target="store" disabled>
            <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
        </button>
    </div>
</form>

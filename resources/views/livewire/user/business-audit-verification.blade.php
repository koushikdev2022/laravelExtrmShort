<div class="dash-bottom-part pt-0">
    <div class="bottom-part-2">
        <div class="dash_headingbx">
            <h2 class="dash_heading d-block pl-0">Organize Business Audit (For Service Providers)
                <a href="#" wire:ignore.self class="question_bx" data-toggle="tooltip" data-placement="top"
                    title="Business Audit is the ultimate phase of verifying your business. You can book a virtual or a physical inspection based on the availability of your location. One of our agents will contact you to organize an inspection either online or by visiting your premises. By completing a business audit you confirm to your potential clients that your business is legit and has all the facilities as described in your profile description.  Your business will be promoted more by our website and you are more likely to close deals with high-value customers."><i
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
                                    @if (!empty($audit_upload) && $audit_upload->status!=='1')
                                    <li class="arrowup">
                                        <a href="#" wire:click.prevent="formOpen" wire:target="formOpen">
                                            {{$audit_upload->status==='0'?'Audit Scheduled for '.date('d/m/Y',strtotime($audit_upload->schedule_date)).' (Click here to re-schedule)':'Book Business Audit'}}
                                        </a>
                                        &nbsp; &nbsp;
                                        <span class=custloading" type="button" wire:loading wire:target="formOpen"
                                            disabled>
                                            <i class="fa fa-circle-o-notch fa-spin"></i> Loading...
                                        </span>
                                    </li>
                                    @elseif (!empty($audit_upload) && $audit_upload->status==='1')
                                    <li class="complted">
                                        <a href="#" wire:click.prevent="triggershow" wire:target="triggershow">Book
                                            Ausit Completed on
                                            {{ date('d/m/Y',strtotime($audit_upload->schedule_date)) }}
                                        </a>
                                        &nbsp; &nbsp;
                                        <span class=custloading" type="button" wire:loading wire:target="triggershow"
                                            disabled>
                                            <i class="fa fa-circle-o-notch fa-spin"></i> Loading...
                                        </span>
                                    </li>
                                    @else
                                    <li class="notsubmited">
                                        <a href="#" wire:click.prevent="formOpen" wire:target="formOpen">Book
                                            Business Audit
                                        </a>
                                        &nbsp; &nbsp;
                                        <span class=custloading" type="button" wire:loading wire:target="formOpen"
                                            disabled>
                                            <i class="fa fa-circle-o-notch fa-spin"></i> Loading...
                                        </span>
                                    </li>
                                    @endif

                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-12 border_right">
                            @if($showInternet)
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="cmnverfiction_bx mt-3 id_uploadbx">
                                        <div class="common-dash-form">
                                            <form wire:submit.prevent="save" action="" method="post"
                                                enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        @if($form_open)
                                                        <div class="form-group">
                                                            <label>Contact Name</label>
                                                            <input class="form-control" name="contact_name"
                                                                wire:model.defer="contact_name"
                                                                placeholder="Please enter your name" type="text"
                                                                maxlength="250" required>
                                                            @error('contact_name')
                                                            <p class="text-sm mt-2 text-red-500">
                                                                {{ $message }}
                                                            </p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Contact Email Address</label>
                                                            <input class="form-control" name="contact_email"
                                                                wire:model.defer="contact_email"
                                                                placeholder="Enter your contact email address"
                                                                type="text" maxlength="250" required>
                                                            @error('contact_email')
                                                            <p class="text-sm mt-2 text-red-500">
                                                                {{ $message }}
                                                            </p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Phone Number</label>
                                                            <input class="form-control" name="contact_phone"
                                                                wire:model.defer="contact_phone"
                                                                placeholder="Enter your phone number" type="text"
                                                                required>
                                                            @error('contact_phone')
                                                            <p class="text-sm mt-2 text-red-500">
                                                                {{ $message }}
                                                            </p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <input class="form-control" name="address"
                                                                wire:model.defer="address" maxlength="300"
                                                                placeholder="Address" type="text" required>
                                                            @error('address')
                                                            <p class="text-sm mt-2 text-red-500">
                                                                {{ $message }}
                                                            </p>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Country</label>
                                                            <select class="form-control" name="country"
                                                                wire:model.defer="country" required>
                                                                <option value="">Select Country</option>
                                                                @forelse ($countries as $country)
                                                                <option value="{{$country->id}}">
                                                                    {{$country->name}}
                                                                </option>
                                                                @empty

                                                                @endforelse
                                                            </select>
                                                            @error('country')
                                                            <p class="text-sm mt-2 text-red-500">
                                                                {{ $message }}
                                                            </p>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Schedule Date</label>
                                                            <input class="form-control" wire:model.defer="schedule_date"
                                                                min="{{date('Y-m-d')}}" type="date" required>
                                                            @error('schedule_date')
                                                            <p class="text-sm mt-2 text-red-500">
                                                                {{ $message }}
                                                            </p>
                                                            @enderror
                                                        </div>
                                                        @elseif(!empty($audit_upload))
                                                        <div class="form-group">
                                                            <div class="over-view-cont attachment">
                                                                <label>Contact Name</label>
                                                                <p>{{$audit_upload->contact_name}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="over-view-cont attachment">
                                                                <label>Contact Email Address</label>
                                                                <p>{{$audit_upload->contact_email}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="over-view-cont attachment">
                                                                <label>Phone Number</label>
                                                                <p>{{$audit_upload->contact_phone}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="over-view-cont attachment">
                                                                <label>Address</label>
                                                                <p>{{$audit_upload->address}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="over-view-cont attachment">
                                                                <label>Country</label>
                                                                <p>{{optional($audit_upload->countryDetail)->name}}</p>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="over-view-cont attachment">
                                                                <label>Schedule Date</label>
                                                                <p>{{ !empty($audit_upload->schedule_date)?date('d/m/Y',strtotime($audit_upload->schedule_date)):'N/A' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if($form_open)
                                                <div class="text-center save mb-3 dash_btnwrp">
                                                    <button button="submit" class="common-btn green"
                                                        wire:loading.class="d-none">Save</button>
                                                    <button class="common-btn green custloading" type="button"
                                                        wire:loading wire:target="save" disabled>
                                                        <i class="fa fa-circle-o-notch fa-spin"></i> Processing...
                                                    </button>
                                                </div>
                                                @elseif(!empty($audit_upload))
                                                <div class="text-center save mb-3 dash_btnwrp">
                                                    <div class="status_bx">
                                                        <span class="badge badge-success w-50"><i
                                                                class="icofont-check-circled"></i>
                                                            @if ($audit_upload->status==='1')
                                                            Audit Completed
                                                            @elseif($audit_upload->status==='3')
                                                            Audit Booked
                                                            @else
                                                            Not Audited
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@extends('layouts.main')
@include('partials.dashboard.header')
@section('content')
<div class="user-dash-right">
    @include('partials.dashboard.topright')
    <div class="clearfix">
        <div class="dash-bottom-part pb-0">
            <div class="justify-content-center">
                <div class="col-lg-8 col-sm-12">
                    <div class="tabarea_bx">
                        <div class="row">
<!--                            <div class="col-md-6 text-center nwmob forMobile mb-3">
                                <a href="#" class="common-btn adbtn"><i class="icofont-plus-circle"></i>Post A Opportunity</a>
                            </div>-->

                            <div class="col-lg-8">
                                <ul class="nav nav-pills" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="active-tab" data-toggle="tab" href="#details" role="tab" aria-controls="home" aria-selected="true">Personal Details </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="progresstab" data-toggle="tab" href="#password" role="tab" aria-controls="profile" aria-selected="false">Change Password</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="active-tab">

                            <div class="common-section-box-content">
                                <div class="common-dash-form">
                                    <div id="profile_msgs"></div>
                                    <form id="updateProfile" action="{{ Route('update-profile') }}" method="POST" data-type="json" enctype="multipart/form-data">
                                        <input name="_token" type="hidden" value="{{csrf_token()}}">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Update Profile Picture</label>
                                                    <div class="avatar-upload">
                                                        <div class="avatar-edit">
                                                            <input type='file' id="profile_picture" accept=".png, .jpg, .jpeg" name="profile_picture" onchange="showPreview('profile_picture_preview', event, 'profileImage');" />
                                                            <label for="profile_picture"></label>
                                                        </div>
                                                        <div class="preview">
                                                            <img id="profile_picture_preview" style="width: 100%;height: 192px;display:none;">
                                                        </div>
                                                        <div class="avatar-preview" id="profileImage">
                                                            @if($data['profile_picture'] !='' )
                                                            <div id="imageProfilePreview" style="background-image: url( {{ URL::asset('public/uploads/frontend/profile_picture/preview/'.$data['profile_picture']) }} );">
                                                            </div>
                                                            @else
                                                            <div id="imageProfilePreview" style="background-image: url( {{ URL::asset('public/frontend/images/profile_user.png') }} );">
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="help-block has-error text-danger"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <label>Update Cover Photo</label>
                                                    <div class="avatar-upload">
                                                        <div class="avatar-edit">
                                                            <input type='file' id="cover_image" accept=".png, .jpg, .jpeg" name="cover_image" onchange="showPreview('cover_image_preview', event, 'coverImage');" />
                                                            <label for="cover_image"></label>

                                                        </div>
                                                        <div class="preview">
                                                            <img id="cover_image_preview" style="width: 100%;height: 192px;display:none;">
                                                        </div>
                                                        <div class="avatar-preview" id="coverImage">
                                                            @if($data['cover_image'] !='' )
                                                            <div id="imageCoverPreview" style="background-image: url( {{ URL::asset('public/uploads/frontend/cover_image/preview/'.$data['cover_image']) }} );">
                                                            </div>
                                                            @else
                                                            <div id="imageCoverPreview" style="background-image: url( {{ URL::asset('public/frontend/images/coverphoto_placeholder.jpg') }} );">
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="help-block has-error text-danger"></div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" name="first_name" class="form-control" placeholder="" value="{{ $data['first_name'] }}">
                                                    <span class="help-block has-error text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" name="last_name" class="form-control" placeholder="" value="{{ $data['last_name'] }}">
                                                    <span class="help-block has-error text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" class="form-control" placeholder="" value="{{ $data['email'] }}">
                                                    <span class="help-block has-error text-danger"></span>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="usr">Date of Birth</label>
                                                    <input type="date" name="dob" class="form-control" placeholder="" value="{{ $data['dob'] }}" max="<?php echo date("Y-m-d"); ?>">
                                                    <span class="help-block has-error text-danger"></span>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="usr">Phone</label>
                                                    <input type="number" class="form-control" placeholder="" name="phone" value="{{ $data['phone'] }}">
                                                    <span class="help-block has-error text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>User Name</label>
                                                    <input type="text" class="form-control" placeholder="" name="username" value="{{ $data['username'] }}">
                                                    <span class="help-block has-error text-danger"></span>
                                                </div>
                                            </div>
                                            @php
                                                $lang_arr = [];
                                                if($data['language'] != ''){
                                                $lang_str = $data['language'];
                                                $lang_arr = explode (",", $lang_str);
                                                }
                                            @endphp
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="usr">Language Known</label>
                                                    @if(count($lang_arr) > 0)
                                                    <select multiple="multiple" name="language[]" class="js-example-placeholder-multiple form-control cast-slet">
                                                        @for($i = 0; $i < count($language) ; $i++)
                                                            <option value={{$language[$i]->id}} {{ in_array($language[$i]->id, $lang_arr) ? "selected" : "" }}>{{$language[$i]->Language}}</option>
                                                        @endfor
                                                    </select>
                                                    @else
                                                    <select multiple="multiple" name="language[]" class="js-example-placeholder-multiple form-control cast-slet">
                                                            @foreach($language as $lang)
                                                                <option value={{$lang['id']}}>{{$lang['Language']}}</option>
                                                            @endforeach
                                                    </select>
                                                    @endif
                                                    <span class="help-block has-error text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="usr">Gender</label>
                                                    <div class="row frmnwdsp mx-0">
                                                        <div class="custom-control custom-radio mr-3">
                                                            <input type="radio" class="custom-control-input" id="male" name="gender" value="M" {{ ($data->gender=="M")? "checked" : "" }}>
                                                            <label class="custom-control-label" for="male">Male</label>
                                                        </div>
                                                        <div class="custom-control custom-radio mr-3">
                                                            <input type="radio" class="custom-control-input" id="female" name="gender" value="F" {{ ($data->gender=="F")? "checked" : "" }}>
                                                            <label class="custom-control-label" for="female">Female</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" class="custom-control-input" id="other" name="gender" value="O" {{ ($data->gender=="O")? "checked" : "" }}>
                                                            <label class="custom-control-label" for="other">Others</label>
                                                        </div>
                                                    </div>
                                                    <span class="help-block has-error" id="gender-error"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="spllablecls dispnwarea">
                                                    <label for="usr">Topic</label>
                                                    <div class="input-group-append justify-content-end">
                                                        <button id="addTopic" type="button" class="common-btn"><i class="icofont-plus-circle"></i> Add Row</button>
                                                    </div>
                                                </div>
                                                @if($data['topic'])
                                                @php
                                                $topic = $data['topic'];
                                                $s_topic = explode (",", $topic);
                                                @endphp
                                                @foreach($s_topic as $topic)
                                                <div class="input-group dashinputgrpstl">
                                                    <input type="text" name="topic[]" id="topic" value="{{$topic}}" class="form-control" placeholder="Add Topic">
                                                </div>
                                                <br>
                                                @endforeach
                                                @else
                                                <div class="input-group dashinputgrpstl">
                                                    <input type="text" name="topic[]" id="topic" class="form-control" placeholder="Add Topic">
                                                </div>
                                                <br>
                                                @endif
                                                <div id="newRowTopic"></div>
                                                <span class="help-block has-error" id="skills-work-error"></span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" placeholder="" name="address_line1" value="{{ $data['address_line1'] }}">
                                                    <span class="help-block has-error text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="usr">City</label>
                                                    <input type="text" class="form-control" placeholder="" name="city" id="city" value="{{ $data['city'] }}">
                                                    <span class="help-block has-error text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" placeholder="" name="state" value="{{ $data['state'] }}">
                                                    <span class="help-block has-error text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Zip Code</label>
                                                    <input type="text" class="form-control" placeholder="" name="zipcode" value="{{ $data['zipcode'] }}">
                                                    <span class="help-block has-error text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="usr">Country</label>
                                                    <select name="country" class="form-control">
                                                        <option value="">Select Country</option>
                                                        @foreach($country as $c)
                                                        <option value={{$c['country_name']}} {{ ($data->country==$c['country_name'])? "selected" : "" }}>{{$c['country_name']}}</option>
                                                        @endforeach
                                                    </select>

                                                    <span class="help-block has-error text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="usr">Short description about yourself</label>
                                                    <textarea class="form-control" name="about_me">{{ $data['about_me'] }}</textarea>
                                                    <span class="help-block has-error text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="usr">Facebook Link</label>
                                                    <input type="text" class="form-control" placeholder="" name="facebook" value="{{ $data['facebook'] }}">
                                                    <span class="help-block has-error text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Instagram</label>
                                                    <input type="text" class="form-control" placeholder="" name="instagram" value="{{ $data['intragram'] }}">
                                                    <span class="help-block has-error text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="usr">Bio</label>
                                                    <textarea class="form-control" name="bio">{{ $data['bio'] }}</textarea>
                                                    <span class="help-block has-error text-danger"></span>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="usr">Website Link</label>
                                                    <input type="text" class="form-control" placeholder="" name="website" value="{{ $data['website'] }}">
                                                    <span class="help-block has-error text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content-footer-part text-center">
                                            <input type="button" value="Edit">
                                            <input type="submit" value="Save">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="active-tab">
                            <div class="common-section-box-content">
                                <div class="common-dash-form">
                                    <div id="password_msgs"></div>
                                    <form id="changePassword" action="{{ Route('update-password') }}" method="POST" data-type="json">
                                        @csrf
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input class="form-control" name="old_password" placeholder="Enter Old Password" type="password">
                                            <div class="help-block has-error text-danger"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input class="form-control" name="new_password" placeholder="Enter New Password" type="password">
                                            <div class="help-block has-error text-danger"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input class="form-control" name="confirm_new_password" placeholder="Enter Confirm Password" type="password">
                                            <div class="help-block has-error text-danger"></div>
                                        </div>

                                        <div class="content-footer-part text-center">
                                            <input type="submit" value="Save">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- col-lg-12 end -->
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Select2 Multiple
        $('.js-example-placeholder-multiple').select2({
            placeholder: "Select",
            width: '100%',
            allowClear: true
        });
    });

    // add row
    $("#addTopic").click(function() {
        var html = '';
        html += '<div class="d-flex" id="inputFormRowTopic">';
        html += '<div class="input-group dashinputgrpstl mb-3">';
        html += '<input type="text" name="topic[]" id="topic" class="form-control" placeholder="Add Topic">';
        html += '</div>';
        html += '<button class="input_close" id="removeRowTopic"><i class="icofont-close-circled"></i></button>';
        html += '</div>';

        $('#newRowTopic').append(html);
    });

    // remove row
    $(document).on('click', '#removeRowTopic', function() {
        $(this).closest('#inputFormRowTopic').remove();
    });
</script>
@stop
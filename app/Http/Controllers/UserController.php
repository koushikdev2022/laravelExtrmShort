<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\{UserMaster, Country, Language, Project, UserStory, UserLikes, BookmarkProject, ReportProject, UserFollower, Notification, Payments, Checkout,TaxDetail, EscrowWallet};
use File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Traits\HelperTrait;

class UserController extends Controller
{
    use HelperTrait;

    public function dashboard()
    {
        $data = [];
        $user = Auth()->guard('frontend')->user();
        $data =  Project::with('info')->where(['user_id' => $user->id])->where('status', '<>', '3')->orderBy('id','desc')->paginate(9);
        return view('user.dashboard', compact('data'));
    }
  
    public function taxdetails(){
        $data = [];
        $user = Auth()->guard('frontend')->user();
        $data= TaxDetail::where(['user_id'=>$user->id])->first();
        $country = Country::all();
        return view('user.taxdetails', compact('data','country'));
    }

    public function payments()
    {
        $data = [];
        $user = Auth()->guard('frontend')->user();
        $data =  Payments::where(['user_id' => $user->id])->where('status', '=', 'approved')->get()->sum('amount');
        $received_amount = EscrowWallet::where(['user_id'=>$user->id,'status'=>'0'])->sum('amount');
        $withdrawal_amount = EscrowWallet::where(['user_id'=>$user->id,'status'=>'1'])->sum('amount');
        $hold_amount = EscrowWallet::where(['user_id'=>$user->id,'status'=>'2'])->sum('amount');
        $amount = $received_amount - $withdrawal_amount - $hold_amount;
        return view('user.payments', compact('data','amount'));
    }

    public function changeNotificationStatus($id){
        $notifications = Notification::findOrFail($id);
        if($notifications !=''){
            $notifications->update(['is_view'=>'1']);
            return true;
        }
    }
    
    public function videoListing()
    {
        $user = Auth()->guard('frontend')->user();
       $data =  Project::with('info', 'likes')->where(['user_id' => $user->id, 'status' => '1'])->orderBy('id','desc')->paginate(9);
        return view('user.myVideos', compact('data'));
    }

    public function purchasedVideoListing()
    {
        $user = Auth()->guard('frontend')->user();
        $data = Checkout::with('projects')->where(['user_id' => $user->id, 'status' => '2'])->get();
        return view('user.myPurchasedVideos', compact('data'));
    }

    public function upgradeLicence($id){
        $user = Auth()->guard('frontend')->user();
         $now = date('Y-m-d');
         $data = Checkout::where(['user_id' => $user->id, 'status' => '2','project_id'=>$id])->orderBy('id','desc')->first();
         if($data !=''){
            $created = \Carbon\Carbon::parse($data->created_at)->format('Y-m-d');
            if(strtotime($created) < strtotime($now)){
                $resp['message'] = "Please Do upgrade";
                return response()->json($resp);
            }else{
                $resp['message'] = "Cannot Upgrade Before 24 Hours of buying product";
                return response()->json($resp,422);
            }
        }else{
            $resp['message'] = "Cannot Upgrade Before 24 Hours of buying product";
            return response()->json($resp,422);
        }
    }

    public function followers()
    {
        $user = Auth()->guard('frontend')->user();
        $data = UserFollower::where(['user_id' => $user->id, 'status' => '1'])->get();
        $name = "Followers";
        return view('user.followers', compact('data', 'name'));
    }

    public function bookmark_videos(){
        $user = Auth()->guard('frontend')->user();
        $data = BookmarkProject::with('project')->where(['user_id' => $user->id])->get();
        // $data =  Project::with('bookmark')->where(['user_id' => $user->id, 'status' => '1'])->orderBy('id','desc')->paginate(9);
        return view('user.bookmark', compact('data')); 
    }

    public function following()
    {
        $user = Auth()->guard('frontend')->user();
        $data = UserFollower::where(['following_user_id' => $user->id, 'status' => '1'])->get();
        $name = "Following";
        return view('user.followers', compact('data', 'name'));
    }

    public function earning()
    {
        $user = Auth()->guard('frontend')->user();
        $name = "Earning";
        $data = Payments::where(['user_id' => $user->id, 'status' => 'approved'])->get();
        return view('user.earning', compact('data', 'name'));
    }

    public function viewprofile($id)
    {
        $nid = base64_decode($id);
        $data = UserMaster::findOrFail($nid);
        return view('user.profile', compact('data'));
    }

    // public function uploadStory(Request $request)
    // {
    //     $rules = [
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'video' => 'nullable|file|mimes:mp4,mov,ogg|max:20000', // Adjust file max size as needed
    //     ];
    
    //     // Custom conditional validation
    //     $validator = Validator::make($request->all(), $rules);

    //     $validator->after(function ($validator) use ($request) {
    //         if (!$request->hasFile('image') && !$request->hasFile('video')) {
    //             $validator->errors()->add('media', 'Either an image or a video is required.');
    //         }
    //     });
    
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'errors' => $validator->errors(),
    //         ], 422); // Unprocessable Entity
    //     }
    
    
    //     $user = Auth()->guard('frontend')->user();
    //     if ($request->ajax()) {
    //         if ($request->has('image')) {
    //             $image = $request->file('image');
    //             $ext = $image->getClientOriginalExtension();
    //             $image_name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
    //             $destinationPath = public_path('uploads/frontend/story/image/'); //public path folder dir

    //             $path = public_path('uploads/frontend/story/');
    //             Image::make($image->getRealPath())->resize(400, 285)->save($path . 'img_preview/' . $image_name);
    //             $image->move($destinationPath, $image_name);
    //         }else{
    //             $image_name='';
    //         }

    //         if ($request->has('video')) {
    //             $video = $request->file('video');
    //             $folder = "video";
    //             $saved_video = $this->fileUpload($request, 'video', $folder);
    //             $ext = $video->getClientOriginalExtension();
    //         }else{
    //             $saved_video='';
    //         }

    //         UserStory::create([
    //             'image' => $image_name,
    //             'video' => $saved_video,
    //             'video_extension' => $ext,
    //             'user_id' => $user->id,
    //             'status' => '1'
    //         ]);

    //         $admin = UserMaster::where(['type_id' => '1'])->first();

    //         $notification = new Notification;
    //         $notification->notifier_id = $admin->id;
    //         $notification->from_id = $user->id;
    //         $notification->message = $user->name . " has created Story";
    //         $notification->is_view = '0';
    //         $notification->status = '1';
    //         $notification->created_at = date("Y-m-d h:i:s");
    //         $notification->save();
    //     }
    //     return response()->json([
    //         'message' => 'Story Uploaded Successfully'
    //     ]);
    // }

    public function uploadStory(Request $request)
    {
        $rules = [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|file|mimes:mp4,mov,ogg|max:20000', // Adjust file max size as needed
        ];
    
        // Custom conditional validation
        $validator = Validator::make($request->all(), $rules);

        $validator->after(function ($validator) use ($request) {
            if (!$request->hasFile('image') && !$request->hasFile('video')) {
                $validator->errors()->add('media', 'Either an image or a video is required.');
            }
        });
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422); // Unprocessable Entity
        }
    
    
        $user = Auth()->guard('frontend')->user();
        $admin = UserMaster::where(['type_id' => '1'])->first();

        if ($request->ajax()) {
            if ($request->has('image')) {
                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $image_name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
                $destinationPath = public_path('uploads/frontend/story/image/'); //public path folder dir

                $path = public_path('uploads/frontend/story/');
                Image::make($image->getRealPath())->resize(400, 285)->save($path . 'img_preview/' . $image_name);
                $image->move($destinationPath, $image_name);
                UserStory::create([
                    'image' => $image_name,
                    //'video' => $saved_video,
                    //'video_extension' => $ext,
                    'user_id' => $user->id,
                    'status' => '1'
                ]);
            }

            if ($request->has('video')) {
                $video = $request->file('video');
                $folder = "video";
                $saved_video = $this->fileUpload($request, 'video', $folder);
                $ext = $video->getClientOriginalExtension();
                UserStory::create([
                    //'image' => $image_name,
                    'video' => $saved_video,
                    'video_extension' => $ext,
                    'user_id' => $user->id,
                    'status' => '1'
                ]);
            }

            $notification = new Notification;
            $notification->notifier_id = $admin->id;
            $notification->from_id = $user->id;
            $notification->message = $user->name . " has created Story";
            $notification->is_view = '0';
            $notification->status = '1';
            $notification->created_at = date("Y-m-d h:i:s");
            $notification->save();
        }
        return response()->json([
            'message' => 'Story Uploaded Successfully'
        ]);
    }

    public function addBank()
    {
        return view('user.addBank');
    }

    public function edit_profile()
    {
        $user = Auth()->guard('frontend')->user();
        $data = UserMaster::findOrFail($user['id']);
        $country = Country::all();
        $language = Language::all();
        return view('user.edit_profile', compact('data', 'country', 'language'));
    }

    public function post_update_password(Request $request)
    {
        $user = Auth()->guard('frontend')->user();
        $request->validate([
            'old_password'  =>  ['required'],
            'new_password'  =>  ['required'],
            'confirm_new_password'  =>  ['required', 'same:new_password'],
        ]);
        if ($request->ajax()) {
            $model = UserMaster::findOrFail($user['id']);
            if ($model) {
                if (Hash::check($request->old_password, $model->password)) {

                    $model->update(['password' => Hash::make($request['new_password'])]);
                    $data_msg['message'] = "You have successfully changed your password.";

                    $admin = UserMaster::where(['type_id' => '1'])->first();

                    $notification = new Notification;
                    $notification->notifier_id = $admin->id;
                    $notification->from_id = $user->id;
                    $notification->message = $user->name . " has updated password";
                    $notification->is_view = '0';
                    $notification->status = '1';
                    $notification->created_at = date("Y-m-d h:i:s");
                    $notification->save();

                    return response()->json($data_msg);
                } else {
                    return response()->json([
                        'error' => "You have entered wrong Old Password"
                    ], 422);
                }
            }
        }
    }

    public function post_update_profile(Request $request)
    {
        $user = Auth()->guard('frontend')->user();
        $model = UserMaster::findOrFail($user['id']);

        $request->validate([
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'first_name'  =>  ['required', 'max:255', 'string'],
            'last_name'  =>  ['required', 'max:255', 'string'],
            'email'  =>  ['required', 'max:255', 'email'],
            'username'  =>  ['required', 'max:255'],
            'bio'  =>  ['required', 'max:255'],
            'phone'  =>  ['required'],
            'dob'  =>  ['required', 'date_format:Y-m-d'],
            'gender'  =>  ['required', 'in:M,F,O'],
            'about_me'  =>  ['required', 'max:255'],
            'address_line1' =>  ['required', 'max:255'],
            'city'  =>  ['required', 'max:255'],
            'state'  =>  ['required', 'max:255'],
            'country'  =>  ['required', 'max:255'],
            'zipcode'  =>  ['required', 'max:6'],
            'facebook' =>  ['required', 'max:255', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'instagram' =>  ['required', 'max:255', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'website' =>  ['required', 'max:255', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'language' => 'required',
        ]);
        if ($request->ajax()) {
            if ($request->has('profile_picture')) {
                $folder = "profile_picture";
                $input['new_profile_picture'] = $this->imageUpload($request, 'profile_picture', $folder, $model);
                $model->profile_picture = $input['new_profile_picture'];
            }
            if ($request->has('cover_image')) {
                $folder = "cover_image";
                $input['new_cover_image'] = $this->imageUpload($request, 'cover_image', $folder, $model);
                $model->cover_image = $input['new_cover_image'];
            }

            $model->first_name  =  $request['first_name'];
            $model->last_name  =  $request['last_name'];
            $model->email  =  $request['email'];
            $model->username  =  $request['username'];
            $model->bio  =  $request['bio'];
            $model->phone  =  $request['phone'];
            $model->dob  =  $request['dob'];
            $model->gender  =  $request['gender'];
            $model->about_me  =  $request['about_me'];
            $model->gender  =  $request['gender'];
            $model->address_line1 =  $request['address_line1'];
            $model->city  =  $request['city'];
            $model->state  =  $request['state'];
            $model->country  =  $request['country'];
            $model->zipcode  =  $request['zipcode'];
            $model->facebook  =  $request['facebook'];
            $model->intragram =  $request['instagram'];
            $model->website =  $request['website'];
            $model->topic =  (count($request['topic']) > 0) ? implode(",", $request['topic']) : '';
            $model->language  =  ($request['language'] != '') ? implode(",", $request['language']) : '';

            $model->save();

            $admin = UserMaster::where(['type_id' => '1'])->first();

            $notification = new Notification;
            $notification->notifier_id = $admin->id;
            $notification->from_id = $user->id;
            $notification->message = $user->name . " has updated profile";
            $notification->is_view = '0';
            $notification->status = '1';
            $notification->created_at = date("Y-m-d h:i:s");
            $notification->save();

            $data['message'] = "You have successfully Updated your Profile.";
            $data['success'] = "success";
            return response()->json($data);
        }
    }

    function imageUpload(Request $request, $fname, $folder, $model)
    {
        if ($request->hasFile($fname)) {  //check the file present or not
            if ($model != '') {
                if (file_exists(public_path('uploads/frontend/' . $folder . '/original/' . $model->$folder))) {
                    File::delete(public_path('uploads/frontend/' . $folder . '/original/' . $model->$folder));
                    File::delete(public_path('uploads/frontend/' . $folder . '/preview/' . $model->$folder));
                    File::delete(public_path('uploads/frontend/' . $folder . '/thumb/' . $model->$folder));
                }
            }
            $image = $request->file($fname); //get the file
            $name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
            $destinationPath = public_path('uploads/frontend/' . $folder . '/original/'); //public path folder dir
            $path = public_path('uploads/frontend/' . $folder . '/');
            Image::make($image->getRealPath())->resize(300, 200)->save($path . 'preview/' . $name);
            Image::make($image->getRealPath())->resize(100, 100)->save($path . 'thumb/' . $name);
            $image->move($destinationPath, $name);
            return $name;
        }
    }

    public function likeProject(Request $request)
    {
        $user = Auth()->guard('frontend')->user();

        $details = UserLikes::where(['project_id' => $request['id'], 'user_id' => $user['id']])->first();
        if ($details != '') {
            if ($details['like_status'] != 0) {
                $details->update(['like_status' => '0']);
                $result['message'] = "Disliked Successfully ";
            } else {
                $details->update(['like_status' => '1']);
                $result['message'] = "Liked Successfully";
            }
        } else {
            UserLikes::create([
                'project_id' => $request['id'],
                'user_id' => $user['id'],
                'like_status' => '1',
                'status' => '1'
            ]);
            $result['message'] = "Liked Successfully ";
        }
        $result['success'] = true;
        return response()->json($result);
    }

    public function saveProject(Request $request)
    {
        $user = Auth()->guard('frontend')->user();

        $details = BookmarkProject::where(['project_id' => $request['id'], 'user_id' => $user['id']])->first();
        if ($details != '') {
            if ($details['like_status'] != 0) {
                $details->update(['like_status' => '0']);
                $result['message'] = "Bookmark Removed Successfully ";
            } else {
                $details->update(['like_status' => '1']);
                $result['message'] = "Bookmark Successfully";
            }
        } else {
            BookmarkProject::create([
                'project_id' => $request['id'],
                'user_id' => $user['id'],
                'like_status' => '1',
                'status' => '1'
            ]);
            $result['message'] = "Bookmark Successfully ";
        }


        $result['success'] = true;
        return response()->json($result);
    }

    public function report(Request $request)
    {
        $user = Auth()->guard('frontend')->user();
        ReportProject::create([
            'user_id' => $user->id,
            'project_id' => $request->project_id,
            'description' => $request->description
        ]);
        $admin = UserMaster::where(['type_id' => '1'])->first();

        $notification = new Notification;
        $notification->notifier_id = $admin->id;
        $notification->from_id = $user->id;
        $notification->message = $user->name . " has reported project " . $request->project_id;
        $notification->is_view = '0';
        $notification->status = '1';
        $notification->created_at = date("Y-m-d h:i:s");
        $notification->save();

        $result['success'] = true;
        $result['message'] = "Reported Successfully ";
        return response()->json($result);
    }

    public function followuser(Request $request)
    {
        $user = Auth()->guard('frontend')->user();
        $list = UserFollower::where(['user_id' => $user->id, 'following_user_id' => $request->user_id])->first();
        if ($list != '') {
            if ($list->status == '1') {
                $list->update(['status' => '2']);
                $result['message'] = "UnFollow Successfully ";

                $admin = UserMaster::where(['type_id' => '1'])->first();
                $follower = UserMaster::where(['id' => $request->user_id])->first();
                $notification = new Notification;
                $notification->notifier_id = $admin->id;
                $notification->from_id = $user->id;
                $notification->message = $user->name . " has unfollow " . $follower->name;
                $notification->is_view = '0';
                $notification->status = '1';
                $notification->created_at = date("Y-m-d h:i:s");
                $notification->save();
            } else {
                $list->update(['status' => '1']);
                $result['message'] = "Followed Successfully ";

                $admin = UserMaster::where(['type_id' => '1'])->first();
                $follower = UserMaster::where(['id' => $request->user_id])->first();
                $notification = new Notification;
                $notification->notifier_id = $admin->id;
                $notification->from_id = $user->id;
                $notification->message = $user->name . " has started following " . $follower->name;
                $notification->is_view = '0';
                $notification->status = '1';
                $notification->created_at = date("Y-m-d h:i:s");
                $notification->save();
            }
        } else {
            UserFollower::create([
                'user_id' => $user->id,
                'following_user_id' => $request->user_id,
                'status' => '1'
            ]);

            $admin = UserMaster::where(['type_id' => '1'])->first();
            $follower = UserMaster::where(['id' => $request->user_id])->first();
            $notification = new Notification;
            $notification->notifier_id = $admin->id;
            $notification->from_id = $user->id;
            $notification->message = $user->name . " has started following " . $follower->name;
            $notification->is_view = '0';
            $notification->status = '1';
            $notification->created_at = date("Y-m-d h:i:s");
            $notification->save();
            $result['message'] = "Followed Successfully ";
        }
        $result['success'] = true;
        return response()->json($result);
    }

    public function deleteCart($id){
        $checkout = Checkout::findOrFail($id);
        if($checkout != ''){
            $checkout->update(['status'=>'4']);
            $data['message']= 'Deleted Successfully';
            return response()->json($data);
        }else{
            $data['message']= 'Something went wrong';
            return response()->json($data,422);
        }
        
    }
}

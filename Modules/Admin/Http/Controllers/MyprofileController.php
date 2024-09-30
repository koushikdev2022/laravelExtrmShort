<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\UserMaster;

class MyprofileController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function get_myprofile() {
        $data['active_tab'] = (isset($_GET['tab']) && $_GET['tab'] != "") ? $_GET['tab'] : 'tab_1';
        $model = new UserMaster;
        $admin_user = Auth()->guard('backend')->user();
        $data['model'] = $admin_user;
        return view('admin::myprofile.index', $data);
    }

    public function post_myprofile(Request $request) {
        $data = [];
        $admin_user = Auth()->guard('backend')->user();
        if (isset($_POST['tab']) && $_POST['tab'] == 'tab_1') {
            $data['tab'] = 'tab_1';
            $image_pre = $admin_user->image;
            $validator = Validator::make($request->all(), [
                        'first_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
                        'last_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
                        'email' => 'required|email|max:255',
                        'image' => 'mimes:jpeg,bmp,png',
            ]);
            $validator->after(function($validator)use ($request) {
                $other_user = UserMaster::where('email', $request->input('email'))->where('status', '<>', '3')->where('id', '<>', Auth()->guard('backend')->user()->id)->first();
                if (!empty($other_user)) {
                    $validator->errors()->add('email', 'Email id already in use.');
                }
            });
            if ($validator->passes()) {
                $admin_user->first_name = $request->input('first_name');
                $admin_user->last_name = $request->input('last_name');
                $admin_user->email = strtolower($request->input('email'));
                $admin_user->updated_at = date('Y-m-d H:i:s');
                if ($request->file('image')) {
                    $img_name = $this->rand_string(12) . '.' . $request->file('image')->getClientOriginalExtension();
                    $file = $request->file('image');
                    $destinationPath = public_path('uploads/admin/profile_picture/original/');
                    $file->move($destinationPath, $img_name);
                    Image::make(public_path('uploads/admin/profile_picture/original/') . $img_name)->resize(500, 500)->save(public_path('uploads/admin/profile_picture/preview/') . $img_name);
                    Image::make(public_path('uploads/admin/profile_picture/original/') . $img_name)->resize(200, 200)->save(public_path('uploads/admin/profile_picture/thumb/') . $img_name);

                    $admin_user->profile_picture = $img_name;
                }
                $admin_user->save();
                $request->session()->flash('success', 'Profile updated successfully.');
            }
            return redirect()->route('admin-myprofile', $data)->withErrors($validator)->withInput();
        }
        if (isset($_POST['tab']) && $_POST['tab'] == 'tab_2') {
            $data['tab'] = 'tab_2';
            $validator = Validator::make($request->all(), [
                        'old_password' => 'required',
                        'new_password' => 'required|min:6',
                        'retype_password' => 'required|same:new_password',
            ]);
            $validator->after(function($validator)use ($request) {
                $admin_user = Auth()->guard('backend')->user();
                if (Hash::check($request->input('old_password'), $admin_user->password) != 1)
                    $validator->errors()->add('old_password', 'Old password is incorrect.');
            });
            if ($validator->passes()) {
                $admin_user->password = Hash::make($request->input('new_password'));
                $admin_user->updated_at = date('Y-m-d H:i:s');
                $admin_user->save();
                $request->session()->flash('success', 'Password changed successfully.');
            }
            return redirect()->route('admin-myprofile', $data)->withErrors($validator)->withInput();
        }
    }

}

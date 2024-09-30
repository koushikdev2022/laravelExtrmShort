<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Validator;
use App\Traits\HelperTrait;

use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\TranslationCategory;
use App\Models\Category;
use App\Models\ProjectAddress;
use App\Models\Bid;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\{ProjectFileRequest, ProjectStoreRequest};

class ProjectController extends AdminController
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    use HelperTrait;

    public function index()
    {
        $data = [];
         $data = Project::join('project_files as vdo', 'project.id', 'vdo.project_id')
            ->select('project.*', 'vdo.image as file', 'vdo.status', 'vdo.created_at', 'vdo.type')
            ->where('vdo.type', '1')
            ->get();
        //$data = Project::with('files')->get();
        return view('admin::video.index', compact('data'));
    }

    public function view($id)
    {
        $data = [];
   
        $data = Project::join('project_files as vdo', 'project.id', 'vdo.project_id')
            ->select('project.*', 'vdo.image as file', 'vdo.status', 'vdo.created_at', 'vdo.type', 'vdo.id as fileId')
            ->where('vdo.type', '1')->where('project.id', $id)
            ->first();
        return view('admin::video.view', compact('data'));
    }

    public function statusUpdate(Request $request, $id)
    {
        $data = ProjectFile::findOrFail($id);
        if ($data != '') {
            Project::where(['id' => $request->id])->update([
                'status' => $request->input('status')
            ]);
           
            $data->update([
                'status' => $request->input('status')
            ]);
        }
        $request->session()->flash('success', 'Updated successfully.');
        return redirect()->route('admin-project');
    }


    // public function project_list()
    // {
    //     $project_list = Project::where('status', '<>', '3');
    //     return Datatables::of($project_list)
    //         ->addIndexColumn()
    //         ->editColumn('name', function ($model) {
    //             return $model->user->name;
    //         })
    //         ->editColumn('categories', function ($model) {
    //             $arr = [];
    //             $cats = explode(",", $model->categories);
    //             foreach ($cats as $cat) {
    //                 $cat_name = Category::with('translation')->whereNull('parent_id')->where('id', '=', $cat)->where('status', '=', '1')->first();
    //                 $arr[] = $cat_name->translation->category_name;
    //             }
    //             return implode(", ", $arr);
    //         })
    //         ->editColumn('sub_categories', function ($model) {
    //             $arr = [];
    //             $subcats = explode(",", $model->sub_categories);
    //             foreach ($subcats as $subcat) {
    //                 $subcat_name = Category::with('translation')->where('id', '=', $subcat)->where('status', '=', '1')->first();
    //                 $arr[] = $subcat_name->translation->category_name;
    //             }
    //             return implode(", ", $arr);
    //         })
    //         ->editColumn('created_at', function ($model) {
    //             return date("jS M Y, g:i A", strtotime($model->created_at));
    //         })
    //         ->editColumn('begin_date', function ($model) {
    //             return $model->begin_date;
    //         })
    //         ->editColumn('status', function ($model) {
    //             return $model->status;
    //         })
    //         ->editColumn('offer', function ($model) {
    //             $bid_count = Bid::where('project_id', $model->id)->where('status', '0')->count();
    //             return $bid_count;
    //         })
    //         ->editColumn('accepted', function ($model) {
    //             $bid_count = Bid::where('project_id', $model->id)->where('status', '1')->count();
    //             return $bid_count;
    //         })
    //         ->addColumn('action', function ($model) {
    //             $action_html = '<a href="' . Route('admin-editproject', ['id' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
    //                 . '<i class="fa fa-edit"></i>'
    //                 . '</a>'
    //                 . '<a href="javascript:;" data-tbl="project"   data-href="' . Route('admin-deleteproject', [base64_encode($model->id)]) . '" data-title="Project" onclick="deleteObject(this);" class="btn btn-outline btn-circle btn-sm dark">'
    //                 . '<i class="fa fa-trash"></i>'
    //                 . '</a>';

    //             // $action_html="";
    //             return $action_html;
    //         })
    //         ->make(true);
    // }







    public function edit($id)
    {
        $data = [];
        $data['categories'] = Category::with('translation')->where('parent_id', NULL)->where('status', '1')->get();
        $data['subcategories'] = Category::with('translation')->where('parent_id', '!=', NULL)->where('status', '1')->get();
        $data['project'] = $project = Project::find($id);
        return view('admin::video.update', $data);
    }

    public function project_update(ProjectStoreRequest $request)
    {
        if ($request->ajax()) {
            $data_msg = [];
            // $user = Auth()->guard('frontend')->user();
            $input = $request->except('_token');
            // $input['user_id'] = $user->id;
            if (!empty($input['bid'])) {
                $model = Project::where(['id' => $input['bid'], ['status', '<>', '3']])->first();
                if (!empty($model)) {
                    if (!empty($request->input('categories'))) {
                        $input['categories'] = implode(",", $request->input('categories'));
                    }
                    if (!empty($request->input('sub_categories'))) {
                        $input['sub_categories'] = implode(",", $request->input('sub_categories'));
                    }
                    if (!empty($request->input('services'))) {
                        $input['services'] = implode(",", $request->input('services'));
                    }
                    if (!empty($request->input('avl_date'))) {
                        $input['avl_date'] = implode(",", $request->input('avl_date'));
                    }

                    $model->update($input);
                    $this->save_project_images($input, $model->id);

                    if (count($request['final_address'])) {
                        for ($i = 0; $i < count($request['final_address']); $i++) {
                            $project_address = ProjectAddress::where('project_id', $model->id)->where('final_address', $request['final_address'][$i])->where('status', '1')->first();
                            if (empty($project_address)) {
                                ProjectAddress::create([
                                    'final_address' => $request['final_address'][$i],
                                    // 'address2' => $request['address2'][$i],
                                    'final_latitude' => $request['final_latitude'][$i],
                                    'final_longitude' => $request['final_longitude'][$i],
                                    'project_id' => $model->id
                                ]);
                            } else {
                                $project_address->update([
                                    'final_address' => $request['final_address'][$i],
                                    // 'address2' => $request['address2'][$i],
                                    'final_latitude' => $request['final_latitude'][$i],
                                    'final_longitude' => $request['final_longitude'][$i],
                                    'project_id' => $model->id
                                ]);
                            }
                        }
                    }

                    $data_msg['status'] = 200;
                    $data_msg['msg'] = 'You are successfully update Project of ' . $input['title'];
                    $redirect_url = route('admin-editproject', $input['bid']);
                }
            }
            $data_msg['link'] = $redirect_url;
            return response()->json($data_msg);
        }
    }


    public function upload_project_photo(ProjectFileRequest $request)
    {
        if ($request->ajax()) {
            $file = $request->file('file');
            $mime = $file->getMimeType();
            $split_mime = explode('/', $mime);
            $split_mime[0] = $split_mime[0] ?? '';
            if ($split_mime[0] == 'video') {
                $data_msg['file_type'] = 2;
            } else {
                $data_msg['file_type'] = 1;
            }
            $data_msg['file_name'] = $this->imageUpload($request, 'file');
            $data_msg['modelName'] = 'AllImages';
            $status = 200;

            return response()->json($data_msg, $status);
        }
    }

    public function remove_project_photo(Request $request)
    {
        if ($request->ajax()) {
            $data_msg = [];
            $file_name = $request->input('file_name');
            if (!empty($file_name)) {
                $path = public_path('storage/uploads/frontend/project/' . $file_name);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            return response()->json($data_msg);
        }
    }

    private function save_project_images($arr, $project_id)
    {
        if ($arr['AllImages']['image'] !== NULL && !empty($project_id)) {
            $images = $arr['AllImages'];
            $checkExistimage = ProjectFile::where('project_id', $project_id)->where('status', '1')->get();
            if (sizeof($checkExistimage) > 0) {
                foreach ($checkExistimage as $image) {
                    $image->update(['status' => '3']);
                }
            }
            foreach ($images['image'] as $i => $image) {
                $input = [];
                $input['project_id'] = $project_id;
                $input['image'] = $image;
                $input['status'] = '1';
                $input['file_type'] = $arr['AllImages']['filetype_'][$i] ?? '1';
                if ($i == $images['is_default']) {
                    $input['is_default'] = '1';
                } else {
                    $input['is_default'] = '0';
                }
                $checkImageName = ProjectFile::where(['project_id' => $project_id, 'image' => $image])->first();
                if (!empty($checkImageName)) {
                    $checkImageName->update($input);
                } else {
                    ProjectFile::create($input);
                }
            }
        }
    }


    function imageUpload(Request $request, $fname)
    {
        if ($request->hasFile($fname)) {  //check the file present or not
            $image = $request->file($fname); //get the file
            $name = $this->rand_string(50) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
            $destinationPath = public_path('storage/uploads/frontend/project/'); //public path folder dir
            $image->move($destinationPath, $name);
            return $name;
        }
    }

    public function destroy(Request $request, $bid)
    {
        if ($request->ajax()) {
            $data_msg = [];
            $bid = base64_decode($bid);
            // $user_id = Auth()->guard('frontend')->user()->id;
            $model = Project::where(['id' => $bid, ['status', '<>', '3']])->first();
            if (!empty($model)) {
                $model->update(['status' => '3']);
                $checkExistimage = ProjectFile::where('project_id', $model->id)->where('status', '1')->get();
                if (sizeof($checkExistimage) > 0) {
                    foreach ($checkExistimage as $image) {
                        $image->status = "3";
                        $image->update();
                    }
                }
                $data_msg['status'] = 200;
                $data_msg['msg'] = 'Project deleted successfully.';
            } else {
                $data_msg['status'] = 400;
                $data_msg['msg'] = 'Project details not found.';
            }
            return response()->json($data_msg);
        }
    }

    public function location_destroy(Request $request, $bid)
    {
        if ($request->ajax()) {
            $data_msg = [];
            $bid = base64_decode($bid);
            $model = ProjectAddress::where('id', $bid)->where('status', '<>', '3')->first();
            if (!empty($model)) {
                $model->update(['status' => '3']);
                $data_msg['id'] = $bid;
                $data_msg['status'] = 200;
                $data_msg['msg'] = 'Location deleted successfully.';
            } else {
                $data_msg['status'] = 400;
                $data_msg['msg'] = 'Project details not found.';
            }
            return response()->json($data_msg);
        }
    }

    public function showimages(Request $request)
    {
        if ($request->ajax()) {
            $data_msg = [];
            $images = [];
            $bid = $request->input('bid');
            $productImages = ProjectFile::where('project_id', $bid)->where('status', '1')->get();
            //   dd($productImages);
            //print_r($productImages);exit;
            if (sizeof($productImages) > 0) {
                foreach ($productImages as $key => $image) {
                    $images[$key]['name'] = $image->image;
                    $targetFile = public_path('storage/uploads/frontend/project/' . $image->image);

                    $images[$key]['size'] = filesize($targetFile);
                    //$images[$key]['size'] = filesize($targetFile);
                }
                $data_msg['res'] = 1;
                $data_msg['images'] = $images;
            }
            return response()->json($data_msg);
        }
    }

    public function signup_subcategory(Request $request)
    {
        if ($request->ajax()) {
            //    dd($request->input());
            $data = [];
            $values = $request->input('values');
            // dd($values);
            if (!empty($request['category_id'])) {
                $arrayList =  $request['category_id'];
                $categories = Category::whereIn('parent_id', $arrayList)->orderBy('parent_id', 'DESC')->where('status', '1')->get();
            } else {
                $categories = [];
            }

            $data['content'] = view('ajax.ajax-signup-subcategory', compact("categories", "values"))->render();
            $data['status'] = "success";
            return response()->json($data);
        }
    }
}

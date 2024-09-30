<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Cms;
use App\Models\CmsTranslate;
use Intervention\Image\ImageManagerStatic as Image;

class CmsController extends AdminController
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [];
        $data['page_name'] = $page_name = isset($_GET['page_name']) ? $_GET['page_name'] : "";
        $data['content_name'] = $content_name = isset($_GET['content_name']) ? $_GET['content_name'] : "";
        $data['search_filter'] = isset($_GET['search_filter']) ? $_GET['search_filter'] : "";
        $query = CmsTranslate::where('slug', 'like', '%');
        if ($page_name != "") {
            $query->where('page_name', 'like', '%' . $page_name . '%');
        }
        if ($content_name != "") {
            $query->where('content_name', 'like', '%' . $content_name . '%');
        }
        $model = $query->where('language_code', 'en')->paginate(10);
        $data['model'] = $model;
        return view('admin::cms.index', $data);
    }

    public function view($id)
    {
        $data = [];
        $data['model'] = CmsTranslate::where(['id' => base64_decode($id)])->first();
        return view('admin::cms.view', $data);
    }

    public function get_update($id)
    {
        $data = [];
         $data['model'] = CmsTranslate::where(['id' => base64_decode($id), 'language_code' => 'en'])->first();
        return view('admin::cms.update', $data);
    }

    public function post_update(Request $request, $id)
    {
        $data = [];

        $model = CmsTranslate::where('id', base64_decode($id))->first();

        $validator = Validator::make($request->all(), [
            'page_name' => 'required',
            'content_name' => 'required',
            'content_body' => 'required',
        ]);
        

        $validator->after(function ($validator) use ($request) {
            if ($request->input('page_name') != "" && strlen($request->input('page_name')) > 100)
                $validator->errors()->add('page_name', 'The page name may not be greater than 100 characters.');
            else if ($request->input('page_name') == "")
                $validator->errors()->add('page_name', 'The page name field is required.');
            if ($request->input('content_name') != "" && strlen($request->input('content_name')) > 100)
                $validator->errors()->add('content_name', 'The content name may not be greater than 100 characters.');
            else if ($request->input('content_name') == "")
                $validator->errors()->add('content_name', 'The content name field is required.');
        });
        if ($validator->passes()) {

            if ($model->type == '2') {
                if ($request->file('content_body')) {
                    $img_name = $this->rand_string(20) . '.' . $request->file('content_body')->getClientOriginalExtension();
                    $file = $request->file('content_body');
                    $file->move(public_path('storage/uploads/frontend/cms/pictures/original/'), $img_name);
                    Image::make(public_path('storage/uploads/frontend/cms/pictures/original/') . $img_name)->resize(1220, 500)->save(public_path('uploads/frontend/cms/pictures/preview/') . $img_name);
                    $model->content_body = $img_name;
                    CmsTranslate::find($model->id)->update([
                        'page_name' => $request->input('page_name'),
                        'content_name' => $request->input('content_name'),
                        'content_body' => $img_name,
                        'updated_at' => Carbon::now()
                    ]);
                }
            }  else {
                $model->content_body = $request->input('content_body');
                    CmsTranslate::find($model->id)->update([
                        'page_name' => $request->input('page_name'),
                        'content_name' => $request->input('content_name'),
                        'content_body' => $request->input('content_body'),
                        'updated_at' => Carbon::now()
                    ]);
                }
            
            $request->session()->flash('success', 'Content updated successfully.');
            return redirect()->route('admin-cms');
        }else{
            return redirect()->route('admin-updatecms', ['id' => $id])->withErrors($validator)->withInput();
        }
    }
}

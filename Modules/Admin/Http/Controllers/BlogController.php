<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\{Category, Blog};
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use App\Traits\HelperTrait;
use File;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController extends Controller
{
    use HelperTrait;

    public function index()
    {
        $data = [];
        return view('admin::blogs.index', $data);
    }

    public function blog_list()
    {
        $blog_list = Blog::where('status', '<>', '3');
        return DataTables::of($blog_list)
            ->addIndexColumn()
            ->editColumn('title', function ($model) {
                return \Illuminate\Support\Str::limit($model->title,40) ;
            })
            ->editColumn('category', function ($model) {
                return $model->category;
            })
            ->editColumn('post_date', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->post_date));
            })
            ->editColumn('status', function ($model) {
                return $model->status;
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-editblog', ['id' => base64_encode($model->id)]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Update">'
                    . '<i class="fa fa-edit" aria-hidden="true"></i>'
                    . '</a>'
                    . '<a href="javascript:void(0);" onclick="deleteBlog(this);" data-href="' . Route("admin-blog-delete", ['id' => base64_encode($model->id)]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
                    . '<i class="fa fa-trash"></i>'
                    . '</a>';

                return $action_html;
            })
            ->make(true);
    }

    public function create()
    {
        $categories = Category::join('translation_categories', 'translation_categories.category_id', 'categories.id')
            ->where('categories.status', '1')->where('translation_categories.lang_code', '=', 'en')
            ->where('parent_id', null)->get();
        return view('admin::blogs.create', $categories);
    }

    public function post_add(Request $request)
    {
        $request->validate([
            'title' => 'required',
            // 'slug' => 'required',
            'category' => 'required',
            // 'email' => 'required|email',
            'description' => 'required',
            'image' => 'required',
            'post_date' => 'required',
            'status' => 'required',
        ]);
        $user = Auth()->guard('backend')->user();
        if ($request->has('image')) {
            $folder = "Blog";
            $image = $this->imageUpload($request, 'image', $folder, $model = '');
        }

        $input = new Blog();
        $input->title = $request->title;
        $input->slug = $request->title;
        $input->email = $user->email;
        $input->category = $request->category;
        $input->description = $request->description;
        $input->image = $image;
        $input->post_date = $request->post_date;
        $input->status = $request->status;
        $input->created_by = Auth()->guard('backend')->user()->id;
        $input->written_by = $request->written_by;
        $input->save();

        $data['message'] =  'Blog added successfully.';
        return response()->json($data);
    }

    public function edit($id)
    {
        $categories = Category::join('translation_categories', 'translation_categories.category_id', 'categories.id')
            ->where('categories.status', '1')->where('translation_categories.lang_code', '=', 'en')
            ->where('parent_id', null)->get();
        $nid = base64_decode($id);
        $model = Blog::find($nid);
        return view('admin::blogs.edit', compact('categories', 'model'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            // 'slug' => 'required',
            'category' => 'required',
            //'email' => 'required|email',
            'description' => 'required',
            'post_date' => 'required',
            'status' => 'required',
        ]);

        $model = Blog::find($id);
        if ($request->has('image')) {
            $folder = "Blog";
            $image = $this->imageUpload($request, 'image', $folder, $model);
        } else {
            $image = $model['image'];
        }
        $user = Auth()->guard('backend')->user();
        $model->update([
            'title' => $request->title,
            'slug' => $request->title,
            'email' => $user->email,
            'description' => $request->description,
            'image' => $image,
            'category' => $request->category,
            'post_date' => $request->post_date,
            'status' => $request->status,
            'created_by' => Auth()->guard('backend')->user()->id,
            'written_by' => $request->written_by,
        ]);
        $data['message'] = "Blog Updated Successfully";
        return response()->json($data);
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
            Image::make($image->getRealPath())->resize(447, 341)->save($path . 'preview/' . $name);
            Image::make($image->getRealPath())->resize(70, 70)->save($path . 'thumb/' . $name);
            $image->move($destinationPath, $name);
            return $name;
        }
    }
    public function destroy(Request $request)
    {
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $id = base64_decode($_GET['id']);
            $model = Blog::findOrFail($id);
            if (!empty($model) && $model->status != '3') {
                $model->update(['status'=>'3']);
                $request->session()->flash('success', 'Blog deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-blog');
    }
}

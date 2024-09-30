<?php

namespace Modules\Admin\Http\Controllers;

use App\Models\Category;
use App\Models\TranslationCategory;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
// ************ Requests ************
use Illuminate\Support\Facades\View;
use Modules\Admin\Http\Requests\CreateCategoryRequest;
// ************ Mails ************
// ************ Models ************
use Modules\Admin\Http\Requests\UpdateCategoryRequest;
use Yajra\DataTables\Facades\DataTables;


class CategoryController extends AdminController
{
    use HelperTrait;
    public $parent_id;

    public function __construct()
    {
        $data = [];
        $data['pid'] = $pid = request()->has('pid') ? request()->input('pid') : '';
        $this->parent_id = !empty($pid) ? base64_decode($pid) : '';
        if (!empty($this->parent_id)) {
            $data['parent_model'] = Category::find($this->parent_id);
        }
        View::share($data);
    }

    public function index(Request $request)
    {
        $data = [];
        $data['categories'] = Category::where('status', '1')->get();
        if ($request->ajax()) {

            $data_sql = Category::select('categories.*', 'translation_categories.category_name')->leftJoin('translation_categories', 'translation_categories.category_id', 'categories.id')
                ->where('categories.status', '<>', '3')->where('translation_categories.lang_code', 'en');

            // if (!empty($this->parent_id) && is_numeric($this->parent_id)) {
            //     $data_sql->where('parent_id', $this->parent_id);
            // }

            $data_sql->where('categories.parent_id', NULL)->where(['translation_categories.lang_code' => 'en', 'translation_categories.status' => '1'])->get();

            return DataTables::of($data_sql)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="' . Route('admin-category-edit', [base64_encode($row->id)]) . '?pid=' . base64_encode($this->parent_id) . '" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>';
                    if (empty($row->parent_id)) :
                        $html .= '<a href="' . Route('admin-subcategory') . '?pid=' . base64_encode($row->id) . '" class="btn btn-outline btn-circle btn-sm purple">
                        <i class="fa fa-list"></i> Sub Category
                    </a>';
                    endif;
                    $html .= '<a href="javascript:;" data-tbl="Category" data-href="' . Route('admin-category-delete', [base64_encode($row->id)]) . '" data-title="Category" onclick="deleteObject(this);" class="btn btn-outline btn-circle btn-sm dark">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>';
                    return $html;
                })
                // ->editColumn('parent_category_name', function ($row) {
                //     if(!empty($row->parent_id))
                //     {
                //         $model = Category::select('translation_categories.category_name')->leftJoin('translation_categories', 'translation_categories.category_id', 'categories.id')->where('categories.id', $row->parent_id)->where(['translation_categories.lang_code' => 'en', 'translation_categories.status' => '1'])->first();
                //         return $model->category_name;
                //     }else{
                //         return "<b>Parent</b>";
                //     }
                // })
                ->editColumn('translation_categories.category_name', function ($row) {
                    return $row->category_name;
                })
                ->editColumn('categories.created_at', function ($row) {
                    return !empty($row->created_at) ? date('jS M Y, g:i A', strtotime($row->created_at)) : 'N/A';
                })
                ->editColumn('categories.status', function ($row) {
                    return ($row->status === '0') ? '<span class="label label-sm label-warning"> Inactive </span>' : (($row->status === '1') ? '<span class="label label-sm label-success"> Active </span>' : '<span class="label label-sm label-danger"> Deleted </span>');
                })
                ->rawColumns(['categories.status', 'action', 'parent_category_name'])
                ->make(true);
        }
        return view('admin::category.index', $data);
    }


    public function subcategory_index(Request $request)
    {

        $data = [];
        if ($request->ajax()) {

            $data_sql = Category::select('categories.*', 'translation_categories.category_name')->leftJoin('translation_categories', 'translation_categories.category_id', 'categories.id')
                ->where('categories.status', '<>', '3')->where('translation_categories.lang_code', 'en');

            if (!empty($this->parent_id) && is_numeric($this->parent_id)) {
                $data_sql->where('parent_id', $this->parent_id);
            }

            $data_sql->where('categories.parent_id', $request->pid)->where(['translation_categories.lang_code' => 'en', 'translation_categories.status' => '1'])->get();

            return DataTables::of($data_sql)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="' . Route('admin-category-edit', [base64_encode($row->id)]) . '?pid=' . base64_encode($this->parent_id) . '" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>';
                    // if (empty($row->parent_id)) :
                    //     $html .= '<a href="' . Route('admin-subcategory') . '?pid=' . base64_encode($row->id) . '" class="btn btn-outline btn-circle btn-sm purple">
                    //     <i class="fa fa-list"></i> Sub Category
                    // </a>';
                    // endif;
                    $html .= '<a href="javascript:;" data-tbl="subcategory"   data-href="' . Route('admin-category-delete', [base64_encode($row->id)]) . '" data-title="Category" onclick="deleteObject(this);" class="btn btn-outline btn-circle btn-sm dark">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>';
                    return $html;
                })
                // ->editColumn('parent_category_name', function ($row) {
                //     if(!empty($row->parent_id))
                //     {
                //         $model = Category::select('translation_categories.category_name')->leftJoin('translation_categories', 'translation_categories.category_id', 'categories.id')->where('categories.id', $row->parent_id)->where(['translation_categories.lang_code' => 'en', 'translation_categories.status' => '1'])->first();
                //         return $model->category_name;
                //     }else{
                //         return "<b>Parent</b>";
                //     }
                // })
                ->editColumn('translation_categories.category_name', function ($row) {
                    return $row->category_name;
                })
                ->editColumn('categories.created_at', function ($row) {
                    return !empty($row->created_at) ? date('jS M Y, g:i A', strtotime($row->created_at)) : 'N/A';
                })
                ->editColumn('categories.status', function ($row) {
                    return ($row->status === '0') ? '<span class="label label-sm label-warning"> Inactive </span>' : (($row->status === '1') ? '<span class="label label-sm label-success"> Active </span>' : '<span class="label label-sm label-danger"> Deleted </span>');
                })
                ->rawColumns(['categories.status', 'action', 'parent_category_name'])
                ->make(true);
        }
        return view('admin::category.subcategory_index', $data);
    }


    public function get_create()
    {
        $data = [];
        $data['languages'] = $this->getActiveLanguages();
        return view('admin::category.create', $data);
    }

    public function post_create(CreateCategoryRequest $request)
    {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $input['status'] = '1';
            $input['parent_id'] = !empty($this->parent_id) && is_numeric($this->parent_id) ? $this->parent_id : null;
            if ($request->hasFile('picture')) {
                $input['image'] = $this->AvatarUpload($request->file('picture'));
            }
            $input['category_type'] = $request['category_type'];

            $model = Category::create($input);

            $language_codes = $this->getActiveLanguages();

            $arr = [];
            foreach ($language_codes as $language_code) {
                $input = $request->input($language_code->lang_code);
                array_push($arr, [
                    'lang_code' => $language_code->lang_code,
                    'category_name' => $input['category_name'],
                ]);
            }

            $model->translation()->createMany($arr);

            if (!empty($_GET['pid'])) {
                $data_msg['msg'] = 'Sub Category Created Sucessfully';
                $pid = base64_decode($_GET['pid']);
                $data_msg['link'] = Route('admin-subcategory') . '?pid=' . base64_encode($pid);
            } else {
                $data_msg['msg'] = 'Category Created Sucessfully';
                $data_msg['link'] = route('admin-category');
            }

            //$data_msg['link'] = route('admin-category') . '?pid=' . base64_encode($this->parent_id);
            return response()->json($data_msg);
        }
    }

    public function get_edit($id)
    {
        $id = base64_decode($id);
        $model = Category::where('id', $id)->where('status', '<>', '3')->first();
        if (!empty($model)) {
            $eventTrans = $model->eventTrans->mapWithKeys(function ($item) {
                return [$item['lang_code'] => $item];
            });
            $languages = $this->getActiveLanguages();
            return view('admin::category.update', compact('model', 'languages', 'eventTrans'));
        }
        return redirect()->back()->with('error', 'No category details found.');
    }

    public function post_edit(UpdateCategoryRequest $request, $id)
    {
        if ($request->ajax()) {
            $data_msg = [];
            $id = base64_decode($id);
            $model = Category::where('id', $id)->first();
            $input = $request->input();
            if ($request->hasFile('picture')) {
                if($model->image != ''){
                    $this->deleteExistFile($model);
                }
                $input['image'] = $this->AvatarUpload($request->file('picture'));
            }
            $model->category_type = $request['cat-status'];
            $model->update($input);
            $language_codes = $this->getActiveLanguages();
            foreach ($language_codes as $language_code) {
                $input = $request->input($language_code->lang_code);
                $arr = [
                    'lang_code' => $language_code->lang_code,
                    'category_id' => $model->id,
                    'category_name' => $input['category_name'],
                ];
                TranslationCategory::updateOrCreate([
                    'lang_code' => $arr['lang_code'],
                    'category_id' =>  $arr['category_id'],
                ], $arr);
            }

            if (!empty($_GET['pid'])) {
                $data_msg['msg'] = 'Sub Category Created Sucessfully';
                $pid = base64_decode($_GET['pid']);
                $data_msg['link'] = Route('admin-subcategory') . '?pid=' . base64_encode($pid);
            } else {
                $data_msg['msg'] = 'Category Created Sucessfully';
                $data_msg['link'] = route('admin-category');
            }
            // $data_msg['msg'] = 'Category updated successfully.';
            // $data_msg['link'] = route('admin-category') . '?pid=' . base64_encode($this->parent_id);
            return response()->json($data_msg);
        }
    }

    private function deleteExistFile($model)
    {

        if ($model->getRawOriginal('image') && File::exists(public_path('uploads/frontend/category/' . $model->getRawOriginal('image')))) {
            File::delete(public_path('uploads/frontend/category/' . $model->getRawOriginal('image')));
        }
    }

    public function destroy($id)
    {
        $data = [];
        $cid = base64_decode($id);
        $model = Category::where('id', $cid)->where('status', '<>', '3')->first();
        if (!empty($model)) {
            $model->update(['status' => '3']);
            $this->deleteExistFile($model);
            $model->eventTrans->map(function ($row) {
                $row->update(['status' => '3']);
            });
            $data['msg'] = 'Category deleted successfully.';
            $data['status'] = 200;
        } else {
            $data['msg'] = 'Category details not found.';
        }
        return response()->json($data);
    }

    private function AvatarUpload($file)
    {
        $img_name = NULL;
        if ($file) {
            $img_name = Str::random(16) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/frontend/category/'); //public path folder dir
            $file->move($destinationPath, $img_name);
            //$file->storeAs('uploads/frontend/category/', $img_name, 'public');
        }
        return $img_name;
    }
}

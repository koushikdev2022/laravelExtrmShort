<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\Datatables\Datatables;
use App\Traits\HelperTrait;
use App\Models\{Keyword, Category,TranslationCategory};
use Illuminate\Support\Facades\Validator;


class KeywordController extends AdminController
{
    use HelperTrait;

    public function index()
    {
        $data = [];
        $data = Keyword::where('status', "<>", "3")->get();
        return view('admin::keywords.index', compact('data'));
    }


    public function create()
    {
        $categories = Category::select('categories.*', 'translation_categories.category_name')->leftJoin('translation_categories', 'translation_categories.category_id', 'categories.id')
            ->where('categories.status', '<>', '3')->where('translation_categories.lang_code', 'en')->get();
        return view('admin::keywords.create', compact('categories'));
    }

    public function post_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'category' => 'required',
            'status' => 'required'
        ]);

        if ($validator->passes()) {
            Keyword::create([
                'name' => $request->name,
                'category' => $request->category,
                'status' => $request->status
            ]);
            $request->session()->flash('success', 'Keyword Created successfully.');
        } else {
            return redirect()->route('admin-addkeyword')->withErrors($validator)->withInput();
        }
        return redirect()->route('admin-keyword')->withErrors($validator)->withInput();
    }


    public function edit($id)
    {
        $nid = base64_decode($id);
         $model = Keyword::where('id', '=', $nid)->where('status', '<>', '3')->first();
        if($model != ''){
            $categories = Category::select('categories.*', 'translation_categories.category_name')->leftJoin('translation_categories', 'translation_categories.category_id', 'categories.id')
                ->where('categories.status', '<>', '3')->where('translation_categories.lang_code', 'en')->get();
            return view('admin::keywords.edit', compact('categories','model'));
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    public function post_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'category' => 'required',
            'status' => 'required'
        ]);

        if ($validator->passes()) {
            $model = Keyword::findOrFail($id);
            if($model != ''){
                $model->update([
                    'name' => $request->name,
                    'category' => $request->category,
                    'status' => $request->status
                ]);
                $request->session()->flash('success', 'Keyword Updated successfully.');
            }else{
                $request->session()->flash('error', 'Something went wrong');
            }
           
        } else {
            return redirect()->route('admin-addkeyword')->withErrors($validator)->withInput();
        }
        return redirect()->route('admin-keyword')->withErrors($validator)->withInput();
    }


    public function keyword_list()
    {
        $keyword_list = Keyword::where('status', '<>', '3');
        return Datatables::of($keyword_list)
            ->addIndexColumn()
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('category', function ($model) {
                if($model->category != ''){
                    $lang = session()->get('locale');
                    $data = TranslationCategory::where(['category_id'=>$model->category])->where('lang_code', '=', $lang)->first();
                   return $data->category_name;
                }else{
                    return $model->category;
                }
              
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->editColumn('status', function ($model) {
                return $model->status;
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-editkeyword', ['id' => base64_encode($model->id)]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
                    . '<i class="fa fa-edit"></i>'
                    . '</a>'
                    . '<a href="javascript:void(0);" onclick="deleteKeyword(this);"   data-href="' . Route('admin-deletekeyword', ['id' => $model->id]) . '"  class="btn btn-outline btn-circle btn-sm dark">'
                    . '<i class="fa fa-trash"></i>'
                    . '</a>';
                return $action_html;
            })
            ->make(true);
    }


    public function destroy(Request $request)
    {
        if (isset($_GET['id']) && $_GET['id'] != "") {
            $model = Keyword::findOrFail($_GET['id']);
            if (!empty($model) && $model->status != '3') {
                $model->status = '3';
                $model->save();
                $request->session()->flash('success', 'Deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-keyword');
    }
}

<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use App\Models\Seo;

class SeoController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        $data = [];
        $data['route'] = $route = isset($_GET['route']) ? $_GET['route'] : "";
        $data['title'] = $title = isset($_GET['title']) ? $_GET['title'] : "";
        $data['keyword'] = $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
        $data['search_filter'] = isset($_GET['search_filter']) ? $_GET['search_filter'] : "";
        $query = Seo::where('route', 'like', '%' . $route . '%');
        if ($route != "") {
            $query->where('route', 'like', '%' . $route . '%');
        }
        if ($title != "") {
            $query->where('title', 'like', '%' . $title . '%');
        }
        if ($keyword != "") {
            $query->where('keyword', 'like', '%' . $keyword . '%');
        }
        $model = $query->paginate(10);
        $data['model'] = $model;
        return view('admin::seo.index', $data);
    }

    public function view($id) {
        $data = [];
        $data['model'] = Seo::findOrFail($id);
        return view('admin::seo.view', $data);
    }

    public function get_update($id) {
        $data = [];
        $data['model'] = Seo::findOrFail($id);
        return view('admin::seo.update', $data);
    }

    public function post_update(Request $request, $id) {
        $data = [];
        $model = Seo::findOrFail($id);
        $validator = Validator::make($request->all(), [
                    'title' => 'max:200',
                    'keyword' => 'max:255',
        ]);
        if ($validator->passes()) {
            $model->title = $request->title;
            $model->keyword = $request->keyword;
            $model->description = $request->description;
            $model->save();
            $request->session()->flash('success', 'SEO updated successfully.');
        }
        return redirect()->route('admin-updateseo', ['id' => $id])->withErrors($validator)->withInput();
    }

}

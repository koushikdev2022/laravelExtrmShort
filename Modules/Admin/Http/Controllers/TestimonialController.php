<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use App\Models\{Testimonial};
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\File;


class TestimonialController extends AdminController
{
    use HelperTrait;


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function testimonial_index()
    {
        $data = [];
        return view('admin::testimonial.index', $data);
    }

    public function get_testimonial_data()
    {
        $testimonial_list = Testimonial::where('status', '<>', '3')->where('lang_code', 'en')->orderby('id', 'desc')->get();
        return Datatables::of($testimonial_list)
            ->addIndexColumn()
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('over_all_rating', function ($model) {
                return $model->over_all_rating;
            })

            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->editColumn('status', function ($model) {
                return $model->status;
            })
            ->addColumn('action', function ($model) {
                $action_html = '<a href="' . Route('admin-edittestimonial', [base64_encode($model->id)]) . '" class="btn btn-outline btn-circle btn-sm purple">
                <i class="fa fa-edit"></i>
            </a>' . '<a href="javascript:void(0);" onclick="deleteTestimonial(this);" data-href="' . Route("admin-deletetestimonial", ['id' => base64_encode($model->id)]) . '" data-id="' . $model->id . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
                    . '<i class="fa fa-trash"></i>'
                    . '</a>';
                return $action_html;
            })
            ->make(true);
    }

    public function testimonial_add()
    {
        return view('admin::testimonial.add');
    }

    public function testimonial_post_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'subtitle' => 'required',
            'over_all_rating' => 'required',
            'location' => 'required',
            'image' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        if ($validator->passes()) {

            $input = new Testimonial;
            $input->name = $request->name;
            $input->over_all_rating = $request->over_all_rating;
            $input->location = $request->location;
            $image = $request->file('image');

            $name = $this->rand_string(50) . time() . '.' . $image->getClientOriginalExtension(); //get the file extention
            // Image::make($image)->resize(207, 181)->save(public_path('uploads/admin/testimonial_image/preview/') .  $name);
            $destinationPath = public_path('uploads/admin/testimonial_image/original/'); //public path folder dir
            $image->move($destinationPath, $name);
            $input->image = $name;
            $input->lang_code = 'en';
            $input->description = $request->description;
            $input->subtitle = $request->subtitle;
            $input->status = '1';
            $input->created_at = date("Y-m-d h:i:s");
            $input->save();
            $request->session()->flash('success', 'Testimonial added Successfully.');
            return redirect()->route('admin-testimonial')->withErrors($validator)->withInput();
        } else {
            return redirect()->route('admin-addtestimonial')->withErrors($validator)->withInput();
        }
    }

    public function testimonial_edit($id)
    {
        $data = [];
        $data['testimonial'] = Testimonial::where(['id' => base64_decode($id)])->first();
        return view('admin::testimonial.update', $data);
    }

    public function testimonial_post_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'subtitle' => 'required',
            'over_all_rating' => 'required',
            'location' => 'required',
            // 'image' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        if ($validator->passes()) {

            $testimonial = Testimonial::where(['id' => base64_decode($id)])->first();
            if ($testimonial != '') {

                if ($request->has('image')) {
                    $image = $request->file('image');
                    $name = $this->rand_string(50) . time() . '.' . $image->getClientOriginalExtension(); //get the file extention
                    // Image::make($image)->resize(207, 181)->save(public_path('uploads/admin/testimonial_image/preview/') .  $name);
                    $destinationPath = public_path('uploads/admin/testimonial_image/original/'); //public path folder dir
                    $image->move($destinationPath, $name);
                    $testimonial->image = $name;
                } else {
                    $testimonial->image = $testimonial->image;
                }

                $testimonial->name = $request->name;
                $testimonial->over_all_rating = $request->over_all_rating;
                $testimonial->location = $request->location;

                $testimonial->lang_code = 'en';
                $testimonial->description = $request->description;
                $testimonial->subtitle = $request->subtitle;
                $testimonial->status = '1';
                $testimonial->created_at = date("Y-m-d h:i:s");
                $testimonial->save();
                $request->session()->flash('success', 'Testimonial updated Successfully.');
                return redirect()->route('admin-testimonial')->withErrors($validator)->withInput();
            }
        } else {
            return redirect()->route('admin-edittestimonial',$id)->withErrors($validator)->withInput();
        }
    }

    private function deleteExistFile($model)
    {
        if ($model->getRawOriginal('image') && File::exists(public_path('uploads/admin/testimonial_image/original/' . $model->getRawOriginal('image')))) {
            File::delete(public_path('uploads/admin/testimonial_image/original/' . $model->getRawOriginal('image')));
        }
    }

    public function testimonial_delete(Request $request, $id)
    {

        if (isset($id) && $id != "") {
            $model = Testimonial::findOrFail(base64_decode($id));
            if (!empty($model) && $model->status != '3') {
                $model->update(['status' => '3']);
                $this->deleteExistFile($model);

                $request->session()->flash('success', 'Testimonial deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-testimonial');
    }
}

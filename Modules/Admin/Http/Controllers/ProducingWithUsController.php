<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use App\Models\{ProducingWithUs};
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\File;


class ProducingWithUsController extends AdminController
{
    use HelperTrait;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $model = ProducingWithUs::where(['status'=>'1'])->paginate(5);
        return view('admin::producing_with_us.index', compact('model'));
    }

    public function add()
    {
        return view('admin::producing_with_us.add');
    }

    public function post_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'status' => 'required',
        ]);

        if ($validator->passes()) {

            $input = new ProducingWithUs;
            
            $image = $request->file('image');

            $name = $this->rand_string(50) . time() . '.' . $image->getClientOriginalExtension(); //get the file extention

            $destinationPath = public_path('uploads/admin/producing_image/'); //public path folder dir
            $image->move($destinationPath, $name);
            $input->image = $name;
           
            $input->status = '1';
            $input->created_at = date("Y-m-d h:i:s");
            $input->save();
            $request->session()->flash('success', 'Added Successfully.');
            return redirect()->route('admin-producing_with_us')->withErrors($validator)->withInput();
        } else {
            return redirect()->route('admin-addproducing_with_us')->withErrors($validator)->withInput();
        }
    }

    public function edit($id)
    {
        $data = [];
        $data['producing'] = ProducingWithUs::where(['id' => base64_decode($id)])->first();
        return view('admin::producing_with_us.update', $data);
    }

    public function post_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // 'image' => 'required',
            'status' => 'required',
        ]);

        if ($validator->passes()) {

            $producing = ProducingWithUs::where(['id' => base64_decode($id)])->first();
            if ($producing != '') {

                if ($request->has('image')) {

                    $image = $request->file('image');
                    $name = $this->rand_string(50) . time() . '.' . $image->getClientOriginalExtension(); //get the file extention

                    $destinationPath = public_path('uploads/admin/producing_image/'); //public path folder dir
                    $image->move($destinationPath, $name);
                    $producing->image = $name;
                } else {
                    $producing->image = $producing->image;
                }

                $producing->status = '1';
                $producing->created_at = date("Y-m-d h:i:s");
                $producing->save();
                $request->session()->flash('success', 'Updated Successfully.');
                return redirect()->route('admin-producing_with_us')->withErrors($validator)->withInput();
            }
        } else {
            return redirect()->route('admin-editproducing_with_us', $id)->withErrors($validator)->withInput();
        }
    }

    private function deleteExistFile($model)
    {
        if ($model->getRawOriginal('image') && File::exists(public_path('uploads/admin/producing_image/' . $model->getRawOriginal('image')))) {
            File::delete(public_path('uploads/admin/producing_image/' . $model->getRawOriginal('image')));
        }
    }

    public function delete(Request $request, $id)
    {
        if (isset($id) && $id != "") {
            $model = ProducingWithUs::findOrFail(base64_decode($id));
            if (!empty($model) && $model->status != '3') {
                $model->update(['status' => '3']);
                $this->deleteExistFile($model);

                $request->session()->flash('success', 'Deleted successfully.');
            } else {
                $request->session()->flash('danger', 'Oops. Something went wrong.');
            }
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-producing_with_us');
    }
}

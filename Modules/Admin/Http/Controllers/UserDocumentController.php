<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
// ************ Requests ************
use Yajra\DataTables\Facades\DataTables;
use App\Models\UserDocument;
use App\Models\UserMaster;
use App\Models\UserVerification;
use App\Traits\HelperTrait;
use Modules\Admin\Http\Requests\UserDocumentUpdateRequest;

class UserDocumentController extends AdminController
{
    use HelperTrait;
    public function index(Request $request)
    {
        $user_id = $request->has('uid') ? base64_decode($request->input('uid')) : '';
        if ($request->ajax()) {
            $data = UserDocument::query()->where('user_id', $user_id);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('user-documents.show', base64_encode($row->id)) . '" class="btn btn-circle btn-sm btn-info">
                                        <i class="fa fa-eye"></i> View
                            </a>';
                })
                // ->editColumn('user_id', function ($row) {
                //     return !empty($row->user) ? $row->user->name() : '';
                // })
                ->editColumn('document_type', function ($row) {
                    $dcouments = $this->getUserDocumentType();
                    return isset($dcouments[$row->document_type]) ? $dcouments[$row->document_type] : '';
                })
                ->editColumn('created_at', function ($row) {
                    return !empty($row->created_at) ? date('jS M Y, g:i A', strtotime($row->created_at)) : 'N/A';
                })
                ->editColumn('status', function ($row) {
                    $status_html = '';
                    if ($row->status === '0') {
                        $status_html = '<span class="label label-sm label-warning">Pending</span>';
                    } elseif ($row->status === '1') {
                        $status_html = '<span class="label label-sm label-info">Approved</span>';
                    } elseif ($row->status === '3') {
                        $status_html = '<span class="label label-sm label-danger">Rejected</span>';
                    }
                    return  $status_html;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        $user = UserMaster::find($user_id);
        return view('admin::users.document.index', compact('user'));
    }


    public function show($id)
    {
        $data = [];
        $cid = base64_decode($id);
        $data['model'] = $model = UserDocument::where('id', $cid)->first();
        if (!empty($model)) {
            $data['user'] = UserMaster::find($model->user_id);
            $data['documents'] = $this->getUserDocumentType();
            return view('admin::users.document.view', $data);
        }
        return response()->back()->with('danger', 'Sorry! No user documents found.');
    }

    public function update(UserDocumentUpdateRequest $request, $id)
    {
        $data = [
            'status' => 400,
            'msg' => 'No user document found.',
        ];
        $cid = base64_decode($id);
        $model = UserDocument::where('id', $cid)->first();
        $input = $request->input();
        $flag = 0;
        if (!empty($model) && $model->document_type === '10') {
            $flag = 1;
        } elseif (!empty($model) && $model->status === '0') {
            $flag = 1;
        }
        if ($flag === 1) {
            $model->update($input);
            $arr = [
                'user_id' => $model->user_id,
                'identity' => ($model->status === '1') ? '1' : '0',
            ];
            if ($model->document_type == '6') {
                $arr['business_registration'] = ($model->status === '1') ? '1' : '0';
            } elseif ($model->document_type == '7') {
                $arr['premises_photo'] = ($model->status === '1') ? '1' : '0';
            } elseif ($model->document_type == '8') {
                $arr['internet_speed'] = ($model->status === '1') ? '1' : '0';
            } elseif ($model->document_type == '10') {
                $arr['business_audit'] = ($model->status === '1') ? '1' : '0';
            }
            $model->user->verification()->update($arr);
            ///Notification 
            if ($model->document_type === '10') {
                $msg = 'The audit ' . ($model->status === '1' ? 'completed' : ($model->status === '0' ? 'rescheduled' : 'cancled')) . ' successfully.';
            } else {
                $msg = 'Your identity verification ' . ($model->status === '1' ? 'approved' : 'rejected');
            }
            $this->makeNotification([
                'notifier_id' => $model->user_id,
                'from_id' => 1,
                'message' => $msg,
                'url' => url('user/verification'),
            ]);
            $data['status'] = 200;
            if ($model->document_type === '10') {
                $data['msg'] = $msg;
                $data['link'] = route('admin-viewuser', base64_encode($model->user_id));
            } else {
                $data['msg'] = 'user document ' . ($model->status === '1' ? 'approved' : 'rejected') . ' successfully.';
                $data['link'] = route('user-documents.show', $id);
            }
        } elseif (!empty($model) && $model->document_type !== '10' && $model->status !== '0') {
            $data['msg'] = 'user document has already been ' . ($model->status === '1' ? 'approved' : 'rejected');
        }

        return response()->json($data);
    }

    public function updateDocument(Request $request, $id, $type)
    {
        $data = [
            'status' => 400,
            'msg' => 'No user document found.',
        ];
        $cid = base64_decode($id);
        $model = UserDocument::where('id', $cid)->first();
        $input = $request->input();
        $status = '3';
        if ($type == 'approve') {
            $status = '1';
        }
        $input['status'] = $status;
        $flag = 0;
        if (!empty($model) && $model->document_type === '10') {
            $flag = 1;
        } elseif (!empty($model) && $model->status === '0') {
            $flag = 1;
        }
        $model->update($input);
        if ($flag === 1) {
            $arr = [
                'user_id' => $model->user_id,
            ];
            if ($model->document_type == '6') {
                $arr['business_registration'] = ($model->status === '1') ? '1' : '0';
            } elseif ($model->document_type == '7') {
                $arr['premises_photo'] = ($model->status === '1') ? '1' : '0';
            } elseif ($model->document_type == '8') {
                $arr['internet_speed'] = ($model->status === '1') ? '1' : '0';
            } elseif ($model->document_type == '2') {
                $total_identity = UserDocument::where(['user_id' => $model->user_id, 'status' => '1'])->whereIn('document_type', ['front', 'rear', 'selfi'])->count();
                $arr['identity'] = $total_identity >= 3 ? '1' : '0';
            }
            $model->user->verification()->update($arr);
            ///Notification 
            $msg = 'User docuemnt verification ' . ($model->status === '1' ? 'approved' : 'rejected');
            $this->makeNotification([
                'notifier_id' => $model->user_id,
                'from_id' => 1,
                'message' => $msg,
                'url' => url('user/verification'),
            ]);
            $data['status'] = 200;
            $data['msg'] = 'user document ' . ($model->status === '1' ? 'approved' : 'rejected') . ' successfully.';
        } elseif (!empty($model) && $model->document_type !== '10' && $model->status !== '0') {
            $data['msg'] = 'user document has already been ' . ($model->status === '1' ? 'approved' : 'rejected');
        }

        $total_documents = UserDocument::where(['user_id' => $model->user_id, 'status' => '1'])->whereIn('document_type', ['11', '12', '13'])->count();

        $total_identities = UserDocument::where(['user_id' => $model->user_id, 'status' => '1'])->whereIn('document_type', ['2'])->count();
        
        if($total_identities==3)
        {
            $UserVerification=UserVerification::where('user_id',$model->user_id)->first();
            $UserVerification->identity='1';
            $UserVerification->save();
        }

        if($total_documents==3)
        {
            $UserVerification=UserVerification::where('user_id',$model->user_id)->first();
            $UserVerification->documents='1';
            $UserVerification->save();
        }
            
        

        $data['link'] = route('user-documents.show', $id);
        return response()->json($data);
    }
}
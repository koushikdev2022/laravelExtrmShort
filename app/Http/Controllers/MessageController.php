<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventUploadPhotoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB;
use Validator;
use App\Traits\HelperTrait;

// ************ Requests ************
use App\Http\Requests\SendMessageRequest;
use App\Http\Requests\ManageConnectionStatusRequest;
// ************ Models ************
use App\Models\UserMaster;
use App\Models\Message;
use App\Models\MessageConnection;
use App\Models\Project;
use App\Models\ExtendExpireDate;

define('SCROLL_OFFSET', 5);

class MessageController extends Controller
{
    use HelperTrait;
    
    public function get_messages(Request $request,$code = NULL)
    {
        $date=date('Y-m-d');
        // dd($date);
        $user=Auth::guard('frontend')->user();
        if($user->type_id==3)
        {
            $ExtendExpireDate=ExtendExpireDate::where('end_date','>',$date)->where('user_id',$user->id)->orderBy('id','DESC')->first();
            $user_subscription_user=ExtendExpireDate::where('user_id',$user->id)->orderBy('id','DESC')->first();
            if(!empty($user_subscription_user))
            {
                if(!empty($ExtendExpireDate))
                {
                    if (!empty($code)) { 
                        $this->checkAndMakeConnection($code, auth()->guard('frontend')->user()->id);
                    }
                    $response = $this->getRecipients();
                    $recipients = $response['recipients'];
                    $connection_arr = $response['connection_arr'];
                    $project_arr = $response['project_arr'];
                    $connection_bid_codes = $response['codes'];
                    $message_user_id=base64_decode($code);
                    return view('message.messages', compact('recipients', 'connection_arr', 'project_arr', 'code', 'connection_bid_codes','message_user_id'));
                }else{
                    $request->session()->flash('error', 'Your subscription plan has been expired.');
                    return redirect()->route('user.subscription');
                }
    
            }else{
                $request->session()->flash('error', 'Please select any subscription plan first');
                return redirect()->route('user.subscription');
            }

        }else{
            if (!empty($code)) { 
            $this->checkAndMakeConnection($code, auth()->guard('frontend')->user()->id);
            }
            $response = $this->getRecipients();
            $recipients = $response['recipients'];
            $connection_arr = $response['connection_arr'];
            $project_arr = $response['project_arr'];
            $connection_bid_codes = $response['codes'];
            $message_user_id=base64_decode($code);
            return view('message.messages', compact('recipients', 'connection_arr', 'project_arr', 'code', 'connection_bid_codes','message_user_id'));
        }
    

        
    
    }


    private static function getRecipients()
    {
        $recipients = [];
        $codes = [];
        $connection_arr = [];
        $project_arr = [];
        $user_id = Auth()->guard('frontend')->user()->id;
        $now = date('Y-m-d H:i:s');
        $sql1 = 'select id,from_user_id,to_user_id,bid_code,project_id,TIMESTAMPDIFF(SECOND, updated_at, "' . $now . '") as time from message_connections where (((from_user_id=' . $user_id . ') or (to_user_id=' . $user_id . ')) and status IN ("0","1","2")) ORDER BY time ASC';
        $connections = DB::select(DB::raw($sql1));
        if (sizeof($connections) > 0) {
            foreach ($connections as $connection) {
                $opponent_id = ($connection->from_user_id !== $user_id) ? $connection->from_user_id : $connection->to_user_id;
                if (!in_array($opponent_id, $recipients)) {
                    array_push($recipients, $opponent_id);
                    array_push($connection_arr, $connection->id);
                    $project = Project::find($connection->project_id);
                    array_push($project_arr, $project->title ?? '');
                    array_push($codes, $connection->bid_code ?? '');
                }
            }
        }

        return ['recipients' => $recipients, 'connection_arr' => $connection_arr, 'project_arr' => $project_arr, 'codes' => $codes];
    }

    public function lastOnlineTimeUpdate(Request $request)
    {
        if ($request->ajax()) {
            $data = [];
            $user_id = Auth()->guard('frontend')->user()->id;
            $user_model = UserMaster::where('id', $user_id)->first();
            if (!empty($user_model)) {
                $user_model->update(['last_online_at' => date('Y-m-d H:i:s')]);
            }
            $now = date('Y-m-d H:i:s');
            $recipients = [];
            $connection_arr = [];
            $sql1 = 'select id,from_user_id,to_user_id,TIMESTAMPDIFF(SECOND, updated_at, "' . $now . '") as time,status from message_connections where (((from_user_id=' . $user_id . ') or (to_user_id=' . $user_id . ')) and status IN ("0","1")) ORDER BY time ASC';
            $connections = DB::select(DB::raw($sql1));

            if (sizeof($connections) > 0) {
                foreach ($connections as $connection) {
                    $opponent_id = ($connection->from_user_id !== $user_id) ? $connection->from_user_id : $connection->to_user_id;
                    if (!in_array($opponent_id, $recipients)) {
                        array_push($recipients, $opponent_id);
                        array_push($connection_arr, $connection->id);
                    }
                }
            }
            if (!empty($recipients)) {
                $now = date('Y-m-d H:i:s');
                foreach ($recipients as $key => $id) {
                    $user = UserMaster::selectRaw('id,TIMESTAMPDIFF(SECOND, last_online_at, "' . $now . '") as time')->where('id', $id)->first();
                    if (isset($user->time) && ($user->time < 10 || $user->time === 0)) {
                        $data['users'][$id]['status'] = 'online';
                    } else {
                        $data['users'][$id]['status'] = 'offline';
                    }
                    $data['users'][$id]['msg'] = '';
                    $last_message = Message::where(['connection_id' => $connection_arr[$key]])->latest()->first();
                    if (!empty($last_message)) {
                        $msg = '<p class="preview" style="' . (($last_message->from_user_id == $id && $last_message->is_read === '0') ? 'font-weight:700;' : '') . '">';
                        if ($last_message->message_type === '3') :
                            $msg .= Str::limit($last_message->message, 25);
                        else :
                            $msg .= 'Media file send.';
                        endif;
                        $msg .= '</p>';
                        $data['users'][$id]['msg'] = $msg;
                    }

                    $total_unread_message = Message::where(['from_user_id' => $id, 'is_read' => '0'])->count();
                    $data['users'][$id]['unread'] = ($total_unread_message > 100) ? '100+' : $total_unread_message;
                }
            }
            $data['total_unread_msg'] = Message::where(['to_user_id' => $user_id, 'is_read' => '0'])->count();

            $data['res'] = 'success';
            return response()->json($data);
        }
    }

    public function fetchMessages(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $receiver_id = Auth()->guard('frontend')->user()->id;
            $data['html'] = '<div class="col-md-12">
                                    <div class="alert alert-info text-center" role="alert">
                                        Sorry! No messages found.
                                    </div> 
                                </div> ';
            $data['total_msg'] = 'No';
            $sender_id = $request->input('fatch_id');
            $offet = $request->input('scroll_offset');
            $connectionid = $request->input('connectionid');
            $last_as = 0;
            if (!empty($sender_id)) {
                $connection = MessageConnection::findorFail($connectionid);
                $data['connection_id'] = $connection->id ?? '';
                $data['connection_receiver_id'] = $connection->to_user_id ?? '';
                $data['connection_update_id'] = $connection->updated_by ?? '';
                $data['c_status'] = $connection->status ?? '';
                $data['usemode'] = 3;
				$data['encode_model_id'] = base64_encode($sender_id);

                $totalMsg = Message::where('connection_id', $connectionid)->count();
                $skip = ($totalMsg > 5) ? $totalMsg - SCROLL_OFFSET : 0;

                $messages = Message::where('connection_id', $connectionid)->take(10)->skip($skip)->orderBy('id', 'ASC')->get();

                $not_read_messages = Message::where('connection_id', $connectionid)->where('to_user_id', $receiver_id)->where('is_read', '0')->get();
                if (sizeof($not_read_messages) > 0) {
                    foreach ($not_read_messages as $not_read_message) {
                        $not_read_message->update(['is_read' => '1']);
                    }
                }

                if (sizeof($messages) > 0) {
                    $data['html'] = view('message.fetch_body', compact('messages', 'last_as'))->render();
                    $data['total_msg'] = sizeof($messages);
                }
                $data['usemode'] = 3;
            }
            return response()->json($data);
        }
    }

    public function prependMessages(Request $request) {
        if ($request->ajax()) {
            // dd($request->input());
            $data = [];
            $receiver_id = Auth()->guard('frontend')->user()->id;
            $data['html'] = '';
            $data['total_msg'] = 'No';
            $sender_id = $request->input('fetch_id');
            $scrolloffset = $request->input('scroll_offset');
            $connectionid = $request->input('connectionid');
            $last_as = 0;
            if (!empty($sender_id)) {
                $connection = MessageConnection::where('id', $connectionid)->first();
                $data['connection_id'] = $connection->id ?? '';
                $data['connection_receiver_id'] = $connection->to_user_id ?? '';
                $data['connection_update_id'] = $connection->updated_by ?? '';
                $data['c_status'] = $connection->status ?? '';
                $totalMsg = Message::where('connection_id', $connectionid)->count();

                $offset = ($scrolloffset >= SCROLL_OFFSET) ? $totalMsg - $scrolloffset : $totalMsg - (2 * SCROLL_OFFSET);

                if ($totalMsg > $scrolloffset) {
                    $messages = Message::where('connection_id', $connectionid)->take(SCROLL_OFFSET)->skip($offset)->orderBy('id', 'ASC')->get();
                    
                    if (sizeof($messages) > 0) {
                        $data['html'] = view('message.fetch_body', compact('messages', 'last_as'))->render();
                        $data['status'] = 200;
                    }
                }else{
                    $messages = Message::where('connection_id', $connectionid)->take(SCROLL_OFFSET)->skip(0)->orderBy('id', 'ASC')->get();
                    
                    if (sizeof($messages) > 0) {
                        $data['html'] = view('message.fetch_body', compact('messages', 'last_as'))->render();
                        $data['status'] = 200;
                    }
                }
                $data['totalMsg'] = $totalMsg;
                $data['offset'] = ($scrolloffset == 0) ? (3 * SCROLL_OFFSET) : $scrolloffset + SCROLL_OFFSET;
                
            }
            return response()->json($data);
        }
    }


    public function post_message(SendMessageRequest $request)
    {
        if ($request->ajax()) {
            $data = [];
            $user = Auth()->guard('frontend')->user();
            $input = $request->all();
            $input['to_user_id'] = $request->input('receiver_id');
            $input['from_user_id'] = $user->id;
            $isMedia = $request->has('media_file') ? $request->input('media_file') : NULL;
            if ($isMedia == 1 && !empty($request->input('upload_file_names'))) {
                $input['message_type'] = '5';
//                $input['message'] = '';
                // $input['message'] = $request->file('file_name')->getClientOriginalName();
                // if (str_contains($request->file('file_name')->getClientMimeType(), 'image/')) {
                //     $input['message_type'] = '4';
                // }
                $_file_names = [];
                foreach ($request->input('upload_file_names') as $file_name) {
                    array_push($_file_names, $file_name);
                }
                // foreach ($request->input('upload_file_names') as $file) {
                //     $name = $this->rand_string(15) . time() . '.' . $file->getClientOriginalExtension(); //get the  file extention
                //     $destinationPath = public_path('storage/uploads/frontend/messages/'); //public path folder dir
                //     $file->move($destinationPath, $name);
                //     array_push($_file_names, $name);
                // }
                $input['file_name'] = implode(',', $_file_names);
            } else {
                $input['file_name'] = NULL;
                $input['message_type'] = '3';
            }

            $last_as = $request->input('last_message_as');
            $message_model = Message::create($input);
            $message = Message::findorFail($message_model->id);
            if (!empty($message->connection_id)) :
                $connection = MessageConnection::where('id', $message->connection_id)->first();
                if (!empty($connection)) {
                    $connection->updated_at = date('Y-m-d H:i:s');
                    $connection->save();
                }
            endif;
            $data['usemode'] = 3;
            $data['message'] = view('message.fetch_body', ['messages' => [$message], 'last_as' => $last_as])->render();
            $data['status'] = 200;
            return response()->json($data);
        }
    }

    public function updateMessages(Request $request) {
        if ($request->ajax()) {
            // dd($request->input());
            $data = [];
            $receiver_id = Auth()->guard('frontend')->user()->id;
            $sender_id = $request->input('fatch_id');
            $last_id = $request->input('last_id');
            $connectionid = $request->input('connectionid');
            $last_as = $request->input('last_as');

            if (!empty($sender_id)) {
                $messages = Message::where('id', '>', $last_id)->where('connection_id', $connectionid)->get();

                if (sizeof($messages) > 0) {
                    foreach ($messages as $message) {
                        if ($message->to_user_id == $receiver_id) {
                            $message->update(['is_read' => '1']);
                        }
                    }
                }

                $connection = MessageConnection::findorFail($connectionid);

                $data['connection_id'] = $connection->id ?? '';
                $data['connection_receiver_id'] = $connection->to_user_id ?? '';
                $data['connection_update_id'] = $connection->updated_by ?? '';
                $data['c_status'] = $connection->status ?? '';

                //                $fromuser = User::select('mode_of_chat')->where('id', $connection->to_user_id)->first();
                //                $data['usemode'] = (isset($fromuser->mode_of_chat) && $connection->chat_process === '0') ? $fromuser->mode_of_chat : 2;
                $data['usemode'] = 3;
                if (sizeof($messages) > 0) {
                    $data['status'] = 200;
                    $data['html'] = view('message.fetch_body', compact('messages', 'last_as'))->render();
                    $data['add_msg'] = sizeof($messages);
                } else {
                    $data['msg'] = __('messages.No New message found.');
                }
            }
            return response()->json($data);
        }
    }

    public function saveConnection(Request $request, $status)
    {
        if ($request->ajax()) {
            $data = [];
            $data['open'] = 0;
            $connection = $request->input('connectionid');
            if (!empty($connection)) {
                $connection_model = MessageConnection::findorFail($connection);
                if (!empty($connection_model)) {
                    $connection_model->update(['status' => $status]);
                    if ($connection_model->status === '1') {
                        $data['open'] = 1;
                        $data['msg'] = 'Now you can chat with each other.';
                        $fromuser = UserMaster::where('id', $connection_model->to_user_id)->first();
                        $data['usemode'] = 2;
                    } else if ($connection_model->status === '3') {
                        $data['open'] = 3;
                    }
                }
            }
            return response()->json($data);
        }
    }

    public function get_record_modal(Request $request)
    {
        if ($request->ajax()) {
            $data = [];
            $data['content'] = view('message.record_file')->render();
            return response()->json($data);
        }
    }

    public function manage_connection_status(ManageConnectionStatusRequest $request, $state)
    {
        if ($request->ajax()) {
            $data = [];
            $connection_id = $request->input('connectionid');
            $user_id = Auth()->guard('frontend')->user()->id;
            if ($state == 'block') {
                $status = '2';
            } else {
                $status = '1';
            }
            $checkConnection = MessageConnection::where('id', $connection_id)->first();
            if (!empty($checkConnection) && $checkConnection->status != $status) {
                $checkConnection->update(['status' => $status, 'updated_by' => $user_id]);
                $data['status'] = 200;
            } else {
                $data['status'] = 400;
            }
            return response()->json($data);
        }
    }

    private function mediaUpload(Request $request, $fname)
    {
        if ($request->hasFile($fname)) {  //check the file present or not
            $image = $request->file($fname); //get the file
            $name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
            $destinationPath = public_path('storage/uploads/frontend/messages/'); //public path folder dir
            $image->move($destinationPath, $name);
            return $name;
        }
    }

    public function UpdatelastOnlineTime(Request $request)
    {
        if ($request->ajax()) {
            $data = [];
            $user_id = Auth()->guard('frontend')->user()->id;
            $user_model = UserMaster::where('id', $user_id)->first();
            if (!empty($user_model)) {
                $user_model->update(['last_online_at' => date('Y-m-d H:i:s')]);
            }
            return response()->json($data);
        }
    }
    public function fileuploadforuploader(EventUploadPhotoRequest $request)
    {
        if ($request->ajax()) {
            if ($request->hasFile('filedata')) {
                $data['name'] = $this->mediaUpload($request, 'filedata');
            }
            $data['msg'] = 'Your file upload successfully.';
            $data['status'] = 200;
            return response()->json($data);
        }
    }

    public function add_user_autocomplete(Request $request)
    {
        $user_id = Auth()->guard('frontend')->user()->id;
        if ($request->ajax()) {
            $data = [];
            $keyword = $request->input('q');
            if (!empty($keyword)) {
                $connection=MessageConnection::where('from_user_id',$user_id)->where('status','1')->pluck('to_user_id')->toArray(); 
                $items = UserMaster::where(function($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('username', 'like', '%' . $keyword . '%');
                })->where('id','<>',$user_id)->whereNotIn('id',$connection)->where('status','1')->get();
                // $items= UserMaster::where('id','<>',$user_id)->whereNotIn('id',$players)->where('name', 'like', '%' . $keyword . '%')->orWhere('username', 'like', '%' . $keyword . '%')->where("status","1")->get();
                if (count($items) > 0) {
                    foreach ($items as $i => $item) {
                        $data[$i]['value'] = $item->name;
                        $data[$i]['id'] = $item->id;
                        $data[$i]['img'] = $item->profile_picture;
                        // $data[$i]['link']=URL::to("product-details",['name'=>$item->product_slug]);
                    }
                } else {
                    $data[0]['value'] = 'No Record Found.';
                    $data[0]['id'] = '';
                    $data[0]['count'] = '0';
                }
            }
            return response()->json($data);
        }
    }


    public function create_message_connection(Request $request)
    {
        
        $user_id = Auth()->guard('frontend')->user()->id;
        $user=MessageConnection::where('from_user_id',$user_id)->where('to_user_id',$request->input('to_id'))->first();
        $validator = Validator::make($request->all(), [
            'to_id' => 'required',
            // 'message' => 'required',
        ]);
        if ($validator->passes()) {
            $data = New MessageConnection;
            $data->from_user_id = $user_id;
            $data->to_user_id = $request->input('to_id');
            $data->message = $request->input('message'); 
            $data->status = '1';          
            $data->created_at = date("Y-m-d h:i:s");
            $data->save();

            // $model = New Notification;
            // $model->notifier_id = $request->input('to_id');
            // $model->from_id = $user_id;
            // $model->notification_type = '7';
            // $model->message = "has invited you to their profile";
            // $model->add_player_id = $data->id;
            // $model->is_view = '0';
            // $model->status = '1';          
            // $model->created_at = date("Y-m-d h:i:s");
            // $model->save();
            $data['status']="success";
            $data['message']="User Added successfully";

        return response()->json($data);

      }else{
        return response()->json(['error' => $validator->errors()], 422);
      }
    
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HelperTrait;
use App\Rules\VideoDuration;
// ************ models ************
use App\Models\{Project, UserStory ,Category, Playlist, Keyword, ProjectInfo,  Checkout, UserMaster, Notification, Commission, Settings, Event};
use Response;
// ************ Requests ************
use File;
use Intervention\Image\ImageManagerStatic as Image;

class ProjectController extends Controller
{
    use HelperTrait;

    public function index()
    {

        $data['commissions'] = Commission::where(['status' => '1'])->get();
        return view('user.addProject', $data);
    }

    //store video file in database from dropzone directly
    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:mp4', new VideoDuration]
        ]);
        $user = Auth()->guard('frontend')->user();

        if ($request->file('file')) {

            $image = $request->file('file'); //get the file
            $name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
            $destinationPath = public_path('uploads/frontend/project/video/'); //public path folder dir

            $image->move($destinationPath, $name);

            $user = Auth()->guard('frontend')->user();

            $ffprobe = \FFMpeg\FFProbe::create();
            $video = $ffprobe->streams(public_path('uploads/frontend/project/video/' . $name))->videos()->first();
            $duration = $ffprobe->streams(public_path('uploads/frontend/project/video/' . $name))->videos()->first()->get('duration');
            $width = $video->get('width');
            $height = $video->get('height');

            if ($width > $height) {
                $orientation = "landscape";
            } else {
                $orientation = "portrait";
            }

            Project::create([
                'video' => $name,
                'video_extension' => $image->getClientOriginalExtension(),
                'video_name' => $image->getClientOriginalName(),
                'status' => '0',
                'user_id' => $user->id,
                'step' => '1',
                'level' => '0',
                'duration' => $duration,
                'orientation' => $orientation
            ]);
        }
        return response()->json(['success' => $name]);
    }

    //remove video from dropzone
    public function removeFile(Request $request)
    {
        $name =  $request->get('name');
        $model = Project::where(['video_name' => $name])->first();
        if (file_exists(public_path('uploads/frontend/project/video/' . $model->video))) {
            File::delete(public_path('uploads/frontend/project/video/' . $model->video));
        }
        return response()->json(['success' => $name]);
    }

    //edit file of video from dropzone
    public function edit_file(Request $request, $id)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:mp4', new VideoDuration]
        ]);

        $data = Project::where('id', $id)->first();
        $user = Auth()->guard('frontend')->user();
        if ($data != '') {
            if (file_exists(public_path('uploads/frontend/project/video/' . $data->video))) {
                File::delete(public_path('uploads/frontend/project/video/' . $data->video));
            }
            if ($request->file('file')) {
                $image = $request->file('file'); //get the file
                $name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
                $destinationPath = public_path('uploads/frontend/project/video'); //public path folder dir
                $image->move($destinationPath, $name);

                $ffprobe = \FFMpeg\FFProbe::create();
                $video = $ffprobe->streams(public_path('uploads/frontend/project/video/' . $name))->videos()->first();
                $duration = $ffprobe->streams(public_path('uploads/frontend/project/video/' . $name))->videos()->first()->get('duration');
                $width = $video->get('width');
                $height = $video->get('height');

                if ($width > $height) {
                    $orientation = "landscape";
                } else {
                    $orientation = "portrait";
                }
                $data->update([
                    'video' => $name,
                    'video_extension' => $image->getClientOriginalExtension(),
                    'video_name' => $image->getClientOriginalName(),
                    'status' => '0',
                    'user_id' => $user->id,
                    'step' => '1',
                    'level' => '0',
                    'duration' => $duration,
                    'orientation' => $orientation
                ]);
            }
        } else {
            if ($request->file('file')) {
                $image = $request->file('file'); //get the file
                $name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
                $destinationPath = public_path('uploads/frontend/project/video'); //public path folder dir
                $image->move($destinationPath, $name);

                Project::create([
                    'video' => $name,
                    'video_extension' => $image->getClientOriginalExtension(),
                    'video_name' => $image->getClientOriginalName(),
                    'status' => '0',
                    'user_id' => $user->id,
                    'step' => '1',
                    'level' => '0'
                ]);
            }
        }
        return response()->json(['success' => $name]);
    }

    public function step1(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|min:50|max:200',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:3072',
        ]);

        $user = Auth()->guard('frontend')->user();

        $query = Project::where(['title' => $request['title'], 'user_id' => $user['id'], 'description' => $request['description'], 'step' => '1'])->orderBy('id', 'desc')->first();
        if ($query == '') {
            $model = Project::where(['user_id' => $user->id, 'step' => '1', 'level' => '0'])->orderBy('id', 'desc')->first();

            if ($request->hasfile('image')) {
                $image = $request->file('image');
                $name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
                $destinationPath = public_path('uploads/frontend/project/image'); //public path folder dir

                $path = public_path('uploads/frontend/project/');
                Image::make($image->getRealPath())->resize(400, 285)->save($path . 'img_preview/' . $name);
                $image->move($destinationPath, $name);
            } else {
                $name = $model->image;
            }
            if ($model != '') {
                $model->update([
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'image' => $name,
                    'footage_code' => $this->generateRandomString(),
                ]);
                $project = Project::where(['user_id' => $user->id, 'step' => '1', 'level' => '0'])->orderBy('id', 'desc')->first();
            } else {
                $project = Project::create([
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'image' => $name,
                    'status' => '0',
                    'user_id' => $user->id,
                    'step' => '1',
                    'level' => '0',
                    'footage_code' => $this->generateRandomString(),
                ]);
            }

            $data['project_id_step2'] = $project->id;
            $data['project_id_step3'] = $project->id;
        } else {
            $data['project_id_step2'] = $query->id;
            $data['project_id_step3'] = $query->id;
        }

        $data['message'] = 'Successfully Moved to Step 2';

        $data['previous'] = 'step1';
        $data['next'] = 'step2';
        $data['draft'] = '0';
        $data['project_li'] = 'steplitwo';
        $data['checkpoint'] = 'step_process1';
        return response()->json($data);
    }

    public function step2(Request $request)
    {
        $request->validate([
            'category' => 'required',
            //'keywords' => 'required|array|min:1',
            //'keywords.*' => 'required|min:1',
            //'playlist_id' => 'required',
            'location' => 'required',
            'event_id'=>'required'
        ]);

        $user = Auth()->guard('frontend')->user();
        $query = Project::where(['category' => $request->category, 'user_id' => $user->id, 'id' => $request->project_id, 'playlist_id' => $request->playlist_id, 'step' => '2'])->orderBy('id', 'desc')->first();
        if ($query == '') {
            $model = Project::where(['id' => $request->project_id, 'user_id' => $user->id])->first();
            if ($model != '') {
                $model->update([
                    'category' => $request->category,
                    'playlist_id' => $request->playlist_id,
                    'location' => $request->location,
                    'keywords' => (isset($request->keywords) && count($request->keywords) > 0) ? implode(",", $request->keywords) : '',
                    'step' => '2',
                    'event_id'=>$request->event_id
                ]);
            }
        }
        $data['message'] = 'Successfully Moved to Step 3';
        $data['previous'] = 'step2';
        $data['next'] = 'step3';
        $data['project_id_step2'] = $request->project_id;
        $data['project_id_step3'] = $request->project_id;
        $data['draft'] = '0';
        $data['project_li'] = 'steplithree';
        $data['checkpoint'] = 'step_process2';
        return response()->json($data);
    }

    public function step3(Request $request)
    {
        $user = Auth()->guard('frontend')->user();
        $query = Project::where(['user_id' => $user->id, 'id' => $request->project_id, 'step' => '3'])->orderBy('id', 'desc')->first();
        if ($query == '') {
            $model = Project::where(['id' => $request->project_id, 'user_id' => $user->id])->first();
            if ($model != '') {
                if (count($request['quality']) > 0) {
                    for ($i = 0; $i < count($request['quality']); $i++) {
                        $data['quality']  = $request['quality'][$i];
                        $data['quality_amount']  = $request['quality_amount'][$i];
                        $data['licence_for']  = (isset($request['licence_for']) ? $request['licence_for'][$i] : '');
                        $data['licence_amount']  = $request['licence_amount'][$i];
                        $res[] = $data;
                    }

                    foreach ($res as $r) {
                        $exists_data = ProjectInfo::where(['quality' => $r['quality'], 'quality_amount' => $r['quality_amount'], 'licence_for' => $r['licence_for'], 'licence_amount' => $r['licence_amount'], 'project_id' => $model->id, 'user_id' => $user->id])->first();
                        if ($exists_data == '') {
                            ProjectInfo::create([
                                'project_id' => $model['id'],
                                'user_id' => $user->id,
                                'quality' =>  $r['quality'],
                                'quality_amount' =>  $r['quality_amount'],
                                'licence_for' =>  $r['licence_for'],
                                'licence_amount' =>  $r['licence_amount'],
                                'created_at' =>  \Carbon\Carbon::now(),
                                'total' => ($r['quality_amount'] + $r['licence_amount'])
                            ]);
                        } else {
                            $exists_data->update([
                                'project_id' => $model['id'],
                                'user_id' => $user->id,
                                'quality' =>  $r['quality'],
                                'quality_amount' =>  $r['quality_amount'],
                                'licence_for' =>  $r['licence_for'],
                                'licence_amount' =>  $r['licence_amount'],
                                'updated_at' =>  \Carbon\Carbon::now(),
                                'total' => ($r['quality_amount'] + $r['licence_amount'])
                            ]);
                        }
                    }
                }
                $model->update([
                    'is_exclusive' => $request->is_exclusive,
                    'exclusive_amount' => $request->exclusive_amount,
                    'step' => '3',
                ]);
            }
        }

        $admin = UserMaster::where(['type_id' => '1'])->first();
        $notification = new Notification;
        $notification->notifier_id = $admin->id;
        $notification->from_id = $user->id;
        $notification->message = $user->name . " has created projeect Please Review.";
        $notification->is_view = '0';
        $notification->status = '1';
        $notification->created_at = date("Y-m-d h:i:s");
        $notification->save();

        if ($request->draft_2 != '') {
            $data['message'] = 'Thanks for saving data in draft';
            $data['project_data'] = $request->project_id;
        } else {
            $data['message'] = 'Thanks, Admin will review and update you soon.';
            $data['project_data'] = $request->project_id;
        }

        $data['previous'] = 'step3';
        $data['next'] = 'step4';
        $data['draft'] = '1';
        $data['checkpoint'] = 'step_process3';
        $data['project_li'] = 'steplifour';
        return response()->json($data);
    }

    public function editUpload($id)
    {
        $nid =  base64_decode($id);
        $categories = Category::where('categories.status', '1')->join('translation_categories as trc', 'categories.id', 'trc.category_id')
            ->where('trc.status', '1')->where('trc.lang_code', 'en')
            ->get();
        $data = Project::with('info')->where(['id' => $nid])->first();
        $commissions = Commission::where(['status' => '1'])->get();

        return view('user.editProject', compact('data', 'categories', 'commissions'));
    }

    public function update_step1(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|min:50|max:200',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:3072',
        ]);

        $user = Auth()->guard('frontend')->user();

        $query = Project::where(['id' => $request->project_id, 'title' => $request['title'], 'user_id' => $user['id'], 'description' => $request['description'], 'step' => '1'])->orderBy('id', 'desc')->first();
        if ($query == '') {
            $model = Project::where(['id' => $request->project_id, 'user_id' => $user->id, 'level' => '0'])->orderBy('id', 'desc')->first();

            if ($request->hasfile('image')) {

                if (file_exists(public_path('uploads/frontend/project/image/' . $model->image))) {
                    File::delete(public_path('uploads/frontend/project/image/' . $model->image));
                    File::delete(public_path('uploads/frontend/project/img_preview/' . $model->image));
                }

                $image = $request->file('image');
                $name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
                $destinationPath = public_path('uploads/frontend/project/image'); //public path folder dir

                $path = public_path('uploads/frontend/project/');
                Image::make($image->getRealPath())->resize(400, 285)->save($path . 'img_preview/' . $name);
                $image->move($destinationPath, $name);
            } else {
                $name = $model->image;
            }
            if ($model != '') {
                $model->update([
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'image' => $name,
                    'footage_code' => $this->generateRandomString(),
                ]);
            }
        }

        $data['message'] = 'Successfully Moved to Step 2';

        $data['previous'] = 'step1';
        $data['next'] = 'step2';
        $data['draft'] = '0';
        $data['project_li'] = 'steplitwo';
        $data['checkpoint'] = 'step_process1';
        return response()->json($data);
    }

    public function savePlaylist(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        if ($request->type == '1') {
            Playlist::create([
                'name' => $request->name,
            ]);
        } elseif ($request->type == '2') {
            Event::create([
                'name' => $request->name,
                'status'=>'1'
            ]);
        }
        $data['message'] = "Data Added Successfully";
        return response()->json($data);
    }

    public function getevents(){
        $data = Event::where(['status' => '1'])->get();
        return response()->json($data);
    }

    public function getplaylist()
    {
        $data = Playlist::where(['status' => '1'])->get();
        return response()->json($data);
    }

    public function getKeyword(Request $request)
    {
        if ($request->category != '') {
            $data['keyword'] = Keyword::where(['status' => '1', 'category' => $request->category])->get();
            $view = view('ajax.keywords', $data)->render();
            $result['content'] = $view;
        } else {
            $result = [];
        }

        $admin = UserMaster::where(['type_id' => '1'])->first();
        $user = Auth()->guard('frontend')->user();
        $notification = new Notification;
        $notification->notifier_id = $admin->id;
        $notification->from_id = $user->id;
        $notification->message = $user->name . " has created keyword";
        $notification->is_view = '0';
        $notification->status = '1';
        $notification->created_at = date("Y-m-d h:i:s");
        $notification->save();

        return response()->json($result);
    }

    public function listing()
    {
        return view('user.videolisting');
    }

    public function delete($id)
    {
        $data = Project::findorFail($id);
        if ($data != '') {
            $data->update(['status' => '3']);
            $data['message'] = 'Deleted Successfully';
            return response()->json($data);
        }
    }

    public function download($name)
   {
    //   $filepath = public_path('uploads/frontend/attachments/original/') . $name;
      $filepath = public_path('frontend/images/') . $name;

      return Response::download($filepath);
   }
    public function details($id)
    {
        $nid = base64_decode($id);
        $user = Auth()->guard('frontend')->user();
        $data = Project::with('info', 'bookmark', 'likes', 'user')->where(['id' => $nid])->where("status", '<>', '3')->first();
        if ($data != '') {
            $maker_data = Project::with('info', 'bookmark', 'likes', 'user')->where('id', '!=', $nid)->where(["user_id" => $data->user->id, "status" => '3'])->get();

            $similar_data = Project::with('info', 'bookmark', 'likes', 'user')->where('id', '!=', $nid)->where(["playlist_id" => $data->playlist_id])->where(["status" => '3'])->get();

            return view('user.details', compact('data', 'user', 'maker_data', 'similar_data'));
        }
    }

    public function getVideoInfo($id)
    {
        $data = Project::select('id', 'video')->where(['id' => $id])->where("status", '<>', '3')->first();
        return response()->json($data);
    }
    public function getVideoStory($id)
    {
        $data = UserStory::select('id', 'video')->where(['id' => $id])->first();
        return response()->json($data);
    }

    public function autocomplete()
    {
        $user = Auth()->guard('frontend')->user();
      
        $data = Project::select("title")
            ->where("location", "=", $user->city)->orWhere("location", "=", $user->address_line1)
            ->get();

        if (count($data) > 0) {
            foreach ($data as $d) {
                $result[] = $d['title'];
            }
        }
        if (count($data) < 0) {
            $result = [];
        }
        return response()->json($result);
    }

    public function search(Request $request)
    {
        //dd($request);
        $query = Project::with('info', 'likes', 'bookmark')->where("status", '=', '1');
        if ($request['item'] == 'category') {
            $selectedCategories = !empty($_GET['type'])?$_GET['type']:'';
            //dd( $selectedCategories);die;

            if (is_array($selectedCategories) && !empty($selectedCategories)) {
                $query->whereIn('category', $selectedCategories);
            }
            //  elseif ($selectedCategories == 'all' || empty($selectedCategories)) {
            //     $query = $query->whereRaw("find_in_set('" . $request->type . "',category)");
            // }

            // if ($request['type'] != '' && $request['type'] != 'all') {
            //     $query = $query->whereRaw("find_in_set('" . $request->type . "',category)");
            // }
        }
        if ($request['item'] == 'formats') {
            if ($request['type'] != '') {
                $query = $query->where(["video_extension" => $request->type]);
            }
        }

        if ($request['item'] == 'orientation') {
            if ($request['type'] != '' && $request['type'] == 'landscape') {
                $query = $query->where("orientation", '=', $request["type"]);
            }
            if ($request['type'] != '' && $request['type'] == 'portrait') {
                $query = $query->where("orientation", '=', $request["type"]);
            }
        }
        if ($request['item'] == 'created_at') {
            if ($request['type'] != '') {
                if ($request['type'] == "Newest") {
                    $query = $query->orderBy("created_at", 'DESC');
                } elseif ($request['type'] == "Oldest") {
                    $query = $query->orderBy("created_at", 'ASC');
                } elseif ($request['type'] == "MostPopular") {
                    $query = $query->orderBy("created_at", 'ASC');
                } elseif ($request['type'] == "BestMatch") {
                    $query = $query->orderBy("created_at", 'ASC');
                }
            }
        }

        if ($request->has('min_duration') && $request->has('max_duration')) {
            $minDuration = $request->input('min_duration', 0);
            $maxDuration = $request->input('max_duration', 60); // Adjust the maximum duration as needed
    
            $query->whereBetween('duration', [$minDuration, $maxDuration]);
        }

        if ($request['type'] == 'dateSelection') {
            if ($request['item'] != '') {
                if ($request['item'] == "24") {
                    $query = $query->where('created_at', '>=', \Carbon\Carbon::now()->subDay()->toDateTimeString());
                } elseif ($request['item'] == "48") {
                    $query = $query->where('created_at', '>=', \Carbon\Carbon::now()->subDay(2)->toDateTimeString());
                } elseif ($request['item'] == "7") {
                    $query = $query->where('created_at', '>=', \Carbon\Carbon::now()->subDay(7)->toDateTimeString());
                }
            }
        }
        if ($request['type'] == 'searchVal') {
            if ($request['item'] != '') {
                $query = $query->where("title", "LIKE", "%{$request->input('item')}%")->orWhere("description", "LIKE", "%{$request->input('item')}%")->orWhere("location", "LIKE", "%{$request->input('item')}%")->orWhere("created_at", "LIKE", "%{$request->input('item')}%");
            }
        }
        $videolist = $query->get();
        $view = view('ajax.cardViewSorting', compact('videolist'))->render();
        $gridview = view('ajax.gridViewSorting', compact('videolist'))->render();
        $result['content'] = $view;
        $result['gridcontent'] = $gridview;
        $result['TotalCount'] = count($videolist);
        return response()->json($result);
    }

    public function searchMyVideos(Request $request)
    {
        $user = Auth()->guard('frontend')->user();
        $query = Project::with('info', 'likes', 'bookmark')->where("status", '=', '1')->where(['user_id'=>$user->id]);
      
      
        if ($request['item'] == 'created_at') {
            if ($request['type'] != '') {
                if ($request['type'] == "Newest") {
                    $query = $query->orderBy("created_at", 'DESC');
                } elseif ($request['type'] == "Oldest") {
                    $query = $query->orderBy("created_at", 'ASC');
                } elseif ($request['type'] == "MostPopular") {
                    $query = $query->orderBy("created_at", 'ASC');
                } elseif ($request['type'] == "BestMatch") {
                    $query = $query->orderBy("created_at", 'ASC');
                }
            }
        }

        $videolist = $query->get();
        $view = view('ajax.cardViewSorting', compact('videolist'))->render();
        $result['content'] = $view;
        $result['TotalCount'] = count($videolist);
        return response()->json($result);
    }

    function generateRandomString($length = 11)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function saveOrder(Request $request)
    {
        if ($request->info_id != '') {
            $user = Auth()->guard('frontend')->user();
            $data = ProjectInfo::where(['id' => $request->info_id])->first();
            if ($data != '') {
                $rate = Commission::where(['name' => $data->licence_for])->first();
                $admin_commission = Settings::where(['slug' => 'commission'])->first();
                // $t_commission = $rate->percentile + (int)$admin_commission->value;
                $t_commission = (int)$admin_commission->value;
                $total = $data->total + ($data->total * ($t_commission / 100));
                Checkout::create([
                    'order_id' => $this->generateRandomString(),
                    'project_id' => $request->project_id,
                    'user_id' => $user->id,
                    'amount' => $data->total,
                    'total' => $total,
                    'status' => '1',
                    'project_info_id' => $request->info_id
                ]);

                $admin = UserMaster::where(['type_id' => '1'])->first();

                $notification = new Notification;
                $notification->notifier_id = $admin->id;
                $notification->from_id = $user->id;
                $notification->message = $user->name . " has Created order.";
                $notification->is_view = '0';
                $notification->status = '1';
                $notification->created_at = date("Y-m-d h:i:s");
                $notification->save();

                $result['success'] = true;
                $result['link'] = "checkout";
                return response()->json($result);
            }
        } else {
            $result['message'] = "Please Select Size";
            return response()->json($result, 422);
        }
    }

    public function checkout()
    {
        $user = Auth()->guard('frontend')->user();
        $data = Checkout::where(['user_id' => $user->id, 'status' => '1'])->get();
        return view('user.checkout', compact('data'));
    }

    public function getLicenceName(Request $request)
    {
        $data = Commission::where(['name' => $request->input('name')])->first();
        return response()->json($data);
    }


    //////////////////////////////////////////////////ends here//////////////////////////////////////////////////////////
}

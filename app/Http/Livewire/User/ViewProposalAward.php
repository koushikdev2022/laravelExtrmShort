<?php

namespace App\Http\Livewire\User;

use App\Services\Payments;
use App\Models\Bid;
use App\Models\MessageConnection;
use Livewire\Component;

class ViewProposalAward extends Component
{
    
    public $user;
    public $bidid;
    public function mount()
    {
        $this->user = auth()->guard('frontend')->user();
    }

   
    public function render()
    {
        // dd($this->bid);
        $data=[];

        $bid_id=base64_decode($this->bidid);
        $data['bids']=Bid::where('id',$bid_id)->first();
        return view('livewire.user.view-proposal-award',$data);
    }

    public function message($to_id)
    {
        $user = Auth()->guard('frontend')->user();
        $items = MessageConnection::where(function($q) use ($to_id) {
            $q->where('from_user_id',$to_id)
            ->orWhere('to_user_id',$to_id);
        })->where('group_id',NULL)->where('status','1')->get();
         
            if(count($items)>0)
            {
                $data=[];
                $data['to_id']=$to_id;
                return redirect()->route('user.messages');
            }else{
                $data=[];
                $input=[];
                $input['from_user_id']=$user->id;
                $input['to_user_id']=$to_id;
                $input['status']='1';
                $model=MessageConnection::create($input);
                $data['to_id']=$model->to_user_id;
                return redirect()->route('user.messages');
            }
        
    }
    

}
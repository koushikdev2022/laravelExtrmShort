<?php

namespace App\Http\Livewire\Project;

use App\Models\Bid;
use App\Models\Project;
use App\Models\Category;
use App\Models\Country;
use App\Models\Language;
use Livewire\Component;
use Livewire\WithPagination;

class AcceptProposalProjects extends Component
{
    use WithPagination;

    public $title;

    public $talent_type;
    public $category;
    public $country;
    public $language ;

    public $viewData;

    public function paginationView()
    {
        return 'livewire.search.custom-pagination';
    }

    public function mount()
    {
        
        $this->user = auth()->guard('frontend')->user();
    }

    public function render()
    {
        $data = [];
        $user_id = auth()->guard('frontend')->user()->id;
        
        // $bids=Bid::where('author_id',$user_id)->where('is_read_client_proposal','0')->get();
        // foreach($bids as $bid){
        //     $b=Bid::find($bid->id);
        //     $b->is_read_client_proposal='1';
        //     $b->save();
        // }

        $projects = Project::where('user_id',$user_id)->orderBy('id','DESC'); 
        $data['projects']=$projects->paginate(10);
        return view('livewire.project.accept-proposal-projects', $data);
    }

}
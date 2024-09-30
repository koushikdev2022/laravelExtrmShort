<?php

namespace App\Http\Livewire\User;

use App\Models\Bid;
use App\Models\Category;
use App\Models\Project;
use App\Models\Country;
use App\Models\Language;
use Livewire\Component;
use Livewire\WithPagination;

class ViewProposalList extends Component
{
    use WithPagination;

    public $title;
    public $projectid;
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
        $this->fill([
            'talent_type' => $this->talent_type,
            'category' => $this->category,
            'country' => $this->country,
            'language' => $this->language,
        ]);

        // $this->user = auth()->guard('frontend')->user();
    }

    public function render()
    {
        $data = [];
        $projectid=base64_decode($this->projectid);
        $user_id = auth()->guard('frontend')->user()->id;
        
        $bids=Bid::where('author_id',$user_id)->where('is_read_client_proposal','0')->where('status','<>','3')->get();
        foreach($bids as $bid){
            $b=Bid::find($bid->id);
            $b->is_read_client_proposal='1';
            $b->save();
        }

        $bid_projects=Bid::where('project_id',$projectid)->where('author_id',$user_id)->where('client_proposal_read','0')->where('status','<>','3')->get();
        foreach($bid_projects as $bid_project)
        {
            $bid_project=Bid::find($bid_project->id);
            $bid_project->client_proposal_read='1';
            $bid_project->save();
        }

        $award_projects_sql = Bid::select('bids.*', 'bids.id as bid_id','bids.status as bid_status','bid_budgets.budget_amount','bid_budgets.billable_target','project.id', 'project.title', 'project.status as project_status')
            ->leftJoin('project', 'bids.project_id', '=', 'project.id')
            ->leftJoin('bid_budgets', 'bids.id', '=', 'bid_budgets.bid_id')
            ->leftJoin('user_master', 'bids.user_id', '=', 'user_master.id')
            ->leftJoin('user_details', 'bids.user_id', '=', 'user_details.user_id')
            ->leftJoin('user_verifications', 'bids.user_id', '=', 'user_verifications.user_id');
        // if (!empty($this->title)) {
        //     $award_projects_sql->where('projects.title', 'like', '%' . $this->title . '%');
        // }
        if (!empty($this->talent_type) && $this->talent_type==1) {
            $award_projects_sql->where('user_verifications.profile','1');
        }
        if (!empty($this->talent_type) && $this->talent_type==2) {
            $award_projects_sql->where('user_verifications.identity','1');
        }
        if (!empty($this->talent_type) && $this->talent_type==3) {
            $award_projects_sql->where('user_verifications.documents','1');
        }
        if (!empty($this->category)) {
            $award_projects_sql->where('user_details.category_id',$this->category);
        }
        if (!empty($this->country)) {
            $award_projects_sql->where('user_master.country',$this->country);
        }
        if (!empty($this->language)) {
            $award_projects_sql->where('user_master.languages', $this->language);
        }
        
        $data['award_projects'] = $award_projects_sql->where(['bids.author_id' => $user_id,['bids.project_id', $projectid],['bids.withdrow_status', '0'], ['bids.status','<>', '3'], ['project.status', '<>', '4']])
            ->paginate(10);
        $data['project']=Project::find($projectid);
        $data['categories']=Category::where('status','1')->get();
        $data['countries']=Country::where('status','1')->get();
        $data['languages']=Language::where('status','1')->get();
        return view('livewire.user.view-proposal-list', $data);
    }

    public function proposal_award($id)
    {
        $data = [];
        $bid_model = Bid::where('id', $id)->where('status', '<>', '3')->first();
        if (!empty($bid_model)) {
            $bid_model->update(['status' => '1']);
            $msg = 'Proposal awarded suceessfully.';
            $this->dispatchBrowserEvent('livealert', ['type' => 'success', 'message' => $msg, 'showtime' => 5]);
        } else {
            $msg = 'Sorry! you are not authorized user to delete';
            $this->dispatchBrowserEvent('livealert', ['type' => 'success', 'message' => $msg, 'showtime' => 5]);
        }
        return view('livewire.project.accept-proposal-projects', $data);
    }

    public function proposal_delete($id)
    {
        $data = [];
        $bid_model = Bid::where('id', $id)->where('status', '<>', '3')->first();
        if (!empty($bid_model)) {
            $bid_model->update(['status' => '3']);
            $msg = 'Proposal deleteed suceessfully.';
            $this->dispatchBrowserEvent('livealert', ['type' => 'success', 'message' => $msg, 'showtime' => 5]);
        } else {
            $msg = 'Sorry! you are not authorized user to delete';
            $this->dispatchBrowserEvent('livealert', ['type' => 'success', 'message' => $msg, 'showtime' => 5]);
        }
        return view('livewire.project.accept-proposal-projects', $data);
    }

    public function hireModel($id)
    {
        // dd(json_encode(['bid_id' => $id, 'event' => 'depositeFormUpdate']));
        $this->emit('openModal', 'user.hire-talent', json_encode(['bid_id' => $id, 'event' => 'depositeFormUpdate']));
        $this->skipRender();
    }

}
<?php

namespace App\Http\Livewire\User\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class PortfolioDetail extends Component
{
    use WithFileUploads;

    public $portfolios = [];
    public $images = [];
    public $user_detail;

    protected $rules = [
        'portfolios.*.title' => 'required',
        'portfolios.*.description' => 'required',
        'images.*.image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:10240',
    ];

    protected $validationAttributes = [
        'portfolios.*.title' => 'title',
        'portfolios.*.description' => 'description',
        'images.*.image' => 'image',
    ];

    public function mount($user)
    {
        $this->user_detail = $user->details;
        if (!empty($this->user_detail->portfolios)) {
            foreach ($this->user_detail->portfolios as $portfolio) {
                $file_path = public_path('storage/uploads/frontend/portfolios/' . $portfolio['image']);
                if (is_file($file_path)) {
                    $portfolio['image_show'] = asset('storage/uploads/frontend/portfolios/' . $portfolio['image']);
                } else {
                    $portfolio['image_show'] = asset('storage/frontend/images/img_placeholder.jpg');
                }
                array_push($this->portfolios, $portfolio);
                array_push($this->images, ['image' => '']);
            }
        } else {
            $this->portfolios[] = $this->portfolioArray();
            array_push($this->images, ['image' => '']);
        }
    }

    public function render()
    {
        return view('livewire.user.admin.portfolio-detail');
    }

    public function store()
    {
        $this->validate();
        if (sizeof($this->portfolios) > 0) {
            $data = [];
            foreach ($this->portfolios as $i => $portfolio) {
                $input = $portfolio;
                unset($input['image_show']);
                if ($this->images[$i]['image']) {
                    $file = $this->images[$i]['image'];
                    $input['image'] = $img_name = Str::random(16) . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('uploads/frontend/portfolios/', $img_name, 'public');
                }
                array_push($data, $input);
            }
            $this->user_detail = tap($this->user_detail)->update([
                'portfolios' => $data
            ]);
            $this->dispatchBrowserEvent('livealert', ['type' => 'success', 'message' => 'Portfolios saved successfully.', 'showtime' => 4]);
        }
    }

    private function portfolioArray()
    {
        return [
            'image' => '',
            'title' => '',
            'description' => '',
        ];
    }

    public function add()
    {
        array_push($this->portfolios, $this->portfolioArray());
        array_push($this->images, ['image' => '']);
    }

    public function remove($i)
    {
        unset($this->portfolios[$i]);
        unset($this->images[$i]);
    }
}
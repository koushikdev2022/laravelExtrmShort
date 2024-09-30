<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use FFMpeg\FFProbe;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         \URL::forceScheme('https');
        // Validator::extend('video_length', function($attribute, $value, $parameters, $validator) {

        //     // validate the file extension
        //     if(!empty($value->getClientOriginalExtension()) && ($value->getClientOriginalExtension() == 'mp4')){
    
        //         $ffprobe = FFMpeg\FFProbe::create();
        //         $duration = $ffprobe
        //             ->format($value->getRealPath()) // extracts file information
        //             ->get('duration');
        //         return(round($duration) > $parameters[0]) ?false:true;
        //     }else{
        //         return false;
        //     }
        // });

       // $lang = session()->get('locale');
        $categories = Category::join('translation_categories', 'translation_categories.category_id', 'categories.id')
        ->where('categories.status', '1')->where('translation_categories.lang_code', '=', 'en')
        ->where('parent_id', null)->get();
        Paginator::useBootstrap();
        View::share('categories', $categories);
    }
}

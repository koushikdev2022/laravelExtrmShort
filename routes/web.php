<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['web'])->group(function () {
    Route::get('clear-cache/v1', function () {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        return "Cache,View is cleared";
    });
    Route::get('/', ['uses' => 'SiteController@index', 'as' => '/']);

    Route::get('about-us', ['uses' => 'CmsController@about', 'as' => 'about-us']);
    Route::get('privacy-policy', ['uses' => 'CmsController@privacy_policy', 'as' => 'privacy-policy']);
    Route::get('cookie-policy', ['uses' => 'CmsController@cookie_policy', 'as' => 'cookie-policy']);
    Route::get('terms-and-conditions', ['uses' => 'CmsController@terms_and_conditions', 'as' => 'terms-and-conditions']);
    Route::get('user-agreement', ['uses' => 'CmsController@user_agreement', 'as' => 'user-agreement']);

    Route::get("email", ['uses' => 'PHPMailerController@email', "as"=>'email']);

    Route::post("send-email", ['uses' => 'PHPMailerController@composeEmail', 'as'=>"send-email"]);
    
    Route::get('how_it_works', ['uses' => 'CmsController@how_it_works', 'as' => 'how_it_works']);

    Route::get('testimonials', ['uses' => 'CmsController@testimonials', 'as' => 'testimonials']);
    Route::get('help-and-support', ['uses' => 'CmsController@help_and_support', 'as' => 'help-and-support']);
    Route::get('contact-us', ['uses' => 'CmsController@contact', 'as' => 'contact-us']);

    Route::get('careers', ['uses' => 'CmsController@careers', 'as' => 'careers']);
    Route::post('post-careers', ['uses' => 'CmsController@post_careers', 'as' => 'post-careers']);

    Route::post('post-contact-us', ['uses' => 'CmsController@post_contact_us', 'as' => 'post-contact-us']);
    Route::get('faq', ['uses' => 'CmsController@faq', 'as' => 'faq']);
    Route::get('blog', ['uses' => 'CmsController@blog', 'as' => 'blog']);
    Route::get('blog_details/{id}', ['uses' => 'CmsController@blog_details', 'as' => 'blog_details']);
    Route::get('loadPost', ['uses' => 'CmsController@loadPost', 'as' => 'loadPost']);


    Route::middleware(['user_not_logged_in'])->group(function () {

        Route::get('signup', ['uses' => 'SiteController@signup', 'as' => 'signup']);
        Route::post('signup', ['uses' => 'SiteController@registration_submit', 'as' => 'signup']);

        Route::get('login', ['uses' => 'SiteController@login', 'as' => 'login']);
        Route::post('login', ['uses' => 'SiteController@post_login', 'as' => 'login']);
        Route::get("forgot-password", ['uses' => 'SiteController@forgot_password', 'as' => 'forgot-password']);
        Route::get("reset-password", ['uses' => 'SiteController@reset_password', 'as' => 'reset-password']);
        Route::post('user-forgot-password', ['uses' => 'SiteController@user_forgot_password', 'as' => 'user-forgot-password']);
        Route::get('user-reset-password/{id}/{token}', 'SiteController@get_reset_password')->name('user-reset-password');
        Route::post('set-password', 'SiteController@post_reset_password')->name('set-password');
        Route::get('active-account/{id}/{token}', 'SiteController@get_active_account')->name('active-account');

        Route::get('oauth/{driver}', 'SiteController@redirectToProvider')->name('social.oauth');
        Route::get('oauth/{driver}/callback', 'SiteController@handleProviderCallback')->name('social.callback');
    });

    Route::get('listing', ['uses' => 'ProjectController@listing', 'as' => 'listing']);
    Route::get('getVideoInfo/{id}', ['uses' => 'ProjectController@getVideoInfo', 'as' => 'getVideoInfo']);
    Route::get('getVideoStory/{id}', ['uses' => 'ProjectController@getVideoStory', 'as' => 'getVideoStory']);

    Route::get('searchVideo', ['uses' => 'ProjectController@search', 'as' => 'searchVideo']);

    Route::get('searchMyVideos', ['uses' => 'ProjectController@searchMyVideos', 'as' => 'searchMyVideos']);
    
    Route::get('getStories', ['uses' => 'SiteController@getStories', 'as' => 'getStories']);
    Route::get('priceChart', ['uses' => 'SiteController@priceChart', 'as' => 'priceChart']);
    Route::get('details/{id}', ['uses' => 'ProjectController@details', 'as' => 'details']);

    Route::middleware(['user_logged_in'])->group(function () {

        Route::get('dashboard', ['uses' => 'UserController@dashboard', 'as' => 'dashboard']);
        Route::get('videoListing', ['uses' => 'UserController@videoListing', 'as' => 'videoListing']);
        Route::get('autocomplete', ['uses' => 'ProjectController@autocomplete', 'as' => 'autocomplete']);
        Route::get('download/{name}', ['uses' => 'ProjectController@download', 'as' => 'download']);
        Route::get('changeNotificationStatus/{id}', ['uses' => 'UserController@changeNotificationStatus', 'as' => 'changeNotificationStatus']);
        Route::get('bookmark-videos', ['uses' => 'UserController@bookmark_videos', 'as' => 'bookmark-videos']);

        Route::get('deleteCart/{id}', ['uses' => 'UserController@deleteCart', 'as' => 'deleteCart']);
        
        Route::get('checkAllDetails', ['uses' => 'PaymentController@checkAllDetails', 'as' => 'checkAllDetails']);

        Route::post('requestWithdrawalAmount', ['uses' => 'PaymentController@requestWithdrawalAmount', 'as' => 'requestWithdrawalAmount']);
        
        Route::get('purchasedVideoListing', ['uses' => 'UserController@purchasedVideoListing', 'as' => 'purchasedVideoListing']);
        Route::get('logout', ['uses' => 'SiteController@logout', 'as' => 'logout']);
        Route::get('saveProject', ['uses' => 'UserController@saveProject', 'as' => 'saveProject']);
        Route::get('likeProject', ['uses' => 'UserController@likeProject', 'as' => 'likeProject']);

        Route::get('followers', ['uses' => 'UserController@followers', 'as' => 'followers']);
        Route::get('following', ['uses' => 'UserController@following', 'as' => 'following']);
        Route::get('earning', ['uses' => 'UserController@earning', 'as' => 'earning']);
      
        Route::get('project-create', ['uses' => 'ProjectController@index', 'as' => 'project-create']);

        //store step call
        Route::get('getLicenceName', ['uses' => 'ProjectController@getLicenceName', 'as' => 'getLicenceName']);

        Route::post('project-step1', ['uses' => 'ProjectController@step1', 'as' => 'project.step1']);
        Route::post('project-step2', ['uses' => 'ProjectController@step2', 'as' => 'project.step2']);
        Route::post('project-step3', ['uses' => 'ProjectController@step3', 'as' => 'project.step3']);
        
        //upload different calls
        Route::get('project-delete/{id}', ['uses' => 'ProjectController@delete', 'as' => 'project-delete']);
        
        Route::get('editUpload/{id}', ['uses' => 'ProjectController@editUpload', 'as' => 'editUpload']);

        //step 2 calls
        Route::post('savePlaylist', ['uses' => 'ProjectController@savePlaylist', 'as' => 'savePlaylist']);
        Route::get('getplaylist', ['uses' => 'ProjectController@getplaylist', 'as' => 'getplaylist']);
        Route::get('getevents', ['uses' => 'ProjectController@getevents', 'as' => 'getevents']);

        Route::get('getKeyword', ['uses' => 'ProjectController@getKeyword', 'as' => 'getKeyword']);
        //store video call
        Route::post('files', ['uses' => 'ProjectController@store', 'as' => 'file-store']);
        Route::post('files/remove', ['uses' => 'ProjectController@removeFile', 'as' => 'file-remove']);

        //update video call
        Route::post('file-update-video/{id}', ['uses' => 'ProjectController@edit_file', 'as' => 'file-update-video']);
        //store step call
        Route::post('project-update_step1', ['uses' => 'ProjectController@update_step1', 'as' => 'project.update_step1']);


        //account setting or profile update
        Route::post('update-password', ['uses' => 'UserController@post_update_password', 'as' => 'update-password']);
        Route::post('update-profile', ['uses' => 'UserController@post_update_profile', 'as' => 'update-profile']);
        //upload story
        Route::post('uploadStory', ['uses' => 'UserController@uploadStory', 'as' => 'uploadStory']);

        //show story by ajax

        Route::post('report', ['uses' => 'UserController@report', 'as' => 'report']);
        Route::get('followuser', ['uses' => 'UserController@followuser', 'as' => 'followuser']);

        Route::get('payments', ['uses' => 'UserController@payments', 'as' => 'payments']);
        Route::get('addBank', ['uses' => 'UserController@addBank', 'as' => 'addBank']);
        Route::get('taxdetails', ['uses' => 'UserController@taxdetails', 'as' => 'taxdetails']);

        Route::post('addBankDetails', ['uses' => 'PaymentController@addBankDetails', 'as' => 'addBankDetails']);
        Route::get('getAllBankDetails', ['uses' => 'PaymentController@getAllBankDetails', 'as' => 'getAllBankDetails']);
        Route::get('getBankDetails',['uses'=>'PaymentController@getBankDetails','as'=>'getBankDetails']);
        Route::post('editBankDetails', ['uses' => 'PaymentController@editBankDetails', 'as' => 'editBankDetails']);
        Route::get('deleteDetails',['uses'=>'PaymentController@deleteDetails','as'=>'deleteDetails']);

        Route::get('setPrimaryAccount',['uses'=>'PaymentController@setPrimaryAccount','as'=>'setPrimaryAccount']);
        
        Route::get('profileAddress',['uses'=>'PaymentController@profileAddress','as'=>'profileAddress']);
        
        Route::post('saveResidence', ['uses' => 'PaymentController@saveResidence', 'as' => 'saveResidence']);
        Route::post('saveUSTaxData', ['uses' => 'PaymentController@saveUSTaxData', 'as' => 'saveUSTaxData']);
        Route::post('saveNonUSTaxData', ['uses' => 'PaymentController@saveNonUSTaxData', 'as' => 'saveNonUSTaxData']);

        Route::get('saveOrder', ['uses' => 'ProjectController@saveOrder', 'as' => 'saveOrder']);
        Route::get('checkout', ['uses' => 'ProjectController@checkout', 'as' => 'checkout']);
        Route::post('pay', ['uses' => 'PaymentController@pay', 'as' => 'pay']);
        Route::get('success', ['uses' => 'PaymentController@success', 'as' => 'success']);
        Route::get('cancel', ['uses' => 'PaymentController@cancel', 'as' => 'cancel']);
        Route::get('upgradeLicence/{id}', ['uses' => 'UserController@upgradeLicence', 'as' => 'upgradeLicence']);


        Route::prefix('user/')->as('user.')->group(function () {

            Route::get('edit/profile', ['uses' => 'UserController@edit_profile', 'as' => 'edit.profile']);
            Route::get('profile/{id}', ['uses' => 'UserController@viewprofile', 'as' => 'viewprofile']);

            Route::get('verification', ['uses' => 'UserController@pages', 'as' => 'verification']);
            Route::get('notifications', ['uses' => 'UserController@pages', 'as' => 'notification']);
            Route::get('settings', ['uses' => 'UserController@pages', 'as' => 'settings']);
            // Route::get('message', ['uses' => 'User\MainController@message_view', 'as' => 'message']);

            Route::get('manage-project', ['uses' => 'ProjectController@manage_project', 'as' => 'manage-project']);
            Route::get('edit-project/{id}', ['uses' => 'ProjectController@edit_project', 'as' => 'edit-project']);

            /*         * *********************************Messages****************************** */
            Route::get('messages/{code?}', ['uses' => 'MessageController@get_messages', 'as' => 'messages']);
            Route::post('add_review', ['uses' => 'ReviewController@store', 'as' => 'add_review']);
            Route::post('add-review', ['uses' => 'ReviewController@review_store', 'as' => 'add-review']);
            Route::post('add-favorite', ['uses' => 'UserController@add_favorite', 'as' => 'add-favorite']);
            Route::post('add-report', ['uses' => 'ReportController@store', 'as' => 'add-report']);
            Route::get('review', ['uses' => 'SiteController@review', 'as' => 'review']);
        });

        /*         * *********************************Messages****************************** */
        Route::post('fetch-messages', 'MessageController@fetchMessages')->name('fetch-messages');
        Route::post('post-message', 'MessageController@post_message')->name('post-message');
        Route::post('append-message', 'MessageController@updateMessages')->name('append-message');
        Route::post('prepend-message', 'MessageController@prependMessages')->name('prepend-message');
        Route::post('manager-connection-status/{state}', 'MessageController@manage_connection_status')->name('manager-connection-status');
        Route::any('lastOnlineTimeUpdate', 'MessageController@lastOnlineTimeUpdate')->name('lastOnlineTimeUpdate');
        Route::post('check-host-online', ['uses' => 'MessageController@UpdatelastOnlineTime', 'as' => 'check-host-online']);
        Route::post('fileuploadforjob', ['uses' => 'MessageController@fileuploadforuploader', 'as' => 'fileuploadforjob']);
        Route::get('add-user-autocomplete', ['uses' => 'MessageController@add_user_autocomplete', 'as' => 'add-user-autocomplete']);
        Route::post('create-message-connection', ['uses' => 'MessageController@create_message_connection', 'as' => 'create-message-connection']);
    });
});

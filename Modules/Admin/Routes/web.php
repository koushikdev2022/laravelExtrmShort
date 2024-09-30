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

Route::prefix('admin')->group(function () {
    Route::middleware(['admin_not_logged_in'])->group(function () {
        Route::get('/', 'AuthController@get_login');
        Route::get('admin-login', ['uses' => 'AuthController@get_login', 'as' => 'admin-login']);
        Route::post('admin-login', ['uses' => 'AuthController@post_login', 'as' => 'admin-login']);
        Route::post('admin-forgotpassword', ['uses' => 'AuthController@post_forgot_password', 'as' => 'admin-forgotpassword']);
        Route::get('admin-lockscreen', ['uses' => 'AuthController@get_lockscreen', 'as' => 'admin-lockscreen']);
        Route::post('admin-lockscreen', ['uses' => 'AuthController@post_lockscreen', 'as' => 'admin-lockscreen']);
    });

    Route::middleware(['admin_logged_in'])->group(function () {
        Route::get('admin-logout', ['uses' => 'AuthController@logout', 'as' => 'admin-logout']);
        
        Route::get('admin-dashboard', ['uses' => 'DashboardController@index', 'as' => 'admin-dashboard']);
        Route::get('admin-notifications', ['uses' => 'DashboardController@notifications', 'as' => 'admin-notifications']);
        Route::get('admin-notification-list-datatable', ['uses' => 'DashboardController@notification_list', 'as' => 'admin-notification-list-datatable']);
        Route::get('admin-deletenotification', ['uses' => 'DashboardController@delete', 'as' => 'admin-deletenotification']);
        Route::get('changeNotificationStatus/{id}', ['uses' => 'DashboardController@changeNotificationStatus', 'as' => 'changeNotificationStatus']);


        Route::get('admin-testimonial', ['uses' => 'TestimonialController@testimonial_index', 'as' => 'admin-testimonial']);
        Route::get('admin-addtestimonial', ['uses' => 'TestimonialController@testimonial_add', 'as' => 'admin-addtestimonial']);
        Route::post('admin-addtestimonial', ['uses' => 'TestimonialController@testimonial_post_add', 'as' => 'admin-addtestimonial']);
        Route::get('admin-testimonial-list-datatable', ['uses' => 'TestimonialController@get_testimonial_data', 'as' => 'admin-testimonial-list-datatable']);
        Route::get('admin-edittestimonial/{id}', ['uses' => 'TestimonialController@testimonial_edit', 'as' => 'admin-edittestimonial']);
        Route::post('admin-updatetestimonial/{id}', ['uses' => 'TestimonialController@testimonial_post_update', 'as' => 'admin-updatetestimonial']);
        Route::get('admin-deletetestimonial/{id}', ['uses' => 'TestimonialController@testimonial_delete', 'as' => 'admin-deletetestimonial']);

        Route::get('admin-producing_with_us', ['uses' => 'ProducingWithUsController@index', 'as' => 'admin-producing_with_us']);
        Route::get('admin-addproducing_with_us', ['uses' => 'ProducingWithUsController@add', 'as' => 'admin-addproducing_with_us']);
        Route::post('admin-addproducing_with_us', ['uses' => 'ProducingWithUsController@post_add', 'as' => 'admin-addproducing_with_us']);
        Route::get('admin-editproducing_with_us/{id}', ['uses' => 'ProducingWithUsController@edit', 'as' => 'admin-editproducing_with_us']);
        Route::post('admin-updateproducing_with_us/{id}', ['uses' => 'ProducingWithUsController@post_update', 'as' => 'admin-updateproducing_with_us']);
        Route::get('admin-deleteproducing_with_us/{id}', ['uses' => 'ProducingWithUsController@delete', 'as' => 'admin-deleteproducing_with_us']);


        Route::get('admin-payment', ['uses' => 'PaymentController@adminRequests', 'as' => 'admin-payment']);
        Route::get('paymentStatusUpdate/{id}', ['uses' => 'PaymentController@statusUpdate', 'as' => 'paymentStatusUpdate']);
        Route::post('specialist_withdraw_req', ['uses' => 'PaymentController@specialist_withdraw_req', 'as' => 'specialist_withdraw_req']);


        Route::get('admin-myprofile', ['uses' => 'MyprofileController@get_myprofile', 'as' => 'admin-myprofile']);
        Route::post('admin-myprofile', ['uses' => 'MyprofileController@post_myprofile', 'as' => 'admin-myprofile']);

        Route::get('admin-cms', ['uses' => 'CmsController@index', 'as' => 'admin-cms']);
        Route::get('admin-viewcms/{id}', ['uses' => 'CmsController@view', 'as' => 'admin-viewcms']);
        Route::get('admin-updatecms/{id}', ['uses' => 'CmsController@get_update', 'as' => 'admin-updatecms']);
        Route::post('admin-updatecms/{id}', ['uses' => 'CmsController@post_update', 'as' => 'admin-updatecms']);

        Route::get('admin-contact', ['uses' => 'ContactController@index', 'as' => 'admin-contact']);
        Route::get('admin-viewcontact/{id}', ['uses' => 'ContactController@view', 'as' => 'admin-viewcontact']);
        Route::post('send-reply/{id}', ['uses' => 'ContactController@send_reply', 'as' => 'send-reply']);

        Route::get('admin-career', ['uses' => 'CareerController@index', 'as' => 'admin-career']);
        Route::get('admin-viewcareer/{id}', ['uses' => 'CareerController@view', 'as' => 'admin-viewcareer']);
        // Route::post('send-reply/{id}', ['uses' => 'ContactController@send_reply', 'as' => 'send-reply']);


        Route::get('admin-report', ['uses' => 'ContactController@report1', 'as' => 'admin-report']);
        Route::get('review', ['uses' => 'ReviewController@index', 'as' => 'reivew']);
        Route::get('ReviewstatusUpdate/{id}', ['uses' => 'ReviewController@reviewStatusUpdate', 'as' => 'ReviewstatusUpdate']);

        Route::get('admin-reports-user', ['uses' => 'ReportController@users', 'as' => 'admin-reports-user']);

        Route::get('admin-reports-order', ['uses' => 'ReportController@orders', 'as' => 'admin-reports-order']);

        Route::get('admin-reports-payments', ['uses' => 'ReportController@payments', 'as' => 'admin-reports-payments']);

        /******************Category Management*****************/
        Route::get('admin-category', ['uses' => 'CategoryController@index', 'as' => 'admin-category']);
        Route::delete('admin-category-delete/{id}', ['uses' => 'CategoryController@destroy', 'as' => 'admin-category-delete']);
        Route::get('admin-category-edit/{id}', ['uses' => 'CategoryController@get_edit', 'as' => 'admin-category-edit']);
        Route::post('admin-category-edit/{id}', ['uses' => 'CategoryController@post_edit', 'as' => 'admin-category-edit']);
        Route::get('admin-category-create', ['uses' => 'CategoryController@get_create', 'as' => 'admin-category-create']);
        Route::post('admin-category-create', ['uses' => 'CategoryController@post_create', 'as' => 'admin-category-create']);
        Route::get('admin-subcategory', ['uses' => 'CategoryController@subcategory_index', 'as' => 'admin-subcategory']);


        /******************Blog Management*****************/
        Route::get('admin-blog', ['uses' => 'BlogController@index', 'as' => 'admin-blog']);
        Route::get('admin-blog-delete', ['uses' => 'BlogController@destroy', 'as' => 'admin-blog-delete']);
        Route::get('admin-editblog/{id}', ['uses' => 'BlogController@edit', 'as' => 'admin-editblog']);
        Route::post('admin-editblog/{id}', ['uses' => 'BlogController@update', 'as' => 'admin-editblog']);
        Route::get('admin-addblog', ['uses' => 'BlogController@create', 'as' => 'admin-addblog']);
        Route::post('admin-add-blog', ['uses' => 'BlogController@post_add', 'as' => 'admin-add-blog']);
        Route::get('admin-blog-list-datatable', ['uses' => 'BlogController@blog_list', 'as' => "admin-blog-list-datatable"]);

        Route::get('admin-requested-amount', ['uses' => 'PaymentController@requested_details', 'as' => 'admin-requested-amount']);
        Route::get('admin-requested-amount-list-datatable', ['uses' => 'PaymentController@details', 'as' => "admin-requested-amount-list-datatable"]);
        Route::get('admin-requested-amount-update/{id}', ['uses' => 'PaymentController@edit', 'as' => 'admin-requested-amount-update']);
        Route::post('admin-requested-amount-update/{id}', ['uses' => 'PaymentController@post_update', 'as' => 'admin-requested-amount-update']);

        
        // Video Management
        Route::get('admin-video', ['uses' => 'VideoController@index', 'as' => 'admin-video']);
        Route::get('admin-viewvideo/{id}', ['uses' => 'VideoController@view', 'as' => 'admin-viewvideo']);
        Route::get('admin-video_statusUpdate/{id}', ['uses' => 'VideoController@statusUpdate', 'as' => 'admin-video_statusUpdate']);
        Route::get('admin-video-list-datatable', ['uses' => 'VideoController@project_list', 'as' => "admin-video-list-datatable"]);
        Route::get('admin-deletevideo', ['uses' => 'VideoController@destroy', 'as' => 'admin-deletevideo']);

        // Keyword Management
        Route::get('admin-keyword', ['uses' => 'KeywordController@index', 'as' => 'admin-keyword']);

        Route::get('admin-addkeyword', ['uses' => 'KeywordController@create', 'as' => 'admin-addkeyword']);
        Route::post('admin-addkeyword', ['uses' => 'KeywordController@post_add', 'as' => 'admin-addkeyword']);

        Route::get('admin-editkeyword/{id}', ['uses' => 'KeywordController@edit', 'as' => 'admin-editkeyword']);
        Route::post('admin-editkeyword/{id}', ['uses' => 'KeywordController@post_update', 'as' => 'admin-editkeyword']);
        Route::get('admin-keyword-list-datatable', ['uses' => 'KeywordController@keyword_list', 'as' => "admin-keyword-list-datatable"]);
        Route::get('admin-deletekeyword', ['uses' => 'KeywordController@destroy', 'as' => 'admin-deletekeyword']);

        // Order(Checkout) Management
        Route::get('admin-order', ['uses' => 'OrderController@index', 'as' => 'admin-order']);
        Route::get('admin-order-list-datatable', ['uses' => 'OrderController@order_list', 'as' => "admin-order-list-datatable"]);
        Route::get('admin-deleteorder', ['uses' => 'OrderController@destroy', 'as' => 'admin-deleteorder']);
        Route::get('admin-vieworder/{id}', ['uses' => 'OrderController@view', 'as' => 'admin-vieworder']);


        // Commission Management
        Route::get('admin-commission', ['uses' => 'CommissionController@index', 'as' => 'admin-commission']);
        Route::get('admin-commission-list-datatable', ['uses' => 'CommissionController@commission_list', 'as' => "admin-commission-list-datatable"]);
        Route::get('admin-addcommission', ['uses' => 'CommissionController@create', 'as' => 'admin-addcommission']);
        Route::post('admin-addcommission', ['uses' => 'CommissionController@post_add', 'as' => 'admin-addcommission']);

        Route::get('admin-updatecommission/{id}', ['uses' => 'CommissionController@edit', 'as' => 'admin-updatecommission']);
        Route::post('admin-updatecommission/{id}', ['uses' => 'CommissionController@post_update', 'as' => 'admin-updatecommission']);

        Route::get('admin-deletecommission', ['uses' => 'CommissionController@destroy', 'as' => 'admin-deletecommission']);
        Route::get('admin-viewcommission/{id}', ['uses' => 'CommissionController@view', 'as' => 'admin-viewcommission']);


         // Video Management
         Route::get('admin-transaction', ['uses' => 'TransactionController@index', 'as' => 'admin-transaction']);
         Route::get('admin-viewtransaction/{id}', ['uses' => 'TransactionController@view', 'as' => 'admin-viewtransaction']);
         Route::get('admin-transaction-list-datatable', ['uses' => 'TransactionController@transaction_list', 'as' => "admin-transaction-list-datatable"]);

        /*         * ****************Skill Management**************** */


        Route::get('admin-emails', ['uses' => 'EmailController@index', 'as' => 'admin-emails']);
        Route::get('admin-viewemail/{id}', ['uses' => 'EmailController@view', 'as' => 'admin-viewemail']);
        Route::get('admin-updateemail/{id}', ['uses' => 'EmailController@get_update', 'as' => 'admin-updateemail']);
        Route::post('admin-updateemail/{id}', ['uses' => 'EmailController@post_update', 'as' => 'admin-updateemail']);

        Route::get('admin-faqs', ['uses' => 'FaqController@index', 'as' => 'admin-faqs']);
        Route::get('admin-createfaq', ['uses' => 'FaqController@get_create', 'as' => 'admin-createfaq']);
        Route::post('admin-createfaq', ['uses' => 'FaqController@post_create', 'as' => 'admin-createfaq']);
        Route::get('admin-viewfaq/{id}', ['uses' => 'FaqController@view', 'as' => 'admin-viewfaq']);
        Route::get('admin-updatefaq/{id}', ['uses' => 'FaqController@get_update', 'as' => 'admin-updatefaq']);
        Route::post('admin-updatefaq/{id}', ['uses' => 'FaqController@post_update', 'as' => 'admin-updatefaq']);
        Route::get('admin-deletefaq', ['uses' => 'FaqController@delete', 'as' => 'admin-deletefaq']);

        Route::get('admin-settings', ['uses' => 'SettingsController@index', 'as' => 'admin-settings']);
        Route::post('admin-settings', ['uses' => 'SettingsController@post_update', 'as' => 'admin-settings']);

        Route::get('admin-seo', ['uses' => 'SeoController@index', 'as' => 'admin-seo']);
        Route::get('admin-viewseo/{id}', ['uses' => 'SeoController@view', 'as' => 'admin-viewseo']);
        Route::get('admin-updateseo/{id}', ['uses' => 'SeoController@get_update', 'as' => 'admin-updateseo']);
        Route::post('admin-updateseo/{id}', ['uses' => 'SeoController@post_update', 'as' => 'admin-updateseo']);

        Route::get('admin-user', ['uses' => 'UserController@index', 'as' => 'admin-user']);
        Route::get('admin-professional', ['uses' => 'UserController@professional_index', 'as' => 'admin-professional']);
        Route::get('admin-adduser', ['uses' => 'UserController@add', 'as' => 'admin-adduser']);
        Route::post('admin-adduser', ['uses' => 'UserController@post_add', 'as' => 'admin-adduser']);
        Route::get('admin-user-list-datatable', ['uses' => 'UserController@user_list', 'as' => "admin-user-list-datatable"]);
        Route::get('admin-professional-list-datatable', ['uses' => 'UserController@professional_list', 'as' => "admin-professional-list-datatable"]);
        Route::get('admin-updateuser/{id}', ['uses' => 'UserController@edit', 'as' => "admin-updateuser"]);

        Route::post('admin-updateuser/{id}', ['uses' => 'UserController@post_update', 'as' => 'admin-updateuser']);

        Route::get('admin-viewuser/{id}', ['uses' => 'UserController@view', 'as' => 'admin-viewuser']);
        Route::get('admin-deleteuser', ['uses' => 'UserController@delete', 'as' => "admin-deleteuser"]);

        Route::get('admin-updateverify/{id}', ['uses' => 'UserController@user_verify', 'as' => 'admin-updateverify']);

        Route::post('extend-expire-date', ['uses' => 'UserController@extend_expire_date', 'as' => 'extend-expire-date']);

        Route::post('paid_unpaid_subscription', ['uses' => 'UserController@paid_unpaid_subscription', 'as' => 'paid_unpaid_subscription']);
        /*         * ****************User Document Management**************** */
        Route::resource('user-documents', 'UserDocumentController');
        Route::post('updatedocument.response/{id}/{type}', ['uses' => 'UserDocumentController@updateDocument', 'as' => 'updatedocument.response'])
            ->where('type', 'approve|reject');

        // Route::get('admin-retail',['uses'=>'UserController@index','as'=>'admin-retail']);
        // Route::get('admin-adduser',['uses'=>'UserController@add','as'=>'admin-adduser']);
        // Route::post('admin-adduser',['uses'=>'UserController@post_add','as'=>'admin-adduser']);
        // Route::get('admin-user-list-datatable',['uses'=>'UserController@user_list','as'=>"admin-user-list-datatable"]);
        // Route::get('admin-updateretail/{id}',['uses'=>'UserController@edit','as'=>"admin-updateretail"]);
        // Route::post('admin-updateretail/{id}',['uses'=>'UserController@post_update','as'=>'admin-updateretail']);
        // Route::get('admin-documentDetails/{id}',['uses'=>'UserController@post_documents','as'=>'admin-documentDetails']);
        // Route::post('admin-updatedocument/{id}',['uses'=>'UserController@update_documents','as'=>'admin-updatedocument']);
        // Route::get('admin-deleteuser',['uses'=>'UserController@delete','as'=>"admin-deleteuser"]);

        // Route::get('admin-designer',['uses'=>'UserController@designer','as'=>'admin-designer']);
        // Route::get('admin-view-escort/{id}',['uses'=>'UserController@viewEscort','as'=>'admin-view-escort']);
        // Route::get('admin-addescort',['uses'=>'UserController@add_escort','as'=>'admin-addescort']);
        // Route::post('admin-addescorts',['uses'=>'UserController@post_addescort','as'=>'admin-addescorts']);
        // Route::get('admin-desiners-list-datatable',['uses'=>'UserController@desinersList','as'=>"admin-desiners-list-datatable"]);
        // Route::get('admin-update-designer/{id}',['uses'=>'UserController@editDesiner','as'=>"admin-updatedesiner"]);
        // Route::post('admin-updatedesigner/{id}',['uses'=>'UserController@post_update','as'=>'admin-updatedesigner']);
        // Route::get('admin-verify-escort/{id}',['uses'=>'UserController@escortVerify','as'=>"admin-escortVerify"]);
        // Route::post('admin-post_verify-escort/{id}',['uses'=>'UserController@verify_post','as'=>"admin-verify_post"]);

        Route::get('admin-category', ['uses' => 'CategoryController@index', 'as' => 'admin-category']);
        Route::get('admin-addcategory', ['uses' => 'CategoryController@add', 'as' => 'admin-addcategory']);
        Route::post('admin-addcategory', ['uses' => 'CategoryController@post_category', 'as' => 'admin-addcategory']);
        Route::get('admin-category-list-datatable', ['uses' => 'CategoryController@category_list', 'as' => "admin-category-list-datatable"]);
        Route::get('admin-deletecategory', ['uses' => 'CategoryController@delete', 'as' => 'admin-deletecategory']);
        Route::get('admin-updatecategory/{id}', ['uses' => 'CategoryController@edit', 'as' => 'admin-updatecategory']);
        Route::post('admin-updatecategory/{id}', ['uses' => 'CategoryController@post_update', 'as' => 'admin-updatecategory']);

        // Route::get('admin-material',['uses'=>'MaterialController@index','as'=>'admin-material']);
        // Route::get('admin-addmaterial',['uses'=>'MaterialController@add','as'=>'admin-addmaterial']);
        // Route::post('admin-addmaterial',['uses'=>'MaterialController@post_material','as'=>'admin-addmaterial']);
        // Route::get('admin-material-list-datatable',['uses'=>'MaterialController@material_list','as'=>"admin-material-list-datatable"]);
        // Route::get('admin-deletematerial',['uses'=>'MaterialController@delete','as'=>'admin-deletematerial']);
        // Route::get('admin-updatematerial/{id}',['uses'=>'MaterialController@edit','as'=>'admin-updatematerial']);
        // Route::post('admin-updatematerial/{id}',['uses'=>'MaterialController@post_update','as'=>'admin-updatematerial']);

        // Route::get('admin-showroom',['uses'=>'ShowroomController@index','as'=>'admin-showroom']);
        // Route::get('admin-addshowroom',['uses'=>'ShowroomController@add','as'=>'admin-addshowroom']);
        // Route::post('admin-addshowroom',['uses'=>'ShowroomController@post_showroom','as'=>'admin-addshowroom']);
        // Route::get('admin-showroom-list-datatable',['uses'=>'ShowroomController@showroom_list','as'=>"admin-showroom-list-datatable"]);
        // Route::get('admin-deleteshowroom',['uses'=>'ShowroomController@delete','as'=>'admin-deleteshowroom']);
        // Route::get('admin-updateshowroom/{id}',['uses'=>'ShowroomController@edit','as'=>'admin-updateshowroom']);
        // Route::post('admin-updateshowroom/{id}',['uses'=>'ShowroomController@post_update','as'=>'admin-updateshowroom']);

        // Route::get('admin-gallery',['uses'=>'GalleryController@index','as'=>'admin-gallery']);
        // Route::get('admin-addgallery',['uses'=>'GalleryController@add','as'=>'admin-addgallery']);
        // Route::post('admin-addgallery',['uses'=>'GalleryController@post_gallery','as'=>'admin-addgallery']);
        // Route::get('admin-gallery-list-datatable',['uses'=>'GalleryController@gallery_list','as'=>"admin-gallery-list-datatable"]);
        // Route::get('admin-deletegallery',['uses'=>'GalleryController@delete','as'=>'admin-deletegallery']);
        // Route::get('admin-updategallery/{id}',['uses'=>'GalleryController@edit','as'=>'admin-updategallery']);
        // Route::post('admin-updategallery/{id}',['uses'=>'GalleryController@post_update','as'=>'admin-updategallery']);
        // Route::post('admin-gallery-photo',['uses'=>'GalleryController@upload_gallery_photo','as'=>'admin-gallery-photo']);
        // Route::post('remove-gallery-image',['uses'=>'GalleryController@remove_gallery_photo','as'=>'remove-product-image']);
        // Route::get('show-gallery-images',['uses'=>'GalleryController@showimages','as'=>'show-gallery-images']);

        // Route::get('admin-product',['uses'=>'ProductController@index','as'=>'admin-product']);
        // Route::get('admin-addproduct',['uses'=>'ProductController@add','as'=>'admin-addproduct']);
        // Route::post('admin-addproduct',['uses'=>'ProductController@post_product','as'=>'admin-addproduct']);
        // Route::get('admin-product-list-datatable',['uses'=>'ProductController@product_list','as'=>"admin-product-list-datatable"]);
        // Route::get('admin-deletproduct',['uses'=>'ProductController@delete','as'=>'admin-deleteproduct']);
        // Route::get('admin-deletproductattribute',['uses'=>'ProductController@productattributedelete','as'=>'admin-deletproductattribute']);
        // Route::get('admin-productimagedelete/{id}',['uses'=>'ProductController@productattributeimagedelete','as'=>'admin-productimagedelete']);
        // Route::get('admin-updateproduct/{id}',['uses'=>'ProductController@edit','as'=>'admin-updateproduct']);
        // Route::post('admin-updateproduct/{id}',['uses'=>'ProductController@post_update','as'=>'admin-updateproduct']);
        // Route::post('admin-product-photo',['uses'=>'ProductController@upload_product_photo','as'=>'admin-product-photo']);
        // Route::post('remove-product-image',['uses'=>'ProductController@remove_product_photo','as'=>'remove-product-image']);
        // Route::get('show-product-images',['uses'=>'ProductController@showimages','as'=>'show-product-images']);
        // Route::post('remove-bussiness-image',['uses'=>'ProductController@remove_bussiness_photo','as'=>'remove-bussiness-image']);

        // Route::get('admin-order',['uses'=>'OrderController@index','as'=>'admin-order']);
        // Route::get('admin-order-list-datatable',['uses'=>'OrderController@order_list','as'=>"admin-order-list-datatable"]);
        // Route::get('admin-deletorder',['uses'=>'OrderController@delete','as'=>'admin-deletorder']);
        // Route::get('admin-updateorder/{order_id}',['uses'=>'OrderController@edit','as'=>'admin-updateorder']);
        // Route::post('admin-updateorder/{order_id}',['uses'=>'OrderController@post_update','as'=>'admin-updateorder']);
        // // Route::post('admin-product-photo',['uses'=>'ProductController@upload_product_photo','as'=>'admin-product-photo']);
        // // Route::post('remove-product-image',['uses'=>'ProductController@remove_product_photo','as'=>'remove-product-image']);
        // // Route::get('show-product-images',['uses'=>'ProductController@showimages','as'=>'show-product-images']);
        // // Route::post('remove-bussiness-image',['uses'=>'ProductController@remove_bussiness_photo','as'=>'remove-bussiness-image']);


        // Route::get('admin-cancelproduct',['uses'=>'CancelProductController@index','as'=>'admin-cancelproduct']);
        // Route::get('admin-product-list-datatable',['uses'=>'CancelProductController@product_list','as'=>"admin-product-list-datatable"]);
        // Route::get('admin-deletcancelproduct',['uses'=>'CancelProductController@delete','as'=>'admin-deletcancelproduct']);
        // Route::get('admin-updatecancelproduct/{id}',['uses'=>'CancelProductController@edit','as'=>'admin-updatecancelproduct']);
        // Route::post('admin-updatecancelproduct/{id}',['uses'=>'CancelProductController@post_update','as'=>'admin-updatecancelproduct']);


        /*         * ****************Notification Management**************** */
        Route::post('admin-get-notifications', ['uses' => 'NotificationController@admin_get_notifications', 'as' => 'admin-get-notifications']);
        Route::get('admin-notification', ['uses' => 'NotificationController@admin_show_all_notification', 'as' => 'admin-notification']);
        Route::post('admin-markAsInactive', ['uses' => 'NotificationController@markAsInactive', 'as' => 'admin-markAsInactive']);
        Route::get('changenotistatus', ['uses' => 'NotificationController@changenotistatus', 'as' => 'changenotistatus']);

        Route::get('admin-addsunscriptionplan', ['uses' => 'SubscrptionController@add_index', 'as' => 'admin-addsunscriptionplan']);
        Route::post('admin-addsunscriptionplan', ['uses' => 'SubscrptionController@post_create', 'as' => 'admin-addsunscriptionplan']);
        Route::get('admin-subscriptionplan', ['uses' => 'SubscrptionController@index', 'as' => 'admin-subscriptionplan']);
        Route::get('admin-plan-list-datatable', ['uses' => 'SubscrptionController@plan_list', 'as' => "admin-plan-list-datatable"]);
        // Route::get('admin-addsunscriptionplan',['uses'=>'SubscrptionController@add','as'=>'admin-addsunscriptionplan']);
        Route::get('admin-editsunscriptionplan/{id}', ['uses' => 'SubscrptionController@edit', 'as' => 'admin-editsunscriptionplan']);
        Route::post('admin-editsunscriptionplan/{id}', ['uses' => 'SubscrptionController@update', 'as' => 'admin-editsunscriptionplan']);
        Route::post('admin-editsunscriptionplan/{id}', ['uses' => 'SubscrptionController@update', 'as' => 'admin-editsunscriptionplan']);
        Route::delete('admin-deletesunscriptionplan/{id}', ['uses' => 'SubscrptionController@destroy', 'as' => 'admin-deletesunscriptionplan']);

        Route::delete('admin-location-delete/{bid}', 'ProjectController@location_destroy')->name('admin-location-delete');

        Route::post('admin-store-project', 'ProjectController@project_update')->name('admin-store-project');
        Route::post('admin-project-photo', ['uses' => 'ProjectController@upload_project_photo', 'as' => 'admin-project-photo']);
        Route::post('remove-project-photo', ['uses' => 'ProjectController@remove_project_photo', 'as' => 'remove-project-photo']);
        Route::get('show-project-images', ['uses' => 'ProjectController@showimages', 'as' => 'show-project-images']);
        Route::post('admin-signup-subcategory', ['uses' => 'ProjectController@signup_subcategory', 'as' => 'admin-signup-subcategory']);


        // support routes
        Route::get('admin-support', ['uses' => 'SupportController@index', 'as' => 'admin-support']);
        Route::get('admin-viewsupport/{id}', ['uses' => 'SupportController@view', 'as' => 'admin-viewsupport']);
        Route::post('send-support/{id}', ['uses' => 'SupportController@send_request', 'as' => 'send-support']);
    });

    Route::middleware(['moderator_logged_in'])->group(function () {
        /*         * ****************ModeratorController**************** */

        Route::get('admin-moderator', ['uses' => 'ModeratorController@index', 'as' => 'admin-moderator']);
        Route::get('admin-moderator-list-datatable', ['uses' => 'ModeratorController@moderator_list', 'as' => "admin-moderator-list-datatable"]);
        Route::get('admin-addmoderator', ['uses' => 'ModeratorController@add', 'as' => 'admin-addmoderator']);
        Route::post('admin-addmoderator', ['uses' => 'ModeratorController@post_add', 'as' => 'admin-addmoderator']);
        Route::get('admin-updatemoderator/{id}', ['uses' => 'ModeratorController@edit', 'as' => "admin-updatemoderator"]);
        Route::post('admin-updatemoderator/{id}', ['uses' => 'ModeratorController@post_update', 'as' => 'admin-updatemoderator']);
        Route::get('admin-deletemoderator', ['uses' => 'ModeratorController@delete', 'as' => "admin-deletemoderator"]);
    });
});

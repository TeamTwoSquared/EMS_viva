<?php

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

Route::get('/test', function () {
    return view('test');
});
Route::post('/orderdata', 'TestsController@orderdata');

Route::get('/client/redirect', 'SocialAuthGoogleController@redirect');
Route::get('/client/callback', 'SocialAuthGoogleController@callback');


Route::get('/test2/{id}', 'svp\SVPsController@sendActivationLink');
Route::get('/', function(){
    return view('home');
});
Route::get('/login',function(){
    return view('index');
});


Route::get('/index.html',function(){
    return view('home');
});

Route::get('/aboutus',  function(){
    return view('aboutus');
});

Route::get('/contactus', 'ContactUsController@index');
Route::post('/contact/submit','ContactUsController@store');


//Routes of Admin

Route::get('/admin/login', function (){
    return view ('admin.login');

});
Route::post('/admin/dologin', 'admin\AdminsController@authenticate');
Route::get('/admin/dash', 'admin\AdminsController@index');

Route::get('/admin/template', 'event\TemplatesController@admin_index');
Route::get('/admin/template/add', 'event\TemplatesController@admin_create');
Route::post('/admin/template/store', 'event\TemplatesController@admin_store');
Route::get('/admin/template/edit/{id}', 'event\TemplatesController@admin_edit');
Route::get('/admin/template/block/{id}','event\TemplatesController@block');
Route::get('/admin/template/delete/{id}','event\TemplatesController@destroy');
Route::post('/admin/template/edit/update/{id}','event\TemplatesController@admin_update');

Route::get('/admin/task/add/{id}', 'event\TasksController@template_task');
Route::get('/admin/task', 'event\TasksController@admin_index');
Route::get('/admin/task/add', 'event\TasksController@admin_create');
Route::post('/admin/task/store', 'event\TasksController@admin_store');
Route::get('/admin/task/edit/{id}', 'event\TasksController@admin_edit');
Route::get('/admin/task/block/{id}','event\TasksController@block');
Route::get('/admin/task/delete/{id}','event\TasksController@destroy');
Route::post('/admin/task/edit/update/{id}','event\TasksController@admin_update');

Route::get('/admin/catergory', 'event\CatergoriesController@admin_index');
Route::get('/admin/catergory/add', 'event\CatergoriesController@admin_create');
Route::post('/admin/catergory/store', 'event\CatergoriesController@admin_store');
Route::get('/admin/catergory/edit/{id}', 'event\CatergoriesController@admin_edit');
Route::get('/admin/catergory/delete/{id}','event\CatergoriesController@destroy');
Route::post('/admin/catergory/edit/update/{id}','event\CatergoriesController@admin_update');

Route::get('/admin/client', 'client\ClientsController@admin_index');
Route::get('/admin/client/add', 'client\ClientsController@admin_create');
Route::post('/admin/client/save_profile','client\ClientsController@admin_new_store');
Route::get('/admin/client/delete/{id}','client\ClientsController@destroy');
Route::get('/admin/client/edit/{id}', 'client\ClientsController@admin_edit');
Route::post('/admin/client/edit/update/{id}','client\ClientsController@admin_edit_store');
Route::get('/admin/client/block/{id}','client\ClientsController@block');

Route::get('/admin/svp', 'svp\SVPsController@admin_index');
Route::get('/admin/svp/delete/{id}','svp\SVPsController@destroy');
Route::get('/admin/svp/block/{id}','svp\SVPsController@block');
Route::get('/admin/svp/add', 'svp\SVPsController@admin_create');
Route::post('/admin/svp/save_profile','svp\SVPsController@admin_new_store');
Route::get('/admin/svp/edit/{id}', 'svp\SVPsController@admin_edit');
Route::post('/admin/svp/edit/update/{id}','svp\SVPsController@admin_edit_store');

Route::get('/admin/ad', 'ad\AdsController@admin_index');
Route::get('/admin/ad/delete/{id}', 'ad\AdsController@admin_destroy');
Route::get('/admin/ad/block/{id}', 'ad\AdsController@admin_block');
Route::get('/admin/ad/unblock/{id}', 'ad\AdsController@admin_unblock');
Route::get('/admin/ad/approve/{id}', 'ad\AdsController@admin_approve');
Route::get('/admin/ad/view/{id}', 'ad\AdsController@admin_view');

/*Route::get('/admin/catergory', function (){
    return view ('admin.event.catergory');
});*/
Route::get('/admin/profile', function (){
    return view ('admin.profile');

});
Route::get('/admin/settings', function (){
    return view ('admin.settings');

});
Route::post('/admin/save_profile', 'admin\AdminsController@save_profile');

Route::post('/admin/settings/payhere', 'SettingsController@save_payhere');
Route::post('/admin/settings/ads', 'SettingsController@save_adConfig');

Route::post('/admin/change_img', 'admin\AdminsController@change_img');
Route::get('/admin/logout', function (){
    session()->flush();
    return redirect('/admin/login')->with('success','Logged out Succesfully');

});

//Routes for Service providers 

Route::get('/svp/login', function (){
    return view ('svp.login');
});
Route::get('/svp/register', function (){
    return view ('svp.register');
});
Route::get('/svp/toverify', function (){
    return view ('svp.verify');
});

Route::post('/svp/doregister', 'svp\SVPsController@register');
Route::get('/svp/dash', 'svp\SVPsController@index');
Route::post('/svp/dologin', 'svp\SVPsController@authenticate');
Route::get('/svpverification/{id}', 'svp\SVPsController@sendActivationLink');
Route::get('/svpverification/{id}/{key}', 'svp\SVPsController@doVerify');

//Route::get('/svp/client','');
Route::get('/svp/service','service\ServicesController@index');



Route::get('/svp/help',function(){
    return view('svp.help');
});

Route::get('/svp/profile', function (){
    return view ('svp.profile');

});
Route::get('/svp/settings', function (){
    return view ('svp.settings');

});
Route::post('/svp/save_profile', 'svp\SVPsController@save_profile');
Route::post('/svp/account/delete/{id}', 'svp\SVPsController@delete');

Route::post('/svp/change_img', 'svp\SVPsController@change_img');
Route::get('/svp/logout','svp\SVPsController@logout');


//Routes for Clients
Route::get('/client/login', function (){
    return view ('client.login');

});
Route::get('/client/register', function (){
    return view ('client.register');

});
Route::get('/client/toverify', function (){
    return view ('client.verify');
});

Route::get('/client/dash', 'client\ClientsController@index');
Route::post('/client/doregister', 'client\ClientsController@register');
Route::post('/client/dologin', 'client\ClientsController@authenticate');
Route::get('/clverification/{id}', 'client\ClientsController@sendActivationLink');
Route::get('/clverification/{id}/{key}', 'client\ClientsController@doVerify');

Route::get('/client/help',function(){
    return view('client.help');
});

Route::get('/client/profile', function (){
    return view ('client.profile');

});
Route::get('/client/settings', function (){
    return view ('client.settings');

});
Route::get('/client/manage/{id}','event\TemplatesController@step1_index');
Route::post('/client/saveevent','event\EventsController@store_step1');
Route::post('/client/saveeventagain','event\EventsController@store_step1_again');
Route::get('/client/savenewtemplate/{event_id}/{template_id}','event\EventsController@store_template');
Route::post('/client/saveown','event\EventsController@store_own');
Route::get('/client/ownstep2/{event_id}','event\EventsController@clientOwn_step2');
Route::post('/client/savetemplate1','event\EventsController@store1');
Route::post('/client/savetemplate2','event\EventsController@store2');

Route::get('/client/myevents','event\EventsController@client_index');
Route::get('/client/myevents/delete/{id}','event\EventsController@destroy');
Route::get('/client/myevents/{id}','event\TemplatesController@client_index2');
Route::get('/client/search1/{text}','service\ServicesController@client_search_text');
Route::get('/client/search2/{id}','service\ServicesController@client_search_id');
Route::post('/client/myevents/store','InvitationsController@store');
Route::post('/client/myevents/sendMessage','ChatboxController@sendMessage');

Route::post('/client/search','service\ServicesController@client_normal_search');
Route::get('/client/view/service/{id}','service\ServicesController@client_view');
Route::get('/client/view/service/{service}/{task}','service\ServicesController@client_view2');
Route::get('/client/view/svp/{id}','svp\SVPsController@client_view');

Route::get('/client/reserve/{service_id}/{svp_id}/{task_id?}','service\ServicesController@getReservationModal');
Route::post('/client/saveevent/{service}','event\EventsController@reserve_event_save');
Route::get('/client/makereserve/{event}/{task}/{svp}/{service}','BookingsController@make_reservation');
Route::get('/client/manage/listen/{event_id}/{task_id}','event\EventTemplateTasksController@listenForBooking');


Route::post('/client/save_profile', 'client\ClientsController@save_profile');
Route::post('/client/change_img', 'client\ClientsController@change_img');
Route::get('/client/logout','client\ClientsController@logout');

Route::get('/client/review/get/{event_id}/{task_id}','review\ReviewsController@getModal');
Route::post('/client/review/new','review\ReviewsController@save');

// Routes for side Adds.

Route::get('/svp/ads','ad\AdsController@svp_index');
Route::get('/svp/ads/create','ad\AdsController@create');
Route::post('/svp/ads/store','ad\AdsController@store');
Route::get('/svp/ads/edit/{id}','ad\AdsController@edit');
Route::post('/svp/ads/update/{id}','ad\AdsController@update');
Route::get('/svp/ads/delete/{id}','ad\AdsController@destroy');
Route::get('/svp/ads/pay/done','ad\AdsController@pay_done');
Route::get('/svp/ads/pay/cancel','ad\AdsController@pay_cancel');
Route::post('/svp/ads/pay/notify','ad\AdsController@pay_notify');
Route::get('/svp/ads/get/{id}','ad\AdsController@getContent');
Route::get('/svp/ads/clickinc/{id}','ad\AdsController@clickInc');

// Routes for services of svp

Route::get('/svp/service','service\ServicesController@index');
Route::get('/svp/addServices','service\ServicesController@create');
Route::post('/svp/submitService','service\ServicesController@store');
Route::get('/svp/ViewService/{service_id}','service\ServicesController@show');
Route::get('/svp/DeleteService/{service_id}','service\ServicesController@destroy');
Route::get('/svp/EditService/{service_id}','service\ServicesController@edit');
Route::post('/svp/updateService','service\ServicesController@update');
//Route::post

// routes for service package

Route::get('/svp/packageService','service\packageService\packageController@index');
Route::get('/svp/addpackageService','service\packageService\packageController@create');
Route::post('/svp/submitServicePackage','service\packageService\packageController@store');
Route::get('/svp/ViewPackage/{package_id}','service\packageService\packageController@show');
Route::get('/svp/EditPackage/{package_id}','service\packageService\packageController@edit');
Route::post('/svp/updatePackage/{package_id}','service\packageService\packageController@update');
Route::get('/svp/DeletePackage/{package_id}','service\packageService\packageController@destroy');

// routes for services that are into package..

Route::get('/svp/packageService/{package_id}','service\packageService\packageServiceController@index1');
Route::get('/svp/package/addServices/{package_id}','service\packageService\packageServiceController@create');
Route::post('/svp/package/submitService/{package_id}','service\packageService\packageServiceController@store');
Route::get('/svp/package/ViewService/{package_id}/{service_id}','service\packageService\packageServiceController@show1');
Route::get('/svp/package/EditService/{package_id}/{service_id}','service\packageService\packageServiceController@edit1');
Route::post('/svp/package/updateService/{package_id}/{serviceID}','service\packageService\packageServiceController@update');
Route::get('/svp/package/DeleteService/{package_id}/{service_id}','service\packageService\packageServiceController@destroy');
Route::get('/svp/package/addExsistingServices/{package_id}','service\packageService\packageServiceController@addExsistingServices');
Route::post('/svp/package/addToPackage/{package_id}','service\packageService\packageServiceController@addExsistingServicesToPackage');

//routes for help center to client..

Route::get('/admin/support','support\helpByAdmin@index');
Route::get('/client/help','support\helpForClient@index');
Route::get('/client/getSupport','support\helpForClient@create');
Route::post('/client/submitHelpRequest','support\helpForClient@store');

// routes for help center to admin..

Route::get('/admin/notification','support\helpByAdmin@index');
Route::get('/admin/notification/{notification_id}','support\helpByAdmin@show');
Route::post('/admin/notification/sendReply/{support_request_id}','support\helpByAdmin@store2');

// routes for help center to client ..

Route::get('/client/support','support\helpReplyForClient@index');
Route::get('/client/notification/{notification_id}','support\helpReplyForClient@show');
Route::post('/client/notification/sendReply/{support_request_id}','support\helpReplyForClient@store2');

// routes for help center to svp

Route::get('/svp/support','support\helpReplyForSVP@index');
Route::get('/svp/getSupport','support\helpReplyForSVP@create');
Route::post('/svp/submitHelpRequest','support\helpReplyForSVP@store');

Route::get('/svp/notification','support\helpReplyForSVP@allNotification');
Route::get('/svp/notification/{notification_id}','support\helpReplyForSVP@show');
Route::post('/svp/notification/sendReply/{support_request_id}','support\helpReplyForSVP@store2');














//SVP BOOKINGS
Route::get('/svp/booking','BookingsController@index');
Route::get('/svp/booking/add','BookingsController@create');
Route::post('/svp/booking/store','BookingsController@store');
Route::get('/svp/booking/delete/{id}','BookingsController@destroy');
Route::get('/svp/booking/block/{id}','BookingsController@block');



//pansilu
Route::get('/pansilu/{id}','chat\ChatsController@show');
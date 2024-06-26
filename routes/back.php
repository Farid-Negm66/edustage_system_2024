<?php

use App\Models\Back\Setting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Start Auth Route
Route::group(['namespace' => 'App\Http\Controllers\Back'], function(){
    Route::get('/login', function(){
        // $settings = Setting::first();
        return view('back.auth.login');
    });

    Route::post('login_post' , 'HomeController@login_post');
});


// Route::group(['prefix' => 'admin/forget_password'], function(){
//     Route::get('/', function(){
//         return view('back.auth.forget_password');
//     });
// });

// clear_cache
Route::get('clear_cache', function() {
    Artisan::call('cache:clear');
    return "cleared cache";
});

 //404
Route::fallback(function () {
    return view("back.404");
});

// , 'middleware' => 'checkLogin' , 'middleware' => 'throttle'
Route::group(['prefix' => '/', 'namespace' => 'App\Http\Controllers\Back'], function(){

    Route::get('/', 'HomeController@index');

    Route::get('logout' , 'HomeController@logout');



    ////////////////////////////////////////////////////////////////////////////////
    // Admin Home Page
    Route::get('/temp-dark', function(){
    return view('back.temp_dark.index');
    });

    // users Routes
    Route::group(['prefix' => 'users'] , function (){
        Route::get('/' , 'UsersController@index');
        Route::post('/store' , 'UsersController@store');
        Route::get('/edit/{id}' , 'UsersController@edit');
        Route::post('/update/{id}' , 'UsersController@update');
        Route::get('/destroy/{id}' , 'UsersController@destroy');
        
        Route::get('datatable' , 'UsersController@datatable');
    });


    // parents Routes
    Route::group(['prefix' => 'parents'] , function (){
        Route::get('/' , 'ParentController@index');
        Route::get('/crm_info/{id}' , 'ParentController@crm_info');
        Route::post('/crm_info_update/{id}' , 'ParentController@crm_info_update');
        Route::get('/destroy/{id}' , 'ParentController@destroy');
        
        Route::get('datatable' , 'ParentController@datatable');


        Route::group(['prefix' => 'report'], function(){
            Route::get('/crm_pdf/{id}', 'ParentController@crm_pdf');                
        });
    });


    // time_table Routes
    Route::group(['prefix' => 'time_table'] , function (){
        Route::get('/' , 'TimeTableController@index');
        Route::get('/crm_info/{id}' , 'TimeTableController@crm_info');
        Route::post('/crm_info_update/{id}' , 'TimeTableController@crm_info_update');
        Route::get('/destroy/{id}' , 'TimeTableController@destroy');
        
        Route::get('datatable' , 'TimeTableController@datatable');


        Route::group(['prefix' => 'report'], function(){
            Route::get('/crm_pdf/{id}', 'ParentController@crm_pdf');                
        });
    });










    
    // crm_columns_name Routes
    Route::group(['prefix' => 'crm'] , function (){
        Route::get('/columns_name' , 'CrmColumnsNamesController@index');
        Route::get('/columns_name/lastOrderNumber/{id}' , 'CrmColumnsNamesController@lastOrderNumber');
        Route::post('/columns_name/store' , 'CrmColumnsNamesController@store');
        Route::get('/columns_name/edit/{id}' , 'CrmColumnsNamesController@edit');
        Route::post('/columns_name/update/{id}' , 'CrmColumnsNamesController@update');
        Route::get('/columns_name/destroy/{id}' , 'CrmColumnsNamesController@destroy');
        
        Route::get('columns_name/datatable' , 'CrmColumnsNamesController@datatable');
    });
    
    // crm_columns_values Routes
    Route::group(['prefix' => 'crm'] , function (){
        Route::get('/columns_values' , 'CrmColumnsValuesController@index');
        Route::post('/store' , 'CrmColumnsValuesController@store');
        Route::post('/store' , 'CrmColumnsValuesController@store');
        Route::get('/edit/{id}' , 'CrmColumnsValuesController@edit');
        Route::post('/update/{id}' , 'CrmColumnsValuesController@update');
        Route::get('/destroy/{id}' , 'CrmColumnsValuesController@destroy');
        
        Route::get('datatable' , 'CrmColumnsValuesController@datatable');
    });


    // roles_permissions Routes
    Route::group(['prefix' => 'roles_permissions'] , function (){
        Route::get('/' , 'RolesPermissionsController@index');
        Route::get('create' , 'RolesPermissionsController@create');
        Route::post('/store' , 'RolesPermissionsController@store');
        Route::get('/edit/{id}' , 'RolesPermissionsController@edit');
        Route::post('/update/{id}' , 'RolesPermissionsController@update');
        Route::get('/destroy/{id}' , 'RolesPermissionsController@destroy');

        Route::get('datatable_roles_permissions' , 'RolesPermissionsController@datatable_roles_permissions');
    });

    // settings Routes
    Route::group(['prefix' => 'settings'] , function (){
        Route::get('/' , 'SettingController@index');
        Route::get('/show/{id}' , 'SettingController@show');
        Route::get('/edit/{id}' , 'SettingController@edit');
        Route::post('/update/{id}' , 'SettingController@update');
        
        Route::get('datatable_settings' , 'SettingController@datatableSettings');
    });


    Route::group(['prefix' => 'reports'] , function (){
        // itemAll المخزن العام
        Route::get('itemAll' , 'ReportController@gItemAll');
        Route::get('itemAll/stores/{id}' , 'ReportController@gItemAllStores');
        Route::get('itemAll/get/{store}' , 'ReportController@pItemAll');
    });
});


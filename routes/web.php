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


/**
 * CURL test
 *
 */

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'HomeController@index')->name('main');



Route::get('/curl', function (){
    // create curl resource
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, "https://api.exchangeratesapi.io/latest");

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);

    $output = json_decode($output, true);

    dd($output);
});


/**
 * Guzzle test
 *
 */

Route::get('/guzzletest', function (){

    $client = new  GuzzleHttp\Client([

        'base_uri' => 'https://api.exchangeratesapi.io'

    ]);

    $response = $client->request('GET', 'latest');
    $stream = $response->getBody();
    $data = json_decode($stream->getContents(), true);
    dd($data);

});




Auth::routes();


Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
], function (){
    Auth::routes(['register' => false]);

    Route::group(['middleware' => 'auth:admin'], function(){
        Route::get('/user', 'UserController@index')->name('user');
        Route::get('/user/{id}/toogle-status', 'UserController@toogleStatus')->name('toogle-status');
        Route::get('/user/{id}/edit', 'UserController@edit')->name('user-edit');
        Route::get('/user/{id}/update', 'UserController@edit')->name('user-update');
        Route::get('/home', 'HomeController@index')->name('home');

        //Post-Categories routes
        Route::get('/categories', 'CategoriesController@index')->name('categories');
        Route::get('/categories/create', 'CategoriesController@create')->name('categories-create');
        Route::post('/categories/store', 'CategoriesController@store')->name('categories-store');
        Route::get('/categories/{id}/edit', 'CategoriesController@edit')->name('categories-edit');
        Route::post('/categories/{id}/update', 'CategoriesController@update')->name('categories-update');
        Route::get('/categories/{id}/delete', 'CategoriesController@delete')->name('categories-delete');

        //Hashtags
        Route::get('/hashtags', 'HashtagController@index')->name('hashtags');
        Route::get('/hashtags/create', 'HashtagController@create')->name('hashtags-create');
        Route::post('/hashtags/store', 'HashtagController@store')->name('hashtags-store');
        Route::get('/hashtags/{id}/edit', 'HashtagController@edit')->name('hashtags-edit');
        Route::post('/hashtags/{id}/update', 'HashtagController@update')->name('hashtags-update');
        Route::get('/hashtags/{id}/delete', 'HashtagController@delete')->name('hashtags-delete');




    });
});

Route::group([
    'prefix' => 'bloger',
    'namespace' => 'Bloger',
], function (){
    Route::group(['middleware' => 'auth'], function(){
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/about', 'AboutController@index')->name('about');

        //Post routes
        Route::get('/posts', 'PostController@index')->name('post');
        Route::get('/posts/view/{id}', 'PostController@view')->name('post-view');
        Route::get('/posts/create', 'PostController@create')->name('create-post');
        Route::post('/posts/store', 'PostController@store')->name('post-store');
        Route::get('/posts/edit/{id}', 'PostController@edit')->name('post-edit');
        Route::post('/posts/update/{id}', 'PostController@update')->name('post-update');
        Route::get('/posts/delete/{id}', 'PostController@delete')->name('post-delete');


    });
});


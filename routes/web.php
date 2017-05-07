<?php
route::get('test',['as'=>'test','uses'=>'TestController@test']);

//Get news (crawler):
route::post('postnews',['as'=>'postnews','uses'=>'GetNewController@postNews']);
route::get('getnews',['as'=>'getnews','uses'=>'GetNewController@getNews']);

//Login-Logout:
route::get('login',['as'=>'getlogin','uses'=>'Auth\LoginController@getLogin']);
route::post('login',['as'=>'postlogin','uses'=>'Auth\LoginController@postLogin']);
route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@getLogout']);

//Register:
route::post('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@postRegister']);
route::get('active/{code}/{username}', ['as' => 'active', 'uses' => 'Auth\RegisterController@getActive']);

//Forgot password:
route::get('forgot', ['as' => 'getforgot', 'uses' => 'Auth\ForgotPasswordController@getForgot']);
route::post('forgot', ['as' => 'postforgot', 'uses' => 'Auth\ForgotPasswordController@postForgot']);

//ResetPassword:
route::get('resetpassword/{code}/{phone}/{email}',['as'=>'resetpassword','uses'=>'Auth\ResetPasswordController@getNewPass']);

//Login by facebook account:
Route::get('auth/facebook', ['as'=>'auth/facebook','uses'=>'Auth\AuthController@redirectToProvider']);
Route::get('auth/facebook/callback', ['as'=>'auth/facebook','uses'=>'Auth\AuthController@handleProviderCallback']);

route::get('home',['as'=>'home','uses'=>'HomeController@getIndex']);

//Route::any('{all?}','HomeController@getIndex')->where('all','(.*)');
Route::any('{all?}','HomeController@getIndex')->where('all','(.)');

//Login required:
route::group(['midleware'=>'auth'],function (){
        route::get('/',function (){
            return view('user.index');
        });
        //go to home-page
        route::get('index',['as'=>'getindex','uses'=>'HomeController@getIndex']);

        //go to profile-page
        route::get('profile',['as'=>'getprofile','uses'=>'ProfileController@getProfile']);
        route::post('profile',['as'=>'postprofile','uses'=>'ProfileController@postProfile']);

        //go to choocate-page
        route::get('choosecate',['as'=>'getchoosecate','uses'=>'ChooseCateController@getChooseCate']);
        route::post('choosecate',['as'=>'postchoosecate','uses'=>'ChooseCateController@postChooseCate']);

        //go to changepassword-page
        route::post('changepassword',['as'=>'changepassword','uses'=>'ChangePasswordController@postChangePassword']);

        //go to single-post-page
        route::get('post/{id}',['as'=>'getpost','uses'=>'PostController@getPost'])->where('id', '[0-9]+');

        //send contact:
        route::get('contact',['as'=>'getcontact','uses'=>'ContactController@getContact']);
        route::post('contact',['as'=>'postcontact','uses'=>'ContactController@postContact']);
});

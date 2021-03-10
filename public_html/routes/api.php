<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register_o','Api\Auth\ORegisterController@register'); //регистрация организации
Route::post('register_c','Api\Auth\CRegisterController@register'); //регистрация гражданина

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('organization', 'Api\Login\OLogController@auth'); //вход организации
Route::post('citizen', 'Api\Login\CLogController@auth'); //вход гражданина

Route::post('lc_citizen', 'Api\Profile\GetProfileController@citizen'); //личный кабинет гражданина
Route::post('lc_organization', 'Api\Profile\GetProfileController@organization'); //личный кабинет организации

Route::post('image-upload', 'ImageUploadController@imageUploadPost');

Route::post('c_upd_city', 'CProfileUpdateController@UpdateCity'); //Обновление города гражданина
Route::post('upd_userpic', 'CProfileUpdateController@UpdateUserpic'); //Обновление фотографии гражданина
Route::post('c_upd_description', 'CProfileUpdateController@UpdateDescription'); //Обновление описания гражданина
Route::post('c_upd_name', 'CProfileUpdateController@UpdateName'); //Обновление имени гражданина
Route::post('c_upd_fname', 'CProfileUpdateController@UpdateFName'); //Обновление фамилии гражданина
Route::post('c_upd_oname', 'CProfileUpdateController@UpdateOName'); //Обновление отчества гражданина
Route::post('c_upd_email', 'CProfileUpdateController@UpdateEmail'); //Обновление почты гражданина


Route::post('o_upd_userpic', 'OProfileUpdateController@UpdateUserpic'); //Обновление почты организации
Route::post('o_upd_description', 'OProfileUpdateController@UpdateDescription'); //Обновление описания организации
Route::post('o_upd_adress', 'OProfileUpdateController@UpdateAdress'); //Обновление адреса организации
Route::post('o_upd_telephone', 'OProfileUpdateController@UpdateTelephone'); //Обновление телефона ограмнизации
Route::post('o_upd_location', 'OProfileUpdateController@UpdateLocation'); //Обновление местоположения организации


Route::post('lenta_org', 'Api\LentaOrg\LentaController@lenta'); //Лента организаций

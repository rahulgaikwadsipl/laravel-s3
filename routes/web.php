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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/','S3ImageController@imageUpload');

Route::get('s3-image-upload','S3ImageController@imageUpload');
Route::post('s3-image-upload','S3ImageController@imageUploadPost');
Route::get('s3-image-delete','S3ImageController@imageDelete');
Route::get('s3-image-delete','S3ImageController@imageDelete');
Route::get('s3-image-delete/{id}','S3ImageController@imageDelete');
Route::post('s3-image-upload-multi','S3ImageController@uploadToS3Multipart');


Route::get('test-me','TestController@testMe');
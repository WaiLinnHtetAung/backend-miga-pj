<?php

use App\Http\Controllers\Api\V1\Admin\BlogsController;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {
    //Blogs
    Route::get('topBlogs', [BlogsController::class, 'getTopBlogs']);
    Route::resource('blogs', 'BlogsController');
});

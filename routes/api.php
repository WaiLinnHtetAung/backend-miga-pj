<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {
    //Blogs
    Route::resource('blogs', 'BlogsController');
});

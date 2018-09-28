<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::post('api/menu','api/Menu/getMenu');
Route::post('api/novel/:id','api/Novel/getNovel');
Route::post('api/chapter/:id','api/Novel/getChapter');
Route::post('api/signin','api/User/signIn')->allowCrossDomain();
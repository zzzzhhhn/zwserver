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



Route::group('api', function () {
	//目录
	Route::post('menu','api/Menu/getMenu');
	Route::post('menu_create','api/Menu/createMenu');
	Route::post('menu_update','api/Menu/updateMenu');
	Route::post('menu_delete','api/Menu/deleteMenu');
	Route::post('menu_recycle','api/Menu/recycleMenu');
	//小说
	Route::post('novel/:id','api/Novel/getNovel');
	Route::post('chapter/:id','api/Novel/getChapter');
	Route::post('novel_update','api/Novel/updateNovel');
	Route::post('catalog_create','api/Novel/createCatalog');
	Route::post('catalog_update','api/Novel/updateCatalog');
	Route::post('catalog_delete','api/Novel/deleteCatalog');
	Route::post('catalog_recycle','api/Novel/recycleCatalog');
	Route::post('chapter_update','api/Novel/updateChapter');
	//用户
	Route::post('signin','api/User/signIn');
	Route::post('signup','api/User/signUp');
})->header('Access-Control-Allow-Origin','http://localhost:8080')->header('Access-Control-Allow-Credentials', 'true')->allowCrossDomain();
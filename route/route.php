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
	Route::post('menu_list','api/Menu/getMenu');
	Route::post('menu_recycle_list','api/Menu/getRecycleMenu');
	Route::post('menu_create','api/Menu/createMenu');
	Route::post('menu_update','api/Menu/updateMenu');
	Route::post('menu_delete','api/Menu/deleteMenu');
	Route::post('menu_recycle','api/Menu/recycleMenu');

	//小说
	Route::post('novel','api/Novel/getNovel');
	Route::post('chapter','api/Novel/getChapter');
	Route::post('novel_update','api/Novel/updateNovel');
	Route::post('novel_img','api/Novel/uploadNovelImg');
	Route::post('catalog_list','api/Novel/getCatalogsByNovelId');
	Route::post('catalog_create','api/Novel/createCatalog');
	Route::post('catalog_update','api/Novel/updateCatalog');
	Route::post('catalog_delete','api/Novel/deleteCatalog');
	Route::post('catalog_recycle','api/Novel/recycleCatalog');
	Route::post('chapter_update','api/Novel/updateChapter');
	//用户
	Route::post('signin','api/User/signIn');
	Route::post('signup','api/User/signUp');
	Route::post('user_token', 'api/User/getUserInfoByToken');
})->header('Access-Control-Allow-Origin','http://localhost:8080')->header('Access-Control-Allow-Credentials', 'true')->allowCrossDomain();
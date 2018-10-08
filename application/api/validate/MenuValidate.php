<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/29
 * Time: 9:18
 */

namespace app\api\validate;


class MenuValidate extends BaseValidate
{
	protected $rule = [
		'name' => 'require|isNotEmpty',
		'type' => 'require|isNotEmpty|number',
		'url' => 'alphaDash'
	];

	protected $message = [
		'name' => '名称格式错误',
		'type' => '类型错误',
		'url' => '路由错误'
	];

}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/29
 * Time: 10:49
 */

namespace app\api\validate;


class NovelValidate extends BaseValidate
{
	protected $rule = [
		'theme' => 'require|isNotEmpty',
		'description' => 'length:0,200',
		'is_end' => 'number',
		'menu_id' => 'number'
	];
}
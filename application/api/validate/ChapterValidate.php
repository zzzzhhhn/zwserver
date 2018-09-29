<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/29
 * Time: 15:45
 */

namespace app\api\validate;


class ChapterValidate extends BaseValidate
{
	protected $rule = [
		'content' => 'require|isNotEmpty',
		'id' => 'require|isNotEmpty|number'
	];
}
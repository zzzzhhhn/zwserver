<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 10:05
 */

namespace app\api\validate;


class IDValidate extends BaseValidate
{
	protected $rule = [
		'id' => 'require|isPositiveInteger'
	];

	protected $message = [
		'id' => 'id必须为正整数'
	];

}
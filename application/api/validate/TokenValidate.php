<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/8
 * Time: 11:49
 */

namespace app\api\validate;


class TokenValidate extends BaseValidate
{
	protected $rule = [
		'token' => 'require|isNotEmpty|alphaNum'
	];
}
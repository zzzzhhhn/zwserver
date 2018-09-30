<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 11:40
 */

namespace app\api\validate;


class SignInValidate extends BaseValidate
{
	protected $rule = [
		'account' => 'require|isNotEmpty|length:3,9|alphaNum',
		'password' => 'require|isNotEmpty|length:32|alphaNum'
	];
	protected $message = [
		'account' => '账号应为3~9位汉字、字母或数字',
		'password' => '密码应为6~16位字母或数字'
	];
}
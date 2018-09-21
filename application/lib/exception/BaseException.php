<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/12
 * Time: 10:08
 */

namespace app\lib\exception;


use think\Exception;

class BaseException extends Exception
{
	// HTTP 状态码
	public $code;
	public $msg;
	// 自定义错误码
	public $errorCode;

	public function __construct($params = [])
	{
		if (!is_array($params)) {
			return ;
		}
		if (array_key_exists('msg', $params)) {
			$this->msg = $params['msg'];
		}
		if (array_key_exists('errorCode', $params)) {
			$this->errorCode = $params['errorCode'];
		}
		if (array_key_exists('code', $params)) {
			$this->code = $params['code'];
		}
	}
}
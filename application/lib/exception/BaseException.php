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
	public $code = 200;
	public $message;
	// 自定义错误码
	public $errorCode;
	public $data;

	public function __construct($params = [])
	{
		if (!is_array($params)) {
			return ;
		}
		if (array_key_exists('message', $params)) {
			$this->message = $params['message'];
		}
		if (array_key_exists('errorCode', $params)) {
			$this->errorCode = $params['errorCode'];
		}
		if (array_key_exists('code', $params)) {
			$this->code = $params['code'];
		}
		if (array_key_exists('data', $params)) {
			$this->data = $params['data'];
		}
	}
}
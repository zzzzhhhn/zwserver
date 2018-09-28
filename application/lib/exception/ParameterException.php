<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 10:55
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
	public $message = '参数错误';
	public $errorCode = 10000;
}
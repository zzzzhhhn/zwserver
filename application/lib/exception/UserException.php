<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 17:26
 */

namespace app\lib\exception;


class UserException extends BaseException
{
	public $message = '账户异常';
	public $errorCode = 60000;
}
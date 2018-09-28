<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 10:16
 */

namespace app\lib\exception;


class MenuException extends BaseException
{
	public $message = '无法获取目录数据';
	public $errorCode = 20000;
}
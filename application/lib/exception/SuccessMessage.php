<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 10:59
 */

namespace app\lib\exception;


class SuccessMessage extends BaseException
{
	public $message = '操作成功';
	public $errorCode = 0;
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 10:10
 */

namespace app\lib\exception;


class NovelException extends BaseException
{
	public $message = '请求的小说不存在或已删除';
	public $errorCode = 30000;

}
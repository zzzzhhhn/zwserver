<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 11:29
 */

namespace app\lib\exception;


class ChapterException extends BaseException
{
	public $message = '请求的章节不存在或已删除';
	public $errorCode = 30001;
}
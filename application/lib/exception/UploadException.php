<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/8
 * Time: 15:28
 */

namespace app\lib\exception;


class UploadException extends BaseException
{
	public $errorCode = 80000;
	public $message = '上传失败';
}
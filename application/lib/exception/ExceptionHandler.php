<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 17:20
 */

namespace app\lib\exception;


use think\exception\Handle;
use think\Log;

class ExceptionHandler extends Handle
{
	private $code;
	private $message;
	private $errorCode;
	private $data;

	public function render(\Exception $e)
	{
		if ($e instanceof BaseException) {
			$this->code = $e->code;
			$this->message = $e->message;
			$this->errorCode = $e->errorCode;
			$this->data = $e->data;
		} else {
			if (config('app_debug')) {
				return parent::render($e);
			} else {
				$this->code = 500;
				$this->message = '内部错误';
				$this->errorCode = 999;
				$this->recordErrorLog($e);
			}
		}
		$requset = \request();
		$result = [
			'message' => $this->message,
			'error_code' => $this->errorCode,
			'data' => $this->data,
			'request_url' => $requset->url()
		];
		return json($result, $this->code);
	}

	private function recordErrorLog(\Exception $e)
	{
		Log::init([
			'type' => 'File',
			'path' => LOG_PATH,
			'level' => ['error']
		]);
		Log::record($e->getMessage(), 'error');
	}
}
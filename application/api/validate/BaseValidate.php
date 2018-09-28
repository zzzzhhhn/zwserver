<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/9
 * Time: 18:44
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Validate;

class BaseValidate extends Validate
{
	public function doCheck()
	{

		$params = request()->param();
		$result = $this->batch()->check($params);

		if(!$result) {
			$msg = is_array($this->error) ? implode(',', $this->error) : $this->error;
			$e = new ParameterException([
				'message' => $msg,
			]);
			throw $e;
		}else {
			return true;
		}
	}

	/**
	 * 验证正整数
	 * @param $value
	 * @param string $rule
	 * @param string $data
	 * @param string $field
	 * @return bool
	 */
	protected function isPositiveInteger($value, $rule = '', $data = '', $field = '')
	{
		if (is_numeric($value) && is_int($value + 0) && ($value + 0 > 0)) {
			return true;
		}else {
			return false;
		}
	}

	protected function isNotEmpty($value, $rule = '', $data = '', $field = '')
	{
		if (empty($value)) {
			return false;
		} else {
			return true;
		}
	}

	protected function isMobile($value)
	{
		$rule = '/^1[34578]\d{9}$/';
		$result = preg_match($rule, $value);

		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	public function getDataByRule($dataArray, $keyArray)
	{
		foreach ($keyArray as $value) {
			if (array_key_exists($value, $dataArray)) {
				throw new ParameterException([
					'msg' => '参数中包含非法参数名：'.$value
				]);
			}
		}
		$newArray = [];
		foreach ($this->rule as $key => $value) {
			$newArray[$key] = $dataArray[$key];
		}
		return $newArray;
	}
}


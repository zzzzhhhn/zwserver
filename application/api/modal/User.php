<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 14:45
 */

namespace app\api\modal;


class User extends BaseModel
{
	static public function checkNameRSD($name)
	{
		return $name = self::where('account', '=', $name)->find();
	}

	static public function getPasswordByAccount($account)
	{
		return self::where('account', '=', $account)->find()->password;
	}
}
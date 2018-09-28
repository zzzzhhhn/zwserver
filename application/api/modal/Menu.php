<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/21
 * Time: 17:26
 */

namespace app\api\modal;


class Menu extends BaseModel
{
	public static function getMenu() {
		$result = self::select();

		return $result;
}
}
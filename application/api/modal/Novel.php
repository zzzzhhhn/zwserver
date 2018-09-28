<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 10:07
 */

namespace app\api\modal;


class Novel extends BaseModel
{
	public function catalog() {
		return $this->hasMany('catalog', 'novel_id', 'id');
	}

	public static function getNovelbyId($id)
	{
		return self::with('catalog')->find($id);
	}
}
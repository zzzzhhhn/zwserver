<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 11:24
 */

namespace app\api\modal;


class Chapter extends BaseModel
{
	public static function getContentByIndex($id)
	{
		return self::where('catalog_id','=',$id)->find();
	}
}
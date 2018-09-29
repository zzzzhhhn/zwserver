<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/29
 * Time: 15:11
 */

namespace app\api\validate;


class CatalogValidate extends BaseValidate
{
	protected $rule = [
		'name' => 'require|isNotEmpty',
		'novel_id' => 'require|isNotEmpty|number'
	];
}
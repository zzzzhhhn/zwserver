<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/21
 * Time: 17:24
 */

namespace app\api\controller;

use app\api\modal\Menu as menuModel;
use app\lib\exception\MenuException;

class Menu
{
	/**
	 * 获取目录
	 * @return array|\PDOStatement|string|\think\Collection
	 * @throws MenuException
	 * @route('api/menu')
	 */
	public function getMenu()
	{
		$menus = menuModel::getMenu();

		if (!$menus) {
			throw new MenuException();
		}
		return $menus;
	}
}
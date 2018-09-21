<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/21
 * Time: 17:24
 */

namespace app\api\controller;

use app\api\modal\Menu as menuModel;

class Menu
{
	public function getMenu()
	{
		$menus = menuModel::getMenu();

		if (!$menus) {

		}
		return $menus;
	}
}
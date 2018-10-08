<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/21
 * Time: 17:24
 */

namespace app\api\controller;

use app\api\modal\Menu as menuModel;
use app\api\validate\IDValidate;
use app\api\validate\MenuValidate;
use app\lib\exception\MenuException;
use app\lib\exception\SuccessMessage;
use think\facade\Session;

class Menu
{
	/**
	 * 获取目录
	 * @route('api/menu')->allowCrossDomain()
	 */
	public function getMenu()
	{
		$menus = menuModel::getMenu();

		if (!$menus) {
			throw new MenuException();
		}
		return $menus;
	}

	/**
	 * 获取已删除目录
	 * @return array|\PDOStatement|string|\think\Collection
	 * @throws MenuException
	 */
	public function getRecycleMenu()
	{

		$menus = menuModel::getRecycleMenu();

		if (!$menus) {
			throw new MenuException();
		} else {
			throw new SuccessMessage(['data' => $menus]);
		}
	}

	/**
	 * 新增
	 * @route('api/menu_create')->allowCrossDomain()
	 */
	public function createMenu()
	{
		(new MenuValidate())->doCheck();

		menuModel::createOrUpdate(1);

	}

	/**
	 * 变更
	 * @route('api/menu_update')->allowCrossDomain()
	 */
	public function updateMenu()
	{
		(new MenuValidate())->doCheck();
		(new IDValidate())->doCheck();

		menuModel::createOrUpdate(2);

	}

	/**
	 * 软删除
	 * @route('api/menu_delete')->allowCrossDomain()
	 */
	public function deleteMenu()
	{
		(new IDValidate())->doCheck();

		menuModel::deleteOrRecycle(0);

	}

	/**
	 * 回收
	 * @route('api/menu_recycle')->allowCrossDomain()
	 */
	public function recycleMenu()
	{
		(new IDValidate())->doCheck();

		menuModel::deleteOrRecycle(1);

	}
}
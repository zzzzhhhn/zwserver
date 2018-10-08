<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/21
 * Time: 17:26
 */

namespace app\api\modal;


use app\lib\exception\MenuException;
use app\lib\exception\NovelException;
use app\lib\exception\SuccessMessage;

class Menu extends BaseModel
{
	/**
	 * 获取所有未删除数据
	 * @return array|\PDOStatement|string|\think\Collection
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public static function getMenu()
	{
		return self::where('enabled', '=', 1)->select();
	}

	public static function getRecycleMenu()
	{
		$type = request()->param()['type'];
		return self::where('type', '=', $type)->where('enabled', '=', 0)->select();
	}

	/**
	 * 验证名称是否已存在
	 * @param $name
	 * @return array|null|\PDOStatement|string|\think\Model
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public static function checkNameExisting($name)
	{
		return self::where('name', '=', $name)->find();
	}

	/**
	 * 验证di是否存在
	 * @param $id
	 * @return array|null|\PDOStatement|string|\think\Model
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public static function checkIdExisting($id)
	{
		return self::where('id', '=', $id)->find();
	}

	/**
	 * 删除或回收
	 * @param $value
	 * @throws MenuException
	 * @throws SuccessMessage
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public static function deleteOrRecycle($value)
	{
		$param = request()->param();
		$existence = self::checkIdExisting($param['id']);
		if (!$existence) {
			throw new MenuException(['message' => '目录不存在']);
		}
		$result = self::update(
			['enabled' => $value],
			['id' => $param['id']]
		);
		$message = $value == 1 ? '回收失败请重试' : '删除失败请重试';
		if ($result) {
			throw new SuccessMessage();
		} else {
			throw new MenuException([
				'message' => $message
			]);
		}
	}

	/**
	 * 新增或更新
	 * @param $type
	 * @throws MenuException
	 * @throws NovelException
	 * @throws SuccessMessage
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public static function createOrUpdate($type)
	{
		$param = request()->param();
		if ($type == 1) {
			$existence = self::checkNameExisting($param['name']);
			if ($existence) {
				throw new MenuException(['message' => '名称已存在']);
			}
			$result = self::create([
				'name' => $param['name'],
				'type' => $param['type'],
				'url' => $param['url']
			]);
			if ($result) {
				if ($param['type'] == 1) {
					$novel = Novel::createNovel($result->id);

					if (!$novel) {
						throw new NovelException(['message' => '小说信息创建失败']);
					}
				}
			}

			$message = '保存失败请重试';
		} else {
			$existence = self::checkIdExisting($param['id']);
			if (!$existence) {
				throw new MenuException(['message' => '目录不存在']);
			}
			$result = self::update([
				'name' => $param['name'],
				'type' => $param['type'],
				'url' => $param['url']
			],['id' => $param['id']]);

			$message = '更新失败请重试';
		}
		if ($result) {
			throw new SuccessMessage();
		} else {
			throw new MenuException([
				'message' => $message
			]);
		}
	}

}
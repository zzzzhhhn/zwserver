<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 11:20
 */

namespace app\api\modal;


use app\lib\exception\NovelException;
use app\lib\exception\SuccessMessage;

class Catalog extends BaseModel
{
	public static function getCatalogsByNovelId()
	{
		$id = request()->param()['id'];
		return self::where('novel_id', '=', $id)->where('enabled', '=', 1)->select();
	}

	/**
	 * 验证章节名称是否已存在
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
	 * 验证id是否存在
	 * @param $id
	 * @return array|null|\PDOStatement|string|\think\Model
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public static function checkIdExisting($id)
	{
		return self::find($id);
	}

	/**
	 * 创建或修改
	 * @param $value
	 * @throws NovelException
	 * @throws SuccessMessage
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public static function createOrUpdate($value)
	{
		$params = request()->param();
		$exitence = self::checkNameExisting($params['name']);
		if ($exitence) {
			throw new NovelException([
				'message' => '章节名已存在'
			]);
		}
		if ($value == 1) {
			$result = self::create([
				'name' => $params['name'],
				'novel_id' => $params['novel_id']
			]);
			if ($result) {
				$chapter = Chapter::create([
					'content' => '',
					'catalog_id' => $result->id
				]);
				if (!$chapter) {
					throw new NovelException([
						'message' => '章节创建失败'
					]);
				} else {
					throw new SuccessMessage([
						'data' => $chapter->id
					]);
				}
			}
		} else {
			$result = self::update([
				'name' => $params['name']
			], [
				'id' => $params['id']
			]);
			if ($result) {
				throw new SuccessMessage();
			} else {
				throw new NovelException([
					'message' => '保存失败'
				]);
			}
		}
	}

	/**
	 * 删除或回收
	 * @param $value
	 * @throws NovelException
	 * @throws SuccessMessage
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public static function deleteOrRecycle($value)
	{
		$id = request()->param()['id'];
		$existence = self::checkIdExisting($id);
		if (!$id) {
			throw new NovelException([
				'message' => '章节不存在'
			]);
		}
		$result = self::update(
			['enabled' => $value],
			['id' => $id]
		);
		$message = $value == 1 ? '回收失败请重试' : '删除失败请重试';
		if ($result) {
			throw new SuccessMessage();
		} else {
			throw new NovelException([
				'message' => $message
			]);
		}
	}

}
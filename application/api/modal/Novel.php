<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 10:07
 */

namespace app\api\modal;


use app\lib\exception\NovelException;
use app\lib\exception\SuccessMessage;

class Novel extends BaseModel
{
	/**
	 * 小说目录
	 * @return \think\model\relation\HasMany
	 */
	public function catalog() {
		return $this->hasMany('catalog', 'novel_id', 'id')->where('enabled', '=', 1);
	}

	/**
	 * 小说信息
	 * @param $id
	 * @return array|null|\PDOStatement|string|\think\Model
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public static function getNovelbyMenuId()
	{
		$id = request()->param()['id'];
		return self::where('menu_id', '=', $id)->with('catalog')->find();
	}

	/**
	 * 新建小说信息
	 * @param $id
	 * @throws NovelException
	 * @throws SuccessMessage
	 */
	public static function createNovel($id)
	{
		$params = request()->param();

		$result = self::create([
			'menu_id' => $id
		]);

		if ($result) {
			throw new SuccessMessage();
		} else {
			throw new NovelException([
				'message' => '小说信息新建失败'
			]);
		}

	}

	/**
	 * 修改小说信息
	 * @throws NovelException
	 * @throws SuccessMessage
	 */
	public static function updateNovel()
	{
		$params = request()->param();

		$result = self::update([
			'theme' => $params['theme'],
			'description' => $params['description'],
			'img' => $params['img'],
			'is_end' => $params['is_end'],
		], ['menu_id' => $params['menu_id']]);

		if ($result) {
			throw new SuccessMessage();
		} else {
			throw new NovelException([
				'message' => '修改失败'
			]);
		}

	}
}
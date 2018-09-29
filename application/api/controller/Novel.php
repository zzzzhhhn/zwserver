<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 9:58
 */

namespace app\api\controller;


use app\api\modal\Catalog;
use app\api\modal\Chapter;
use app\api\validate\CatalogValidate;
use app\api\validate\ChapterValidate;
use app\api\validate\IDValidate;
use app\api\modal\Novel as NovelModel;
use app\api\validate\NovelValidate;
use app\lib\exception\ChapterException;
use app\lib\exception\NovelException;
use app\lib\exception\SuccessMessage;

class Novel
{

	/**
	 * 获取小说信息
	 * @param $id
	 * @return array|null|\PDOStatement|string|\think\Model
	 * @throws NovelException
	 * @throws \app\lib\exception\ParameterException
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 * @route('api/novel/:id')
	 */
	public function getNovel($id)
	{
		(new IDValidate())->doCheck();

		$novel = NovelModel::getNovelbyMenuId($id);

		if (!$novel) {
			throw new NovelException();
		}

		return $novel;
	}

	/**
	 * 获取章节内容
	 * @param $id
	 * @return array|null|\PDOStatement|string|\think\Model
	 * @throws ChapterException
	 * @throws \app\lib\exception\ParameterException
	 * @route('api/chapter/:id')
	 */
	public function getChapter($id)
	{
		(new IDValidate())->doCheck();

		$chapter = Chapter::getContentByIndex($id);

		if (!$chapter) {
			throw new ChapterException();
		}

		return $chapter;
	}

	/**
	 * 修改小说信息
	 * @route('api/novel_update')->allowCrossDomain()
	 */
	public function updateNovel()
	{
		(new NovelValidate())->doCheck();

		NovelModel::updateNovel();
	}

	/**
	 * 新增章节
	 * @route('api/catalog_create')->allowCrossDomain()
	 */
	public function createCatalog()
	{
		(new CatalogValidate())->doCheck();

		Catalog::createOrUpdate(1);
	}

	/**
	 * 修改章节
	 * @route('api/catalog_update')->allowCrossDomain()
	 */
	public function updateCatalog()
	{
		(new CatalogValidate())->doCheck();

		Catalog::createOrUpdate(2);
	}

	/**
	 * 删除章节
	 * @route('api/catalog_delete')->allowCrossDomain()
	 */
	public function deleteCatalog()
	{
		(new IDValidate())->doCheck();

		Catalog::deleteOrRecycle(0);
	}

	/**
	 * 回收章节
	 * @route('api/catalog_recycle')->allowCrossDomain()
	 */
	public function recycleCatalog()
	{
		(new IDValidate())->doCheck();

		Catalog::deleteOrRecycle(1);
	}

	/**
	 * 保存内容
	 * @throws NovelException
	 * @throws SuccessMessage
	 * @throws \app\lib\exception\ParameterException
	 * @route('api/chapter_update')->allowCrossDomain()
	 */
	public function updateChapter()
	{
		(new ChapterValidate())->doCheck();
		$params = request()->param();
		$result = Chapter::update(
			['content' => $params['content']],
			['id' => $params['id']]
		);
		if ($result) {
			throw new SuccessMessage();
		} else {
			throw new NovelException([
				'message' => '内容保存失败'
			]);
		}
	}
}
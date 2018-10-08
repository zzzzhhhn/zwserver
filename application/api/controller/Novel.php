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
	public function getNovel()
	{
		(new IDValidate())->doCheck();

		$novel = NovelModel::getNovelbyMenuId();

		if (!$novel) {
			throw new NovelException();
		} else {
			throw new SuccessMessage(['data' => $novel]);
		}
	}

	/**
	 * 获取小说目录列表
	 * @throws NovelException
	 * @throws SuccessMessage
	 * @throws \app\lib\exception\ParameterException
	 */
	public function getCatalogsByNovelId()
{
	(new IDValidate())->doCheck();
	$catalogs = Catalog::getCatalogsByNovelId();

	if (!$catalogs) {
		throw new NovelException();
	}else {
		throw new SuccessMessage(['data' => $catalogs]);
	}
}

	/**
	 * 获取章节内容
	 * @param $id
	 * @return array|null|\PDOStatement|string|\think\Model
	 * @throws ChapterException
	 * @throws \app\lib\exception\ParameterException
	 * @route('api/chapter/:id')
	 */
	public function getChapter()
	{
		(new IDValidate())->doCheck();

		$chapter = Chapter::getChapterByCatalog();

		if (!$chapter) {
			throw new ChapterException();
		} else {
			throw new SuccessMessage(['data' => $chapter]);
		}
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

	public function uploadNovelImg()
	{
		$file = @$_FILES['file'];//得到传输的数据
		$name = $file['name'];//文件名
		$ex = strtolower(substr($name,strrpos($name,'.'))); //扩展名
		$upload_path = "../public/uploads/"; //上传文件的存放路径
		$new_name = rand().rand().$ex;
//开始移动文件到相应的文件夹
		if(move_uploaded_file($file['tmp_name'],$upload_path.$new_name)){
			throw new SuccessMessage(['data' => $new_name]);
		}else{
			// 上传失败获取错误信息
			throw new NovelException(['message' => $file->getError()]);
		}

	}
}
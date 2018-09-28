<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 9:58
 */

namespace app\api\controller;


use app\api\modal\Chapter;
use app\api\validate\IDMustBePositiveInt;
use app\api\modal\Novel as NovelModel;
use app\lib\exception\ChapterException;
use app\lib\exception\NovelException;

class Novel
{
	/**
	 * 获取小说信息
	 * @param $id
	 * @return array|null|\PDOStatement|string|\think\Model
	 * @throws NovelException
	 * @throws \app\lib\exception\ParameterException
	 * @route('api/novel/:id')
	 */
	public function getNovel($id)
	{
		(new IDMustBePositiveInt())->doCheck();

		$novel = NovelModel::getNovelbyId($id);

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
		(new IDMustBePositiveInt())->doCheck();

		$chapter = Chapter::getContentByIndex($id);

		if (!$chapter) {
			throw new ChapterException();
		}

		return $chapter;
	}
}
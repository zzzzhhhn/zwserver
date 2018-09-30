<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/27
 * Time: 11:33
 */

namespace app\api\controller;


use app\api\modal\User as UserModel;
use app\api\validate\SignInValidate;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use think\facade\Session;

class User
{
	/**
	 * 登录
	 * @throws SuccessMessage
	 * @throws UserException
	 * @throws \app\lib\exception\ParameterException
	 * @route('api/signin')
	 */
	public function signIn()
	{
		(new SignInValidate())->doCheck();
		$params = request()->param();
		$user = UserModel::getUserByAccount($params['account']);
		if (!$user) {
			$params = ['message' => '账号不存在', 'errorCode' => 60004];
			throw new UserException($params);
		}
		if ($params['password'] === strrev($user['password'])) {
			$chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
				'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'q', 'r', 's',  
't', 'u', 'v', 'w', 'x', 'y','z', 'A', 'B', 'C', 'D',  
'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O',  
'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z',  
'0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
			$token = '';
			$arr = array_rand($chars,16);
			foreach ($arr as $value) {
				$token = $token.$chars[$value];
			}
			Session::set($token, $params['account']);
			$user['token'] = $token;
			$params = ['message' => '登录成功', 'errorCode' => 0, 'data' => $user];
			throw new SuccessMessage($params);
		} else {
			$params = ['message' => '密码错误', 'errorCode' => 60003];
			throw new UserException($params);
		}
	}

	/**
	 * 注册
	 * @throws SuccessMessage
	 * @throws UserException
	 * @throws \app\lib\exception\ParameterException
	 * @route('api/signup')->header('Access-Control-Allow-Origin','http://localhost:8080')->header('Access-Control-Allow-Credentials', 'true')->allowCrossDomain()
	 */
	public function signUp()
	{
		(new SignInValidate())->doCheck();
		$params = request()->param();
		$RSD = UserModel::checkNameRSD($params['account']);

		if ($RSD) {
			$params = ['message' => '账号已存在', 'errorCode' => 60001];
			throw new UserException($params);
		} else {
			$create = UserModel::create([
				'account' => $params['account'],
				'password' => strrev($params['password'])
			]);
			if (!$create) {
				$params = ['message' => '注册失败请重试', 'errorCode' => 60002];
				throw new UserException($params);
			} else {
				throw new SuccessMessage();
			}
		}
	}
}
<?php
namespace backend\controllers\common;

use Yii;
use yii\web\Controller;
use backend\services\UrlService;
use backend\models\Admin;

class CommonController extends Controller{

	// 这里设置允许的action
	protected $allowAllAction = [
		'user/login'
	];

	protected $current_user = null;
	//init
	public function beforeAction( $action ){
		$auth_cookies = $this->checkLoginStatus();
		// 获取action id $action->uniqueId
		// if( !$auth_cookies && !in_array($action->uniqueId, $this->allowAllAction)){
		if( !$auth_cookies ){
			if( Yii::$app->request->isAjax){
				$this->renderJSON( [], "", -302);
			}else{
				$this->redirect( UrlService::buildUrl('user/login'));
			}
			return false;
		}

		return true;
	}

	public function checkLoginStatus(){
		$request = Yii::$app->request;
		$cookies = $request->cookies;
		$auth_cookies = $cookies->get(Yii::$app->user->identity->username);
		if( !$auth_cookies){
			return false;
		}
		list($auth_token, $uid) = explode("#", $auth_cookies);
		if(!$auth_token || !$uid){
			return false;
		}
		if( $uid && preg_match("/^\d+$/", $uid)){
			$adminInfo = Admin::find()->where( ['id'=>$uid])->one();
			if(!$adminInfo){
				return false;
			}
			if($auth_token != $this->createAuthToken($adminInfo['id'], $adminInfo['username'], $adminInfo['password_hash'], $_SERVER['HTTP_USER_AGENT']) ){
				return false;
			}
			$this->current_user = $adminInfo;
			$view = Yii::$app->view;
			$view->params['current_user'] = $adminInfo;
			return true;
		}
		return false;
	}

	/**
	 * set cookies
	 * @param  [admin] $userInfo [description]
	 * @return [type]           [description]
	 */
	public function createLoginStatus($userInfo){
		$auth_token = $this->createAuthToken( $userInfo['id'], $userInfo['username'], $userInfo['password_hash'],  $_SERVER['HTTP_USER_AGENT']);
		$cookies = Yii::$app->response->cookies;
		$cookies->add(new \yii\web\Cookie( [
			"name"=> $userInfo['username'],
			'value' => $auth_token."#".$userInfo['id']
		] ));
	}

	/**
	 * create auth_token
	 * @param  [int] $uid         [user id]
	 * @param  [string] $name        [username]
	 * @param  [string] $password    [password]
	 * @param  [string] $user_agrent [http_agent]
	 * @return [string]              [description]
	 */
	public function createAuthToken( $uid, $name, $password, $user_agrent ){
		return md5( $uid.$name.$password.$user_agrent);
	}

	/**
	 * 接受post请求
	 * @param  [type] $key    [description]
	 * @param  string $params [description]
	 * @return [type]         [description]
	 */
	public function post( $key, $params = "" ){
		return Yii::$app->request->post($key, $params);
	}

	/**
	 * 接受get 请求
	 * @param  [type] $key    [description]
	 * @param  [type] $params [description]
	 * @return [type]         [description]
	 */
	public function get( $key, $params){
		return Yii::$app->request->get( $key, $params);
	}

	/**
	 * 统一返回json格式数据
	 * @param  array   $data [description]
	 * @param  string  $msg  [description]
	 * @param  integer $code [description]
	 * @return [type]        [description]
	 */
	public function renderJSON( $data = [], $msg = "ok", $code = 200){
		header('Content-type: aplication/json'); // setting header config
		echo json_encode([
				"code" => $code,
				"msg" => $msg,
				"data" => $data,
				"req_id" =>uniqid(),
			]);
		return Yii::$app->end();
	}

}
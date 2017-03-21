<?php
namespace backend\controllers;
use Yii;
use backend\controllers\common\CommonController;

class DefaultController extends CommonController{
	public function actionIndex(){
		return $this->render("index");
	}
}
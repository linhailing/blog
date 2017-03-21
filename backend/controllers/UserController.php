<?php
namespace backend\controllers;
use Yii;
use backend\controllers\common\CommonController;
use backend\models\LoginForm;
use backend\services\UrlService;

class UserController extends CommonController{
	/**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
    	$this->layout = "login";
        // if (!Yii::$app->user->isGuest) {
        //     return $this->goHome();
        // }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->createLoginStatus(Yii::$app->user->identity);
            return $this->redirect(UrlService::buildUrl('default/index'));
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
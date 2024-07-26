<?php

namespace app\api\v1\controllers;

use app\api\v1\models\SignupForm;
use app\components\JwtHelper;
use app\api\v1\models\LoginForm;
use yii\rest\Controller;

class AuthController extends Controller
{
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = \yii\web\Response::FORMAT_JSON;
        return $behaviors;
    }

    public function actionSignup(): array {
        $model = new SignupForm();


        if ($model->load(\Yii::$app->request->post(), '') && $model->signup()) {
            return ['status' => 'success', 'message' => 'Registration successful'];
        }
        return ['status' => 'error', 'message' => $model->errors];
    }

    public function actionLogin(): array {
        $model = new LoginForm();

        if ($model->load(\Yii::$app->request->post(), '') && $model->login()) {
            $user = \Yii::$app->user->identity;
            $payload = [
                'sub' => $user->getId(),
                'exp' => time() + 60 * 60,
            ];
            $token = JwtHelper::generateToken($payload);
            return ['status' => 'success', 'message' => 'Login successful', 'token' => $token];
        }
        return ['status' => 'error', 'message' => $model->errors];
    }
}
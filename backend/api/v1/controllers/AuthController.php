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

        if (!$model->load(\Yii::$app->request->post(), '')){
            $model->validate();
            \Yii::$app->response->statusCode = 400;
            return ['status' => 'error', 'message' => $model->errors];
        }

        $user = $model->signup();
        if ($user) {
            \Yii::$app->response->statusCode = 201;
            return ['user' => $user, 'status' => 'success', 'message' => 'Registration successful'];
        }

        \Yii::$app->response->statusCode = 400;
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
            \Yii::$app->response->statusCode = 200;
            return ['status' => 'success', 'message' => 'Login successful', 'token' => $token];
        }

        $model->validate();
        \Yii::$app->response->statusCode = 401;
        return ['status' => 'error', 'message' => $model->errors];
    }
}
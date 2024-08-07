<?php

namespace app\api\v1\controllers;

use app\api\v1\models\SignupForm;
use app\api\v1\models\TokenForm;
use app\components\JwtHelper;
use app\api\v1\models\LoginForm;
use yii\filters\Cors;
use yii\rest\Controller;

class AuthController extends Controller
{
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = \yii\web\Response::FORMAT_JSON;
        return array_merge($behaviors, ['cors' => Cors::class]);
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
        try {
            JwtHelper::init();
        } catch (\Exception $e) {
            \Yii::$app->response->statusCode = 500;
            return ['status' => 'error', 'message' => $e->getMessage()];
        }

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

    public function actionValidateToken(): array {
        $isValidToken = False;
        $model = new TokenForm();

        $authHeader = \Yii::$app->request->headers->get('Authorization');
        if ($authHeader && $authHeader.str_starts_with($authHeader, 'Bearer ')){
            $token = substr($authHeader, 7);
            $model->token = $token;
            if($model->isValidToken())
                $isValidToken = True;
        }
        else{
            \Yii::$app->response->statusCode = 400;
            return ['message' => 'Authorization header is missing or invalid.'];
        }

        if($model->validate()){
            \Yii::$app->response->statusCode = 200;
            return ['validated' => $isValidToken];
        }

        \Yii::$app->response->statusCode = 400;
        return ['message' => $model->errors];
    }
}
<?php

namespace backend\controllers;
use Yii;
use yii\web\Controller;

class HelloController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
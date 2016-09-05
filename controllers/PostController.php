<?php

namespace app\controllers;

use mini\Controller;
use app\models\PostModel;
use mini\Mini;
use app\controllers\ErrorController;

class PostController extends Controller 
{
    function __construct() 
    {
        parent::__construct();
    }
    
    public function indexAction() 
    {
        $posts = PostModel::find();
        return $this->render('index', ['posts' => $posts]);
    }
    
    public function deleteByIdAjaxAction($data)
    {
        $r = PostModel::delete($data['id']);
        if ($r == 1) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }
    
    public function deleteByIdAction($id)
    {
        $this->render('deleteById', [
            'res' => PostModel::delete($id),
            'id' => $id
        ]);
    }
    
    public function createAction()
    {
        $model = new PostModel();
        if ($model->load(Mini::postData()) && $model->save()) {
            return $this->render('create', [
                'res' => true,
                'model' => $model
            ]);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }
    
    public function viewAction($id)
    {
        $model = PostModel::findOne(['id' => $id]);
        return $this->render('view', ['model' => $model]);
    }
    
    public function editAction($id)
    {
        $model = PostModel::findOne(['id' => $id]);
        if (!is_null($model) && $model->load(Mini::postData()) && $model->update()) {
            return $this->render('edit', [
                'res' => true,
                'model' => $model
            ]);
        } else {
            return $this->render('edit', ['model' => $model]);
        }
    }
}
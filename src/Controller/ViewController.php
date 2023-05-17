<?php

namespace App\Controller;

use App\Controller;
use App\Form\FormValidator;
use App\Model\ArticleModel;

class ViewController extends Controller
{
    public function __construct(
        private $model = new ArticleModel())
    {
        $this->model = $model;
    }

    public function allArticles(): void
    {
        $data = $this->model->all();
        echo $this->render('articles-all', $data);
    }

    public function insertArticles()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'POST') {
            $fv = new FormValidator(
                [
                    [
                        'name' => 'libelle',
                        'required' => true,
                        'type' => 'string',
                        'value' => $_POST['libelle']
                    ],
                    [
                        'name' => 'prix',
                        'required' => true,
                        'type' => 'numeric',
                        'value' => $_POST['prix']
                    ],
                ]
            );

            $fv->validate();

            if (!empty($errors = $fv->getErrors())) {
                echo $this->render('articles-insert', $errors);
            } else {
                $this->model->insert($_POST);
                echo $this->render('articles-insert', ['msg' => "Les données ont été enregistrées"]);
            }
        } else if ($method === 'GET') {
            echo $this->render('articles-insert');
        }
    }
}
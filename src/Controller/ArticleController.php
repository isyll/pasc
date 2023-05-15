<?php

namespace App\Controller;

use App\Controller;
use App\Model\ArticleModel;

class ArticleController extends Controller
{
  private $model;

  public function __construct()
  {
    $this->model = new ArticleModel();
  }

  public function all()
  {
    return $this->jsonResponse($this->model->all());
  }

  public function insert()
  {
    $datas = $this->jsonDecode();

    if (null === $datas || !isset($datas['libelle']) || !isset($datas['prix'])) {
      header("HTTP/1.1 400 Bad Request");

      $this->jsonResponse([
        'code' => 400,
        'message' => 'Les données sont invalides'
      ]);
    } else {
      $this->model->insert(
        ['libelle' => $datas['libelle'], 'prix' => (float) $datas['prix']]
      );
    }
  }
}
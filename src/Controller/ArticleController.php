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
    return $this->jsonResponse(
      200,
      "HTTP/1.1 200 OK",
      "Recupération des données",
      $this->model->all()
    );
  }

  public function insert()
  {
    $datas = $this->jsonDecode();

    if (null === $datas || !isset($datas['libelle']) || !isset($datas['prix'])) {
      $this->jsonResponse(
        400,
        'HTTP/1.1 400 Bad Request',
        'Les données sont invalides'
      );
    } else {
      $this->model->insert($datas);
      $this->jsonResponse(
        200,
        "HTTP/1.1 200 OK",
        'Les données ont été enregistrées',
        $datas
      );
    }
  }
}
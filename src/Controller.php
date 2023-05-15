<?php

namespace App;

class Controller
{
  public function jsonDecode()
  {
    $jsonDatas = file_get_contents('php://input');
    return json_decode($jsonDatas, true);
  }

  public function jsonResponse(array $datas)
  {
    header('content-type:application/json;charset=utf-8');
    echo json_encode($datas);
  }
}
<?php

namespace App;

class Controller
{
  public function jsonDecode()
  {
    $jsonDatas = file_get_contents('php://input');
    return json_decode($jsonDatas, true);
  }

  public function jsonResponse(
    int $code,
    string $codeMsg,
    string $msg,
    array $datas = null
  ) {
    header($codeMsg);

    $results = [
      "code" => $code,
      "message" => $msg,
      "datas" => $datas ?? []
    ];

    header('content-type:application/json;charset=utf-8');
    echo json_encode($results);
  }
}
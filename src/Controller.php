<?php

namespace App;

class Controller
{
    public const BASE_URL = "http://localhost:8000";
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

    public function render(string $file, array $data = []): string
    {
        $file = "View/$file.php";
        if (!array_is_list($data))
            extract($data);

        ob_start();
        require_once $file;
        $content = ob_get_clean();

        ob_start();
        require_once 'View/layout.php';
        return ob_get_clean();
    }
}
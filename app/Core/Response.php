<?php


namespace App\Core;

/**
 * Class Response
 *
 * @package App\Core
 * @author Celal Akyüz <cllakyz@hotmail.com>
 */
class Response
{
    /**
     * Set http response status code
     *
     * @param int $code
     */
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    /**
     * JSON response func.
     *
     * @param int $code
     * @param string $msg
     * @param array $data
     */
    public function response(int $code = 0, string $msg = '', array $data = [])
    {
        $response = [
            'code' => $code
        ];

        if ($msg !== '') {
            $response['msg'] = $msg;
        }

        if (!empty($data)) {
            if ($code > 0) {
                $response['errors'] = $data;
            } else {
                $response['data'] = $data;
            }
        }

        header('Content-type: application/json');
        echo json_encode($response);
        exit;
    }
}
<?php


namespace App\Controllers;

use App\Core\Application;
use App\Core\Controller;
use App\Core\Request;
use App\Models\Stock;

/**
 * Class StocksController
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Controllers\Auth
 */
class StocksController extends Controller
{
    /**
     * Stock List
     *
     * @return
     */
    public function index()
    {
        $s = new Stock();
        $data = $s->stockList();
        Application::$app->response->setStatusCode(200);
        Application::$app->response->response(0, 'success', $data);
    }

    /**
     * Stock save
     *
     * @param Request $request
     * @return string
     */
    public function store(Request $request)
    {
        $s = new Stock();
        $s->loadData($request->getBody());

        $validate = $s->validate();
        if (!$validate) {
            Application::$app->response->setStatusCode(422);
            Application::$app->response->response(422, 'error', $s->errors);
        }

        $insert = $s->save();
        if ($insert) {
            $data = $s->findById($insert);
            Application::$app->response->setStatusCode(200);
            Application::$app->response->response(0, 'success', [
                'product_id' => $data->product_id,
                'name' => $data->name,
                'stock' => $data->stock,
                'created_date' => $data->created_date,
            ]);
        }
        else {
            Application::$app->response->setStatusCode(400);
            Application::$app->response->response(400, 'Stock could not be created!');
        }
    }
}
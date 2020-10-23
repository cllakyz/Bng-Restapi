<?php


namespace App\Controllers;

use App\Core\Controller;

/**
 * Class HomeController
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Controllers
 */
class HomeController extends Controller
{
    /**
     * Home page
     *
     * @return string|string[]
     */
    public function index()
    {
        return $this->render('home');
    }
}
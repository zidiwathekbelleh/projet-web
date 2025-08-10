<?php

class HomeController extends Controller
{
    public function index()
    {
        $this->render('front/home', [
            'title' => 'Bienvenue sur EventPlatform',
            'user' => $_SESSION['user'] ?? null
        ]);
    }
}

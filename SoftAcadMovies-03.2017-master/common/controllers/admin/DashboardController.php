<?php

class DashboardController extends Controller
{

    public function index()
    {
        $this->loadView('dashboard/dashboard');

    }

}
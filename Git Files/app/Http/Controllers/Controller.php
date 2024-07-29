<?php

namespace App\Http\Controllers;
use Illuminate\Http\Client\Request;

abstract class Controller
{
    //UserDetails page
    public function index()
    {
        return view("Home");
    }

    public function DateRented()
    {
        return view("DateRented");
    }

}

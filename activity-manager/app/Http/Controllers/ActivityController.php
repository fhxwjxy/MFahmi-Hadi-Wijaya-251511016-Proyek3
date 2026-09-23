<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        logger()->info('ActivityController@index dipanggil');

        return "Halaman Activities Berhasil Dimuat!";
    }
}
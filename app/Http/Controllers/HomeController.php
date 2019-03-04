<?php

namespace App\Http\Controllers;

use App\Vessel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show list of vessels.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data = ['vessels' => Vessel::getVesselsList()];

        return view('home', $data);
    }

    /**
     *
     *
     * @param $imei
     * @return $this
     */
    public function addImage($imei) {

        return view('add_image')->with('vessel_imei', $imei);
    }
}

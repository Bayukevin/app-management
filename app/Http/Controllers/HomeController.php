<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DataBarang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function root()
    {
        $userCount = User::count();
        $dataBarangCount = DataBarang::count();
        $barangMasukCount = BarangMasuk::count();
        $barangKeluarCount = BarangKeluar::count();
        return view('index', compact('userCount', 'dataBarangCount', 'barangMasukCount', 'barangKeluarCount'));
    }

    public function index(Request $request)
    {
        $userCount = User::count();

        if (view()->exists($request->path())) {
            return view($request->path(), compact('userCount'));
        }
        return view('errors.404');
    }
}

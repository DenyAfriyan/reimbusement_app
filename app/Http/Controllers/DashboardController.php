<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use App\Models\Pengeluaran;
use App\Models\PermintaanPengambilan;
use App\Models\Sisa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $title = "Dashboard";

        $dataToView = ['title'];
    
        return view('dashboard.index',compact($dataToView));
    }
}

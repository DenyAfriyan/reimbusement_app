<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use App\Models\Pengeluaran;
use App\Models\PermintaanPengambilan;
use App\Models\Reimbursement;
use App\Models\Sisa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $title = "Dashboard";

        $reimbusrsement_baru = Reimbursement::where('status_pengajuan',0)
        ->when(Auth::user()->roles->pluck('name')[0] == 'user',function($query){
            $query->where('user_id', Auth::user()->id);
        })->count();
        $reimbusrsement_all = Reimbursement::when(Auth::user()->roles->pluck('name')[0] == 'user',function($query){
            $query->where('user_id', Auth::user()->id);
        })->count();
        $reimbusrsement_diterima = Reimbursement::where('status_pengajuan',1)
        ->when(Auth::user()->roles->pluck('name')[0] == 'user',function($query){
            $query->where('user_id', Auth::user()->id);
        })->count();
        $reimbusrsement_ditolak = Reimbursement::where('status_pengajuan',2)
        ->when(Auth::user()->roles->pluck('name')[0] == 'user',function($query){
            $query->where('user_id', Auth::user()->id);
        })->count();
        $dataToView = ['title','reimbusrsement_baru','reimbusrsement_all','reimbusrsement_diterima','reimbusrsement_ditolak'];
    
        return view('dashboard.index',compact($dataToView));
    }
}

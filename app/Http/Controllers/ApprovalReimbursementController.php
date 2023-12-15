<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengeluaran;
use App\Models\MetodePembayaran;
use App\Models\Reimbursement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ApprovalReimbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('approval reimbursement'), 403);
        $title = 'Reimbursement';
        $reimbursement = Reimbursement::
        leftJoin('kategori_pengeluaran','kategori_pengeluaran.id','=','reimbursements.kategori_pengeluaran_id')
        ->leftJoin('users','users.id','=','reimbursements.user_id')
        ->select('*','reimbursements.id as reimbursement_id','users.name as user_name')
        ->orderByDesc('reimbursement_id')
        ->get();
        $dataToView = ['title','reimbursement'];
        return view('approval_reimbursement.index',compact($dataToView));
    }

    public function setujui(int $id){
        abort_if(Gate::denies('approval reimbursement'), 403);
        $reimbursement = Reimbursement::findOrFail($id);
        $reimbursement->no_referensi = "A-".date("dmy").rand(10,100).$id;
        $reimbursement->tanggal_persetujuan = date('Y-m-d');
        $reimbursement->status_pengajuan = 1;
        $reimbursement->save();
        
        return redirect('approval-reimbursement')->with('message','Reimbursement Berhasil diesetujui');
    }
    public function ditolak(int $id){
        abort_if(Gate::denies('approval reimbursement'), 403);
        $reimbursement = Reimbursement::findOrFail($id);
        $reimbursement->no_referensi = "R-".date("dmy").rand(10,100).$id;
        $reimbursement->tanggal_persetujuan = date('Y-m-d');
        $reimbursement->status_pengajuan = 2;
        $reimbursement->save();
        
        return redirect('approval-reimbursement')->with('message','Reimbursement Berhasil ditolak');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('request reimbursement'), 403);
        $validator = Validator::make($request->all(), [
            'kategori_pengeluaran_id' => 'required',
            'metode_pembayaran_id' => 'required',
            'jumlah_pengeluaran' => 'required',
            'bukti_pengeluaran' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $file = $request->file('bukti_pengeluaran');
        $extention = $file->getClientOriginalExtension();
        $path = $request->file('bukti_pengeluaran')->storeAs(
            'bukti_pengeluaran',
            uniqid().".".$extention,
            'public'
        );
        $dataToStore = [

            'user_id' => $request->user()->id,
            'kategori_pengeluaran_id' => $request->kategori_pengeluaran_id,
            'metode_pembayaran_id' => $request->metode_pembayaran_id,
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
            'bukti_pengeluaran' => $path,
            'notes' => $request->notes,
            'status_pengajuan' => 0,
            'tanggal_pengajuan' => date("Y-m-d"),
        ];
  

        
        Reimbursement::create($dataToStore);
        return redirect('reimbursement')->with('message','Data Berhasil Ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(Gate::denies('approval reimbursement'), 403);
        $title = 'Reimbursement';
        $reimbursement = Reimbursement::
        leftJoin('kategori_pengeluaran','kategori_pengeluaran.id','=','reimbursements.kategori_pengeluaran_id')
        ->leftJoin('metode_pembayaran','metode_pembayaran.id','=','reimbursements.metode_pembayaran_id')
        ->leftJoin('users','users.id','=','reimbursements.user_id')
        ->where('reimbursements.id','=',$id)
        ->select('*','reimbursements.id as reimbursement_id',
        'kategori_pengeluaran.name as kategori_name',
        'metode_pembayaran.name as metode_pembayaran_name',
        'users.name as user_name')
        ->first();
        $dataToView = ['title','reimbursement'];
        return view('approval_reimbursement.show',compact($dataToView));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        abort_if(Gate::denies('request reimbursement'), 403);
        $title = 'Reimbursement';
        $reimbursement = Reimbursement::findOrFail($id);
        $dataToView = ['title','reimbursement'];
        return view('approval_reimbursement.edit',compact($dataToView));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        abort_if(Gate::denies('request reimbursement'), 403);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:reimbursements|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $reimbursement = Reimbursement::where('id',$id)->update(['name' => $request->input('name')]);
        return redirect('reimbursement')->with('message','Data Berhasil Diupdate');
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        abort_if(Gate::denies('request reimbursement'), 403);
        $reimbursement = Reimbursement::findOrFail($id);
 
        $reimbursement->delete();
        
        return redirect()->back()->with('message','Data Berhasil Dihapus');
    }
}

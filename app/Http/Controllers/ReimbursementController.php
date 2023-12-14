<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengeluaran;
use App\Models\Reimbursement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class ReimbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('request reimbursement'), 403);
        $title = 'Reimbursement';
        $reimbursement = Reimbursement::all();
        $dataToView = ['title','reimbursement'];
        return view('reimbursement.index',compact($dataToView));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('request reimbursement'), 403);
        $title = 'Reimbursement';
        $users = User::where('departement_id','!=','')->pluck('id','name');
        $kategori_pengeluaran = KategoriPengeluaran::all()->pluck('id','name');
        $dataToView = ['title','users','kategori_pengeluaran'];
        return view('reimbursement.create',compact($dataToView));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('request reimbursement'), 403);
        $validator = Validator::make($request->all(), [
            'kategori_pengeluaran_id' => 'required',
            'jumlah_pengeluaran' => 'required',
            'bukti_pengeluaran' => 'required',
        ]);
        $path = $request->file('avatar')->store('avatars');
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Reimbursement::create($request->all());
        return redirect('master-data/reimbursement')->with('message','Data Berhasil Ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        return view('reimbursement.edit',compact($dataToView));
        
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
        return redirect('master-data/reimbursement')->with('message','Data Berhasil Diupdate');
 
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

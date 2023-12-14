<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class KategoriPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('masterdata'), 403);
        $title = 'Kategori Pengeluaran';
        $kategori_pengeluaran = KategoriPengeluaran::all();
        $dataToView = ['title','kategori_pengeluaran'];
        return view('masterdata.kategori_pengeluaran.index',compact($dataToView));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('masterdata'), 403);
        $title = 'Kategori Pengeluaran';
        $dataToView = ['title'];
        return view('masterdata.kategori_pengeluaran.create',compact($dataToView));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('masterdata'), 403);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:kategori_pengeluaran|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        KategoriPengeluaran::create($request->all());
        return redirect('master-data/kategori-pengeluaran')->with('message','Data Berhasil Ditambahkan');

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
        abort_if(Gate::denies('masterdata'), 403);
        $title = 'Kategori Pengeluaran';
        $kategori_pengeluaran = KategoriPengeluaran::findOrFail($id);
        $dataToView = ['title','kategori_pengeluaran'];
        return view('masterdata.kategori_pengeluaran.edit',compact($dataToView));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        abort_if(Gate::denies('masterdata'), 403);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:kategori_pengeluaran|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $kategori_pengeluaran = KategoriPengeluaran::where('id',$id)->update(['name' => $request->input('name')]);
        return redirect('master-data/kategori-pengeluaran')->with('message','Data Berhasil Diupdate');
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        abort_if(Gate::denies('masterdata'), 403);
        $kategori_pengeluaran = KategoriPengeluaran::findOrFail($id);
 
        $kategori_pengeluaran->delete();
        
        return redirect()->back()->with('message','Data Berhasil Dihapus');
    }
}

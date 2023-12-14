<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class MetodePembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('masterdata'), 403);
        $title = 'Metode Pembayaran';
        $metode_pembayaran = MetodePembayaran::all();
        $dataToView = ['title','metode_pembayaran'];
        return view('masterdata.metode_pembayaran.index',compact($dataToView));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('masterdata'), 403);
        $title = 'Metode Pembayaran';
        $dataToView = ['title'];
        return view('masterdata.metode_pembayaran.create',compact($dataToView));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('masterdata'), 403);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:metode_pembayaran|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        MetodePembayaran::create($request->all());
        return redirect('master-data/metode-pembayaran')->with('message','Data Berhasil Ditambahkan');

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
        $title = 'Metode Pembayaran';
        $metode_pembayaran = MetodePembayaran::findOrFail($id);
        $dataToView = ['title','metode_pembayaran'];
        return view('masterdata.metode_pembayaran.edit',compact($dataToView));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        abort_if(Gate::denies('masterdata'), 403);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:metode_pembayaran|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $metode_pembayaran = MetodePembayaran::where('id',$id)->update(['name' => $request->input('name')]);
        return redirect('master-data/metode-pembayaran')->with('message','Data Berhasil Diupdate');
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        abort_if(Gate::denies('masterdata'), 403);
        $metode_pembayaran = MetodePembayaran::findOrFail($id);
 
        $metode_pembayaran->delete();
        
        return redirect()->back()->with('message','Data Berhasil Dihapus');
    }
}

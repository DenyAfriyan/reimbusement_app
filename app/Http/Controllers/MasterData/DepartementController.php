<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('masterdata'), 403);
        $title = 'Departement';
        $departement = Departement::all();
        $dataToView = ['title','departement'];
        return view('masterdata.departement.index',compact($dataToView));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('masterdata'), 403);
        $title = 'Departement';
        $dataToView = ['title'];
        return view('masterdata.departement.create',compact($dataToView));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('masterdata'), 403);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:departements|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Departement::create($request->all());
        return redirect('master-data/departement')->with('message','Data Berhasil Ditambahkan');

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
        $title = 'Departement';
        $departement = Departement::findOrFail($id);
        $dataToView = ['title','departement'];
        return view('masterdata.departement.edit',compact($dataToView));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        abort_if(Gate::denies('masterdata'), 403);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:departements|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $departement = Departement::where('id',$id)->update(['name' => $request->input('name')]);
        return redirect('master-data/departement')->with('message','Data Berhasil Diupdate');
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        abort_if(Gate::denies('masterdata'), 403);
        $departement = Departement::findOrFail($id);
 
        $departement->delete();
        
        return redirect()->back()->with('message','Data Berhasil Dihapus');
    }
}

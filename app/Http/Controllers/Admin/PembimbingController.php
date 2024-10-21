<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Dudi;
use App\Models\Admin\Pembimbing;
use App\Models\Admin\Guru;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Pembimbing()
    {
        $pembimbings = Pembimbing::with('guru', 'dudi')->get();
        
        return view('admin.pembimbing', compact('pembimbings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gurus = Guru::all();
        $dudis = Dudi::all();
        return view('admin.tambah_pembimbing',compact('gurus', 'dudis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_guru' => 'required',
            'id_dudi' => 'required',
        ]);
       
        Pembimbing::create([
            'id_guru' => $request->id_guru,
            'id_dudi' => $request->id_dudi,
        ]);

        return redirect()->route('admin.Pembimbing')->with('Success', 'Data Pembimbng Berhasil di Edit');
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
    public function edit(string $id)
    {
        $pembimbing = Pembimbing::find($id);
        $gurus = Guru::with('pembimbingGuru')->get();
        $dudis = Dudi::with('pembimbingDudi')->get();
        return view('admin.Pembimbing_edit', compact('pembimbing','gurus','dudis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $pembimbing = Pembimbing::find($id);

        $request->validate([
            'id_guru' => 'required',
            'id_dudi' => 'required',
        ]);
       
        $pembimbing->update([
            'id_guru' => $request->id_guru,
            'id_dudi' => $request->id_dudi,
        ]);

        return redirect()->route('admin.Pembimbing')->with('Success', 'Data Pembimbng Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function delete($id)
    {
        $pembimbing = Pembimbing::find($id);
        

         $pembimbing->delete();

        return redirect()->back()->with('Success', 'Data pembimbing Berhasil diHapus');
    

    }
}

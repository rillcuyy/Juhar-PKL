<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Guru;
use App\Models\Admin\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function siswa($id)
    {
        $siswas = Siswa::where('id_pembimbing',$id)->get();
        $siswa = Siswa::where('id_pembimbing',$id)->first();

        return view('admin.siswa', compact('siswas','siswa','id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('admin.siswa_tambah',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'nisn' => 'required|unique:siswa,nisn|digits:10',
            'nama_siswa' => 'required',
            'password' => 'required|min:6',
            'foto' => 'nullable|image|mimes:siswa,jpeg,jpg,png,gif|max:2048',
            
        ]);

        $foto = null;

        if($request->hasFile('foto')){
            $uniqueField = uniqid() . '_' . $request->file('foto')->getClientOriginalName();

            $request->file('foto')->storeAs('foto_siswa', $uniqueField, 'public');

            $foto = 'foto_siswa/' . $uniqueField;
        }

        Siswa::create([
            'id_pembimbing'=> $id,
            'nisn' => $request->nisn,
            'nama_siswa' => $request->nama_siswa,
            'password' => Hash::make( $request->password),
            'foto' => $foto,

        ]);

        return redirect()->route('admin.siswa', $id)->with('success','Data Siswa Berhasil di Tambah'); 

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
    public function edit(string $id, $id_siswa)
    {
        $siswa = Siswa::find($id_siswa);
        return view('admin.edit_siswa', compact('siswa','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id,$id_siswa)
    {
        $siswa = Siswa::find($id_siswa);

        $request->validate([
            'nisn' => 'required|digits:10|unique:siswa,nisn,' . $siswa->id_siswa . ',id_siswa',
            'nama_siswa' => 'required',
            'password' => 'nullable|min:6',
            'foto' => 'nullable|image|mimes:siswa,jpeg,jpg,png,gif|max:2048',
            
        ]);

        $foto = $siswa->foto;
        if($request->hasFile('foto')){
            if ('foto'){
                Storage::disk('public')->delete($foto);
            }
            $uniqueField = uniqid() . '_' . $request->file('foto')->getClientOriginalName();

            $request->file('foto')->storeAs('foto_siswa',  $uniqueField, 'public');

            $foto = 'foto_siswa/' . $uniqueField;
        }

        $siswa->update([
            'nisn' => $request->nisn,
            'nama_siswa' => $request->nama_siswa,
            'password' => $request->filled('password') ? Hash::make( $request->password) : $siswa->password,
            'foto' => $foto,
        ]);

        return redirect()->route('admin.siswa', $id)->with('Success', 'Data Siswa Berhasil di Edit');
    }


    public function delete($id,$id_siswa)
    {
        $siswa = Siswa::find($id_siswa);
        $foto = $siswa->foto;

        if($siswa->foto) {
            if(Storage::disk('public')->exists($foto)){
                Storage::disk('public')->delete($foto);
        }


        }

         $siswa->delete();

        return redirect()->back()->with('Success', 'Data siswa Berhasil diHapus');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function siswaGuru($id)
    {
        $siswas = Siswa::where('id_pembimbing',$id)->get();
        $siswa = Siswa::where('id_pembimbing',$id)->first();

        return view('guru.siswa', compact('siswas','siswa','id'));
    }
}

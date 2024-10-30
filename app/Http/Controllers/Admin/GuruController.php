<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function guru()
    {
        $gurus = Guru::all();
        return view('admin.guru', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guru_tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'nullable|unique:guru,nip|digits:18',
            'email' => 'required|email|unique:guru,email',
            'password' => 'required|min:6',
            'nama_guru' => 'required',
            'foto' => 'nullable|image|mimes:guru,jpeg,jpg,png,gif|max:2048',
            
        ]);

        $foto = null;

        if($request->hasFile('foto')){
            $uniqueField = uniqid() . '_' . $request->file('foto')->getClientOriginalName();

            $request->file('foto')->storeAs('foto_guru', $uniqueField, 'public');

            $foto = 'foto_guru/' . $uniqueField;
        }

        Guru::create([
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => Hash::make( $request->password),
            'nama_guru' => $request->nama_guru,
            'foto' => $foto,

        ]);

        return redirect()->route('admin.Guru')->with('success','Data Guru Berhasil di Tambah'); 
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
        
        $guru = Guru::find($id);
        if(!$guru){
            return back();
        }
        return view('admin.edit_guru', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guru = Guru::find($id);

        $request->validate([
            'nip' => 'nullable|digits:18|unique:guru,nip,' . $guru->id_guru . ',id_guru',
            'email' => 'required|email|unique:guru,email,' . $guru->id_guru . ',id_guru',
            'password' => 'nullable|min:6',
            'nama_guru' => 'required',
            'foto' => 'nullable|image|mimes:guru,jpeg,jpg,png,gif|max:2048',
            
        ]);

        $foto = $guru->foto;
        if($request->hasFile('foto')){
            if ('foto'){
                Storage::disk('public')->delete($foto);
            }
            $uniqueField = uniqid() . '_' . $request->file('foto')->getClientOriginalName();

            $request->file('foto')->storeAs('foto_guru',  $uniqueField, 'public');

            $foto = 'foto_guru/' . $uniqueField;
        }

        $guru->update([
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make( $request->password) : $guru->password,
            'nama_guru' => $request->nama_guru,
            'foto' => $foto,
        ]);

        return redirect()->route('admin.Guru')->with('success', 'Data Guru Berhasil di Edit');
    }


    public function delete($id)
    {
        $guru = Guru::find($id);
        $foto = $guru->foto;

        if($guru->foto) {
            if(Storage::disk('public')->exists($foto)){
                Storage::disk('public')->delete($foto);
        }


        }

         $guru->delete();

        return redirect()->back()->with('success', 'Data Guru Berhasil diHapus');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logoutGuru(Request $request)
    {
        Auth::guard('guru')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('guru.login');
    }

    public function profileGuru()
    {
        $profile = Auth::guard('guru')->user();
        return view('guru.profile_guru', compact('profile'));
    }


    public function updateGuru(Request $request)
    {
        $id_guru = Auth::guard('guru')->user()->id_guru;
        $guru = Guru::find($id_guru);


        $request->validate([
            'nip' => 'nullable|digits:18|unique:guru,nip,' . $id_guru . ',id_guru',
            'email' => 'required|email|unique:guru,email,' . $id_guru . ',id_guru',
            'password' => 'nullable|min:6',
            'nama_guru' => 'required',
            'foto' => 'nullable|image|mimes:guru,jpeg,jpg,png,gif|max:2048',
            
        ]);

        $foto = $guru->foto;
        if($request->hasFile('foto')){
            if ('foto'){
                Storage::disk('public')->delete($foto);
            }
            $uniqueField = uniqid() . '_' . $request->file('foto')->getClientOriginalName();

            $request->file('foto')->storeAs('foto_guru',  $uniqueField, 'public');

            $foto = 'foto_guru/' . $uniqueField;
        }

        $guru->update([
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make( $request->password) : $guru->password,
            'nama_guru' => $request->nama_guru,
            'foto' => $foto,
        ]);

        return redirect()->route('guru.profile_guru')->with('success', 'Data Guru Berhasil di Edit');
    }

    
}

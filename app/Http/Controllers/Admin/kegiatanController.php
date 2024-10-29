<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Kegiatan;
use App\Models\Admin\Pembimbing;
use App\Models\Admin\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class kegiatanController extends Controller
{
    public function Kegiatan($id, $id_siswa)

    {

        $loginGuru = Auth::guard('guru')->user()->id_guru;

        $siswa = Siswa::find($id_siswa);

        if(!$siswa || !$siswa->id_pembimbing)
        {
            return back()->withErrors(['access' => 'Siswa tidak ditemukan atau tidak memiliki pembimbing' ]);
        }

        if($siswa->id_pembimbing !=$id)
        {
            return back()->withErrors(['access' => 'Pembimbing tidak sesuai' ]);
        }

        $pembimbing = Pembimbing::find($id);

        if(!$pembimbing || $pembimbing->id_guru !== $loginGuru)
        {
            return back()->withErrors(['access' => 'Akses anda ditolak. Siswa ini tidak dibimbing anda' ]);
        }
    
        

        $kegiatans = Kegiatan::where('id_siswa', $id_siswa)->get();
        $kegiatan = Kegiatan::where('id_siswa', $id_siswa)->first();
        $id_pembimbing = $id;
        return view('guru.kegiatan',compact('kegiatans','kegiatan','id_pembimbing'));
    }


    

   
    public function kegiatanDetail($id, $id_siswa, $id_kegiatan)
    {

    $loginGuru = Auth::guard('guru')->user()->id_guru;

    $siswa = Siswa::find($id_siswa);

    if(!$siswa || !$siswa->id_pembimbing)
    {
        return back()->withErrors(['access' => 'Siswa tidak ditemukan atau tidak memiliki pembimbing' ]);
    }

    if($siswa->id_pembimbing !=$id)
    {
        return back()->withErrors(['access' => 'Pembimbing tidak sesuai' ]);
    }

    $pembimbing = Pembimbing::find($id);

    if(!$pembimbing || $pembimbing->id_guru !== $loginGuru)
    {
        return back()->withErrors(['access' => 'Akses anda ditolak. Siswa ini tidak dibimbing anda' ]);
    }


        $kegiatan = Kegiatan::where('id_kegiatan', $id_kegiatan)
                            ->where('id_siswa', $id_siswa)
                            ->first();

        if (!$kegiatan) {
            return back()->withErrors(['access' => 'Kegiatan siswa Tidak Tersedia.']);
        }
        
        return view('guru.kegiatan_siswa_detail', compact('id', 'kegiatan'));
    }

    public function kegiatanSiswa()
    {
        $id_siswa = Auth::guard('siswa')->user()->id_siswa;
        $kegiatans = Kegiatan::where('id_siswa',$id_siswa)->get();
        
        return view('siswa.kegiatan_siswa', compact('kegiatans'));

        

    }

    public function create()
    {
        return view('siswa.kegiatan_tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_siswa = Auth::guard('siswa')->user()->id_siswa;
        $request->validate([
            'tanggal_kegiatan' => 'required',
            'nama_kegiatan' => 'required',
            'ringkasan_kegiatan' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048',
            
        ]);

        $foto = null;

        if($request->hasFile('foto')){
            $uniqueField = uniqid() . '_' . $request->file('foto')->getClientOriginalName();

            $request->file('foto')->storeAs('foto_kegiatan', $uniqueField, 'public');

            $foto = 'foto_kegiatan/' . $uniqueField;
        }

        Kegiatan::create([
            'id_siswa' => $id_siswa,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'nama_kegiatan' => $request->nama_kegiatan,
            'ringkasan_kegiatan' => $request->ringkasan_kegiatan,
            'foto' => $foto,

        ]);

        return redirect()->route('siswa.kegiatan_siswa')->with('success','Kegiatan Berhasil di Tambah'); 
    }

    public function edit(string $id)
    {
        $kegiatan = Kegiatan::find($id);
        return view('siswa.kegiatan_edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kegiatan = Kegiatan::find($id);

        $request->validate([
            'tanggal_kegiatan' => 'required' ,
            'nama_kegiatan' => 'required' ,
            'ringkasan_kegiatan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            
        ]);

        $foto = $kegiatan->foto;
        if($request->hasFile('foto')){
            if ('foto'){
                Storage::disk('public')->delete($foto);
            }
            $uniqueField = uniqid() . '_' . $request->file('foto')->getClientOriginalName();

            $request->file('foto')->storeAs('foto_kegiatan',  $uniqueField, 'public');

            $foto = 'foto_kegiatan/' . $uniqueField;
        }

        $kegiatan->update([
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'nama_kegiatan' => $request->nama_kegiatan,
            'ringkasan_kegiatan' => $request->ringkasan_kegiatan,
            'foto' => $foto,
        ]);

        return redirect()->route('siswa.kegiatan_siswa')->with('Success', 'Kegiatan Berhasil di Edit');
    }


    public function delete($id)
    {
        $kegiatan = Kegiatan::find($id);
        $foto = $kegiatan->foto;

        if($kegiatan->foto) {
            if(Storage::disk('public')->exists($foto)){
               Storage::disk('public')->delete($foto);
        }


        }

         $kegiatan->delete();

        return redirect()->back()->with('Success', 'Data Guru Berhasil diHapus');
    }

    public function detail($id_kegiatan)
    {

    $id_siswa = Auth::guard('siswa')->user()->id_siswa;

        $kegiatan = Kegiatan::where('id_kegiatan', $id_kegiatan)
                            ->where('id_siswa', $id_siswa)
                            ->first();

        if (!$kegiatan) {
            return back()->withErrors(['access' => 'Kegiatan siswa Tidak Tersedia.']);
        }
        
        return view('siswa.kegiatan_detail', compact('kegiatan'));
    }
}

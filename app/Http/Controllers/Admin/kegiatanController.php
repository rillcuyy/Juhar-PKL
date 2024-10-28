<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Kegiatan;
use App\Models\Admin\Pembimbing;
use App\Models\Admin\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}

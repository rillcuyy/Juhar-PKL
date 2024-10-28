@extends('guru.layout.app')

@section('tittle','Detail Kegiatan')

@section('content')

@if ($errors->has('access'))
<div class="alert alert-danger">
    {{ $errors->first('access')}}
</div>

@endif


@if($kegiatan)
<div class="row bg-light rounded align-items-center mx-0">
    <div class="col-md-6 p-3">
        <table>
            <tr>
                <td width="100">nama siswa</td>
                <td width="30">=></td>
                <td>
                {{$kegiatan->kegiatanSiswa->nama_siswa}}
                </td>
            </tr>


        </table>
    </div>
</div>
@endif

<br>
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Detail Kegiatan</h6>
                <form action="" method="post">

                    <div class="mb-3">
                        <label for="nama_kegiatan" class="form-label">Nama kegiatan</label>
                        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="{{old('nama_kegiatan', $kegiatan->nama_kegiatan)}}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="ringkasan_kegiatan" class="form-label">Ringkasan Kegiatan</label>
                        <input type="text" class="form-control" id="ringkasan_kegiatan" name="ringkasan_kegiatan" value="{{old('ringkasan_kegiatan', $kegiatan->ringkasan_kegiatan)}}" readonly>

                    </div>

                    <div class="mb-3">
                        <label for="tanggal_kegiatan" class="form-label">Tanggal Kegiatan</label>
                        <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan" value="{{old('tanggal_kegiatan', $kegiatan->tanggal_kegiatan)}}" readonly>

                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Kegiatan</label>


                    </div>
                    <a href="{{route('guru.pembimbing_siswa_kegiatan', ['id' => $id, 'id_siswa' => $kegiatan->id_siswa])}}" class="btn btn-primary">Kembali</a>
                </form>
            </div>
        </div>



    @endsection
@extends('siswa.layout.app')

@section('tittle','Edit Kegiatan')

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Edit Kegiatan</h6>
                <form action="{{route('siswa.kegiatan_siswa_update', $kegiatan->id_kegiatan)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="tanggal_kegiatan" class="form-label">TANGGAL KEGIATAN</label>
                        <input type="date" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan" value="{{old('tanggal_kegiatan', $kegiatan->tanggal_kegiatan)}}">
                        <div class="text-danger">
                            @error('tanggal_kegiatan')
                            {{$message}}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_kegiatan" class="form-label">NAMA KEGIATAN</label>
                        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="{{old('nama_kegiatan', $kegiatan->nama_kegiatan)}}">
                        <div class="text-danger">
                        @error('nama_kegiatan')
                        {{$message}}
                        @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="ringkasan_kegiatan" class="form-label">RINGKASAN KEGIATAN</label>
                        <textarea name="ringkasan_kegiatan" id="ringkasan_kegiatan" rows="5" class="form-control">{{$kegiatan->ringkasan_kegiatan}}</textarea>
                        <div class="text-danger">
                        @error('ringkasan_kegiatan')
                        {{$message}}
                        @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">FOTO KEGIATAN</label>
                        <input type="file" class="form-control" id="foto" name="foto" >
                        <div class="text-danger">
                        @error('foto')
                        {{$message}}
                        @enderror
                        </div>
                    </div>

        

                    <button type="submit" class="btn btn-primary">SAVE</button>

                </form>
            </div>
        </div>

    </div>


    @endsection
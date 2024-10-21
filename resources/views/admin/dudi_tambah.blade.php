@extends('admin.layout.app')

@section('tittle','Tambah Dudi')

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Tambah DUDI</h6>
                <form action="{{route('admin.dudi_store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_dudi" class="form-label">NAMA DUDI</label>
                        <input type="text" class="form-control" id="nama_dudi" name="nama_dudi">
                        <div class="text-danger">
                            @error('nama_dudi')
                            {{$message}}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat_dudi" class="form-label">ALAMAT DUDI</label>
                        <input type="text" class="form-control" id="alamat_dudi" name="alamat_dudi">
                        <div class="text-danger">
                        @error('email')
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
@extends('siswa.layout.app')

@section('tittle','Profile')

@section('content')

<div class="row g-4 justify-content-center">
    <div class="col-6">
        <div class="bg-light rounded h-100 p-4">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success')}}
            </div>
            @endif
            <div class="d-flex align-items-center justify-content-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="{{asset('storage/'. $profile->foto)}}" alt="" style="width: 100px; height: 100px;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
               
            </div>
            <form action="{{route('siswa.siswa_update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="nisn" class="form-label">nisn</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" value="{{old ('nisn', $profile ->nisn)}}" readonly>
                    <div class="text-danger">
                        @error('nisn')
                        {{$message}}
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nama_siswa" class="form-label">nama siswa</label>
                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="{{old ('nama_siswa', $profile ->nama_siswa)}}">
                    <div class="text-danger">
                        @error('nama_siswa')
                        {{$message}}
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="text-danger">
                        @error('password')
                        {{$message}}
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">FOTO</label>
                    <input type="file" class="form-control" id="foto" name="foto" value="{{old ('foto', $profile ->foto)}}">
                    <div class="text-danger">
                        @error('foto')
                        {{$message}}
                        @enderror
                    </div>
                </div>

                <div class="text-center">
                <button type="submit" class="btn btn-primary">SAVE</button>
                </div>

            </form>
        </div>
    </div>

</div>

@endsection
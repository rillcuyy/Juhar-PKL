@extends('admin.layout.app')

@section('tittle','Edit Guru')

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Edit Guru</h6>
                <form action="{{route('admin.guru_update', $guru->id_guru)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="{{old('nip', $guru->nip)}}">
                        <div class="text-danger">
                            @error('nip')
                            {{$message}}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">EMAIL</label>
                        <input type="email" class="form-control" id="email" name="email"  value="{{old('email', $guru->email)}}">
                        <div class="text-danger">
                        @error('email')
                        {{$message}}
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">PASSWORD</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <div class="text-danger">
                        @error('password')
                        {{$message}}
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_guru" class="form-label">NAMA GURU</label>
                        <input type="text" class="form-control" id="nama_guru" name="nama_guru"  value="{{old('nama_guru', $guru->nama_guru)}}">
                        <div class="text-danger">
                        @error('nama_guru')
                        {{$message}}
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">FOTO</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                        <div class="text-danger">
                        @error('foto')
                        {{$message}}
                        @enderror
                    </div>
                    <div class="mb-2">
                    <img src="{{asset('storage/' . $guru->foto)}}" alt="" height="80">
                    </div>
                    <button type="submit" class="btn btn-primary">SAVE</button>

                </form>
            </div>
        </div>

    </div>


    @endsection
@extends('admin.layout.app')

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
            <form action="{{route('admin.profile_update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="username" class="form-label">username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{old ('username', $profile ->username)}}">
                    <div class="text-danger">
                        @error('username')
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
                    <label for="nama_admin" class="form-label">NAMA ADMIN</label>
                    <input type="text" class="form-control" id="nama_admin" name="nama_admin" value="{{old ('nama_admin', $profile ->nama_admin)}}">
                    <div class="text-danger">
                        @error('nama_admin')
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
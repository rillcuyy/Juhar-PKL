@extends('admin.layout.app')

@section('tittle','Dashboard')

@section('content')
<div class="row bg-light rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-6 text-center p-3">
                        <h3>Hi,{{Auth::guard('admin')->user()->nama_admin}} Selamat Datang Di Halaman Dashboard</h3>
                    </div>
                </div>

@endsection
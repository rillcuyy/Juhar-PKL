@extends('admin.layout.app')

@section('tittle','Guru')

@section('content')
<h3>GURU</h3>
<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @endif
        <h6 class="mb-4">Data Guru</h6>
        <div class="table-responsive">
            <a href="{{route('admin.dudi_tambah')}}" class="btn btn-primary btn-sm">Tambah</a>
            <table class="table" id="dudi">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">NAMA DUDI</th>
                        <th scope="col">ALAMAT DUDI</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dudis as $dudi)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$dudi->nama_dudi}}</td>
                        <td>{{$dudi->alamat_dudi}}</td>
                        <td>
                            <a href=" {{route('admin.edit_dudi', $dudi->id_dudi)}}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{route('admin.dudi_delete', $dudi->id_dudi)}}" onclick="return confirm('Yakin Ingin Menghapus Data Tersebut')" class="btn btn-danger btn-sm">delete</a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dudi').DataTable();
    });
</script>

@endsection
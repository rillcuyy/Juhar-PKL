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
            <a href="{{route('admin.guru_tambah')}}" class="btn btn-primary btn-sm">Tambah</a>
            <table class="table" id="guru">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">NIP</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">NAMA GURU</th>
                        <th scope="col">FOTO</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gurus as $guru)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>
                            @if($guru->nip)
                            {{$guru->nip}}
                            @else
                            BELUM MEMILIKI NIP
                            @endif
                        </td>
                        <td>{{$guru->email}}</td>
                        <td>{{$guru->nama_guru}}</td>
                        <td>
                            <img src="{{asset('storage/'.$guru->foto)}}" alt="" height="30">
                        </td>
                        <td>
                            <a href=" {{route('admin.guru_edit', $guru->id_guru)}}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{route('admin.guru_delete', $guru->id_guru)}}" onclick="return confirm('Yakin Ingin Menghapus Data Tersebut')" class="btn btn-danger btn-sm">delete</a>
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
        $('#guru').DataTable();
    });
</script>

@endsection
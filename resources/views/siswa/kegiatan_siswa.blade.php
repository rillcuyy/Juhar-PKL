@extends('siswa.layout.app')

@section('tittle','kegiatan')

@section('content')

<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @endif
        <h6 class="mb-4">Data kegiatan</h6>
        <div class="table-responsive">
            <a href="" class="btn btn-primary btn-sm">Tambah</a>

            <table class="table" id="kegiatan">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col" style="text-align:center;">tanggal kegiatan</th>
                        <th scope="col" style="text-align:center;">NAMA kegiatan</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($kegiatans as $kegiatan)
                    <tr>

                        <th scope="row">{{$loop->iteration}}</th>
                        <td style="text-align:center;">{{$kegiatan->tanggal_kegiatan}}</td>
                        <td style="text-align:center;">{{$kegiatan->nama_kegiatan}}</td>
                        <td>
                            <a href="" class="btn btn-warning btn-sm">Edit</a>
                            <a href="" class="btn btn-danger btn-sm">Hapus</a>
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
        $('#kegiatan').DataTable();
    });
</script>
@endsection
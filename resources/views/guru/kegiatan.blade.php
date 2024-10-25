@extends('guru.layout.app')

@section('tittle','kegiatan')

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
<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @endif
        <h6 class="mb-4">Data kegiatan</h6>
        <div class="table-responsive">
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
                            <a href="{{route('guru.pembimbing_siswa_kegiatan_detail',['id' => $id_pembimbing, 'id_siswa'=> $kegiatan->id_siswa, 'id_kegiatan' => $kegiatan->id_kegiatan])}}" class="btn btn-warning btn-sm">Detail</a>


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
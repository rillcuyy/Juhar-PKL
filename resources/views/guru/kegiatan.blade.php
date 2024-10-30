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

            <form action="{{route('guru.pembimbing_siswa_kegiatan_cari', ['id' => $id_pembimbing, 'id_siswa'=>$id_siswa])}}" method="get" class="row g-3">

                <div class="col-auto">
                    <label for="tanggal_awal" class="form-label">TANGGAL AWAL</label>
                    <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="{{$tanggalAwal ?? ''}}">
                    <div class="text-danger">
                        @error('tanggal_awal')
                        {{$message}}
                        @enderror
                    </div>
                </div>

                <div class="col-auto">
                    <label for="tanggal_akhir" class="form-label">TANGGAL AKHIR</label>
                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="{{$tanggalAkhir ?? ''}}">
                    <div class="text-danger">
                        @error('tanggal_akhir')
                        {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="col-auto align-self-end">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    <a href="{{route('guru.pembimbing_siswa_kegiatan', ['id' => $id_pembimbing, 'id_siswa'=>$id_siswa])}}" class="btn btn-primary"><I class="fas fa-sync-alt"></I></a>
                </div>
            </form>
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
                            <a href="{{route('guru.kegiatan_siswa_detail',['id' => $id_pembimbing, 'id_siswa'=> $kegiatan->id_siswa, 'id_kegiatan' => $kegiatan->id_kegiatan])}}" class="btn btn-primary btn-sm">Detail</a>


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
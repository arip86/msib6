@extends('admin.layouts.app')
@section('konten')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<h1 align="center">Input Pelanggan</h1>
<form method="POST" action="{{route('pelanggan.update', $pl->id)}}"
enctype="multipart/form-data">
@csrf
@method('PUT')
  <div class="form-group row">
    <label for="text" class="col-4 col-form-label">Kode</label> 
    <div class="col-8">
      <input id="text" name="kode" type="text" class="form-control" value="{{$pl->kode}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="text1" class="col-4 col-form-label">Nama</label> 
    <div class="col-8">
      <input id="text1" name="nama" type="text" class="form-control"  value="{{$pl->nama}}" >
    </div>
  </div>
  <div class="form-group row">
    <label for="text2" class="col-4 col-form-label">Jenis Kelamin</label> 
    <div class="col-8">
        @foreach ($gender as $g)
        @php 
        $cek = ($g == $pl->jk) ? 'checked': ''; @endphp
    <div class="custom-control custom-radio custom-control-inline">
        <input name="jk" id="radio_0{{$g}}" type="radio" 
        class="custom-control-input" value="{{$g}}" {{$cek}}> 
        <label for="radio_0{{$g}}" class="custom-control-label">{{$g}}</label>
      </div>
      @endforeach
    </div>
  </div>
  <div class="form-group row">
    <label for="text3" class="col-4 col-form-label">Tempat Lahir</label> 
    <div class="col-8">
      <input id="text3" name="tmp_lahir" type="text" class="form-control"  value="{{$pl->tmp_lahir}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="text4" class="col-4 col-form-label">Tanggal Lahir</label> 
    <div class="col-8">
      <input id="text4" name="tgl_lahir" type="date" class="form-control"  value="{{$pl->tgl_lahir}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="text5" class="col-4 col-form-label">Email</label> 
    <div class="col-8">
      <input id="text5" name="email" type="email" class="form-control" value="{{$pl->email}}">
    </div>
  </div>
  <div class="form-group row">
    <label for="text5" class="col-4 col-form-label">Foto</label> 
    <div class="col-8">
      <input id="text5" name="foto" type="file" class="form-control"  value="{{$pl->foto}}">
      @if(!empty($pl->foto))
      <img src="{{url('admin/image')}}/{{$pl->foto}}" alt="">
      @endif
    
    </div>
  </div>
  <div class="form-group row">
    <label for="select" class="col-4 col-form-label">Pilihan Kartu</label> 
    <div class="col-8">
      <select id="select" name="kartu_id" class="custom-select">
        @foreach($kartu as $k)
        @php 
        $sel = ($k->id == $pl->kartu_id) ? 'selected' : '';
        @endphp
        <option value="{{$k->id}}" {{$sel}}>{{$k->nama}}</option>
        @endforeach
      </select>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>


@endsection
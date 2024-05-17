@extends('admin.layouts.app')
@section('konten')

@foreach($produk as $p)

<h1>Hallo {{$p->nama}}</h1>

@endforeach

@endsection
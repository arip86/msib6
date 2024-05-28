@extends('admin.layouts.app')
@section('konten')

<div class="container-fluid px-4">
                        <h1 class="mt-4">Pelanggan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                        <div class="card mb-4">
                            
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                            <a href="{{route('pelanggan.create')}}" 
                            class="btn btn-md btn-primary" >
                                <i class="fa-solid fa-square-plus"></i>
                            </a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            
                                            
                                          
                                            <th>Kartu</th>
                                            <th>Action</th>
                                           

                                        </tr>
                                    </thead>
                                    <tfoot>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            
                                           
                                          
                                            <th>Kartu</th>
                                            <th>Action</th>
                                    </tfoot>
                                    <tbody>
                                        
                                        @foreach($pelanggan as $p)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$p->kode}}</td>
                                            <td>{{$p->nama}}</td>
                                            <td>{{$p->jk}}</td>
                                          
                                            
                                            
                                            <td>{{$p->kartu->nama}}</td>
                                            <td>
                                        <a href="{{route('pelanggan.show', $p->id)}}" 
                                        class="btn btn-sm btn-success">
                                        <i class="fa-solid fa-eye"></i></a>
                                        <a href="{{route('pelanggan.edit', $p->id)}}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i></a>
                                    <!-- ini untuk modal hapus -->
                                        <!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-sm" 
data-bs-toggle="modal" data-bs-target="#exampleModal{{$p->id}}">
<i class="fa-solid fa-trash-can"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Produk</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin akan menghapus data {{$p->nama}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        <form action="{{ route('pelanggan.destroy', $p->id) }}"
         method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>

                              
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection
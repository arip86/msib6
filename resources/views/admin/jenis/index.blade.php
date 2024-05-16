@extends('admin.layouts.app')
@section('konten')
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jenis Produk</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{url('admin/jenis_produk/store')}}" 
        method="POST" enctype="multipart/form-data" >
            @csrf
        <input type="text" class="form-control" name="nama"
         id="exampleInputEmail1" aria-describedby="emailHelp"
        placeholder="Tambah Jenis Produk">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ini batas modal -->

<div class="container-fluid px-4">
                        <h1 class="mt-4">Jenis Produk</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                        <div class="card mb-4">
                           <!-- tadi saya hapus tampilan disini -->
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                              <a href="" class="btn btn-md btn-primary" 
                              data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-square-plus">

                                </i></a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Produk</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                            <th>No</th>
                                            <th>Jenis Produk</th>
                                    </tfoot>
                                    <tbody>
                                        
                                        @foreach($jenis as $j)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$j->nama}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection
@extends('layouts.dashboard')
@section('content')
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Manage Kejadian</li>
                        </ol>
                     
                       
                        <div class="card mb-4">
                             <div class="card-header d-flex">
                                 <div class="data">
                                    <i class="fas fa-table mr-1"></i>
                                DataTable Kejadian
                                </div>
                                <div class="button ml-auto">

                                <a href="{{route('laporankejadian.create')}}" class="btn btn-success"  >Tambah Kejadian</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Warga</th>
                                                <th class="text-center">Nama  Kejadian</th>
                                                <th class="text-center">Keterangan</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                               <?php $i = 1; ?>   

                                           @foreach ($kejadian as $item)
                                               <tr>
                                                    <td><?= $i ?></td>
                                                    <td class="text-center">{{$item->warga->nama}}</td>
                                                    <td class="text-center">{{$item->ParamKejadian->nama}}</td>
                                                    <td class="text-center">{{$item->keterangan}}</td>
                                                    <td class="text-center">
                                                        @if ($item->status == "Pending")
                                                           <span class="badge badge-warning">Pending</span>
                                                           @else
                                                           <span class="badge badge-success">Success</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($item->status == "Pending")
                                                            <a href="{{route('laporankejadian.edit',$item->kejadian_id)}}" class="btn btn-sm btn-success">Update</a>
                                                        @endif
                                                        <form action="{{ route('laporankejadian.destroy', $item->kejadian_id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('delete')

                                                            <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('Yakin Data Mau Dihapus??');">Hapus</button>
                                                        </form>
                                                    </td>
                                               </tr> 
                                               <?php $i++ ?>   
                                           @endforeach
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                
    <!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> --}}

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Param Kejadian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('paramkejadian.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Kejadian</label>
            <input type="text" name="nama" id="nama" required class="form-control" placeholder="Masukan Nama Kejadian">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
    </form>
      </div>
     
    </div>
  </div>
</div>
@endsection
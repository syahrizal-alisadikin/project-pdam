@extends('layouts.dashboard-rw')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Management Warga</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Primary Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Warning Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Success Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
           <div class="card-header d-flex">
               <div class="data">
                <i class="fas fa-table mr-1"></i>
                DataTable Costumers
            </div>
            <div class="button ml-auto">

               <a href="{{ route('warga.create') }}" class="btn btn-success" name="tambah" id="tambah" >Tambah Warga</a>
           </div>
       </div>
       <div class="card-body">
        <div class="table-responsive">

            @if (session('sukses'))
            <div class="alert alert-primary">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('sukses') }}
            </div>
            @elseif(session('gagal'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('gagal') }}
            </div>
            @endif

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>RW ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>No Hp</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                @foreach($warga as $key)
                <tbody>
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$key->nama}}</td>
                        <td>{{$key->email}}</td>
                        <td>{{$key->alamat}}</td>
                        <td>{{$key->phone}}</td>
                        <td>{{$key->status}}</td>
                        <td align="center" class="d-flex">
                            <a href="{{ route('warga.edit',$key->warga_id) }}" class="btn btn-sm btn-success"><i class="fa fa-pencil-alt"></i></a>
                            <form action="{{ route('warga.destroy', $key->warga_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('Yakin Data Mau Dihapus??');"> <i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>
</div>
</main>


@endsection
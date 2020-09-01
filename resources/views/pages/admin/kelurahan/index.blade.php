@extends('layouts.dashboard')
@section('content')
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Manag Kelurahan</li>
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

                                <a href="{{route('kelurahan.create')}}" class="btn btn-success" name="tambah" id="tambah" >Tambah Kelurahan</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="text-center">Kota</th>
                                                <th class="text-center">kecamatan</th>
                                                <th class="text-center">Kelurahan</th>
                                                <th class="text-center">Action</th>
                                                
                                            </tr>
                                        </thead>
                                     
                                        <tbody>
                                            <?php $i =1 ; ?>
                                          @foreach ($kelurahans as $kelurahan)
                                              <tr>
                                                  <td><?= $i;?></td>
                                                    <td class="text-center">{{$kelurahan->kecamatan->kota->name}}</td>
                                                    <td class="text-center">{{$kelurahan->kecamatan->name}}</td>
                                                    <td class="text-center">{{$kelurahan->name}}</td>
                                                    <td class="text-center">
                                                         <button class="btn btn-success btn-sm" id="ubahData" onclick="ubahData('{{route('kelurahan.update',$kelurahan->kelurahan_id)}}','{{$kelurahan->name}}')"  role="button" ><i class="fas fa-pencil-alt"></i></button>
                                                        
                                                        <form action="{{ route('kelurahan.destroy', $kelurahan->kelurahan_id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('delete')

                                                            <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('Yakin Data Mau Dihapus??');"> <i class="fa  fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                              </tr>
                                              <?php $i++?>
                                          @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                
    
@endsection
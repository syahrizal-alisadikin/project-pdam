@extends('layouts.dashboard')
@section('content')
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Manage Pemabayaran</li>
                        </ol>
                        {{-- <div class="row">
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
                        </div> --}}
                       
                        <div class="card mb-4">
                             <div class="card-header d-flex">
                                 <div class="data">
                                    <i class="fas fa-table mr-1"></i>
                                DataTable Costumers
                                </div>
                                <div class="button ml-auto">

                                 {{-- <a href="{{route('pembayaran.create')}}" class="btn btn-success" name="tambah" id="tambah" >Tambah Pembayaran</a> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>RW </th>
                                                <th>Nama</th>
                                                <th>Tagihan</th>
                                                <th>jumlah</th>
                                                <th>Tanggal Bayar</th>
                                                <th>Jumlah Bayar</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tagihan as $tag)
                                                <tr>
                                                 <td>{{$tag->tagihan->rw->name}}</td>
                                                 <td>{{$tag->tagihan->tarif->nama_tarif}}</td>
                                                 <td>{{$tag->tagihan->tanggal_tagihan}}</td>
                                                 <td>Rp{{number_format($tag->tagihan->tarif->jumlah_tarif, 0, ',', '.')}}</td>
                                                 <td class="text-center">
                                                     @if ($tag->tanggal_bayar == null)
                                                       <span class="badge badge-danger">-</span>
                                                    @else
                                                        {{$tag->tanggal_bayar}}
                                                     @endif
                                                 </td>
                                                 <td class="text-center">
                                                     @if ($tag->jumlah_bayar == null)
                                                       <span class="badge badge-danger">-</span>
                                                     @else
                                                       Rp{{number_format($tag->jumlah_bayar, 0, ',', '.')}}
                                                     @endif
                                                 </td>
                                                  <td>
                                                     @if ($tag->status == "Pending")
                                                       <span class="badge badge-warning">Pending</span>
                                                    @else
                                                       <span class="badge badge-success">Success</span>
                                                     @endif
                                                 </td>
                                                 <td>
                                                    @if ($tag->status == "Pending")
                                                 <a href="{{route('pembayaran.edit',$tag->pembayaran_id)}}" class="btn btn-success btn-sm">Bayar</a>
                                                    @else
                                                       <span class="badge badge-success">Lunas</span>
                                                     @endif
                                                 </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                
    
@endsection
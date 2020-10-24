@extends('layouts.dashboard-rw')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard RW</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Management Views Pembayaran Warga</li>
        </ol>
       

        <div class="card mb-4">
           <div class="card-header d-flex">
               <div class="data">
                <i class="fas fa-table mr-1"></i>
                Details Pembayaran
            </div>
            <div class="button ml-auto">

           </div>
       </div>
       <div class="card-body">
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
            <form action="{{ route('bayar-pembayaran',$data->pembayaran_id) }}" method="POST">
              @csrf
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Nama Tagihan</label>
                  <input type="text" name="jumlah" required class="form-control" readonly value="{{ $data->tagihan->tarif->nama_tarif }}">
                </div>
                <div class="form-group">
                  <label>Tanggal Pembayaran</label>
                  <input type="date" name="tanggal_bayar" required class="form-control">
                </div>
                <div class="form-group">
                  <label>Jumlah Pembayaran</label>
                <input type="number" name="jumlah_bayar" required class="form-control" value="{{$data->tagihan->tarif->jumlah_tarif}}" placeholder="Masukan Jumlah Pembayaran">
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-sm btn-success">Bayar</button>
                </div>
                <div class="float-left">
                  <a href="{{ route('pembayaran-warga.index') }}" class="btn btn-sm btn-danger">Cancel</a>
                </div>
              </div>                    
            </form> 
       </div>
      </div>  
  </div>
</main>
@endsection
<!-- yang ini blumm mas, iya mas pake modal aja kayaknya  -->
<!-- Bener ngak mas ? -->
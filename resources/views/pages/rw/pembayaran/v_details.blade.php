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
            <form action="{{ route('pembayaran-warga.update',$details->fk_pembayaran_id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              {{ method_field('PUT') }}
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Jumlah Bayar</label>
                  <input type="text" name="jumlah" class="form-control" value="{{ $details->jumlah }}">
                </div>
                <div class="form-group">
                  <label>Image</label>
                  <input type="file" name="image" class="form-control"><br>
                  <img src="{{ $details->image ? url('rw/file/pembayaran/' . $details->image) : url('https://bodybigsize.com/wp-content/uploads/2020/02/noimage-22.png') }}" class="" style="width: auto; height: 200px;">
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-sm btn-success">Update</button>
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
@extends('layouts.dashboard')
@section('content')
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Manage Pembayaran</li>
                        </ol>
                      <div class="col-md-8">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">Update Pembayaran</h5>
                                <form action="{{route('pembayaran.update',$pembayaran->pembayaran_id)}}" method="POST">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group">
                                        <label for="name">Nama Rw</label>
                                        <input type="text" class="form-control" readonly value="{{$pembayaran->tagihan->rw->name}}">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div>
                                    <div class="form-group">
                                        <label for="name">Nama Tagihan</label>
                                    <input type="text" name="name" id="name" readonly class="form-control @error('name') is-invalid @enderror" value="{{$pembayaran->tagihan->nama}}" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div>
                                     <div class="form-group">
                                        <label for="name">Tanggal Bayar</label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror"  required>
                                        @error('tanggal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div>
                                     <div class="form-group">
                                        <label for="jumlah">Jumlah Pembayaran</label>
                                     <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukan Jumlah Pembayaran" value="{{$pembayaran->jumlah_bayar}}" required>
                                        @error('jumlah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div>
                                      <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="Lunas">Lunas</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                      </div>
                       
                        
                    </div>
                </main>
                
    
@endsection
@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function(){
        //active select2
            $("#kota, #provinsi,#kelurahan,#kecamatan,#rw").select2({
            theme:'bootstrap4',width:'style',
            });
        });

        // Ajax Select Kota
        $(document).ready(function(){
            $('select[name="provinsi"]').on('change',function(){
                let provindeId = $(this).val();
                if(provindeId){
                    jQuery.ajax({
                        url: '/admin/cities/'+provindeId,
                        type: "GET",
                        dataType: "json",
                        success: function(response){
                            $('select[name="kota"]').empty();
                            $('select[name="kota"]').append('<option value="">-- Pilih Kota  --</option>');
                            $.each(response, function (key, value) {
                             $('select[name="kota"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }else{
                    $('select[name="kota"]').append('<option value="">-- Pilih Kota --</option>');
                }
            });
        });

        // Ajax Select Kecamatan
       $(document).ready(function(){
            $('select[name="kota"]').on('change',function(){
                let kota_id = $(this).val();
                if(kota_id){
                    jQuery.ajax({
                        url: '/admin/kec/'+kota_id,
                        type: "GET",
                        dataType: "json",
                        success: function(response){
                            $('select[name="kecamatan"]').empty();
                            $('select[name="kecamatan"]').append('<option value="">-- Pilih Kecamatan  --</option>');
                            $.each(response, function (key, value) {
                             $('select[name="kecamatan"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }else{
                    $('select[name="kecamatan"]').append('<option value="">-- Pilih Kecamatan --</option>');
                }
            });
        });

         // Ajax Select Kelurahan
       $(document).ready(function(){
            $('select[name="kota"]').on('change',function(){
                let kelurahan_id = $(this).val();
                if(kelurahan_id){
                    jQuery.ajax({
                        url: '/admin/kel/'+kelurahan_id,
                        type: "GET",
                        dataType: "json",
                        success: function(response){
                            $('select[name="kelurahan"]').empty();
                            $('select[name="kelurahan"]').append('<option value="">-- Pilih Kelurahan  --</option>');
                            $.each(response, function (key, value) {
                             $('select[name="kelurahan"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                }else{
                    $('select[name="kelurahan"]').append('<option value="">-- Pilih Kelurahan --</option>');
                }
            });
        });
    </script>
@endpush
@extends('layouts.dashboard')
@section('content')
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Manage Tagihan</li>
                        </ol>
                      <div class="col-md-8">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">Update Tagihan</h5>
                                <form action="{{route('tagihan.update',$tagihan->tagihan_id)}}" method="POST">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group">
                                        <label for="name">Nama Rw</label>
                                        <input type="text" class="form-control" readonly value="{{$tagihan->rw->name}}">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div>
                                    <div class="form-group">
                                        <label for="name">Nama Tagihan</label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{$tagihan->nama}}" placeholder="Masukan Nama" value="{{old('name')}}" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div>
                                     <div class="form-group">
                                        <label for="name">Tanggal Tagihan</label>
                                        <input type="date" name="tanggal" id="tanggal" value="{{$tagihan->tanggal_tagihan}}" class="form-control @error('tanggal') is-invalid @enderror"  required>
                                        @error('tanggal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div>
                                     <div class="form-group">
                                        <label for="jumlah">Jumlah Tagihan</label>
                                        <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{$tagihan->jumlah_tagihan}}" placeholder="Masukan Jumlah Tagihan" required>
                                        @error('jumlah')
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
@extends('layouts.dashboard')
@section('content')
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Manag Tagihan</li>
                        </ol>
                      <div class="col-md-8">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">Tambah Tagihan</h5>
                                <form action="{{route('tagihan.store')}}" method="POST">
                                    @csrf
                                    {{-- <div class="form-group">
                                        <label for="name">Nama Rw</label>
                                        <select name="rw" id="rw" class="form-control">
                                            @foreach ($rw as $item)
                                            <option value="{{$item->rw_id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div> --}}
                                    <div class="form-group">
                                        <label for="tarif">Nama Tagihan</label>
                                        <select name="tarif" id="tarif" required class="form-control">
                                            <option value="">-- Pilih Tagihan --</option>
                                            @foreach ($tarif as $tar)
                                                <option value={{$tar->tarif_id}}>{{$tar->nama_tarif}}</option>
                                            @endforeach
                                        </select>
                                     </div>
                                     
                                     <div class="form-group">
                                        <label for="jumlah">Jumlah Tagihan</label>
                                        <input type="number" readonly name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukan Jumlah Tagihan" required>
                                        @error('jumlah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div> 
                                    <div class="form-group">
                                        <label for="name">Tanggal Tagihan</label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror"  required>
                                        @error('tanggal')
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
            $('#tarif').on('change',function(){
                let id = $(this).val();

                    jQuery.ajax({
                        url: '/admin/tarif/'+id,
                        type: "GET",
                        dataType: "json",
                        success: function(response){
                            $("#jumlah").val(`${response.jumlah_tarif}`);
                        // response.map((value, key) => {
                        // $("#jumlah").val(`${value.jumlah_tarif}`);
                        
                        // });
                        },
                    });
               
            });
        });

    </script>
@endpush
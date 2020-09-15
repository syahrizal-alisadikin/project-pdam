@extends('layouts.dashboard')
@section('content')
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Manage Kejadian</li>
                        </ol>
                      <div class="col-md-8">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">Tambah Kejadian</h5>
                                <form action="{{route('laporankejadian.store')}}" method="POST">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <label for="tarif">Nama Warga</label>
                                        <select name="warga" id="warga" required class="form-control">
                                            <option value="">-- Pilih Warga --</option>
                                             @foreach ($warga as $war)
                                            <option value="{{$war->warga_id}}">{{$war->nama}}</option>
                                                
                                            @endforeach
                                        </select>
                                     </div>
                                     <div class="form-group">
                                        <label for="rw">Nama Rw</label>
                                        <select name="rw" id="rw" required class="form-control">
                                            <option value="">-- Pilih Warga --</option>
                                           
                                        </select>
                                     </div>
                                     <div class="form-group">
                                        <label for="param">Param Kejadian</label>
                                        <select name="param" id="param" required class="form-control">
                                            <option value="">-- Pilih Param Kejadian --</option>
                                            @foreach ($kejadian as $kej)
                                            <option value="{{$kej->param_id}}">{{$kej->nama}}</option>
                                                
                                            @endforeach
                                        </select>
                                     </div>
                                     
                                     <div class="form-group">
                                        <label for="tanggal_kejadian">Tanggal Kejadian</label>
                                        <input type="date"  name="tanggal_kejadian" id="tanggal_kejadian" class="form-control @error('tanggal_kejadian') is-invalid @enderror"  required>
                                        @error('tanggal_kejadian')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div> 
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5" placeholder="Masukan Keterangan Kejadian"></textarea>
                                        @error('keterangan')
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
            $("#warga, #provinsi,#kelurahan,#param,#rw").select2({
            theme:'bootstrap4',width:'style',
            });
        });

        // Ajax Select Kota
        $(document).ready(function(){
            $('#warga').on('change',function(){
                let id = $(this).val();

                    jQuery.ajax({
                        url: '/admin/laporankejadian/'+id,
                        type: "GET",
                        dataType: "json",
                        success: function(response){
                            // console.log(response);
                            // $("#rw").val(`${response.rw.name}`);
                       $('select[name="rw"]').empty();
                            $('select[name="rw"]').append('<option value="' + response.fk_rw_id + '">' + response.rw.name + '</option>');
                        },
                    });
               
            });
        });

    </script>
@endpush
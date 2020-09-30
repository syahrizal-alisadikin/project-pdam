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
                                <h5 class="text-center">Update Kejadian</h5>
                                <form action="{{route('laporankejadian.update',$lapor->kejadian_id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="tarif">Nama Warga</label>
                                        <select name="warga" id="warga" required class="form-control">
                                        <option value="{{$lapor->warga->warga_id}}">{{$lapor->warga->nama}}</option>
                                             @foreach ($warga as $war)
                                            <option value="{{$war->warga_id}}">{{$war->nama}}</option>
                                                
                                            @endforeach
                                        </select>
                                     </div>
                                     <div class="form-group">
                                        <label for="rw">Nama Rw</label>
                                     <input type="text" name="fk_rw_id" value="{{$lapor->fk_rw_id}}" class="form-control" readonly>
                                     </div>
                                     <div class="form-group">
                                        <label for="param">Param Kejadian</label>
                                        <select name="param" id="param" readonly class="form-control">
                                        <option value="{{$lapor->ParamKejadian->param_id}}">{{$lapor->ParamKejadian->nama}}</option>
                                            @foreach ($kejadian as $kej)
                                            <option value="{{$kej->param_id}}">{{$kej->nama}}</option>
                                                
                                            @endforeach
                                        </select>
                                     </div>
                                     
                                     <div class="form-group">
                                        <label for="tanggal_kejadian">Tanggal Kejadian</label>
                                     <input type="date"  name="tanggal_kejadian" id="tanggal_kejadian" readonly class="form-control @error('tanggal_kejadian') is-invalid @enderror" value="{{$lapor->tanggal_kejadian}}"  required>
                                        @error('tanggal_kejadian')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div> 
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5" readonly placeholder="Masukan Keterangan Kejadian">{{$lapor->keterangan}}</textarea>
                                        @error('keterangan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div>
                                     <div class="form-group">
                                         <label for="">Status</label>
                                         <select name="status" id="status" class="form-control"> 
                                        @if ($lapor->status == "Pending")
                                             <option value="Pending">Pending</option>
                                             <option value="Accepted">Accepted</option>
                                             <option value="Failed">Failed</option>
                                         @else
                                         @endif</select>
                                        
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
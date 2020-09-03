@extends('layouts.dashboard')
@section('content')
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Manage Kecamatan</li>
                        </ol>
                      <div class="col-md-8">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">Update Kecamatan</h5>
                                <form action="{{route('kecamatan.update',$kec->kecamatan_id)}}" method="POST">
                                    @csrf
                                    @method("PUT")
                                     <div class="form-group">
                                        <label for="kota">Kota</label>
                                        <select name="kota" id="kota" class="form-control">
                                        <option value="{{$kec->fk_kota_id}}">{{$kec->kota->name}}</option>
                                            @foreach ($kota as $item)
                                            <option value="{{$item->kota_id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nama kelurahan</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{$kec->name}}" required>
                                    </div>
                                  
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block">Update</button>
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
        $("#kota, #provinsi,#kelurahan,#kecamatan").select2({
            theme:'bootstrap4',width:'style',
        });
    });
    </script>
@endpush
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
                                <h5 class="text-center">Tambah Kecamatan</h5>
                                <form action="{{route('kecamatan.store')}}" method="POST">
                                    @csrf
                                     <div class="form-group">
                                        <label for="kota">Kota</label>
                                        <select name="kota" id="kota" class="form-control">
                                            <option value="">Pilih Kota</option>
                                            @foreach ($kota as $kot)
                                            <option value="{{$kot->kota_id}}">{{$kot->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Kecamatan</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Masukan Nama" required>
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
        $("#kota, #provinsi,#kelurahan,#kecamatan").select2({
            theme:'bootstrap4',width:'style',
        });
    });
    </script>
@endpush
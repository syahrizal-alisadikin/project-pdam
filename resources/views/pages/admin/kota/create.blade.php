@extends('layouts.dashboard')
@section('content')
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Manage Kota</li>
                        </ol>
                      <div class="col-md-8">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">Tambah Kota</h5>
                                <form action="{{route('kota.store')}}" method="POST">
                                    @csrf
                                    <select name="provinsi" id="provinsi" class="form-control">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach ($provinsi as $prov)
                                        <option value="{{$prov->provinsi_id}}">{{$prov->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-group">
                                        <label for="name">Nama</label>
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
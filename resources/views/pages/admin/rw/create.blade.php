@extends('layouts.dashboard')
@section('content')
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Manag RW</li>
                        </ol>
                      <div class="col-md-8">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">Tambah Rw</h5>
                                <form action="{{route('rw.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama" value="{{old('name')}}" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                     </div>
                                     <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email" value="{{old('email')}}" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="alamat" id="alamat" cols="30" rows="2"  placeholder="Masukan Alamat" class="form-control">{{old('alamat')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="provinsi">Provinsi</label>
                                        <select name="provinsi" id="provinsi" class="form-control" value="{{old('provinsi')}}" required>
                                            <option value="">Pilih Provinsi</option>
                                              @foreach ($provinsi as $prov)
                                                <option value="{{$prov->provinsi_id}}">{{$prov->name}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                   
                                     <div class="form-group">
                                        <label for="kota">Kota</label>
                                        <select name="kota" id="kota" class="form-control" value="{{old('kota')}}" required>
                                            <option value="">Pilih Kota</option>
                                            @foreach ($kota as $kot)
                                            <option value="{{$kot->kota_id}}">{{$kot->name}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <select name="kecamatan" id="kecamatan" class="form-control" value="{{old('kecamatan')}}" required>
                                            <option value="">Pilih Kecamatan</option>
                                             @foreach ($kecamatan as $kec)
                                            <option value="{{$kec->kecamatan_id}}">{{$kec->name}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                      <div class="form-group">
                                        <label for="kelurahan">Kelurahan</label>
                                        <select name="kelurahan" id="kelurahan" class="form-control" value="{{old('kelurahan')}}" required>
                                            <option value="">Pilih Kelurahan</option>
                                            @foreach ($kelurahan as $kelu)
                                            <option value="{{$kelu->kelurahan_id}}">{{$kelu->name}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                  
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" placeholder="Masukan Password" class="form-control @error('password') is-invalid @enderror" required>
                                        @error('password')
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
        $("#kota, #provinsi,#kelurahan,#kecamatan").select2({
            theme:'bootstrap4',width:'style',
        });
    });
    </script>
@endpush
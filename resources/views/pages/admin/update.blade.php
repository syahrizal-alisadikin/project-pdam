@extends('layouts.dashboard')
@section('content')
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Manage Admin</li>
                        </ol>
                      <div class="col-md-8">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="text-center">Update Admin</h5>
                                <form action="{{route('update-admin',$admin->admin_id)}}" method="POST">
                                    @csrf
                                    @method("PUT")
                                     
                                    <div class="form-group">
                                        <label for="name">Nama Admin</label>
                                         <input type="text" name="name" id="name" class="form-control" value="{{$admin->name}}" required>
                                    </div>
                                     <div class="form-group">
                                        <label for="email">Email</label>
                                         <input type="email" name="email" id="email" class="form-control" value="{{$admin->email}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                         <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password" >
                                         @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                         <p class="text-muted">Kosongkan jika tidak diganti</p>
                                    </div>
                                     <div class="form-group">
                                        <label for="password">Password Confirmation</label>
                                         <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Masukan Password" >
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
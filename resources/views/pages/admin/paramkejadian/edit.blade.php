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
                                <form action="{{route('paramkejadian.update',$kejadian->param_id)}}" method="POST">
                                    @csrf
                                    @method("PUT")
                                   
                                    <div class="form-group">
                                        <label for="name">Nama Kejadian</label>
                                    <input type="text" name="name" id="name"  class="form-control @error('name') is-invalid @enderror" value="{{$kejadian->nama}}" required>
                                        @error('name')
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

        
@endpush
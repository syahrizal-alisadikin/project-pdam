@extends('layouts.dashboard-rw')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Management RW</li>
        </ol>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Tambah Warga</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('warga.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (count($errors) > 0)
                        <div class="alert alert-warning">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nama Rw</label>
                                    <select class="form-control" name="fk_rw_id">
                                        @foreach($rw as $key)
                                        <option value="{{ $key->rw_id }}">{{ $key->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                <input class="form-control" type="text" name="nama" value="{{old('nama')}}" placeholder="Example: Supardi">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" type="email" name="email" value="{{old('email')}}" placeholder="Example: supardi21@gmail.com">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" name="password" placeholder="Masukasan Password">
                                </div>
                                <div class="form-group">
                                    <label>No Hp</label>
                                    <input class="form-control" onkeyup="this.value=this.value.replace(/[^\d]/,'')" type="text" name="phone" placeholder="Example: 0898266272">
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input class="form-control" type="text" name="tempat_lahir" value="{{old('tempat_lahir')}}" placeholder="Example: Semarang">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input class="form-control" type="date" name="tanggal_lahir">
                                </div>   
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="rw">Rw</option>
                                        <option value="warga">Warga</option>
                                        <option value="secuirty">Secuirty</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin">
                                        <option value="laki-laki">Laki Laki</option>
                                        <option value="perempuan">Perempuan</option>
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label>Longtitude</label>
                                 <input class="form-control" type="text" name="longtitude" value="{{old('longtitude')}}" placeholder="Example: -6.238270">
                                </div>   
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input class="form-control" type="text" name="latitude" value="{{old('latitude')}}"  placeholder="Example: 106.975571">
                                </div>
                                <div class="form-group">
                                    <label>Foto KTP</label>
                                    <input class="form-control" type="file" name="foto_ktp">
                                </div>
                                <div class="form-group">
                                    <label>Foto KK</label>
                                    <input class="form-control" type="file" name="foto_kk">
                                </div>
                                <div class="form-group">
                                    <label>Foto Profile</label>
                                    <input class="form-control" type="file" name="foto_profile">
                                </div> 
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="alamat"> {{old('alamat')}}</textarea>
                                </div> 
                                <div class="float-right">
                                    <button type="submit" class="btn btn-sm btn-success"> Submit </button>
                                </div> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
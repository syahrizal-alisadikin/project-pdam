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
					<h5 class="text-center">Tambah Rw</h5>
				</div>
				<div class="card-body">
					<form action="{{route('warga.update',$warga_edit->warga_id)}}" method="POST" enctype="multipart/form-data">
						@csrf
						{{ method_field('PUT') }}
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
										<option value="{{ $key->rw_id }}"
											@if ($key->rw_id == old('fk_rw_id', $warga_edit->fk_rw_id))
											selected="selected"
											@endif
											>{{ $key->name }}
										</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label>Nama</label>
									<input class="form-control" type="text" name="nama" placeholder="Example: Supardi" value="{{ $warga_edit->nama }}">
								</div>
								<div class="form-group">
									<label>Email</label>
									<input class="form-control" type="email" name="email" placeholder="Example: supardi21@gmail.com" value="{{ $warga_edit->email }}">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input class="form-control" type="password" name="password" value="{{ $warga_edit->password }}">
								</div>
								<div class="form-group">
									<label>No Hp</label>
									<input class="form-control" onkeyup="this.value=this.value.replace(/[^\d]/,'')" type="text" name="phone" placeholder="Example: 0898266272" value="{{ $warga_edit->phone }}">
								</div>
								<div class="form-group">
									<label>Tempat Lahir</label>
									<input class="form-control" type="text" name="tempat_lahir" placeholder="Example: Semarang" value="{{ $warga_edit->tempat_lahir }}">
								</div>
								<div class="form-group">
									<label>Tanggal Lahir</label>
									<input class="form-control" type="date" name="tanggal_lahir" value="{{ $warga_edit->tanggal_lahir }}">
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
									<input class="form-control" type="text" name="longtitude" placeholder="Example: -6.238270" value="{{ $warga_edit->longtitude }}">
								</div>   
								<div class="form-group">
									<label>Latitude</label>
									<input class="form-control" type="text" name="latitude" placeholder="Example: 106.975571" value="{{ $warga_edit->latitude }}">
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
									<textarea class="form-control" name="alamat">{{ $warga_edit->alamat }}</textarea>
								</div> 
								<div class="float-right">
									<button type="submit" class="btn btn-sm btn-success"> Update </button>
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
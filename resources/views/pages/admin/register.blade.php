<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>PAM REGISTER</title>
        <link href="{{url('assets\css/styles.css')}}" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Register RW</h3></div>
                                    <div class="card-body">
                                        <form action="{{route('register-rw-process')}}" method="POST">
                                        @csrf
                                        @if (session('sukses'))
                                        <div class="alert alert-primary">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            {{ session('sukses') }}
                                        </div>
                                        @elseif(session('gagal'))
                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            {{ session('gagal') }}
                                        </div>
                                        @endif

                                        @if (count($errors) > 0)
                                        <div class="alert alert-danger">
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
                                                        <label class="small mb-1" for="email">Email</label>
                                                    <input class="form-control py-4 @error('email') is-invalid @enderror" id="email" name="email" type="email" placeholder="Enter email address"  value="{{ old('email') }}"/>
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="email">Name</label>
                                                        <input class="form-control py-4 @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{old('name')}}" placeholder="Enter Name" />
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="provinsi">Provinsi</label>
                                                        <select class="form-control" id="provinsi" name="fk_provinsi_id">
                                                            <option value="">-- Pilih Provinsi --</option>
                                                            @foreach($provinsi as $key)
                                                                <option value="{{ $key->provinsi_id }}">{{ $key->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="kecamatan">Kecamatan</label>
                                                        <select class="form-control" id="kecamatan" name="fk_kecamatan_id">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="kota">Kota</label>
                                                        <select class="form-control" id="kota" name="fk_kota_id">
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="kelurahan">Kelurahan</label>
                                                        <select class="form-control" id="kelurahan" name="fk_kelurahan_id">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="email">Password</label>
                                                        <input class="form-control py-4" id="Password" name="password" type="password" placeholder="Enter Password" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="alamat">Alamat</label>
                                                        <textarea class="form-control py-4" name="alamat" placeholder="Enter Alamat"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group  align-items-center justify-content-between mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary btn-block" >Register</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="#">A Ready Account ? Login Now</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main><br><br><br>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="{{url('assets/js/scripts.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#kota, #provinsi,#kelurahan,#kecamatan").select2();
                $('#provinsi').on('change', function(){
                    var id_prov = $(this).val()
                    $.ajax({
                        url: 'kota/' + id_prov,
                        type: "GET",
                        dataType: "json",
                        success: function(result){
                            $('#kota').empty();
                            $('#kota').append('<option value="">-- Pilih Kota  --</option>');
                            $.each(result, function (key, value) {
                                console.log(key)
                                $('#kota').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    })
                })

                $('#kota').on('change', function(){
                    var id_kota = $(this).val()
                    $.ajax({
                        url: 'kecamatan/' + id_kota,
                        type: "GET",
                        dataType: "json",
                        success: function(result){
                            $('#kecamatan').empty();
                            $('#kecamatan').append('<option value="">-- Pilih Kecamatan  --</option>');
                            $.each(result, function (key, value) {
                                $('#kecamatan').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    })
                })

                $('#kecamatan').on('change', function(){
                    var id_kelurahan = $(this).val()
                    $.ajax({
                        url: 'kelurahan/' + id_kelurahan,
                        type: "GET",
                        dataType: "json",
                        success: function(result){
                            $('#kelurahan').empty();
                            $('#kelurahan').append('<option value="">-- Pilih Kelurahan  --</option>');
                            $.each(result, function (key, value) {
                                $('#kelurahan').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    })
                })
            })
        </script>
    </body>
</html>

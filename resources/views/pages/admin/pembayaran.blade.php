<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>PAM Pembayaran</title>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Pembayaran Warga</h3></div>
                                    <div class="card-body">
                                        
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
                            <div class="text-muted">Copyright &copy; Your Website Pass Sistem 2020</div>
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

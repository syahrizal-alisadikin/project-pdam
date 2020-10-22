@extends('layouts.dashboard-rw')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard RW</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Management Pembayaran Warga</li>
        </ol>
       

        <div class="card mb-4">
           <div class="card-header d-flex">
               <div class="data">
                <i class="fas fa-table mr-1"></i>
                DataTable Pembayaran
            </div>
            <div class="button ml-auto">

           </div>
       </div>
       <div class="card-body">
            <div class="table-responsive">

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

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal Bayar</th>
                            <th>Jumlah Bayar</th>
                            <th>Tanggal Tagihan</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($pembayaran as $key)
                        <tr>
                          <td>{{ $key->tagihan->tarif->nama_tarif }}</td>
                          <td>{{ $key->tanggal_bayar ? $key->tanggal_bayar :'Taggal Bayar Kosong' }}</td>
                          <td>{{ $key->jumlah_bayar ? $key->jumlah_bayar :'Jumlah Bayar Kosong' }}</td>
                          <td>{{ $key->tagihan->tanggal_tagihan }}</td>
                          <td>
                            @if ($key->status == "Pending")
                                <span class="badge badge-warning">PENDING</span>
                                @elseif($key->status == "proses")
                                <span class="badge badge-primary">PROSES</span>
                                @else
                                <span class="badge badge-success">Success</span>
                            @endif
                          </td>
                          <td class="d-flex">
                            @php
                            $data =App\KonfirmasiPembayaran::where('fk_pembayaran_id',$key->pembayaran_id)->count();
                            @endphp

                            @if($data > 0)
                              <a href="{{route('pembayaran-warga.show',$key->pembayaran_id)}}" class="btn btn-sm btn-outline-success">View Bukti</a>
                              @else
                              {{-- <button class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#exampleModal" >Kirim Bukti</button> --}}
                              <button class="edit-modal btn btn-outline-primary btn-sm" id="kirim-bukti" data-toggle="modal" data-target="#exampleModal"
                                data-id_pembayaran="{{ $key->pembayaran_id }}"
                                data-image="{{ $key->image }}"
                                data-jumlah="{{ $key->jumlah_bayar }}">Kirim Bukti</button>
                            @endif
                            @if ($key->status == "proses")
                            <a href="#" class="btn btn-primary ml-2">Sudah Dikirim</a>
                            @else
                            <a href="{{route('pembayaran-warga.edit',$key->pembayaran_id)}}" class="btn btn-primary ml-2">Bayar</a>
                                
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
</div>
</main>

<!-- Modal Kirim Bukti -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kirim Bukti</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="{{ route('pembayaran-warga.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="col-lg-12">
            <div class="form-group">
              <input type="hidden" name="pembayaran_id" id="pembayaran_id">
              <label>Jumlah Bayar</label>
              <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Masukan Jumlah Pembayaran">
            </div>
            <div class="form-group">
              <label>Image</label>
              <input type="file" name="image" class="form-control" id="image">
            </div>
           <div class="form-group">
             <button type="submit" class="btn btn-primary">Kirim Bukti</button>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

          </div>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

{{-- Modal Bayar --}}
<div class="modal fade" id="bayarModal" tabindex="-1" role="dialog" aria-labelledby="bayarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bayarModalLabel">Kirim Bukti</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="{{ route('pembayaran-warga.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="col-lg-12">
            <div class="form-group">
              <input type="hidden" name="pembayaran_id" id="pembayaran_id">
              <label>Jumlah Bayar</label>
              <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Masukan Jumlah Pembayaran">
            </div>
            <div class="form-group">
              <label>Image</label>
              <input type="file" name="image" class="form-control" id="image">
            </div>
           <div class="form-group">
             <button type="submit" class="btn btn-primary">Bayar</button>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

          </div>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
  $(document).ready(function() {
      $(document).on('click', '#kirim-bukti', function() {
        var id_pembayaran = $(this).data('id_pembayaran');
        var jumlah = $(this).data('jumlah');
        var image = $(this).data('image');

        $('#pembayaran_id').val(id_pembayaran);
        $('#jumlah').val(jumlah);
        $('#image').val(image);
      });
  })
</script>
@endsection

<!-- Isinya form nya apa aja mas ? jumlah sama foto aja mas, oke mas -->
<!-- Mas folder di storange images mas ngak buat kan ? iya belum buat -->
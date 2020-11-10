@extends('layouts.dashboard-rw')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Management Petugas Rw</li>
        </ol>
       

        <div class="card mb-4">
           <div class="card-header d-flex">
               <div class="data">
                <i class="fas fa-table mr-1"></i>
                DataTable Petugas Rw
            </div>
            <div class="button ml-auto">

               <a href="#" class="btn btn-success" name="tambah" id="tambah"  data-toggle="modal" data-target="#exampleModal">Tambah Petugas Rw</a>
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
                            <th>RW ID</th>
                            <th class="text-center">Name Petugas</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Level</th>
                            <th class="text-center">Aksi</th>
                            
                        </tr>
                    </thead>
                    @foreach ($data as $item)
                    <tbody>
                      <tr>
                          <td>{{$item->fk_rw_id}}</td>
                          <td class="text-center">{{$item->nama}}</td>
                          <td class="text-center">{{$item->phone}}</td>
                          <td class="text-center">{{$item->level}}</td>
                          <td class="text-center">
                            <a href="{{ route('petugas-rw.edit',$item->id)}}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('petugas-rw.destroy',$item->id)}}" method="post" class="d-inline">
                              @csrf
                              @method("DELETE")
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Data Mau Dihapus??');">Hapus</button>
                            </form>
                          </td>
                        </tr>
                      </tbody>
                      @endforeach
                   
                </table>
            </div>
        </div>
</div>
</div>
</main>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas Rw</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('petugas-rw.store')}}" method="post">
      @csrf
      <div class="form-group">
        <label for="name">Nama Petugas</label>
        <input type="text" name="name" id="name" placeholder="Masukan Nama Petugas" required class="form-control">
      </div>
      <div class="form-group">
        <label for="phone">No Hanphone</label>
        <input type="text" name="phone" id="phone" placeholder="Masukan No Handphone" required class="form-control">
      </div>

       <div class="form-group">
        <label for="level">Level</label>
        <select name="level" class="form-control" id="level">
          <option value="Ketua_rw">Ketua Rw</option>
          <option value="Ketua_rt">Ketua RT</option>
          <option value="petugas_kamtibmas">Prtugas Kamtibmas</option>
          <option value="petugas_sosial">Prtugas Sosial</option>
          <option value="petugas_kebersihan">Petugas Kebersihan</option>
          <option value="petugas_keamanan">Petugas Keamanan</option>
          <option value="petugas_lainnya">Petugas Lainnya</option>
        </select>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Masukan Password" required class="form-control">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
      </div>
      
    </div>
  </div>
</div>

@endsection
{{-- @push('addon-script')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
    <script>
        const DEFAULT_COORD = [-6.2293867, 106.845599];
      // initial Map
      const map = L.map("mapid").fitWorld();
      
      // initial file
      const url = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
      // attribute
      const atribute = "Leaflet with <a href='https://acacemy.byidmore.com'>id More Academy</a>";
      const omstile = new L.TileLayer(url, {
          minZoom: 2,
          maxZoom: 10,
          attribution: atribute
      })
      map.setView(new L.LatLng(DEFAULT_COORD[0], DEFAULT_COORD[1]), 7)
        map.addLayer(omstile)
       
    </script>
@endpush --}}
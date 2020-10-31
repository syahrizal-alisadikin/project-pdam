@extends('layouts.dashboard-rw')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Management Petugas Rw</li>
        </ol>
       

        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
              <form action="{{route('petugas-rw.update',$data->id)}}" method="post">
                @csrf
                @method("PUT")
               <div class="form-group">
                  <label for="name">Nama Petugas</label>
                  <input type="text" name="name" id="name" placeholder="Masukan Nama Petugas" value="{{$data->nama}}" required class="form-control">
                </div>
                <div class="form-group">
                  <label for="phone">No Hanphone</label>
                  <input type="text" name="phone" id="phone" placeholder="Masukan No Handphone" value="{{$data->phone}}"  required class="form-control">
                </div>

                <div class="form-group">
                  <label for="level">Level</label>
                  <select name="level" class="form-control" id="level">
                    @if ($data->level == "ketua_rw")
                     <option value="Ketua_rw">Ketua Rw</option>
                    <option value="Ketua_rt">Ketua RT</option>
                    <option value="prtugas_kamtibmas">Prtugas Kamtibmas</option>
                    <option value="prtugas_sosial">Prtugas Sosial</option>
                    <option value="petugas_kebersihan">Petugas Kebersihan</option>
                    <option value="petugas_keamanan">Petugas Keamanan</option>
                    <option value="petugas_lainnya">Petugas Lainnya</option>
                    @elseif($data->level == "ketua_rt")
                    <option value="Ketua_rt">Ketua RT</option>
                    <option value="Ketua_rw">Ketua Rw</option>
                    <option value="prtugas_kamtibmas">Prtugas Kamtibmas</option>
                    <option value="prtugas_sosial">Prtugas Sosial</option>
                    <option value="petugas_kebersihan">Petugas Kebersihan</option>
                    <option value="petugas_keamanan">Petugas Keamanan</option>
                    <option value="petugas_lainnya">Petugas Lainnya</option>
                     @elseif($data->level == "petugas_kebersihan")
                     <option value="petugas_kebersihan">Petugas Kebersihan</option>
                     <option value="petugas_keamanan">Petugas Keamanan</option>
                    <option value="Ketua_rt">Ketua RT</option>
                    <option value="Ketua_rw">Ketua Rw</option>
                    <option value="prtugas_kamtibmas">Prtugas Kamtibmas</option>
                    <option value="prtugas_sosial">Prtugas Sosial</option>
                    <option value="petugas_lainnya">Petugas Lainnya</option>
                    @elseif($data->level == "petugas_kamtibmas")
                    <option value="petugas_kamtibmas">Prtugas Kamtibmas</option>
                    <option value="petugas_sosial">Prtugas Sosial</option>
                     <option value="petugas_kebersihan">Petugas Kebersihan</option>
                     <option value="petugas_keamanan">Petugas Keamanan</option>
                    <option value="Ketua_rt">Ketua RT</option>
                    <option value="Ketua_rw">Ketua Rw</option>
                    <option value="petugas_lainnya">Petugas Lainnya</option>
                     @elseif($data->level == "petugas_sosial")
                     <option value="petugas_sosial">Prtugas Sosial</option>
                     <option value="petugas_kamtibmas">Prtugas Kamtibmas</option>
                     <option value="petugas_kebersihan">Petugas Kebersihan</option>
                     <option value="petugas_keamanan">Petugas Keamanan</option>
                    <option value="Ketua_rt">Ketua RT</option>
                    <option value="Ketua_rw">Ketua Rw</option>
                    <option value="petugas_lainnya">Petugas Lainnya</option>
                    @elseif($data->level == "petugas_lainnya")
                    <option value="petugas_lainnya">Petugas Lainnya</option>
                     <option value="petugas_sosial">Prtugas Sosial</option>
                     <option value="petugas_kamtibmas">Prtugas Kamtibmas</option>
                     <option value="petugas_kebersihan">Petugas Kebersihan</option>
                     <option value="petugas_keamanan">Petugas Keamanan</option>
                    <option value="Ketua_rt">Ketua RT</option>
                    <option value="Ketua_rw">Ketua Rw</option>
                    @else
                    <option value="petugas_keamanan">Petugas Keamanan</option>
                    <option value="petugas_kebersihan">Petugas Kebersihan</option>
                    <option value="Ketua_rt">Ketua RT</option>
                    <option value="Ketua_rw">Ketua Rw</option>
                    <option value="petugas_sosial">Prtugas Sosial</option>
                    <option value="petugas_kamtibmas">Prtugas Kamtibmas</option>
                    <option value="petugas_lainnya">Petugas Lainnya</option>
                    @endif
                    
                  </select>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </form>
              </div>
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
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('jalan-rw.store')}}" method="post">
      @csrf
      <div class="form-group">
        <label for="name">Nama Jalan</label>
        <input type="text" name="name" id="name" placeholder="Masukan Nama jalan" required class="form-control">
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
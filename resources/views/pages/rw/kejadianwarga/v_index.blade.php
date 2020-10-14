@extends('layouts.dashboard-rw')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Management Kejadian Warga</li>
        </ol>
       

        <div class="card mb-4">
           <div class="card-header d-flex">
               <div class="data">
                <i class="fas fa-table mr-1"></i>
                DataTable Costumers
            </div>
            <div class="button ml-auto">

               {{-- <a href="{{ route('warga.create') }}" class="btn btn-success" name="tambah" id="tambah" >Tambah Warga</a> --}}
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>No Hp</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    
                   
                </table>
            </div>
        </div>
</div>
</div>
</main>


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
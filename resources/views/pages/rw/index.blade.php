@extends('layouts.dashboard-rw')
@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard RW</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Primary Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Warning Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Success Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

       <div class="shadow p-3 mb-5 bg-white rounded">
           <div class="row">
               <div class="col-md-2">
                   RW Id <br>
                   {{ Auth::guard('rw')->user()->rw_id}}

               </div>
               <div class="col-md-2">
                   Nama  <br>
                   {{ Auth::guard('rw')->user()->name}}

               </div>
               <div class="col-md-2">
                   ID Map Rw <br>
                   {{ Auth::guard('rw')->user()->id_rw_maping}}

               </div>
               <div class="col-md-3">
                   Email <br>
                   {{ Auth::guard('rw')->user()->email}}

               </div>
               
               <div class="col-md-2">
                   Phone <br>
                   {{ Auth::guard('rw')->user()->no_hp}}

               </div>
               <div class="col-md-1">
                   Status <br>
                   @if (Auth::guard('rw')->user()->status_aktif == "aktif")
                   <span class="badge badge-success">Aktif</span>
                    @else
                   <span class="badge badge-danger">Belum Aktif</span>

                   @endif

               </div>
           </div>
       </div>
       
</div>
</div>
</main>

</div>
</div>
</div>
@endsection
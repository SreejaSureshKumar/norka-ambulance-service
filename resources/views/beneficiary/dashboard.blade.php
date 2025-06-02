@extends('admin.app')

@section('content')

    <div class="card">
      <div class="card-body">
        <div class="row">
          <!-- Card 1 -->
          <div class="col-xl-4 col-md-6">
            <div class="card bg-secondary-dark dashnum-card text-white overflow-hidden mb-4">
              <span class="round small"></span>
              <span class="round big"></span>
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <div class="avtar avtar-lg">
                      <i class="text-white ti ti-credit-card"></i>
                    </div>
                  </div>
                  <div class="col-auto">
                    <div class="btn-group">
                      <a href="#" class="avtar avtar-s bg-secondary text-white dropdown-toggle arrow-none"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-dots"></i>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li><button class="dropdown-item">Import Card</button></li>
                        <li><button class="dropdown-item">Export</button></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <span class="text-white d-block f-34 f-w-500 my-2">
                  1350
                  <i class="ti ti-arrow-up-right-circle opacity-50"></i>
                </span>
                <p class="mb-0 opacity-50">Total Pending Orders</p>
              </div>
            </div>
          </div>
       
   
        </div>
      </div>
    </div>
 
@endsection

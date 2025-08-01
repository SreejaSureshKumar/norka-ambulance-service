@extends('admin.app')

@section('content')
<style>
  .clickable-card {
    transition: box-shadow 0.2s, transform 0.2s;
    cursor: pointer;
    text-decoration: none;
    display: block;
  }
  .clickable-card:hover, .clickable-card:focus {
    box-shadow: 0 0 0 4px #6c757d33, 0 4px 24px rgba(0,0,0,0.18);
    transform: translateY(-4px) scale(1.03);
    color: #fff;
    text-decoration: none;
  }
  .dashboard-outer-card {
    width: 100%;
    margin-left: auto;
    margin-right: auto;
    min-height: 65vh; 
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
  }
</style>
<div class="container-fluid py-4">
  <div class="dashboard-outer-card">
    <div class="card border-0 shadow-sm flex-grow-1">
      <div class="card-body">
        <div class="row">
          <div class="col-xl-4 col-md-6">
            <a href="{{ route('beneficiary.application-form') }}" class="clickable-card">
              <div class="card bg-primary-dark dashnum-card text-white overflow-hidden mb-4 h-100">
                <span class="round small"></span>
                <span class="round big"></span>
                <div class="card-body d-flex flex-column justify-content-between" style="min-height: 180px;">
                  <div>
                    <h5 class="text-white mb-1">Death Repatriation</h5>
                    <small class="text-white-50 d-block mb-3">Apply for norka assistance in case of death repatriation.</small>
                    <div class="mb-4"></div>
                  </div>
                  <p class="mb-0 opacity-50 fs-5 fw-bold">New Application</p>
                </div>
              </div>
            </a>
          </div>
        
           <div class="col-xl-4 col-md-6">
            <a href="{{ route('beneficiary.service-application-form') }}" class="clickable-card">
              <div class="card bg-secondary-dark dashnum-card text-white overflow-hidden mb-4 h-100">
                <span class="round small"></span>
                <span class="round big"></span>
                <div class="card-body d-flex flex-column justify-content-between" style="min-height: 180px;">
                  <div>
                    <h5 class="text-white mb-1">Ambulance Service</h5>
                    <small class="text-white-50 d-block mb-3">Apply for norka assistance in case of ambulance service.</small>
                    <div class="mb-4"></div>
                  </div>
                  <p class="mb-0 opacity-50 fs-5 fw-bold">New Application</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

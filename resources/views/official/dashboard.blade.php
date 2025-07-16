@extends('admin.app')

@section('content')
<style>
  .clickable-heading {
    cursor: pointer;
    transition: all 0.3s ease;
    color: #2196f3;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    padding: 4px 8px;
    border-radius: 4px;
    position: relative;
  }

  .clickable-heading:hover {
    background-color: rgba(33, 150, 243, 0.1);
    transform: translateY(-1px);
    text-decoration: underline;
  }

  .clickable-heading::after {
    content: "→";
    margin-left: 6px;
    font-size: 0.9em;
    opacity: 0;
    transition: opacity 0.3s ease, transform 0.3s ease;
    transform: translateX(-5px);
  }

  .clickable-heading:hover::after {
    opacity: 1;
    transform: translateX(0);
  }

  /* Make sure dropdown doesn't inherit these styles */
  .dropdown .clickable-heading {
    color: inherit;
    padding: 0;
    background: none;
  }

  .dropdown .clickable-heading:hover {
    background: none;
    transform: none;
    text-decoration: none;
  }

  /* Empty donut container - matches ApexCharts dimensions */
  .empty-donut-container {
    position: relative;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  /* SVG donut - matches ApexCharts proportions */
  .empty-donut-svg {
    width: 100%;
    height: 100%;
    max-width: 407px;
    max-height: 240px;
    /* 300px total height - 34px legend */
  }

  /* Legend styling - matches ApexCharts */
  .empty-legend div {
    font-family: Helvetica, Arial, sans-serif;
    font-size: 12px;
    color: #373d3f;
  }



  /* Center message */
  .empty-message {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
  }

  .empty-message i {
    font-size: 24px;
    color: #d1d1d1;
    display: block;
    margin-bottom: 8px;
  }

  .empty-message span {
    color: #a1a1a1;
    font-size: 14px;
  }
</style>
<div class="container-fluid py-4">
  <div class="row">
    <!-- Death Repartriation Card -->

    <div class="col-md-6 col-xxl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <a href="{{ route('application.index') }}" class="clickable-heading">
              <h5 class="mb-0">Death Repartriation</h5>
            </a>
            <div class="dropdown">
              <a class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ti ti-dots-vertical f-18"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="#">Today</a>
                <a class="dropdown-item" href="#">Weekly</a>
                <a class="dropdown-item" href="#">Monthly</a>
              </div>
            </div>
          </div>
          @if(array_sum($deathRepatriation) > 0)
          <div id="death-repartiation-statistics" data-new="{{ $deathRepatriation['new'] }}"
            data-approved="{{ $deathRepatriation['approved'] }}"
            data-rejected="{{ $deathRepatriation['rejected'] }}"></div>
          @else

          <div class="empty-donut-container" style="height:300px;">
            <svg viewBox="0 0 36 36" class="empty-donut-svg">

              <path class="donut-ring"
                d="M18 2.0845
                    a 15.9155 15.9155 0 0 1 0 31.831
                    a 15.9155 15.9155 0 0 1 0 -31.831"
                fill="transparent"
                stroke="#f0f0f0"
                stroke-width="3" />
              <!-- Transparent center hole -->
              <circle cx="18" cy="18" r="10" fill="white" />


            </svg>
            <div class="empty-message">
              <i class="ti ti-chart-donut-2"></i>
              <span>No applications</span>
            </div>
          </div>
          @endif
          <div class="mt-3 text-center">
            <div class="d-flex justify-content-around">
              <div class="text-center">
                <span class="badge bg-gray-900 rounded-pill px-3 py-1">{{ $deathRepatriation['new'] }}</span>
                <div class="small text-muted mt-1">New</div>
              </div>
              <div class="text-center">
                <span class="badge bg-primary rounded-pill px-3 py-1">{{ $deathRepatriation['approved'] }}</span>
                <div class="small text-muted mt-1">Approved</div>
              </div>
              <div class="text-center">
                <span class="badge bg-gray-600 rounded-pill px-3 py-1">{{ $deathRepatriation['rejected'] }}</span>
                <div class="small text-muted mt-1">Rejected</div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- Ambulance Service Card -->
    <div class="col-md-6 col-xxl-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <a href="{{ route('service.application-list') }}" class="clickable-heading">
              <h5 class="mb-0">Ambulance Service</h5>
            </a>
            <div class="dropdown">
              <a class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ti ti-dots-vertical f-18"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="#">Today</a>
                <a class="dropdown-item" href="#">Weekly</a>
                <a class="dropdown-item" href="#">Monthly</a>
              </div>
            </div>
          </div>
          @if(array_sum($ambulanceService) > 0)
          <div id="ambulance-service-statistics" data-new="{{ $ambulanceService['new'] }}"
            data-approved="{{ $ambulanceService['approved'] }}"
            data-rejected="{{ $ambulanceService['rejected'] }}"></div>
          @else

          <div class="empty-donut-container" style="height:300px;">
            <svg viewBox="0 0 36 36" class="empty-donut-svg">

              <path class="donut-ring"
                d="M18 2.0845
                    a 15.9155 15.9155 0 0 1 0 31.831
                    a 15.9155 15.9155 0 0 1 0 -31.831"
                fill="transparent"
                stroke="#f0f0f0"
                stroke-width="3" />
              <!-- Transparent center hole -->
              <circle cx="18" cy="18" r="10" fill="white" />


            </svg>
            <div class="empty-message">
              <i class="ti ti-chart-donut-2"></i>
              <span>No applications</span>
            </div>
          </div>
          @endif
          <div class="mt-3 text-center">
            <div class="d-flex justify-content-around">
              <div class="text-center">
                <span class="badge bg-gray-900 rounded-pill px-3 py-1">{{ $ambulanceService['new'] }}</span>
                <div class="small text-muted mt-1">New</div>
              </div>
              <div class="text-center">
                <span class="badge bg-primary rounded-pill px-3 py-1">{{ $ambulanceService['approved'] }}</span>
                <div class="small text-muted mt-1">Approved</div>
              </div>
              <div class="text-center">
                <span class="badge bg-gray-600 rounded-pill px-3 py-1">{{ $ambulanceService['rejected'] }}</span>
                <div class="small text-muted mt-1">Rejected</div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>
@endsection
@push('custom-scripts')

<script  data-cfasync="false"  src="{{ asset('js/category-donut-chart.js')}}"></script>

<script  data-cfasync="false"  src="{{ asset('js/category-donut1-chart.js')}}"></script>
@endpush
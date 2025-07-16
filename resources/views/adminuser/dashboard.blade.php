@extends('admin.app')
@section('content')
<div class="row">
    @foreach($mainMenus as $menu)
    @php
        $colors = ['bg-secondary', 'bg-primary', 'bg-success', 'bg-info', 'bg-warning', 'bg-danger'];
        $color = $colors[$loop->index % count($colors)];
        $route = !empty($menu['route_name']) && $menu['route_name'] !== '#' ? 
                (str_starts_with($menu['route_name'], 'http') ? $menu['route_name'] : route($menu['route_name'])) : 
                '#';
    @endphp

<div class="col-xl-3 col-md-6 mb-4">
    <a href="{{ $route }}" class="card-link text-decoration-none">
        <div class="card {{ $color }} order-card hover-lift">
            <div class="card-body position-relative">
                <h5 class="text-white">{{ $menu['name'] }}</h5>
                <p class="m-b-0 text-white-50">Click to access</p>
               
            </div>
        </div>
    </a>
</div>

    @endforeach
</div>
@endsection

<style>
    .order-card {
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .card-icon {
        position: absolute;
        right: 20px;
        top: 70%;
        transform: translateY(-50%);
        opacity: 0.8;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    .card-body {
        padding: 1.5rem;
        position: relative;
    }
    .text-white-50 {
        color: rgba(255,255,255,0.7);
    }
</style>
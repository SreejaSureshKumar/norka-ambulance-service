@if (count($menu_items) > 0)
<div class="page-header">
  <div class="page-block">
    <div class="row align-items-center">
    <div class="col">
      <div class="page-header-title">
     
      </div>
    </div>
    <div class="col-auto">
      <ul class="breadcrumb">
      @foreach ($menu_items as $item)
        <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}" 
          @if($loop->last) aria-current="page" @endif>
        @if (!$loop->last)
          <a href="{{ $item['url'] ?? '#' }}">{{ $item['name'] }}</a>
        @else
          {{ $item['name'] }}
        @endif
        </li>
      @endforeach
      </ul>
    </div>
    </div>
  </div>
  </div>
  <br>
  @endif
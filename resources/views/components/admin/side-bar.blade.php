<nav class="pc-sidebar">
    <div class="navbar-wrapper">
      <div class="m-header">
        <a href="#" class="b-brand text-primary">
          <!-- ========   Change your logo from here   ============ -->
          <img src="{{asset('images/logo-dark.svg')}}" alt="" />
        </a>
      </div>
      <div class="navbar-content">
        <ul class="pc-navbar">
          @foreach ($menu_items as $menu_item)
            @isset ($menu_item['name'])
              @php
                $has_submenu = count($menu_item['submenu']);
                $is_menu_active = $menu_item['active'];
              @endphp
              <li class="pc-item{{ $has_submenu ? ' pc-hasmenu' : '' }}{{ $is_menu_active ? ' active' : '' }}">
                <a href="{{ $menu_item['url'] }}" @class([
                        'pc-link',
                        'nk-menu-link',
                        'nk-menu-toggle' => $has_submenu
                    ])>
                  <span class="nk-menu-icon"><em class="{{ $menu_item['icon'] }}"></em></span>
                  <span class="nk-menu-text">{{ $menu_item['name'] }}</span>
                  @if ($has_submenu)
                    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                  @endif
                </a>
                @if ($has_submenu)
                  <ul class="pc-submenu nk-menu-sub">
                    @foreach ($menu_item['submenu'] as $submenu)
                      <li class="pc-item nk-menu-item">
                        <a href="{{ $submenu['url'] }}" class="pc-link nk-menu-link">
                          <span class="nk-menu-text">{{ $submenu['name'] }}</span>
                        </a>
                      </li>
                    @endforeach
                  </ul>
                @endif
              </li>
            @endisset
          @endforeach
        </ul>
        <div class="w-100 text-center">
          <div class="badge theme-version badge rounded-pill bg-light text-dark f-12"></div>
        </div>
      </div>
    </div>
</nav>
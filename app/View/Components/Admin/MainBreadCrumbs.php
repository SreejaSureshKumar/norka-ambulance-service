<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class MainBreadCrumbs extends Component
{
    public $current_route = '';
    public $user;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }
    public function buildAttrs($module)
    {

       
        $module_path = trim($module->component_path);
        $routes_params=[];
        if(strpos($module_path,'|{') != false)
        {
            $splitted_path=explode('|',$module_path);
            $module_path=$splitted_path[0];
            $params_str = str_replace(['{', '}'], '', $splitted_path[1]);
            $routes_params_splitted=explode(',',$params_str);
            foreach ($routes_params_splitted as $routes_param_splitted) {
                $param_data = explode(':', $routes_param_splitted);
                $routes_params[$param_data[0]] = $param_data[1];
            }
        }

      
        return [
            'name' => $module->component_name,
            'icon' => $module->component_icon,
            'route_name' => $module_path,
            'url' => Route::has($module_path) ? (!empty($routes_params) ? route($module_path, $routes_params) : route($module_path)) : '#',
            'active' => $this->current_route === $module_path
        ];
    }
    public function menuBuilder()
    {
        $components = Auth::user()->getCurrentUserPermissions();
      
      
        $main_menu = array();
        $this->current_route = request()->route()->getName();

        // Group the main menu.
        foreach ($components as $component) {
            $component_id = $component->component_id;
            if ($component->component_parent === 0) {
                $main_menu[$component_id] = array_merge($this->buildAttrs($component), [
                    'submenu' => [],
                ]);
            }
        }

        // Assign submenu.
        foreach ($components as $component) {
            if ($component->component_parent !== 0) {
                $main_menu_id = $component->component_parent;
                $main_menu[$main_menu_id]['submenu'][] = $this->buildAttrs($component);
            }
        }

        // Handle the parent menu active status.
        foreach ($main_menu as $menu_id => $menu_details) {
            if (isset($menu_details['submenu'])) {
                foreach ($menu_details['submenu'] as $submenu) {
                    if ($submenu['active']) {
                        $main_menu[$menu_id]['active'] = true;
                        break;
                    }
                }
            }
        }
        return $main_menu;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $menu_items = $this->menuBuilder();
        return view('components.admin.main-bread-crumbs', ['menu_items' => $menu_items]);
    }
}

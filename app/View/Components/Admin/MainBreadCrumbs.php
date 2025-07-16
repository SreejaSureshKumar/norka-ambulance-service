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
        $this->current_route = request()->route()->getName();

        // Find the current component
        $current = null;
        foreach ($components as $component) {
            if (trim($component->component_path) === $this->current_route) {
                $current = $component;
                break;
            }
        }

        // Build breadcrumb path from current up to root
        $breadcrumbs = [];
        while ($current) {
            $breadcrumbs[] = $this->buildAttrs($current);
            // Find parent
            $parent = null;
            foreach ($components as $comp) {
                if ($comp->component_id === $current->component_parent && $comp->component_parent === 0) {
                    $parent = $comp;
                    break;
                }
            }
            $current = $parent;
        }
        // Reverse to get root -> current order
        return array_reverse($breadcrumbs);
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

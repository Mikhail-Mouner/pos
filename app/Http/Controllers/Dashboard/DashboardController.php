<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        $activities = Activity::with('subject')->latest()->get();

        $pages = [
            'users'  => ['name'=>__('auth.users'), 'icon'=>"users", 'color'=>"success", 'count'=> User::WhereRoleIs('admin')->count() ],
            'clients'=> ['name'=>__('auth.clients'), 'icon'=>"users", 'color'=>"primary", 'count'=> Client::count() ],
            'categories'=> ['name'=>__('details.categories'), 'icon'=>"folder-full", 'color'=>"danger", 'count'=> Category::count() ],
            'products'=> ['name'=>__('details.products'), 'icon'=>"cart-1", 'color'=>"dark", 'count'=> Product::count() ],
            'orders'=> ['name'=>__('details.orders'), 'icon'=>"cart-1", 'color'=>"secondary", 'count'=> Order::count() ],
        ];
        $months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        $total_price = [];
        foreach ($months as $index=>$month){

            $total = Order::select(
                DB::raw('SUM(total_price) as total_price')
            )->whereYear('created_at',date('Y'))->whereMonth('created_at',$index+1)->get();
            $total_price[] = $total[0]->total_price??0;
        }


        return view('dashboard.index',compact('activities','pages','months','total_price'));
    }
}

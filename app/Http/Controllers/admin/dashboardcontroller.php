<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardcontroller extends Controller
{
    public function admin_dashboard()
    {

        return view('pages.admin.dashboard.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Services\AdminService;

class DashboardController extends Controller
{
    protected $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->middleware('auth');
        $this->adminService = $adminService; // Inject the service
    }
     public function  dashboard(): View
     {
        $data['admins'] = $this->adminService->getAllAdmins();
        return view('admin.dashboard.dashboard',$data);
     }
}

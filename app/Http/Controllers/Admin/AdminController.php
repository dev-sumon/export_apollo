<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    protected $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->middleware('auth');
        $this->adminService = $adminService; // Inject the service
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $admins = $this->adminService->getAllAdmins();
        if ($request->ajax()) {
            $admins = $admins->sortBy('sort_order');
            return DataTables::of($admins)
                ->editColumn('status', function ($admin) {
                    return "<span class='" . $admin->getStatusBadgeBg() . "'>" . $admin->getStatusBadgeTitle() . "</span>";
                })
                ->editColumn('created_at', function ($admin) {
                    return timeFormat($admin->created_at);
                })
                ->editColumn('created_by', function ($admin) {
                    return c_user_name($admin->creater);
                })
                ->editColumn('action', function ($admin) {
                    return view('admin.includes.action_buttons', [
                        'menuItems' => [
                            ['routeName' => 'javascript:void(0)', 'data-id' => $admin->id, 'className' => 'view', 'label' => 'Details'],
                            ['routeName' => 'admin.edit', 'params' => [$admin->id], 'label' => 'Edit'],
                            ['routeName' => 'admin.destroy', 'params' => [$admin->id], 'label' => 'Delete', 'delete' => true],
                            ['routeName' => 'admin.status', 'params' => [$admin->id], 'label' => $admin->getStatusBtnTitle()],
                        ],
                    ]);
                })
                ->rawColumns(['status', 'created_at', 'created_by', 'action'])
                ->make(true);
        }
        return view('admin.admin_management.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin_management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $req)
    {
        $admin = $this->adminService->storeAdmin($req);
        session()->flash('success', "$admin->name created successfully");
        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $data = $this->adminService->showAdmin($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data['admin'] = $this->adminService->getAdminForEdit($id);
        return view('admin.admin_management.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $req, int $id)
    {
        $admin = $this->adminService->updateAdmin($req, $id);
        session()->flash('success', "$admin->name updated successfully");
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $admin = $this->adminService->deleteAdmin($id);
        session()->flash('success', "$admin->name deleted successfully");
        return redirect()->route('admin.index');
    }

    public function status(int $id)
    {
        $admin = $this->adminService->toggleStatus($id);
        session()->flash('success', "$admin->name status updated successfully");
        return redirect()->route('admin.index');
    }
}

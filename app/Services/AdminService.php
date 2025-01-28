<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\FileManagementTrait;
use App\Http\Traits\AuditColumnsDataTrait;

class AdminService
{
    use FileManagementTrait, AuditColumnsDataTrait;
    // Get all admins
    public function getAllAdmins()
    {
        return User::with('creater')->orderBy('sort_order')->get();
    }

    // Store new admin
    public function storeAdmin(Request $request)
    {
        $data = new User();
        $this->assignAdminData($data, $request);
        $data->created_by = admin()->id;
        $data->save();
        return $data;
    }
    public function showAdmin(int $id)
    {
        $data = User::with(['creater', 'updater'])->findOrFail($id);
        $this->AuditColumnsData($data);
        $this->StatusData($data);
        return $data;
    }

    public function getAdminForEdit(int $id)
    {
        return User::findOrFail($id);
    }

    // Update an existing admin
    public function updateAdmin(Request $request, int $id)
    {
        $data = User::findOrFail($id);
        $this->assignAdminData($data, $request);
        $data->updated_by = admin()->id;
        $data->update();
        return $data;
    }

    // Delete an admin
    public function deleteAdmin($id)
    {
        $data = User::findOrFail($id);
        $data->deleted_by = admin()->id;
        $data->save();
        $data->delete();
        return $data;
    }

    // Helper function to assign admin data (name, email, image)
    private function assignAdminData(User $data, Request $request)
    {
        $data->name = $request->name;
        $data->email = $request->email;
        $this->handleFileUpload($request, $data, 'image', 'users/');
        if ($request->filled('password')) {
            $data->password = bcrypt($request->password); // Hash password
        }
    }

    // Toggle the status of an admin
    public function toggleStatus($id)
    {
        $data = User::findOrFail($id);
        $data->status = !$data->status;
        $data->updated_by = admin()->id;
        $data->save();
        return $data;
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DatatableOrderRequest;
use App\Services\SortOrderService;
use Illuminate\Http\Request;

class DatatableController extends Controller
{
    protected $sortOrderService;

    public function __construct(SortOrderService $sortOrderService)
    {
        $this->middleware('auth');
        $this->sortOrderService = $sortOrderService;
    }

    public function updateSortOrder(DatatableOrderRequest $request)
    {
        try {
            $this->sortOrderService->updateSortOrder($request->validated());
            session()->flash('success', 'Sort order updated successfully.');
            return response()->json(['success' => true, 'message' => 'Sort order updated successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()], 400);
        }
    }
}

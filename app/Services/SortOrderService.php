<?php

namespace App\Services;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class SortOrderService
{
    public function updateSortOrder($input)
    {
        $modelClass = '\\App\\Models\\' . $input['model'];

        // dd($data);

        // Check if model class exists
        if (!class_exists($modelClass) || !is_subclass_of($modelClass, Model::class)) {
            return response()->json(['success' => false, 'message' => 'Invalid model'], 400);
        }

        // Update sort_order for each model based on new order
        foreach ($input['datas'] as $d) {
            $dbData = $modelClass::find($d['id']);
            $dbData->sort_order = $d['newOrder']; // Set sort_order starting from 1
            $dbData->save();
        }
        return true;
    }
}

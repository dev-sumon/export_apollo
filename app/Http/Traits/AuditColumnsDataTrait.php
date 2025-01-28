<?php

namespace App\Http\Traits;

trait AuditColumnsDataTrait
{
    private function AuditColumnsData($data)
    {
        $data->creating_time = timeFormat($data->created_at);
        $data->updating_time = $data->created_at != $data->updated_at ? timeFormat($data->updated_at) : 'null';
        $data->created_by = c_user_name($data->creater);
        $data->updated_by = u_user_name($data->updater);
    }

    private function StatusData($data)
    {
        $data->statusBadgeBg = $data->status ? $data->getStatusBadgeBg() : '';
        $data->statusBadgeTitle = $data->status ? $data->getStatusBadgeTitle() : '';
        $data->statusBtnBg = $data->status ? $data->getStatusBtnBg() : '';
        $data->statusBtnTitle = $data->status ? $data->getStatusBtnTitle() : '';
    }
}
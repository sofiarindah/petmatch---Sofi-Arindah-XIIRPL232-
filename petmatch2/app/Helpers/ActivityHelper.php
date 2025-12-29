<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

function logActivity($aktivitas, $detail = null)
{
    ActivityLog::create([
        'admin_id' => Auth::id(),
        'aktivitas' => $aktivitas,
        'detail'    => $detail,
    ]);
}

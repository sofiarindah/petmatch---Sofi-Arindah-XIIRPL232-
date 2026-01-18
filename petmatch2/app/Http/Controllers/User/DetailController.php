<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hewan;

class DetailController extends Controller
{
    public function index($id)
    {
        $detail = Hewan::where('id', $id)->first();

        // if (!$hewan) {
        //     abort(404, 'Data hewan tidak ditemukan');
        // }

        return view('user.detail.index', compact('detail'));
    }
}

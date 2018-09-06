<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    //
    public function smtp()
    {
        return view('admin.setting.smtp');
    }


    public function info()
    {
        return view('admin.setting.info');
    }
}

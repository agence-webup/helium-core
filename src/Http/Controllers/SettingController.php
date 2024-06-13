<?php

namespace Webup\Helium\Http\Controllers;

use Illuminate\Routing\Controller;
use Webup\Helium\Facades\Setting;

class SettingController extends Controller
{
    public function index()
    {
        return view('helium::pages.setting.index', [
            'settings' => Setting::all(),
        ]);
    }
}

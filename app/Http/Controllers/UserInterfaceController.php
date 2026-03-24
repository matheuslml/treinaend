<?php

namespace App\Http\Controllers;

use App\Models\Copyright;
use App\Models\Course;
use App\Models\Unit;
use Illuminate\Http\Request;

class UserInterfaceController extends Controller
{
    // Content Typography
    public function typography()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "UI"], ['name' => "Typography"]
        ];
        $courses_nav = Course::where('status', 'PUBLISHED')->get();

                $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/ui-pages/ui-typography', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright', 'courses_nav'));
    }

    // Icons Feather
    public function icons_feather()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "UI"], ['name' => "Feather Icons"]
        ];
        $courses_nav = Course::where('status', 'PUBLISHED')->get();

                $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/ui-pages/icons-feather', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright', 'courses_nav'));
    }
}

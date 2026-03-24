<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Course;
use App\Models\Copyright;
use Illuminate\Http\Request;

class ExtensionController extends Controller
{
    // Sweet Alert
    public function sweet_alert()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extensions"], ['name' => "Sweet Alerts"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/extensions/ext-component-sweet-alerts', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright', 'courses_nav'));
    }

    // block ui
    public function block_ui()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extensions"], ['name' => "BlockUI"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/extensions/ext-component-block-ui', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright', 'courses_nav'));
    }

    // Toastr
    public function toastr()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extensions"], ['name' => "Toastr"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/extensions/ext-component-toastr', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright', 'courses_nav'));
    }

    // NoUi Slider
    public function sliders()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extensions"], ['name' => "Sliders"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/extensions/ext-component-sliders', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright', 'courses_nav'));
    }

    // Drag Drop
    public function drag_drop()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extensions"], ['name' => "Drag & Drop"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/extensions/ext-component-drag-drop', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright', 'courses_nav'));
    }

    // Tour
    public function faq()
    {
        $pageConfigs = ['pageHeader' => false];
$courses_nav = Course::where('status', 'PUBLISHED')->get();

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();

        return view('admin/help/faq', [
            'pageConfigs' => $pageConfigs
        ], compact('unit', 'copyright', 'courses_nav'));
    }

    // Clipboard
    public function clipboard()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extensions"], ['name' => "Clipboard"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/extensions/ext-component-clipboard', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright', 'courses_nav'));
    }

    // Media Player
    public function plyr()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extensions"], ['name' => "Media Player"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/extensions/ext-component-media-player', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright', 'courses_nav'));
    }

    // Context Menu
    public function context_menu()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extensions"], ['name' => "Context Menu"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/extensions/ext-component-context-menu', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright', 'courses_nav'));
    }

    // swiper
    public function swiper()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extensions"], ['name' => "Swiper"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/extensions/ext-component-swiper', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright', 'courses_nav'));
    }

    // tree
    public function tree()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extensions"], ['name' => "Tree"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/extensions/ext-component-tree', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright', 'courses_nav'));
    }

    // ratings
    public function ratings()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extensions"], ['name' => "Ratings"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/extensions/ext-component-ratings', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright', 'courses_nav'));
    }

    // I18n
    public function locale()
    {
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Extensions"], ['name' => "Locale"]
        ];

        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        return view('/content/locale/locale', [
            'breadcrumbs' => $breadcrumbs
        ], compact('unit', 'copyright', 'courses_nav'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Course;
use App\Models\Copyright;
use Illuminate\Http\Request;

class MiscellaneousController extends Controller
{
  // Coming Soon
  public function coming_soon()
  {
    $pageConfigs = ['blankPage' => true];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

    return view('/content/miscellaneous/page-coming-soon', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'courses_nav'));
  }

  // Error
  public function error()
  {
    $pageConfigs = ['blankPage' => true];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

    return view('/content/miscellaneous/error', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'courses_nav'));
  }

  // Not-authorized
  public function not_authorized()
  {
    $pageConfigs = ['blankPage' => true];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

    return view('/content/miscellaneous/page-not-authorized', ['pageConfigs' => $pageConfigs], compact('unit', 'copyright', 'courses_nav'));
  }

  // Maintenance
  public function maintenance()
  {
    $pageConfigs = ['blankPage' => true];

        $unit = Unit::where('web', true)->first();
$copyright = Copyright::where('status', 'PUBLISHED')->first();

    return view('/content/miscellaneous/page-maintenance', [
      'pageConfigs' => $pageConfigs
    ]);
  }
}

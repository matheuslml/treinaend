<?php

namespace App\Http\Controllers;

use App\Models\Orderly;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\Discipline;
use App\Models\Exercise;
use App\Models\ExerciseUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  // Dashboard - Analytics
  public function dashboardAnalytics()
  {
    $pageConfigs = ['pageHeader' => false];

    return view('admin/dashboard/dashboard-ecommerce', ['pageConfigs' => $pageConfigs]);
  }

  // Dashboard - Ecommerce
  public function dashboard()
  {
    $pageConfigs = ['pageHeader' => false];
    $copyright = Copyright::where('status', 'PUBLISHED')->first();
    $unit = Unit::where('web', true)->first();

    $exercises_count = Exercise::whereIn('type', ['A', 'E'])->count();
    $userId = Auth::id();
    $user = User::find($userId);
    $person_id = $user->person_id;
    $exercise_user_count = ExerciseUser::where('user_id', $userId)->count();



    $discipline_atual = Discipline::orderBy('order', 'desc')
        ->whereHas('person', function ($query) use ($person_id) {
            $query->where('person_id', $person_id)
                ->where(function ($q) {
                    $q->where('discipline_people.score', '<=', 7)
                        ->orWhereNull('discipline_people.finished_at');
                });
        })
        ->with(['person' => function ($query) use ($person_id) {
            $query->where('person_id', $person_id)
                ->where(function ($q) {
                    $q->where('discipline_people.score', '<=', 7)
                        ->orWhereNull('discipline_people.finished_at');
                });
        }])
        ->first();

    return view('admin/dashboard/dashboard', compact('unit', 'copyright', 'copyright', 'exercises_count', 'exercise_user_count', 'discipline_atual'));
  }
}

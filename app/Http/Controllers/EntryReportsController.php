<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;
use App\Models\Unit;
use App\Models\Course;
use App\Models\Copyright;
use Illuminate\Contracts\View\View;

class EntryReportsController extends Controller
{

    public function entry_index()
    {
        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $audits = Audit::orderBy('created_at', 'desc')->get();
            return view('admin.entryReport.index', compact('audits', 'unit', 'copyright', 'courses_nav'));
        } catch (\Throwable $throwable) {
            flash('Erro ao buscar as entradas!')->error();
            return redirect()->back()->withInput();
        }
    }
}

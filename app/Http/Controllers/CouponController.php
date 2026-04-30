<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\CouponService;
use App\Services\CouponCreateService;
use App\Services\CouponUpdateService;
use App\Models\Unit;
use App\Models\Course;
use App\Models\Copyright;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function __construct(
        protected CouponService $couponService,
        protected CouponCreateService $couponCreateService,
        protected CouponUpdateService $couponUpdateService,
    ){}

    public function index()
    {
        /*if (! Gate::allows('Ver e Listar Cupom')) {
            return view('pages.not-authorized');
        }*/

        try{
            $pageConfigs = ['pageHeader' => false];
            $courses_nav = Course::where('status', 'PUBLISHED')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $coupons = Coupon::latest()->get();
            $courses = Course::where('status', 'PUBLISHED')->get();

            return view('admin.coupon.index', ['pageConfigs' => $pageConfigs], compact('coupons', 'unit', 'copyright', 'courses_nav', 'courses'));
        } catch (\Throwable $throwable) {
            flash('Erro ao procurar as Cupom Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        Request $request
    ){
        /*if (! Gate::allows('Criar Cupom')) {
            return view('pages.not-authorized');
        }*/

        try {
            DB::beginTransaction();
            $this->couponCreateService->create($request->toArray());

            flash('Cupom criado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar nova Cupom!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        Request $request, $coupon_id
    ){
        /*if (! Gate::allows('Editar Cupom')) {
            return view('pages.not-authorized');
        }*/

        try {
            DB::beginTransaction();
            $this->couponUpdateService->update($request->toArray(), $coupon_id);

            flash('Cupom editado com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            dd($throwable);
            flash('Erro ao editar a Cupom!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($coupon_id)
    {
        /*if (! Gate::allows('Editar Cupom')) {
            return view('pages.not-authorized');
        }*/

        try{
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $courses_nav = Course::where('status', 'PUBLISHED')->get();
            $coupons = $this->couponService->get();
            $coupon_selected = $this->couponService->show($coupon_id);
            $courses = Course::where('status', 'PUBLISHED')->get();
            return view('admin.coupon.show', compact('coupon_selected', 'coupons', 'unit', 'copyright', 'courses_nav', 'courses'));
        } catch (\Exception $exception) {
            dd($exception);
            flash('Erro ao buscar a Cupom!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function destroy($coupon)
    {
        /*if (! Gate::allows('Deletar Cupoms')) {
            return view('pages.not-authorized');
        }*/

        try{
            $coupon = Coupon::find($coupon);
            $coupon->delete();
            $pageConfigs = ['pageHeader' => false];
            $courses_nav = Course::where('status', 'PUBLISHED')->get();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();

            $coupons = Coupon::latest()->get();
            $courses = Course::where('status', 'PUBLISHED')->get();

            flash('Cupom deletado com sucesso!')->success();

            return view('admin.coupon.index', ['pageConfigs' => $pageConfigs], compact('coupons', 'unit', 'copyright', 'courses_nav', 'courses'));
        } catch (\Exception $exception) {
            flash('Erro ao deletar a Cupom!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function validateCoupon($code, $courseId)
    {
        try{
            $today = Carbon::now();

            $course = Course::find($courseId);

            $coupon = Coupon::where('code', $code)
                ->where('course_id', $courseId)
                ->where('status', 'PUBLISHED')
                ->where('started_at', '<=', $today)
                ->where('finished_at', '>=', $today)
                ->where('amount', '>', 0)
                ->with('course') // carrega o curso vinculado
                ->first();

            if ($coupon) {
                return response()->json([
                    'valid' => true,
                    'discount_percentage' => $coupon->discount_percentage,
                    'payment_value' => $course->payment_value,
                ]);
            }

            // Cupom inválido
            return response()->json([
                'valid' => false,
                'discount_percentage' => 0,
                'payment_value' => $course->payment_value,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception
            ]);
        }
    }
}

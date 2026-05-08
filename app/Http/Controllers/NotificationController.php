<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use App\Models\NotificationStatus;
use App\Models\NotificationType;
use App\Models\NotificationUser;
use App\Models\Unit;
use App\Models\Course;
use App\Models\Copyright;
use App\Models\User;
use App\Services\NotificationService;
use App\Services\NotificationCreateService;
use App\Services\NotificationUpdateService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class NotificationController extends Controller
{
    public function __construct(
        protected NotificationService $notificationService,
        protected NotificationCreateService $notificationCreateService,
        protected NotificationUpdateService $notificationUpdateService,
    ){}

    public function index()
    {
        /*if (! Gate::allows('Ver e Listar Notificações')) {
            return view('pages.not-authorized');
        }*/

        try{

            $userId = Auth::id();
            $user = User::find($userId);

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $courses_nav = Course::where('status', 'PUBLISHED')->get();
            //user notifications
            $notifications = Notification::with('users')->orderBy('created_at', 'desc')->get();

            $my_notifications = Notification::whereHas('users', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();
            $readeds = $my_notifications->where('status_id', 1);
            $not_readeds = $my_notifications->where('status_id', '!=', 1);
            $sendeds = Notification::where('sender_id', $user->id)->get();

            $statuses = NotificationStatus::orderBy('status', 'asc')->get();
            $types = NotificationType::orderBy('title', 'asc')->get();
            $users = User::with('person')->latest()->get(['id', 'email', 'person_id']);
            return view('admin.notification.index', compact('unit', 'copyright', 'courses_nav', 'notifications', 'readeds', 'not_readeds', 'sendeds', 'users', 'statuses', 'types'));
        } catch (\Throwable $throwable) {
            dd($throwable);
            flash('Erro ao procurar as notificações Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function show($notification_id)
    {
        /*if (! Gate::allows('Ver e Listar Notificações')) {
            return view('pages.not-authorized');
        }*/

        try{

            $userId = Auth::id();
            $user = User::find($userId);

            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $courses_nav = Course::where('status', 'PUBLISHED')->get();
            //user notifications

            $notification = Notification::find($notification_id);
            $notification->status_id = 1;
            $notification->save();


            // pega o primeiro usuário vinculado à notificação
            $user_id = $notification->users()->first()?->id;

            $notifications = Notification::whereHas('users', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();
            $readeds = $notifications->where('status_id', 1);
            $not_readeds = $notifications->where('status_id', '!=', 1);
            $sendeds = Notification::where('sender_id', $user->id)->get();

            $statuses = NotificationStatus::orderBy('status', 'asc')->get();
            $types = NotificationType::orderBy('title', 'asc')->get();
            $users = User::with('person')->latest()->get(['id', 'email', 'person_id']);
            return view('admin.notification.show', compact('user_id','notification', 'notifications', 'unit', 'copyright', 'courses_nav', 'readeds', 'not_readeds', 'sendeds', 'users', 'statuses', 'types'));
        } catch (\Throwable $throwable) {
            dd($throwable);
            flash('Erro ao procurar as notificações Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function update(
        NotificationRequest $request
    ){
        if (! Gate::allows('Editar Notificações')) {
            return view('pages.not-authorized');
        }

        try {
            DB::beginTransaction();
            $this->notificationUpdateService->update($request->toArray());

            flash('Notificação editada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao editar a notificação!')->error();
            return redirect()->back()->withInput();
        }
    }

    public function store(
        NotificationRequest $request
    ){
        if (! Gate::allows('Criar Notificações')) {
            return view('pages.not-authorized');
        }
        try {
            DB::beginTransaction();
            $this->notificationCreateService->create($request->toArray());

            flash('Notificação criada com sucesso!')->success();
            DB::commit();
            return redirect()->back();
        }catch (\Throwable $throwable){
            DB::rollBack();
            flash('Erro ao adicionar nova notificação!')->error();

        dd($throwable);
            return redirect()->back()->withInput();
        }
    }


    public function destroy($notification)
    {
        if (! Gate::allows('Deletar Notificações')) {
            return view('pages.not-authorized');
        }

        try{
            $notification = Notification::find($notification);
            $notification->delete();
            flash('Notificação deletada com sucesso!')->success();
        } catch (\Exception $exception) {
            flash('Erro ao deletar a notificação!')->error();
        }
        return redirect()->back()->withInput();
    }

    public function changeReaded(int $idNotification)
    {
        try {
            DB::beginTransaction();

            $notification = Notification::find($idNotification);
            $notification->status_id = 1;
            $notification->save();

            DB::commit();
        } catch (\Throwable $throwable) {
            ////Bugsnag::notifyException($exception);
            DB::rollBack();
        }
    }
}

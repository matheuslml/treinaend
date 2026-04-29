<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtensionController;

use App\Http\Controllers\PersonController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlankPageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EntryReportsController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LeadershipController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\OmbudsmanController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectMediaController;
use App\Http\Controllers\CopyrightController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\ExerciseController;

use App\Http\Controllers\TagController;
use App\Http\Controllers\TypeAccessController;
use App\Http\Controllers\TypeRequestController;
use App\Http\Controllers\UserController;
use App\Models\DirectHireModality;

/*************************/
/* WEB CONTROLLERS */
/*************************/
use App\Http\Controllers\HomeWebController;
use App\Http\Controllers\PublicationWebController;
use App\Http\Controllers\FAQWebController;
use App\Http\Controllers\GalleryTypeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProjectProgressController;
use App\Http\Controllers\ProjectResponsibleController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ShortcutWebController;
use App\Http\Controllers\StudentPainel;
use App\Http\Controllers\SupportMaterialController;
use App\Http\Controllers\WebFooterController;
use App\Http\Controllers\WebFooterLogoController;
use App\Models\Registration;
use App\Models\SupportMaterial;

/*
|--------------------------------------------------------------------------
| Main Routes
|---------------------------------------------------------------------------
*/
//Ouvidoria - Ombudsman
Route::get('/ouvidoria_web', 'App\Http\Controllers\OmbudsmanController@web_ouvidoria')->name('web_ouvidoria');
Route::post('/ombudsman_store', 'App\Http\Controllers\OmbudsmanController@ombudsman_store')->name('ombudsman_store');

//Type Access -
Route::get('/type_access_select', 'App\Http\Controllers\TypeAccessController@select')->name('type_access_select');
//file downloadfile
Route::get('/file_web/{file_id}', 'App\Http\Controllers\FileController@file_web')->name('file_web');
//Unit
Route::post('unidade_social_media_add', 'App\Http\Controllers\UnitController@unidade_social_media_add')->name('unidade_social_media_add');
Route::post('unidade_social_media_remove', 'App\Http\Controllers\UnitController@unidade_social_media_remove')->name('unidade_social_media_remove');
Route::post('unidade_social_media_update', 'App\Http\Controllers\UnitController@unidade_social_media_update')->name('unidade_social_media_update');
Route::get('unidade_social_media_delete/{social_media}', 'App\Http\Controllers\UnitController@unidade_social_media_delete')->name('unidade_social_media_delete');

/* Route CODE não pode alterar*/
Route::group(['middleware' => ['auth']], function () {

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
    Route::get('analytics', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard-analytics');

    Route::resource('permissions', PermissionsController::class);
    Route::delete('permissions_mass_destroy', 'App\Http\Controllers\Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', RolesController::class);
    Route::delete('roles_mass_destroy', [RolesController::class, 'massDestroy'])->name('roles.mass_destroy');
    Route::resource('users', UsersController::class );
    Route::delete('users_mass_destroy', [UsersController::class, 'massDestroy'])->name('users.mass_destroy');
    Route::get('user_rule_create/{idUser}', [RolesController::class, 'user_rule_create'])->name('user_rule_create');
    Route::post('user_rule_store', [RolesController::class, 'user_rule_store'])->name('user_rule_store');


    //Main - Pessoas
    Route::resource('/pessoas', PersonController::class);
    Route::resource('/telefones', PhoneController::class);
    Route::resource('/documentos', DocumentController::class);
    Route::resource('/emails', EmailController::class);

    //Main - Treinaend -----------------------------------------------------------------
    Route::resource('/aulas', LessonController::class);
    Route::resource('/disciplinas', DisciplineController::class);
    Route::resource('/cupons', CouponController::class);
    Route::resource('/cursos', CourseController::class);
    Route::resource('/exercicios', ExerciseController::class);
    Route::resource('/materiais_de_apoio', SupportMaterialController::class);
    Route::resource('/matriculas', RegistrationController::class);
    //Main - Treinaend - Student painel -----------------------------------------------------------------
    Route::get('disciplines_student_index/{courseId}', [StudentPainel::class, 'disciplines_student_index'])->name('disciplines_student_index');
    Route::get('exercises_student_index/{disciplineId}', [StudentPainel::class, 'exercises_student_index'])->name('exercises_student_index');
    Route::post('/student_answer_exercise', [StudentPainel::class, 'student_answer_exercise'])->name('student_answer_exercise');
    Route::get('/download_support_material/{id}', [SupportMaterialController::class, 'download'])->name('download_support_material');
    Route::post('/student_save_discipline', [StudentPainel::class, 'student_save_discipline'])->name('student_save_discipline');
    Route::post('/student_save_lesson', [StudentPainel::class, 'student_save_lesson'])->name('student_save_lesson');

    //Main - Departamentos
    Route::resource('/unidades', UnitController::class);
    Route::resource('/departamentos', DepartamentController::class);
    Route::resource('/organizacoes', OrganizationController::class);
    Route::resource('/ocupacoes', OccupationController::class);
    //Main - Arquivos
    Route::resource('/arquivos', FileController::class);
    //Main - Capa do site
    Route::resource('/capas', PostController::class);
    //Main - Notícias
    Route::resource('/noticias', NewsController::class);
    Route::resource('/noticia_categorias', CategoryController::class);
    Route::resource('/noticia_tags', TagController::class);
    //Main - Notificações
    Route::resource('/notificacoes', NotificationController::class);
    //Main - Ouvidoria ouvidoria_requisicoes
    Route::resource('/ouvidoria_manifestacoes', OmbudsmanController::class);
    Route::resource('/ouvidoria_acessos', TypeAccessController::class);
    Route::resource('/ouvidoria_requisicoes', TypeRequestController::class);
    //Main - Projetos
    Route::resource('/projetos', ProjectController::class);
    Route::resource('/projeto_categorias', ProjectCategoryController::class);
    Route::resource('/projeto_responsaveis', ProjectResponsibleController::class);
    Route::resource('/projeto_progressos', ProjectProgressController::class);
    Route::resource('/projeto_medias', ProjectMediaController::class);

    //Main - faq
    Route::resource('/faqs', FAQController::class);
    //Main - Gallery
    Route::resource('/galeria_imagens', GalleryController::class);
    Route::resource('/galeria_tipos', GalleryTypeController::class);
    //Main - Leadership
    Route::resource('/liderancas', LeadershipController::class);
    //Main - about
    Route::resource('/sobres', AboutController::class);
    //Main - Banner
    Route::resource('/banners', BannerController::class);
    //Main - Shortcutweb
    Route::resource('/web_atalhos', ShortcutWebController::class);
    //Main - CopyRight
    Route::resource('/copyrights', CopyrightController::class);
    //Main - WebFooter
    Route::resource('/webfooters', WebFooterController::class);
    Route::resource('/webfooter_logos', WebFooterLogoController::class);
    Route::get('web_footer_logo_create/{web_footer_id}', [WebFooterLogoController::class, 'create_logo'])->name('web_footer_logo_create');

    //Main - blankpage
    Route::resource('/paginas', BlankPageController::class);


    //Notícias
    //Route::post('ajaxRegister', ['as' => 'ajax.storecontent', 'uses' => 'App\Http\Controllers\NewsController@store_content']);
    Route::post('/savenewscontent', [NewsController::class, 'store_content'])->name('store_content');


    //Notifications
    Route::get('notification/readed/{idNotification}', 'App\Http\Controllers\NotificationController@changeReaded');
    //departaments
    Route::get('departament/get-departamentos/{idUnit}', 'App\Http\Controllers\DepartamentController@getDepartamentos');
    Route::get('departament/get-occupations/{idDepartament}', 'App\Http\Controllers\DepartamentController@getOccupations');



    //reports ----------------------------- REPORTS -----------------------------------------------------------
    // --------------------------------------------------------------------------------------------------------

    // ombudsman
    Route::get('report_ombudsman_index', [OmbudsmanController::class, 'report_ombudsman_index'])->name('report_ombudsman_index');
    Route::post('report_ombudsman_pdf', [OmbudsmanController::class, 'report_ombudsman_pdf'])->name('report_ombudsman_pdf');

    //reports ----------------------------- Audits -----------------------------------------------------------
    // --------------------------------------------------------------------------------------------------------

    // entradas
    Route::get('entry_index', [EntryReportsController::class, 'entry_index'])->name('entry_index');

});
/* Route CODE */

/* Route Usuarios */
Route::group(['middleware' => ['auth'], 'prefix' => 'usuarios'], function () {
    Route::post('/usuarios/update/password', [UserController::class, 'updatePassword'])->name('update-password');
    Route::post('/usuarios/update/email', [UserController::class, 'updateEmail'])->name('update-email');
    Route::post('/usuarios/update/photo', [UserController::class, 'updatePhoto'])->name('update-photo');
});
/* Route Usuarios */

/* Route Help */
Route::group(['middleware' => ['auth'], 'prefix' => 'help'], function () {
    Route::get('faq', [ExtensionController::class, 'faq'])->name('faq');
});
/* Route Help */


        /********************/
        /* WEB/SITE ROUTES */
        /********************/


    //  ROTA HOME
    Route::get('/', [HomeWebController::class, 'index'])->name('web_home');

    //~ ROTAS WEB ~~~

    Route::get('/sobre', 'App\Http\Controllers\WebController@about')->name('about');
    Route::get('/contato', 'App\Http\Controllers\WebController@contact')->name('contact');
    Route::get('/consulta', 'App\Http\Controllers\WebController@professional_consult')->name('professional_consult');
    Route::get('/matricula/{courseName}', 'App\Http\Controllers\WebController@membership')->name('membership');
    Route::get('/verificar_cpf/{cpf}', 'App\Http\Controllers\RegistrationController@verificarCPF')->name('verificar_cpf');
    Route::post('/get_registration', [RegistrationController::class, 'get_registration'])->name('get_registration');
    Route::post('/cadastro', [RegistrationController::class, 'web_store'])->name('web_store');
    Route::get('/certificado/{registration_id}', 'App\Http\Controllers\RegistrationController@certificate')->name('certificate');

    // Cursos verificarCPF
    Route::post('/treinamen', [RegistrationController::class, 'web_store'])->name('web_store');

    Route::get('curso/{courseId}', [CourseController::class, 'pagina_web_course'])->name('pagina_web_course');

    // BlankPages
    Route::get('page/{blank_page}', [BlankPageController::class, 'pagina_web'])->name('pagina_web');


    // Galeria WEB
    Route::get('/gallery_web_index', [GalleryController::class, 'gallery_web_index'])->name('gallery_web_index');


    //news
    Route::get('/blog/{new}', 'App\Http\Controllers\WebController@news_web_show')->name('news_web_show');
    Route::get('/blog', 'App\Http\Controllers\WebController@blog')->name('blog');


    // ROTA PROJETOS WEB
    Route::get('/projeto_web/{project_id}', [ProjectController::class, 'web_show'])->name('project_web_show');
    Route::get('/projeto_web', [ProjectController::class, 'web_index'])->name('projects_web_index');
    Route::get('/project_category_web/{category_id}', [ProjectController::class, 'web_category_show'])->name('project_category_web');

    // WEB TRANSPARÊNCIA
    Route::any('/despesas_index', 'App\Http\Controllers\ExpenseController@web_index')->name('web_expense_index');
    Route::get('/web_expense_show/{expense}', 'App\Http\Controllers\ExpenseController@web_show')->name('web_expense_show');
    Route::any('/receitas_index', 'App\Http\Controllers\RevenueController@web_index')->name('web_revenue_index');
    Route::get('/web_revenue_show/{revenue}', 'App\Http\Controllers\RevenueController@web_show')->name('web_revenue_show');
    Route::any('/legislacoes_index', 'App\Http\Controllers\LegislationController@index_web')->name('web_legislacoes_index');

    Route::get('/contratacao_direta_index', 'App\Http\Controllers\DirectHireController@index_web')->name('web_direct_hire_index');
    Route::get('/web_direct_hire_show/{direct_hire_id}', 'App\Http\Controllers\DirectHireController@show_web')->name('web_direct_hire_show');
    Route::get('/web_direct_hire_winner_show/{winner_id}', 'App\Http\Controllers\DirectHireWinnerController@show_web')->name('web_direct_hire_winner_show');
    Route::any('/licitacao_index', 'App\Http\Controllers\BiddingController@index_web')->name('web_bididng_index');
    Route::get('/web_bididng_show/{bididng}', 'App\Http\Controllers\BiddingController@show_web')->name('web_bididng_show');
    Route::any('/contratos_index', 'App\Http\Controllers\BiddingAgreementController@index_web')->name('web_bididng_agreement_index');
    Route::get('/web_bididng_agreement_show/{bidding_agreement_id}', 'App\Http\Controllers\BiddingAgreementController@show_web')->name('web_bididng_agreement_show');

    Route::get('/web_bididng_winner_show/{winner_id}', 'App\Http\Controllers\BiddingWinnerController@show_web')->name('web_bididng_winner_show');



// ROTA OUVIDORIA
Route::get('/ouvidoria',[OmbudsmanController::class, 'web_ouvidoria'])->name('web_ombudsman');
Route::post('/ombudsman_store', [OmbudsmanController::class, 'ombudsman_store'])->name('ombudsman_store');




//

/********************/

/* END WEB/SITE ROUTES */
/***********************/


require __DIR__.'/auth.php';
require __DIR__.'/dev.php';
require __DIR__.'/filters.php';
require __DIR__.'/reports.php';

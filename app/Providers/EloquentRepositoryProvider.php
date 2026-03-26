<?php

namespace App\Providers;

use App\Repositories\Eloquent\AddressEloquentRepository;
use App\Repositories\Eloquent\AddressCreateEloquentRepository;
use App\Repositories\Eloquent\AddressUpdateEloquentRepository;
use App\Repositories\Eloquent\CityEloquentRepository;
use App\Repositories\Eloquent\CountryEloquentRepository;
use App\Repositories\Eloquent\DocumentEloquentRepository;
use App\Repositories\Eloquent\DocumentTypeEloquentRepository;
use App\Repositories\Eloquent\EmailEloquentRepository;
use App\Repositories\Eloquent\EmailCreateEloquentRepository;
use App\Repositories\Eloquent\EmailUpdateEloquentRepository;
use App\Repositories\Eloquent\NotificationEloquentRepository;
use App\Repositories\Eloquent\NotificationCreateEloquentRepository;
use App\Repositories\Eloquent\NotificationUpdateEloquentRepository;
use App\Repositories\Eloquent\NotificationUserEloquentRepository;
use App\Repositories\Eloquent\OccupationEloquentRepository;
use App\Repositories\Eloquent\OccupationCreateEloquentRepository;
use App\Repositories\Eloquent\OccupationUpdateEloquentRepository;
use App\Repositories\Eloquent\PersonEloquentRepository;
use App\Repositories\Eloquent\PersonCreateEloquentRepository;
use App\Repositories\Eloquent\PersonUpdateEloquentRepository;
use App\Repositories\Eloquent\PhoneEloquentRepository;
use App\Repositories\Eloquent\PhoneCreateEloquentRepository;
use App\Repositories\Eloquent\PhoneUpdateEloquentRepository;
use App\Repositories\Eloquent\DepartamentEloquentRepository;
use App\Repositories\Eloquent\DepartamentCreateEloquentRepository;
use App\Repositories\Eloquent\DepartamentUpdateEloquentRepository;
use App\Repositories\Eloquent\StateEloquentRepository;
use App\Repositories\Eloquent\UnitEloquentRepository;
use App\Repositories\Eloquent\UnitCreateEloquentRepository;
use App\Repositories\Eloquent\UnitUpdateEloquentRepository;
use App\Repositories\Eloquent\UserEloquentRepository;

//TREINAEND -------------------------------------------------------------
use App\Repositories\Eloquent\ExerciseEloquentRepository;
use App\Repositories\Eloquent\ExerciseCreateEloquentRepository;
use App\Repositories\Eloquent\ExerciseUpdateEloquentRepository;
use App\Repositories\Eloquent\LessonEloquentRepository;
use App\Repositories\Eloquent\LessonCreateEloquentRepository;
use App\Repositories\Eloquent\LessonUpdateEloquentRepository;
use App\Repositories\Eloquent\RegistrationEloquentRepository;
use App\Repositories\Eloquent\RegistrationCreateEloquentRepository;
use App\Repositories\Eloquent\RegistrationUpdateEloquentRepository;
use App\Repositories\Eloquent\SupportMaterialEloquentRepository;
use App\Repositories\Eloquent\SupportMaterialCreateEloquentRepository;
use App\Repositories\Eloquent\SupportMaterialUpdateEloquentRepository;
use App\Repositories\Eloquent\DisciplineEloquentRepository;
use App\Repositories\Eloquent\DisciplineCreateEloquentRepository;
use App\Repositories\Eloquent\DisciplineUpdateEloquentRepository;
use App\Repositories\Eloquent\CourseEloquentRepository;
use App\Repositories\Eloquent\CourseCreateEloquentRepository;
use App\Repositories\Eloquent\CourseUpdateEloquentRepository;

//SEMAS -------------------------------------------------------------
use App\Repositories\Eloquent\ShortcutWebEloquentRepository;
use App\Repositories\Eloquent\ShortcutWebCreateEloquentRepository;
use App\Repositories\Eloquent\ShortcutWebUpdateEloquentRepository;

//FIPAC -------------------------------------------------------------
use App\Repositories\Eloquent\OrganizationEloquentRepository;
use App\Repositories\Eloquent\OrganizationCreateEloquentRepository;
use App\Repositories\Eloquent\OrganizationUpdateEloquentRepository;

use App\Repositories\Eloquent\OmbudsmanEloquentRepository;
use App\Repositories\Eloquent\OmbudsmanCreateEloquentRepository;
use App\Repositories\Eloquent\OmbudsmanUpdateEloquentRepository;

use App\Repositories\Eloquent\TypeAccessEloquentRepository;
use App\Repositories\Eloquent\TypeAccessCreateEloquentRepository;
use App\Repositories\Eloquent\TypeAccessUpdateEloquentRepository;

use App\Repositories\Eloquent\TypeExpenseEloquentRepository;
use App\Repositories\Eloquent\TypeExpenseCreateEloquentRepository;
use App\Repositories\Eloquent\TypeExpenseUpdateEloquentRepository;

use App\Repositories\Eloquent\TypeRequestEloquentRepository;
use App\Repositories\Eloquent\TypeRequestCreateEloquentRepository;
use App\Repositories\Eloquent\TypeRequestUpdateEloquentRepository;

use App\Repositories\Eloquent\CategoryEloquentRepository;
use App\Repositories\Eloquent\CategoryCreateEloquentRepository;
use App\Repositories\Eloquent\CategoryUpdateEloquentRepository;

use App\Repositories\Eloquent\FileEloquentRepository;
use App\Repositories\Eloquent\FileCreateEloquentRepository;
use App\Repositories\Eloquent\FileUpdateEloquentRepository;

use App\Repositories\Eloquent\TagEloquentRepository;
use App\Repositories\Eloquent\TagCreateEloquentRepository;
use App\Repositories\Eloquent\TagUpdateEloquentRepository;

use App\Repositories\Eloquent\NewsEloquentRepository;
use App\Repositories\Eloquent\NewsCreateEloquentRepository;
use App\Repositories\Eloquent\NewsUpdateEloquentRepository;

use App\Repositories\Eloquent\PostEloquentRepository;
use App\Repositories\Eloquent\PostCreateEloquentRepository;
use App\Repositories\Eloquent\PostUpdateEloquentRepository;

use App\Repositories\Eloquent\ProjectEloquentRepository;
use App\Repositories\Eloquent\ProjectCreateEloquentRepository;
use App\Repositories\Eloquent\ProjectUpdateEloquentRepository;

use App\Repositories\Eloquent\ProjectCategoryEloquentRepository;
use App\Repositories\Eloquent\ProjectCategoryCreateEloquentRepository;
use App\Repositories\Eloquent\ProjectCategoryUpdateEloquentRepository;

use App\Repositories\Eloquent\ProjectMediaEloquentRepository;
use App\Repositories\Eloquent\ProjectMediaCreateEloquentRepository;
use App\Repositories\Eloquent\ProjectMediaUpdateEloquentRepository;

use App\Repositories\Eloquent\FaqEloquentRepository;
use App\Repositories\Eloquent\FaqCreateEloquentRepository;
use App\Repositories\Eloquent\FaqUpdateEloquentRepository;

use App\Repositories\Eloquent\GalleryEloquentRepository;
use App\Repositories\Eloquent\GalleryCreateEloquentRepository;
use App\Repositories\Eloquent\GalleryUpdateEloquentRepository;

use App\Repositories\Eloquent\GalleryTypeEloquentRepository;
use App\Repositories\Eloquent\GalleryTypeCreateEloquentRepository;
use App\Repositories\Eloquent\GalleryTypeUpdateEloquentRepository;

use App\Repositories\Eloquent\LeadershipEloquentRepository;
use App\Repositories\Eloquent\LeadershipCreateEloquentRepository;
use App\Repositories\Eloquent\LeadershipUpdateEloquentRepository;

use App\Repositories\Eloquent\AboutEloquentRepository;
use App\Repositories\Eloquent\AboutCreateEloquentRepository;
use App\Repositories\Eloquent\AboutUpdateEloquentRepository;

use App\Repositories\Eloquent\BannerEloquentRepository;
use App\Repositories\Eloquent\BannerCreateEloquentRepository;
use App\Repositories\Eloquent\BannerUpdateEloquentRepository;

use App\Repositories\Eloquent\CopyrightEloquentRepository;
use App\Repositories\Eloquent\CopyrightCreateEloquentRepository;
use App\Repositories\Eloquent\CopyrightUpdateEloquentRepository;

use App\Repositories\Eloquent\WebFooterEloquentRepository;
use App\Repositories\Eloquent\WebFooterCreateEloquentRepository;
use App\Repositories\Eloquent\WebFooterUpdateEloquentRepository;

use App\Repositories\Eloquent\WebFooterLogoEloquentRepository;
use App\Repositories\Eloquent\WebFooterLogoCreateEloquentRepository;
use App\Repositories\Eloquent\WebFooterLogoUpdateEloquentRepository;

use App\Repositories\Eloquent\BlankPageEloquentRepository;
use App\Repositories\Eloquent\BlankPageCreateEloquentRepository;
use App\Repositories\Eloquent\BlankPageUpdateEloquentRepository;

use App\Repositories\Eloquent\ProjectProgressEloquentRepository;
use App\Repositories\Eloquent\ProjectProgressCreateEloquentRepository;
use App\Repositories\Eloquent\ProjectProgressUpdateEloquentRepository;

use App\Repositories\Eloquent\ProjectResponsibleEloquentRepository;
use App\Repositories\Eloquent\ProjectResponsibleCreateEloquentRepository;
use App\Repositories\Eloquent\ProjectResponsibleUpdateEloquentRepository;

use App\Repositories\RepositoryInterface;


use App\Services\CityService;
use App\Services\CountryService;
use App\Services\DocumentService;
use App\Services\DocumentTypeService;
use App\Services\EmailService;
use App\Services\EmailCreateService;
use App\Services\EmailUpdateService;


use App\Services\NotificationService;
use App\Services\NotificationCreateService;
use App\Services\NotificationUpdateService;
use App\Services\NotificationUserService;
use App\Services\PersonService;
use App\Services\PersonCreateService;
use App\Services\PersonUpdateService;
use App\Services\PhoneService;
use App\Services\PhoneCreateService;
use App\Services\PhoneUpdateService;
use App\Services\DepartamentService;
use App\Services\DepartamentCreateService;
use App\Services\DepartamentUpdateService;
use App\Services\OccupationService;
use App\Services\OccupationCreateService;
use App\Services\OccupationUpdateService;
use App\Services\StateService;
use App\Services\UnitService;
use App\Services\UnitCreateService;
use App\Services\UnitUpdateService;
use App\Services\UserService;

//TREINAEND ---------------------------------------------------------
use App\Services\ExerciseService;
use App\Services\ExerciseCreateService;
use App\Services\ExerciseUpdateService;
use App\Services\LessonService;
use App\Services\LessonCreateService;
use App\Services\LessonUpdateService;
use App\Services\RegistrationService;
use App\Services\RegistrationCreateService;
use App\Services\RegistrationUpdateService;
use App\Services\SupportMaterialService;
use App\Services\SupportMaterialCreateService;
use App\Services\SupportMaterialUpdateService;
use App\Services\DisciplineService;
use App\Services\DisciplineCreateService;
use App\Services\DisciplineUpdateService;
use App\Services\CourseService;
use App\Services\CourseCreateService;
use App\Services\CourseUpdateService;

//SEMAS ---------------------------------------------------------
use App\Services\ShortcutWebService;
use App\Services\ShortcutWebCreateService;
use App\Services\ShortcutWebUpdateService;

//FIPAC ---------------------------------------------------------
use App\Services\OrganizationService;
use App\Services\OrganizationCreateService;
use App\Services\OrganizationUpdateService;

use App\Services\OmbudsmanService;
use App\Services\OmbudsmanCreateService;
use App\Services\OmbudsmanUpdateService;

use App\Services\TypeAccessService;
use App\Services\TypeAccessCreateService;
use App\Services\TypeAccessUpdateService;

use App\Services\TypeExpenseService;
use App\Services\TypeExpenseCreateService;
use App\Services\TypeExpenseUpdateService;

use App\Services\TypeRequestService;
use App\Services\TypeRequestCreateService;
use App\Services\TypeRequestUpdateService;

use App\Services\CategoryService;
use App\Services\CategoryCreateService;
use App\Services\CategoryUpdateService;

use App\Services\FileService;
use App\Services\FileCreateService;
use App\Services\FileUpdateService;

use App\Services\TagService;
use App\Services\TagCreateService;
use App\Services\TagUpdateService;

use App\Services\NewsService;
use App\Services\NewsCreateService;
use App\Services\NewsUpdateService;

use App\Services\PostService;
use App\Services\PostCreateService;
use App\Services\PostUpdateService;

use App\Services\DirectHireService;
use App\Services\DirectHireCreateService;
use App\Services\DirectHireUpdateService;

use App\Services\ProjectService;
use App\Services\ProjectCreateService;
use App\Services\ProjectUpdateService;

use App\Services\ProjectCategoryService;
use App\Services\ProjectCategoryCreateService;
use App\Services\ProjectCategoryUpdateService;

use App\Services\ProjectMediaService;
use App\Services\ProjectMediaCreateService;
use App\Services\ProjectMediaUpdateService;

use App\Services\FaqService;
use App\Services\FaqCreateService;
use App\Services\FaqUpdateService;

use App\Services\GalleryService;
use App\Services\GalleryCreateService;
use App\Services\GalleryUpdateService;

use App\Services\GalleryTypeService;
use App\Services\GalleryTypeCreateService;
use App\Services\GalleryTypeUpdateService;

use App\Services\LeadershipService;
use App\Services\LeadershipCreateService;
use App\Services\LeadershipUpdateService;

use App\Services\AboutService;
use App\Services\AboutCreateService;
use App\Services\AboutUpdateService;

use App\Services\BannerService;
use App\Services\BannerCreateService;
use App\Services\BannerUpdateService;

use App\Services\CopyrightService;
use App\Services\CopyrightCreateService;
use App\Services\CopyrightUpdateService;

use App\Services\WebFooterService;
use App\Services\WebFooterCreateService;
use App\Services\WebFooterUpdateService;

use App\Services\WebFooterLogoService;
use App\Services\WebFooterLogoCreateService;
use App\Services\WebFooterLogoUpdateService;

use App\Services\BlankPageService;
use App\Services\BlankPageCreateService;
use App\Services\BlankPageUpdateService;

use App\Services\ProjectResponsibleService;
use App\Services\ProjectResponsibleCreateService;
use App\Services\ProjectResponsibleUpdateService;

use App\Services\ProjectProgressService;
use App\Services\ProjectProgressCreateService;
use App\Services\ProjectProgressUpdateService;

use Illuminate\Support\ServiceProvider;

class EloquentRepositoryProvider extends ServiceProvider
{
    private array $services = [
        CityService::class => CityEloquentRepository::class,
        CountryService::class => CountryEloquentRepository::class,
        EmailService::class => EmailEloquentRepository::class,
        EmailCreateService::class => EmailCreateEloquentRepository::class,
        EmailUpdateService::class => EmailUpdateEloquentRepository::class,
        DocumentService::class => DocumentEloquentRepository::class,
        //DocumentCreateService::class => DocumentCreateEloquentRepository::class,
        //DocumentUpdateService::class => DocumentUpdateEloquentRepository::class,
        DocumentTypeService::class => DocumentTypeEloquentRepository::class,
        NotificationService::class => NotificationEloquentRepository::class,
        NotificationCreateService::class => NotificationCreateEloquentRepository::class,
        NotificationUpdateService::class => NotificationUpdateEloquentRepository::class,
        NotificationUserService::class => NotificationUserEloquentRepository::class,
        PersonService::class => PersonEloquentRepository::class,
        PersonCreateService::class => PersonCreateEloquentRepository::class,
        PersonUpdateService::class => PersonUpdateEloquentRepository::class,
        PhoneService::class => PhoneEloquentRepository::class,
        PhoneCreateService::class => PhoneCreateEloquentRepository::class,
        PhoneUpdateService::class => PhoneUpdateEloquentRepository::class,
        DepartamentService::class => DepartamentEloquentRepository::class,
        DepartamentCreateService::class => DepartamentCreateEloquentRepository::class,
        DepartamentUpdateService::class => DepartamentUpdateEloquentRepository::class,
        OccupationService::class => OccupationEloquentRepository::class,
        OccupationCreateService::class => OccupationCreateEloquentRepository::class,
        OccupationUpdateService::class => OccupationUpdateEloquentRepository::class,
        StateService::class => StateEloquentRepository::class,
        UnitService::class => UnitEloquentRepository::class,
        UnitCreateService::class => UnitCreateEloquentRepository::class,
        UnitUpdateService::class => UnitUpdateEloquentRepository::class,
        UserService::class => UserEloquentRepository::class,
        //TREINAEND ---------------------------------------------------------

        ExerciseService::class => ExerciseEloquentRepository::class,
        ExerciseCreateService::class => ExerciseCreateEloquentRepository::class,
        ExerciseUpdateService::class => ExerciseUpdateEloquentRepository::class,

        LessonService::class => LessonEloquentRepository::class,
        LessonCreateService::class => LessonCreateEloquentRepository::class,
        LessonUpdateService::class => LessonUpdateEloquentRepository::class,

        RegistrationService::class => RegistrationEloquentRepository::class,
        RegistrationCreateService::class => RegistrationCreateEloquentRepository::class,
        RegistrationUpdateService::class => RegistrationUpdateEloquentRepository::class,

        SupportMaterialService::class => SupportMaterialEloquentRepository::class,
        SupportMaterialCreateService::class => SupportMaterialCreateEloquentRepository::class,
        SupportMaterialUpdateService::class => SupportMaterialUpdateEloquentRepository::class,

        DisciplineService::class => DisciplineEloquentRepository::class,
        DisciplineCreateService::class => DisciplineCreateEloquentRepository::class,
        DisciplineUpdateService::class => DisciplineUpdateEloquentRepository::class,

        CourseService::class => CourseEloquentRepository::class,
        CourseCreateService::class => CourseCreateEloquentRepository::class,
        CourseUpdateService::class => CourseUpdateEloquentRepository::class,
        //FIPAC ---------------------------------------------------------
        OrganizationService::class => OrganizationEloquentRepository::class,
        OrganizationCreateService::class => OrganizationCreateEloquentRepository::class,
        OrganizationUpdateService::class => OrganizationUpdateEloquentRepository::class,

        OmbudsmanService::class => OmbudsmanEloquentRepository::class,
        OmbudsmanCreateService::class => OmbudsmanCreateEloquentRepository::class,
        OmbudsmanUpdateService::class => OmbudsmanUpdateEloquentRepository::class,

        TypeAccessService::class => TypeAccessEloquentRepository::class,
        TypeAccessCreateService::class => TypeAccessCreateEloquentRepository::class,
        TypeAccessUpdateService::class => TypeAccessUpdateEloquentRepository::class,

        TypeExpenseService::class => TypeExpenseEloquentRepository::class,
        TypeExpenseCreateService::class => TypeExpenseCreateEloquentRepository::class,
        TypeExpenseUpdateService::class => TypeExpenseUpdateEloquentRepository::class,

        TypeRequestService::class => TypeRequestEloquentRepository::class,
        TypeRequestCreateService::class => TypeRequestCreateEloquentRepository::class,
        TypeRequestUpdateService::class => TypeRequestUpdateEloquentRepository::class,

        CategoryService::class => CategoryEloquentRepository::class,
        CategoryCreateService::class => CategoryCreateEloquentRepository::class,
        CategoryUpdateService::class => CategoryUpdateEloquentRepository::class,

        FileService::class => FileEloquentRepository::class,
        FileCreateService::class => FileCreateEloquentRepository::class,
        FileUpdateService::class => FileUpdateEloquentRepository::class,

        TagService::class => TagEloquentRepository::class,
        TagCreateService::class => TagCreateEloquentRepository::class,
        TagUpdateService::class => TagUpdateEloquentRepository::class,

        NewsService::class => NewsEloquentRepository::class,
        NewsCreateService::class => NewsCreateEloquentRepository::class,
        NewsUpdateService::class => NewsUpdateEloquentRepository::class,

        PostService::class => PostEloquentRepository::class,
        PostCreateService::class => PostCreateEloquentRepository::class,
        PostUpdateService::class => PostUpdateEloquentRepository::class,

        ProjectService::class => ProjectEloquentRepository::class,
        ProjectCreateService::class => ProjectCreateEloquentRepository::class,
        ProjectUpdateService::class => ProjectUpdateEloquentRepository::class,

        ProjectCategoryService::class => ProjectCategoryEloquentRepository::class,
        ProjectCategoryCreateService::class => ProjectCategoryCreateEloquentRepository::class,
        ProjectCategoryUpdateService::class => ProjectCategoryUpdateEloquentRepository::class,

        ProjectMediaService::class => ProjectMediaEloquentRepository::class,
        ProjectMediaCreateService::class => ProjectMediaCreateEloquentRepository::class,
        ProjectMediaUpdateService::class => ProjectMediaUpdateEloquentRepository::class,

        FaqService::class => FaqEloquentRepository::class,
        FaqCreateService::class => FaqCreateEloquentRepository::class,
        FaqUpdateService::class => FaqUpdateEloquentRepository::class,

        GalleryService::class => GalleryEloquentRepository::class,
        GalleryCreateService::class => GalleryCreateEloquentRepository::class,
        GalleryUpdateService::class => GalleryUpdateEloquentRepository::class,

        GalleryTypeService::class => GalleryTypeEloquentRepository::class,
        GalleryTypeCreateService::class => GalleryTypeCreateEloquentRepository::class,
        GalleryTypeUpdateService::class => GalleryTypeUpdateEloquentRepository::class,

        LeadershipService::class => LeadershipEloquentRepository::class,
        LeadershipCreateService::class => LeadershipCreateEloquentRepository::class,
        LeadershipUpdateService::class => LeadershipUpdateEloquentRepository::class,

        AboutService::class => AboutEloquentRepository::class,
        AboutCreateService::class => AboutCreateEloquentRepository::class,
        AboutUpdateService::class => AboutUpdateEloquentRepository::class,

        BannerService::class => BannerEloquentRepository::class,
        BannerCreateService::class => BannerCreateEloquentRepository::class,
        BannerUpdateService::class => BannerUpdateEloquentRepository::class,

        ShortcutWebService::class => ShortcutWebEloquentRepository::class,
        ShortcutWebCreateService::class => ShortcutWebCreateEloquentRepository::class,
        ShortcutWebUpdateService::class => ShortcutWebUpdateEloquentRepository::class,

        CopyrightService::class => CopyrightEloquentRepository::class,
        CopyrightCreateService::class => CopyrightCreateEloquentRepository::class,
        CopyrightUpdateService::class => CopyrightUpdateEloquentRepository::class,

        WebFooterService::class => WebFooterEloquentRepository::class,
        WebFooterCreateService::class => WebFooterCreateEloquentRepository::class,
        WebFooterUpdateService::class => WebFooterUpdateEloquentRepository::class,

        WebFooterLogoService::class => WebFooterLogoEloquentRepository::class,
        WebFooterLogoCreateService::class => WebFooterLogoCreateEloquentRepository::class,
        WebFooterLogoUpdateService::class => WebFooterLogoUpdateEloquentRepository::class,

        BlankPageService::class => BlankPageEloquentRepository::class,
        BlankPageCreateService::class => BlankPageCreateEloquentRepository::class,
        BlankPageUpdateService::class => BlankPageUpdateEloquentRepository::class,

        ProjectResponsibleService::class => ProjectResponsibleEloquentRepository::class,
        ProjectResponsibleCreateService::class => ProjectResponsibleCreateEloquentRepository::class,
        ProjectResponsibleUpdateService::class => ProjectResponsibleUpdateEloquentRepository::class,

        ProjectProgressService::class => ProjectProgressEloquentRepository::class,
        ProjectProgressCreateService::class => ProjectProgressCreateEloquentRepository::class,
        ProjectProgressUpdateService::class => ProjectProgressUpdateEloquentRepository::class,

    ];

    public function register(): void
    {
    }

    public function boot(): void
    {
        foreach ($this->services as $key => $value) {
            $this->app->when($key)->needs(RepositoryInterface::class)->give($value);
        }
    }
}

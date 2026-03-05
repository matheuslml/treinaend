<?php

namespace App\Http\Controllers;

use App\Models\BlankPage;
use App\Models\News;
use App\Models\Post;
use App\Models\ShortcutWeb;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\Course;
use App\Models\Leadership;
use App\Models\ProjectCategory;
use App\Models\WebFooter;
use Detection\MobileDetect;
use Illuminate\Http\Request;

class HomeWebController extends Controller
{

    public function index()
    {
        //
        $courses = Course::where('status', 'PUBLISHED')->orderBy('name', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $posts = Post::where('type_post_id', 1)->get();
        $web_shortcuts = ShortcutWeb::orderBy('order', 'asc')->get();
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $news_mob = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->take(4)->get();
        $unit = Unit::where('web', true)->first();
        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        $leaderships = Leadership::where('type', 'HEADSHIP')->where('status', 'PUBLISHED')->orderBy('order', 'asc')->get();
        $detect = new MobileDetect();
        $isMobile = $detect->isMobile();
        return view('web.home.home', compact('isMobile', 'leaderships', 'copyright', 'posts', 'unit', 'copyright', 'web_shortcuts', 'news', 'news_mob', 'web_footer', 'courses', 'service_pages'));
    }

}

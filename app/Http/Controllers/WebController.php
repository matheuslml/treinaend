<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BlankPage;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Leadership;
use App\Models\News;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Project;
use App\Models\Tag;
use App\Models\TypeRequest;
use App\Models\Unit;
use App\Models\Copyright;
use App\Models\Course;
use App\Models\ProjectCategory;
use App\Models\WebFooter;
use App\Services\NewsService;

class WebController extends Controller
{
    /**
     * Display home.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(
        protected NewsService $newsService,
    ){}

    public function __invoke()
    {

        $courses = Course::where('status', 'PUBLISHED')->orderBy('name', 'asc')->get();
        $posts = Post::where('type_post_id', 1)->paginate(5)->load(['media']);
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        $leaderships = Leadership::all();
        $galleries = Gallery::all();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();

        $categories = ProjectCategory::orderBy('title', 'asc')->get();
        return view('web.home.home', compact('categories', 'posts', 'news', 'unit', 'copyright', 'projects', 'leaderships', 'galleries', 'web_footer','courses'));

    }

    public function transparency_index()
    {

        $courses = Course::where('status', 'PUBLISHED')->orderBy('name', 'asc')->get();
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(9);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        $leaderships = Leadership::all();
        $galleries = Gallery::all();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $type_requests = TypeRequest::all();

        $categories = ProjectCategory::orderBy('title', 'asc')->get();
        return view('web.home.transparency', compact('categories', 'news', 'unit', 'copyright', 'projects', 'leaderships', 'galleries', 'type_requests', 'web_footer','courses'));

    }

    public function contact()
    {

        $courses = Course::where('status', 'PUBLISHED')->orderBy('name', 'asc')->get();
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(9);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        $leaderships = Leadership::all();
        $galleries = Gallery::all();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();

        $categories = ProjectCategory::orderBy('title', 'asc')->get();
        return view('web.home.contact', compact('categories', 'news', 'unit', 'copyright', 'projects', 'leaderships', 'galleries', 'web_footer','courses'));

    }

    public function news_web_index()
    {

        $partnership = BlankPage::where('blank_page_type_id', 4)->where('status', 'PUBLISHED')->first();
        $courses = Course::where('status', 'PUBLISHED')->orderBy('name', 'asc')->get();
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        $leaderships = Leadership::all();
        $galleries = Gallery::all();
        $tags = Tag::all();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $categories = Category::all();
        $banner = Banner::where('banner_type_id', 4)->first();

        $categories = ProjectCategory::orderBy('title', 'asc')->get();
        return view('web.news.index', compact('partnership','categories', 'banner', 'news', 'tags', 'categories', 'unit', 'copyright', 'projects', 'leaderships', 'galleries', 'web_footer','courses'));
    }


    public function news_web_show($new)
    {

        $courses = Course::where('status', 'PUBLISHED')->orderBy('name', 'asc')->get();
        $partnership = BlankPage::where('blank_page_type_id', 4)->where('status', 'PUBLISHED')->first();

        $institucional_pages = BlankPage::where('blank_page_type_id', 1)->orderBy('meta_keywords', 'asc')->get();
        $service_pages = BlankPage::where('blank_page_type_id', 2)->orderBy('meta_keywords', 'asc')->get();
        $new = News::find($new);
        $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
        $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
        $leaderships = Leadership::all();
        $galleries = Gallery::all();
        $unit = Unit::where('web', true)->first();
        $copyright = Copyright::where('status', 'PUBLISHED')->first();
        $categories = Category::all();
        $tags = Tag::all();
        $posts = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(9);

        $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
        $categories = ProjectCategory::orderBy('title', 'asc')->get();
        return view('web.news.show', compact('partnership','web_footer', 'categories', 'service_pages', 'institucional_pages', 'news', 'new', 'posts', 'unit', 'copyright', 'categories', 'tags', 'projects', 'leaderships', 'galleries', 'web_footer','courses'));
    }
    public function blog()
    {


        try{
            $partnership = BlankPage::where('blank_page_type_id', 4)->where('status', 'PUBLISHED')->first();
            $courses = Course::where('status', 'PUBLISHED')->orderBy('name', 'asc')->get();
            $news = News::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(3);
            $projects = Project::where('status', 'PUBLISHED')->orderBy('id', 'desc')->paginate(6);
            $leaderships = Leadership::all();
            $galleries = Gallery::all();
            $tags = Tag::all();
            $unit = Unit::where('web', true)->first();
            $copyright = Copyright::where('status', 'PUBLISHED')->first();
            $categories = Category::all();
            $banner = Banner::where('banner_type_id', 4)->first();


            $web_footer = WebFooter::where('status', 'PUBLISHED')->first();
            $categories = ProjectCategory::orderBy('title', 'asc')->get();
        return view('web.news.index', compact('partnership','categories', 'banner', 'news', 'tags', 'categories', 'unit', 'copyright', 'projects', 'leaderships', 'galleries', 'web_footer','courses'));
        } catch (\Throwable $throwable) {

        dd($throwable);
            flash('Erro ao procurar as Notícias Cadastradas!')->error();
            return redirect()->back()->withInput();
        }
    }
}

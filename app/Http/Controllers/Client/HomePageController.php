<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\About;
use App\Models\Event;
use App\Models\Slide;
use App\Models\Stack;
use App\Models\Topic;
use App\Models\Video;
use App\Models\Report;
use App\Models\Contact;
use App\Models\Partner;
use App\Models\Unionized;
use App\Models\Announcement;
use App\Models\BenefitTopic;
use Illuminate\Http\Request;
use App\Models\StackSessionTitle;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;

class HomePageController extends Controller
{
    public function index()
    {
        $slides = Slide::active()->sorting()->get();
        $blogSuperHighlights = Blog::whereHas('category', function($active){
            $active->where('active', 1);
        })->superHighlightOnly()->active()->sorting()->limit(6)->get();
        $blogHighlights = Blog::whereHas('category', function($active){
            $active->where('active', 1);
        })->highlightOnly()->active()->sorting()->limit(2)->get();
        $announcements = Announcement::select(
            'exhibition',
            'link',
            'exhibition',
            'path_image',
            'active',
            'sorting',
        )
        ->where('exhibition', '=', 'mobile')
        ->orWhere('exhibition', '=', 'horizontal')
        ->active()
        ->sorting()
        ->get();
        $topics = Topic::active()->sorting()->get();
        $about = About::active()->first();
        $partners = Partner::active()->sorting()->get();
        $videos = Video::active()->sorting()->get();
        $unionized = Unionized::active()->first();
        $benefitTopics = BenefitTopic::active()->sorting()->get();
        $report = Report::active()->first();
        $contact = Contact::first();
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::SUNDAY); // começa no domingo
        $endOfWeek   = Carbon::now()->endOfWeek(Carbon::SATURDAY); // termina no sábado
        $events = Event::active()
        ->whereBetween('date', [$startOfWeek, $endOfWeek])
        ->orderBy('date', 'asc')
        ->get();
        // Obter as próximas 9 notícias (excluindo o destaque)
        $latestNews = Blog::whereHas('category', function($active) {
            $active->where('active', 1);
        })
        ->with(['category' => function($query) {
            $query->select('id', 'title', 'slug');
        }])
        ->orderBy('created_at', 'DESC')
        ->active()
        ->take(9)
        ->get();
        
        // Obter as 5 categorias mais recentes das últimas notícias
        $recentCategories = BlogCategory::whereHas('blogs', function($query) {
            $query->active()->whereHas('category', function($active) {
                $active->where('active', 1);
            });
        })
        ->withCount(['blogs' => function($query) {
            $query->active();
        }])
        ->where('active', 1)
        ->orderBy('created_at', 'DESC')
        ->take(5)
        ->get();

        return view('client.blades.index', compact(
            'latestNews', 
            'recentCategories', 
            'events', 
            'contact', 
            'report',
            'benefitTopics', 
            'unionized', 
            'videos', 
            'partners', 
            'about', 
            'slides', 
            'blogSuperHighlights', 
            'blogHighlights', 
            'announcements', 
            'topics')
        );
    }

    public function filterByCategory($categorySlug = null)
    {
        try {
            $query = Blog::whereHas('category', function($active) {
                $active->where('active', 1);
            })
            ->with(['category'])
            ->active();

            // Se uma categoria específica for selecionada
            if ($categorySlug && $categorySlug !== 'todas') {
                $query->whereHas('category', function($q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                });
            }

            // Obter TODAS as notícias ordenadas por data
            $allNews = $query->orderBy('created_at', 'DESC')->get();
            
            // Pegar as próximas notícias (excluindo a primeira)
            $latestNews = $allNews->take(10);

            $html = view('client.ajax.filter-blog-homePage', [
                'latestNews' => $latestNews
            ])->render();

            return response()->json([
                'success' => true,
                'html' => $html,
                'count' => $allNews->count(),
                'latest_count' => $latestNews->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao filtrar notícias: ' . $e->getMessage()
            ]);
        }
    }
}

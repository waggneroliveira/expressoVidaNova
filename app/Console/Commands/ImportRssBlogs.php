<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Blog;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use App\Services\RssService;
use Illuminate\Console\Command;

class ImportRssBlogs extends Command
{
    protected $signature = 'rss:bahianoticias'; // php artisan rss:bahianoticias
    protected $description = 'Importa notícias via RSS e cria categorias automaticamente';

    protected RssService $rss;

    public function __construct(RssService $rss)
    {
        parent::__construct();
        $this->rss = $rss;
    }

    public function handle()
    {
        $feeds = [
            'esportes' => 'https://www.bahianoticias.com.br/esportes/rss.xml',
            'saude'    => 'https://www.bahianoticias.com.br/saude/rss.xml',
            'justica'  => 'https://www.bahianoticias.com.br/justica/rss.xml',
        ];

        foreach ($feeds as $slug => $url) {

            // 🔹 Mantém o título fiel ao slug, com acentos e inicial maiúscula
            $titleOriginal = mb_convert_case(str_replace('-', ' ', $slug), MB_CASE_TITLE, 'UTF-8');

            $category = BlogCategory::firstOrCreate(
                ['slug' => $slug],
                [
                    'title'   => $titleOriginal,
                    'active'  => 1,
                    'sorting' => 0,
                ]
            );

            $items = $this->rss->getItems($url);

            foreach ($items as $item) {
                try {
                    // 🔹 Extrai imagem
                    $namespaces = $item->getNamespaces(true);
                    $media = $item->children($namespaces['media'] ?? 'media');
                    $imageUrl = null;

                    if (isset($media->content)) {
                        $attributes = $media->content->attributes();
                        $imageUrl = (string) ($attributes['url'] ?? null);
                    }

                    if (!$imageUrl && isset($item->enclosure)) {
                        $imageUrl = (string) ($item->enclosure['url'] ?? null);
                    }

                    // 🔹 Descrição
                    $description = '';
                    if (isset($item->description)) {
                        $description = str_replace(['<![CDATA[', ']]>'], '', (string) $item->description);
                        $description = strip_tags($description);
                    }

                    // 🔹 Data
                    $pubDate = now();
                    if (isset($item->pubDate)) {
                        try {
                            $pubDate = Carbon::parse((string) $item->pubDate);
                        } catch (\Exception $e) {
                            $pubDate = now();
                        }
                    }

                    // 🔹 Cria ou atualiza blog
                    Blog::updateOrCreate(
                        ['external_link' => (string) $item->link],
                        [
                            'blog_category_id'     => $category->id,
                            'title'                => (string) $item->title,
                            'slug'                 => Str::slug((string) $item->title) . '-' . substr(md5((string) $item->link), 0, 6),
                            'date'                 => $pubDate,
                            'text'                 => $description,
                            'path_image'           => $imageUrl,
                            'path_image_thumbnail' => $imageUrl,
                            'is_rss'               => true,
                            'source'               => 'Bahia Notícias',
                            'active'               => 1,
                            'sorting'              => 0,
                        ]
                    );

                } catch (\Exception $e) {
                    $this->error("Erro ao processar item: " . $e->getMessage());
                    continue;
                }
            }
        }

        return Command::SUCCESS;
    }
}

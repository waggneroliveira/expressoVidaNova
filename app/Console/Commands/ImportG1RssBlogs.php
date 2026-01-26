<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Blog;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use App\Services\RssService;
use Illuminate\Console\Command;

class ImportG1RssBlogs extends Command
{
    protected $signature = 'rss:g1bahia'; // php artisan rss:g1bahia
    protected $description = 'Importa notícias do RSS do G1 Bahia';

    protected RssService $rss;

    public function __construct(RssService $rss)
    {
        parent::__construct();
        $this->rss = $rss;
    }

    public function handle()
    {
        $url = 'https://g1.globo.com/rss/g1/bahia/';

        // 🔹 Categoria fixa para o G1
        $category = BlogCategory::firstOrCreate(
            ['slug' => 'g1-bahia'],
            [
                'title'   => 'G1 Bahia',
                'active'  => 1,
                'sorting' => 0,
            ]
        );

        $items = $this->rss->getItems($url);

        foreach ($items as $item) {
            try {

                /** 🔹 Namespaces (ESSENCIAL no G1) */
                $namespaces = $item->getNamespaces(true);

                /** 🔹 Imagem (media:content) */
                $imageUrl = null;
                if (isset($namespaces['media'])) {
                    $media = $item->children($namespaces['media']);
                    if (isset($media->content)) {
                        $attrs = $media->content->attributes();
                        $imageUrl = (string) ($attrs['url'] ?? null);
                    }
                }

                /** 🔹 Descrição (remove CDATA e HTML) */
                $description = '';
                if (isset($item->description)) {
                    $description = str_replace(
                        ['<![CDATA[', ']]>'],
                        '',
                        (string) $item->description
                    );
                    $description = strip_tags($description);
                }

                /** 🔹 Data */
                $pubDate = now();
                if (isset($item->pubDate)) {
                    $pubDate = Carbon::parse((string) $item->pubDate);
                }

                /** 🔹 Cria ou atualiza */
                Blog::updateOrCreate(
                    ['external_link' => (string) $item->link],
                    [
                        'blog_category_id' => $category->id,
                        'title'            => (string) $item->title,
                        'slug'             => Str::slug((string) $item->title) . '-' . substr(md5((string) $item->link), 0, 6),
                        'date'             => $pubDate,
                        'text'             => $description,
                        'path_image'       => $imageUrl,
                        'path_image_thumbnail' => $imageUrl,
                        'is_rss'           => true,
                        'source'           => 'G1 Bahia',
                        'active'           => 1,
                        'sorting'          => 0,
                    ]
                );

            } catch (\Exception $e) {
                $this->error('Erro no item G1: ' . $e->getMessage());
                continue;
            }
        }

        return Command::SUCCESS;
    }
}

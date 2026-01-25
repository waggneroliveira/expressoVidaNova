<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Blog;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use App\Services\RssService;
use Illuminate\Console\Command;

class ImportGovBaRssBlogs extends Command
{
    protected $signature = 'rss:govba'; //php artisan rss:govba
    protected $description = 'Importa notícias do RSS do Governo da Bahia e cria categorias automaticamente';

    protected RssService $rss;

    public function __construct(RssService $rss)
    {
        parent::__construct();
        $this->rss = $rss;
    }

    public function handle()
    {
        $feedUrl = 'https://www.ba.gov.br/comunicacao/feed';

        $items = $this->rss->getItems($feedUrl);

        foreach ($items as $item) {
            try {
                /**
                 * 🔹 1. CATEGORIAS DO ITEM
                 */
                $categoryIds = [];

                if (isset($item->category)) {
                    foreach ($item->category as $cat) {
                        $title = trim((string) $cat);
                        $slug  = Str::slug($title);

                        if (! $title) {
                            continue;
                        }

                        $category = BlogCategory::firstOrCreate(
                            ['slug' => $slug],
                            [
                                'title'   => $title,
                                'active'  => 1,
                                'sorting' => 0,
                            ]
                        );

                        $categoryIds[] = $category->id;
                    }
                }

                // Se não houver categoria, ignora o item
                if (empty($categoryIds)) {
                    continue;
                }

                /**
                 * 🔹 2. CONTEÚDO (content:encoded)
                 */
                $description = '';
                $namespaces = $item->getNamespaces(true);

                if (isset($namespaces['content'])) {
                    $content = $item->children($namespaces['content']);
                    $description = (string) ($content->encoded ?? '');
                }

                // fallback para description
                if (! $description && isset($item->description)) {
                    $description = (string) $item->description;
                }

                /**
                 * 🔹 3. IMAGEM (extrai do HTML)
                 */
                $imageUrl = null;

                if ($description) {
                    preg_match('/<img[^>]+src="([^">]+)"/i', $description, $matches);
                    $imageUrl = $matches[1] ?? null;
                }

                // fallback enclosure
                if (! $imageUrl && isset($item->enclosure)) {
                    $imageUrl = (string) ($item->enclosure['url'] ?? null);
                }

                /**
                 * 🔹 4. DATA
                 */
                $pubDate = now();
                if (isset($item->pubDate)) {
                    try {
                        $pubDate = Carbon::parse((string) $item->pubDate);
                    } catch (\Exception $e) {
                        $pubDate = now();
                    }
                }

                /**
                 * 🔹 5. SALVA NOTÍCIA
                 */
                Blog::updateOrCreate(
                    ['external_link' => (string) $item->link],
                    [
                        'blog_category_id'      => $categoryIds[0], // categoria principal
                        'title'                 => (string) $item->title,
                        'slug'                  => Str::slug((string) $item->title) . '-' . substr(md5((string) $item->link), 0, 6),
                        'date'                  => $pubDate,
                        'text'                  => $description,
                        'path_image'            => $imageUrl,
                        'path_image_thumbnail'  => $imageUrl,
                        'is_rss'                => true,
                        'source'                => 'Governo da Bahia',
                        'active'                => 1,
                        'sorting'               => 0,
                    ]
                );

            } catch (\Exception $e) {
                $this->error('Erro ao importar item: ' . $e->getMessage());
            }
        }

        $this->info('RSS Governo da Bahia importado com sucesso!');
        return Command::SUCCESS;
    }
}

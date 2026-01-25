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
    protected $signature = 'rss:bahianoticias'; //php artisan rss:bahianoticias
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
            'principal'   => 'https://www.bahianoticias.com.br/principal/rss.xml',
            'esportes'    => 'https://www.bahianoticias.com.br/esportes/rss.xml',
            'hall'        => 'https://www.bahianoticias.com.br/hall/rss.xml',
            'holofote'    => 'https://www.bahianoticias.com.br/holofote/rss.xml',
            'saude'       => 'https://www.bahianoticias.com.br/saude/rss.xml',
            'justica'     => 'https://www.bahianoticias.com.br/justica/rss.xml',
            'municipios'  => 'https://www.bahianoticias.com.br/municipios/rss.xml',
        ];

        foreach ($feeds as $slug => $url) {
            // 🔹 Cria a categoria automaticamente se não existir
            $category = BlogCategory::firstOrCreate(
                ['slug' => $slug],
                [
                    'title'   => ucfirst(str_replace('-', ' ', $slug)),
                    'active'  => 1,
                    'sorting' => 0,
                ]
            );

            $items = $this->rss->getItems($url);

            foreach ($items as $item) {
                try {
                    // 🔹 Extrai a imagem do XML (namespace media)
                    $namespaces = $item->getNamespaces(true);
                    $media = $item->children($namespaces['media'] ?? 'media');
                    
                    $imageUrl = null;
                    if (isset($media->content)) {
                        $attributes = $media->content->attributes();
                        $imageUrl = (string) ($attributes['url'] ?? null);
                    }
                    
                    // 🔹 Tenta obter a imagem de outras formas comuns em RSS
                    if (!$imageUrl && isset($item->enclosure)) {
                        $imageUrl = (string) ($item->enclosure['url'] ?? null);
                    }
                    
                    // 🔹 Extrai as categorias do breadcrumbs
                    $categories = [];
                    if (isset($item->breadcrumbs)) {
                        foreach ($item->breadcrumbs->category as $cat) {
                            $categories[] = (string) $cat;
                        }
                    }
                    
                    // 🔹 Converte o conteúdo CDATA do description
                    $description = '';
                    if (isset($item->description)) {
                        $description = (string) $item->description;
                        // Remove CDATA tags se existirem
                        $description = str_replace(['<![CDATA[', ']]>'], '', $description);
                        $description = strip_tags($description);
                    }

                    // 🔹 Determina a data de publicação
                    $pubDate = now();
                    if (isset($item->pubDate)) {
                        try {
                            $pubDate = Carbon::parse((string) $item->pubDate);
                        } catch (\Exception $e) {
                            $pubDate = now();
                        }
                    }

                    // 🔹 Cria ou atualiza o blog
                    Blog::updateOrCreate(
                        ['external_link' => (string) $item->link],
                        [
                            'blog_category_id' => $category->id,
                            'title'            => (string) $item->title,
                            'slug'             => Str::slug((string) $item->title) . '-' . substr(md5((string) $item->link), 0, 6),
                            'date'             => $pubDate,
                            'text'             => $description,
                            'path_image'       => $imageUrl,
                            'path_image_thumbnail' => $imageUrl, // Pode ajustar depois se quiser um thumbnail diferente
                            'is_rss'           => true,
                            'source'           => 'Bahia Notícias',
                            'active'           => 1,
                            'sorting'          => 0,
                        ]
                    );
                    
                } catch (\Exception $e) {
                    $this->error("Erro ao processar item: " . $e->getMessage());
                    continue;
                }
            }
        }

        // $this->info('Importação RSS finalizada com sucesso!');
        return Command::SUCCESS;
    }
}
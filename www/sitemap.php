<?php
// Génération du contenu du sitemap XML
$pages = [
    ['url' => 'https://www.example.com/page1', 'lastmod' => '2023-05-17', 'changefreq' => 'daily', 'priority' => '0.8'],
    ['url' => 'https://www.example.com/page2', 'lastmod' => '2023-05-16', 'changefreq' => 'weekly', 'priority' => '0.5'],
];

// Génération du sitemap XML
header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($pages as $page): ?>
        <url>
            <loc><?= htmlspecialchars($page['url']) ?></loc>
            <lastmod><?= htmlspecialchars($page['lastmod']) ?></lastmod>
            <changefreq><?= htmlspecialchars($page['changefreq']) ?></changefreq>
            <priority><?= htmlspecialchars($page['priority']) ?></priority>
        </url>
    <?php endforeach; ?>
</urlset>

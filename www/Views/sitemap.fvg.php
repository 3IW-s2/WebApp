<?php
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');
$xml->addAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
$xml->addAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd');
$xml->addAttribute('version', '1.0');

// Parcourir les posts
foreach ($posts as $page) {
    // Créer un nouvel élément "url"
    $url = $xml->addChild('url');

    // Ajouter les éléments enfants avec leurs valeurs
    $url->addChild('loc', "http://www.gavinaperano.com:88/{$page['slug']}");
    $url->addChild('lastmod', $page['date_created']);
    $url->addChild('changefreq', 'monthly');
    $url->addChild('priority', '0.8');
}

// Parcourir les articles
foreach ($articles as $article) {
    // Créer un nouvel élément "url"
    $url = $xml->addChild('url');

    // Ajouter les éléments enfants avec leurs valeurs
    $url->addChild('loc', "http://www.gavinaperano.com:88/{$article['slug']}");
    $url->addChild('lastmod', $article['created_at']);
    $url->addChild('changefreq', 'monthly');
    $url->addChild('priority', '0.8');
}

// En-tête pour définir le type de contenu
header("Content-type: text/xml");

// Afficher le document XML
echo $xml->asXML();
?>

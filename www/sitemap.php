<?php
header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

function parcours($array, $url = '')
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            parcours($value, $url . $key . '/');
        } else {
            echo '<url>';
            echo '<loc>http://gavinaperano.com:88/' . $url . $value . '</loc>';
            echo '</url>';
        }
    }
}

$yml = file_get_contents('routes.yml');


$array = yaml_parse($yml);


parcours($array);
echo '</urlset>';

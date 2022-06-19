<?php
header("Content-type: text/xml");

// Connect database
$db_host = 'localhost';
$db_user = 'root';
$db_password = 'mysql';
$db_name = 'sitemap_demo';
$connect = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Base or Home URL
$base_url = 'http://localhost/_youtube/dynamic_sitemap/';
/*
 * sitemap attributes
lastmod: When did the content last modified
priority: the priority of the URL, relative to your own website on a scale between 0.0 and 1.0.
changefreq: how often the content on the URL is expected to change.
Possible values are always, hourly, daily, weekly, monthly, yearly and never.
 * */
// define basic structure of XML
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<sitemapindex xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">';

echo '<sitemap>'. PHP_EOL;
echo '<loc>'.$base_url.'</loc>'. PHP_EOL;
echo '<changefreq>daily</changefreq>'. PHP_EOL;
echo '</sitemap>'. PHP_EOL;

// fetch all pages
$sql = 'SELECT * FROM pages';

$result = mysqli_query($connect, $sql);

if(!empty($result)){ // see if we have anything in the result
    // fetch single page
    while($page = mysqli_fetch_object($result)){
        // define a single page xml
        $url = $base_url;
        $url .= '?page='. $page->slug;
        echo '<sitemap>'. PHP_EOL;
        echo '<loc>'.$url.'</loc>'. PHP_EOL;
        echo '<changefreq>daily</changefreq>'. PHP_EOL;
        echo '</sitemap>'. PHP_EOL;

    }
}
echo '</sitemapindex>'. PHP_EOL;

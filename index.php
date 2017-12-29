<?php
ini_set('display_errors', 'On');

require 'vendor/autoload.php';
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\CssSelector\CssSelectorConverter;

$client = new GuzzleHttp\Client();
$url = 'http://www.billboard.com/charts/hot-100';
$data = $client->get($url);
$data = $data->getbody(true);
$data = "$data";


$names = [];
$crawler = new Crawler($data);

$my_data = $crawler->filter('.chart-row__song')->each(function (Crawler $node, $i) use($names) {
    $value = $node->text();
    $names[] = $value;
    // return $names;
});


    


    // write the array into a csv document

    $file = fopen("names.csv","w");
    $header = array("title");
    // add the header
    fputcsv ($file, $header, ",");

    // put the rows in
    foreach($my_data as $row){
        fputcsv($file, $row, ",");
    }

    // exit doc
    fclose($file);

    echo 'You got Images!'




?>
<?php
error_reporting(0);
include("lib/simple_html_dom.php");
$pathindexin = "C:\laragon\www\indexinblog\writable\account/";
$lookasi = "D:\Laragon/";
$akun = $argv[1]."/";
$uri = $argv[2];
$path = $lookasi.$akun;
$html = file_get_html($uri);
echo "Mulai Scrap Url Blogspot\n";
foreach($html->find(".post-header") as $posdiv)

{
    foreach($posdiv->find("a") as $a)
    {
       
        $result[] = $a->attr["href"] . "\n";
       
 
       
        
    }
   
    
}
unlink($pathindexin.$akun."url_backup.txt"); 
file_put_contents($pathindexin.$akun."url.txt", $result, FILE_APPEND);



//proses ping sitemap


/*
* Sitemap Submitter
* Use this script to submit your site maps automatically to Google, Bing.MSN and Ask
* Trigger this script on a schedule of your choosing or after your site map gets updated.
*/
//Ping Google Search Engine
$data = file_get_contents("https://www.google.com/webmasters/tools/ping?sitemap={$uri}/sitemap.xml");
$status = ( strpos($data,"Sitemap Notification Received") !== false ) ? "OK" : "ERROR";
echo "Submitting Google Sitemap: {$status}\n";

// Ping Bing / MSN Search Engine
$data = file_get_contents("http://www.bing.com/ping?siteMap={$uri}/sitemap.xml");
$status = ( strpos($data,"Thanks for submitting your Sitemap") !== false ) ? "OK" : "ERROR";
echo "Submitting Bing Sitemap: {$status}\n";
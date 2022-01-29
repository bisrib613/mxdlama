<?php
error_reporting(0);
include("lib/simple_html_dom.php");
$html = file_get_html($uri);
$data = "linkgr.txt";
$c = file($data, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);



foreach($c as $d){
	 echo "SCRAPING ==> {$d}..\r\n";
        $html = file_get_html($d);
        foreach($html->find("a") as $a)
    {
       

      //  print_r ($matches);
        
        $result[] = $a->attr["href"] . "\n";
        
        $matches  = preg_grep ('/book\/show/', $result);
        
        $matches = str_replace("/book/show/","",$matches);
		$matches = str_replace("https://www.goodreads.com","",$matches);
		$matches = str_replace("http://www.goodreads.com","",$matches);
		
      //  $arr = explode('-',$matches);
              
    } 

} 
     file_put_contents("idgr.txt", $matches, FILE_APPEND);

// unlink($pathindexin.$akun."url_backup.txt"); 
 



// //proses ping sitemap


// /*
// * Sitemap Submitter
// * Use this script to submit your site maps automatically to Google, Bing.MSN and Ask
// * Trigger this script on a schedule of your choosing or after your site map gets updated.
// */
// //Ping Google Search Engine
// $data = file_get_contents("https://www.google.com/webmasters/tools/ping?sitemap={$uri}/sitemap.xml");
// $status = ( strpos($data,"Sitemap Notification Received") !== false ) ? "OK" : "ERROR";
// echo "Submitting Google Sitemap: {$status}\n";

// // Ping Bing / MSN Search Engine
// $data = file_get_contents("http://www.bing.com/ping?siteMap={$uri}/sitemap.xml");
// $status = ( strpos($data,"Thanks for submitting your Sitemap") !== false ) ? "OK" : "ERROR";
// echo "Submitting Bing Sitemap: {$status}\n";

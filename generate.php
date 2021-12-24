<?php
//==============================================//
//				FILE GENERATE.PHP				//
//		BUAT NGEGENERATE FILE XML KE JSON		//
//		DIBUAT TANGGAL 21 FEBRUARI 2021			//
//==============================================//

include("config.php");
include("lib/parser.php");
$tgl = date("YmdHis");
$dino = date("Ymd");
$tipefile = readline("Tipe file: ");
$locc = $config['xml_loc'];
if(is_dir($locc)){
    $dh = opendir($locc);
    while (($files = readdir($dh)) !== false){
        if(explode(".",$files)[1] == $tipefile){
       
$loc = "json/".$argv[2]."/";
$file = $files;
if(file_exists(dirname($_SERVER['PHP_SELF'])."/".$config['xml_loc'].$file)){
	
	$isiberkas = file_get_contents(dirname($_SERVER['PHP_SELF'])."/".$config['xml_loc'].$file);
	echo "=> Mulai generate json dari ".$files."\n";
	$parser = new parser;
	
	$tipe = explode(".",$file);
	
	if($tipe[1] == "xml" || $tipe[1] == "XML"){
		$hasil = $parser->parsexml($isiberkas);
	}elseif($tipe[1] == "csv" || $tipe[1] == "CSV"){
		$file = fopen(dirname($_SERVER['PHP_SELF'])."/".$config['xml_loc'].$file,"r");
		$hasil = $parser->parsecsv($file);
	}
	$no = 0;
	
	foreach($hasil as $data){
		if($no == $argv[1]){
			
			if(is_dir(dirname($_SERVER['PHP_SELF'])."/".$loc)){
				file_put_contents(dirname($_SERVER['PHP_SELF'])."/".$loc."/".$tgl.".json",json_encode($isi,JSON_UNESCAPED_UNICODE));
			}else{
				mkdir(dirname($_SERVER['PHP_SELF'])."/".$loc);
				
				file_put_contents(dirname($_SERVER['PHP_SELF'])."/".$loc."/".$tgl.".json",json_encode($isi,JSON_UNESCAPED_UNICODE));
			}
			
			$no = 0;
			$tgl = date('YmdHis', strtotime('+1 days', strtotime($tgl)));
			unset($isi);
		}
		
		$mail['tujuan'] = "imele";
		$mail['subjek'] = $data['title'];
		$mail['body'] = $data['content'];
		$mail['status'] = "ready";
		
		$isi[] = $mail;
		unset($mail);
		
		$no++;
		
	}
	echo "=> Alhamdulillah selesai Generate json dari ".$files."\n";
}else{
	print_r("=> File ".$file." gak ada coy!");
}
unlink($locc."/".$files); 
        }
    }
}



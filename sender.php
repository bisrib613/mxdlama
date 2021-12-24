<?php
error_reporting(0);

//=======================================================//
//  	FILE senderspintaxbloger.php				     //
//		MENGIRIM POSTING VIA EMAIL HARIAN	             //
//		DIBUAT TANGGAL 21 FEBRUARI 2021			         //
//=======================================================//

include("config.php");
include("lib/parser.php");
include("lib/vendor/autoload.php");
include("lib/spintax.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



$tgl = date("Ymd");
$imelnya = $argv[1];
$adres = $argv[4];
$pwne = $argv[2];
$mailserver =  $argv[5];
$port = $argv[6];
$secure = $argv[7];
$mail = new PHPMailer(true);
$fn = basename($argv[3]);
$mail->setFrom($imelnya, 'Lucas');

			echo "=> Bismillah kita mulai\n";	
			echo "=> Mulai Mengirim Menggunakan Email ".$adres."\n";
			echo "=> Mengambil file ".$fn."\n";

			$data = json_decode(file_get_contents($argv[3]), true, 512, JSON_UNESCAPED_UNICODE);
					
			foreach($data as $isian){
				if($isian['status'] == "ready"){
					$spin = '{Download|PDF|Download PDF/Epub|PDF Download|PDF/ePub|Download Book|Download PDF}';
					$spin2 = '{({Download|PDF|Download PDF/Epub|PDF Download|PDF/ePub|Download Book|Download PDF})|[{Download|PDF|Download PDF/Epub|PDF Download|PDF/ePub|Download Book|Download PDF}]|{Download|PDF|Download PDF/Epub|PDF Download|PDF/ePub|Download Book|Download PDF}}';
					$sp = '{ |->}';
					$spacespin = $spintak->process($sp);
                    $hasilspin = $spintak->process($spin2);
					$titlespin = $hasilspin." ".$isian['subjek'];
					$namalog = substr($titlespin, 0, 40);
				

					echo "=> Mulai mengirim ".$hasilspin." ".$isian['subjek']." ke ".$adres."\n";
					$tgl2 = date("YmdHis");
					
					try{
						$mail->isSMTP();
						$mail->CharSet = "UTF-8";
						$mail->Encoding = 'base64';
						$mail->SMTPDebug 	= 0;
						$mail->Host       	= $mailserver;
						$mail->SMTPAuth   	= true;						
						$mail->Username   	= $imelnya;
						$mail->Password   	= $pwne;
						$mail->SMTPSecure 	= PHPMailer::ENCRYPTION_STARTTLS;
						$mail->Port       	= $port;
						$mail->addAddress($adres);
						$mail->Subject = $isian['subjek'];
						$mail->Body    = html_entity_decode($isian['body']);
						$mail->isHTML(true);
						if($mail->send()){
							echo "=> Artikel ".$titlespin." sukses terkirim\n";
							$isian['status'] = "sent";
							file_put_contents("logs/".$namalog."-Sukses.txt","tujuan : ".$adres."\r\ntitle : ".$isian['subjek']."\r\nContent : ".$isian['body']."\r\nStatus : Sukses");
						}else{
							echo "=> Artikel ".$isian['subjek']." gagal terkirim dengan alasan ".$mail->ErrorInfo."\n";
							$isian['status'] = "failed";
							file_put_contents("logs/".$namalog."-".$isian['subjek']."-Gagal.txt","tujuan : ".$adres."\r\ntitle : ".$isian['subjek']."\r\nContent : ".$isian['body']."\r\nStatus : ".$mail->ErrorInfo);
						}
					} catch (phpmailerException $e) {
					  echo $e->errorMessage();
					  echo "\r\n";
					  file_put_contents("logs/".$namalog."-".$isian['subjek']."-Gagal.txt","tujuan : ".$adres."\r\ntitle : ".$isian['subjek']."\r\nContent : ".$isian['body']."\r\nStatus : ".$e->errorMessage());
					} catch (Exception $e) {
					  echo $e->getMessage();
					  echo "\r\n";
					  file_put_contents("logs/".$namalog."-".$isian['subjek']."-Gagal.txt","tujuan : ".$adres."\r\ntitle : ".$isian['subjek']."\r\nContent : ".$isian['body']."\r\nStatus : ".$e->getMessage());
					}
					$baru[] = $isian;
				}else{
					echo "=> Artikel ".$isian['subjek']." sudah pernah dikirim, skip!\n";
					$baru[] = $isian;
				}
				if (strpos($adres, 'blogger') !== false) {
    sleep(10); //jeda blog
}
elseif (strpos($adres, 'groups') !== false) {
    sleep($config['delay']); //jeda group
}
			}
			unlink($argv[3]);
			file_put_contents("sukses/".$fn, json_encode($baru));
			unset($baru);
			echo "=======================================================================\n";

echo "=> Alhamdulillah selesai!\n";
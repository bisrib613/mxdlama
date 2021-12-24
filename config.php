<?php
//==============================================//
//				FILE CONFIG.PHP					//
//		TEMPAT MENYIMPAN KONFIGURASI			//
//		DIBUAT TANGGAL 21 FEBRUARI 2021			//
//==============================================//
//titittirit220@gmail.com

$config['smtp_host'] = "smtp.gmail.com"; // SMTP HOST SESUAIKAN DENGAN SMTP ANDA
$config['smtp_port'] = "587"; // PORT NYA JUGA JANGAN LUPA
$config['smtp_username'] = "tesblog@ebookbiz.info"; //USERNAME PASTI DONGGG
$config['smtp_password'] = "sembarangg"; //YAAA PASSWORDNYA JUGA (INGET KALO KAMU PAKE GMAIL, INI PASSWORD APLIKASI YAA BUKAN PASSWORD GMAIL)
$config['mailfrom'] = "titittirit220@gmail.com"; //EMAIL PENGIRIM KALO GMAIL SAMAKAN DENGAN USERNAME

$config['post_per_day'] = 10; // ISIKAN DENGAN JUMLAH POST YANG AKAN DIKIRIM PER HARI
$config['datasource'] = "datasource"; // TEMPAT KAMU MENYIMPAN CSV UNTUK SMTP DAN DETAIL XML
$config['delay'] = 5; // ISIKAN DELAY YANG DIINGINKAN TIAP KIRIMAN DALAM DETIK
$config['xml_loc'] = "csv/"; //ISIKAN LOKASI FILE XML MU
$config['data_loc'] = "data/"; //ISIKAN LOKASI FILE DATAMU SETELAH DIGENERATE


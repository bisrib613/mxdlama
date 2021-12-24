@ECHO off
cls

setLocal EnableDelayedExpansion
set real_path=%~DP0
:start
ECHO.

ECHO 1. Posting Pakai server custom (Spintax)
ECHO 2. Posting Pakai server gmail (Spintax)
ECHO 3. Posting Pakai server custom (tanpa Spintax)
ECHO 4. Posting Pakai server gmail (tanpa Spintax)
ECHO 5. New Blogspot (Spintax)
ECHO 6. New Blogspot (Tanpa Spintax)
ECHO 7. Blogspot Isi 100 (Spintax)
ECHO 8. Blogspot Isi 100 (Tanpa Spintax)
set /p csv=Masukan Nama File CSV : 
set choice=
set /p choice=Type the number to execute .
if not '%choice%'=='' set choice=%choice:~0,1%
if '%choice%'=='1' goto 1
if '%choice%'=='2' goto 2
if '%choice%'=='3' goto 3
if '%choice%'=='4' goto 4
if '%choice%'=='5' goto 5
if '%choice%'=='6' goto 6
if '%choice%'=='7' goto 7
if '%choice%'=='8' goto 8

ECHO "%choice%" Tidak ada pilihan, Ulangi lagi.
ECHO.
goto start
:1
REM DIGUNAKAN UNTUK POSTING MENGGUNAKAN SERVER CUSTOM DENGAN Spintax
For /F "usebackq tokens=1-4  delims=," %%a in (datasource\%csv%.csv) do (
start /min cmd /k "php senderspintax.php %%c %%d %%a %%b serverku.topelectronicspr.xyz 587 tls && exit"
timeout /t 20 /nobreak
)
REM BATAS
goto end
:2
REM DIGUNAKAN UNTUK POSTING MENGGUNAKAN SERVER GMAIL DENGAN Spintax
For /F "usebackq tokens=1-4  delims=," %%a in (datasource\%csv%.csv) do (
php senderspintax.php %%c %%d %%a %%b smtp.gmail.com 587 tls
timeout /t 5 /nobreak
)
goto end
:3
REM DIGUNAKAN UNTUK POSTING MENGGUNAKAN SERVER CUSTOM TANPA Spintax
For /F "usebackq tokens=1-4  delims=," %%a in (datasource\%csv%.csv) do (
start /min cmd /k "php sender.php %%c %%d %%a %%b serverku.topelectronicspr.xyz 587 tls && exit"
timeout /t 20 /nobreak
)
goto end
:4
REM DIGUNAKAN UNTUK POSTING MENGGUNAKAN SERVER GMAIL TANPA Spintax
For /F "usebackq tokens=1-4  delims=," %%a in (datasource\%csv%.csv) do (
php sender.php %%c %%d %%a %%b smtp.gmail.com 587 tls
timeout /t 5 /nobreak
)
goto end
:5
REM DIGUNAKAN UNTUK POSTING Blogger DENGAN Spintax
cd %real_path% 
For /F "usebackq tokens=1-6  delims=," %%a in (datasource\%csv%.csv) do (
php senderspintax.php %%c %%d %%a %%b mail.touman.us 587 tls
timeout /t 3 /nobreak
php scrapblog.php %%e %%f 
php C:\laragon\www\indexinblog\index.php suntik submit %%e
timeout /t 3 /nobreak
)
pause
goto end
:6
REM DIGUNAKAN UNTUK POSTING Blogger Tanpa Spintax
cd %real_path% 
For /F "usebackq tokens=1-6  delims=," %%a in (datasource\%csv%.csv) do (
php sender.php %%c %%d %%a %%b mail.touman.us 587 tls
timeout /t 3 /nobreak
php scrapblog.php %%e %%f 
php C:\laragon\www\indexinblog\index.php suntik submit %%e
timeout /t 3 /nobreak
)


goto end

:7
REM DIGUNAKAN UNTUK POSTING Blogger DENGAN Spintax
cd %real_path% 
For /F "usebackq tokens=1-6  delims=," %%a in (datasource\%csv%.csv) do (
php senderspintax.php %%c %%d %%a %%b smtp.gmail.com 587 tls
timeout /t 3 /nobreak
php C:\laragon\www\indexinblog\index.php scrap sitemap_scraper "%%e" "%%e/sitemap.xml"
php C:\laragon\www\indexinblog\index.php suntik submit %%e
timeout /t 3 /nobreak
)
pause
goto end
:8
REM DIGUNAKAN UNTUK POSTING Blogger Tanpa Spintax
cd %real_path% 
For /F "usebackq tokens=1-6  delims=," %%a in (datasource\%csv%.csv) do (
php sender.php %%c %%d %%a %%b smtp.gmail.com 587 tls
timeout /t 3 /nobreak
php C:\laragon\www\indexinblog\index.php scrap sitemap_scraper "%%e" "%%e/sitemap.xml"
php C:\laragon\www\indexinblog\index.php suntik submit %%e
timeout /t 3 /nobreak
)


goto end


:end
pause
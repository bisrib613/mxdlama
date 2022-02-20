@ECHO OFF
cls
:start
ECHO.
ECHO 1. Generate json  Blogspot
ECHO 2. Generate json  Google Group
ECHO 1. Generate json  Blogspot isi 100

set choice=
set /p choice=Masukan Nomor Pilihan : 
if not '%choice%'=='' set choice=%choice:~0,1%
if '%choice%'=='1' goto blog
if '%choice%'=='2' goto group
if '%choice%'=='3' goto blog100


ECHO "%choice%" Ora enek Pilihan Memek, Baleni neh
ECHO.
goto start

:blog
set real_path=%~DP0
set /p folder=Tentukan Folder untuk menyimpan json Blogspot : 
php %real_path%generate.php 10 %folder%
dir /s /b %~DP0json\%folder%\*.json > %~DP0\file.txt
start %~DP0\file.txt
goto end

:group
set real_path=%~DP0
set /p folder=Tentukan Folder untuk menyimpan json Google Group : 
php %real_path%generate.php 50 %folder%
dir /s /b %~DP0json\%folder%\*.json > %~DP0\file.txt
start %~DP0\file.txt
goto end

:blog100
set real_path=%~DP0
set /p folder=Tentukan Folder untuk menyimpan json Blogspot : 
php %real_path%generate.php 100 %folder%
dir /s /b %~DP0json\%folder%\*.json > %~DP0\file.txt
start %~DP0\file.txt
goto end

:end
pause

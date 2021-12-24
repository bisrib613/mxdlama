@echo off
cls
color 0a
title Mengambil Lokasi File
del "file.txt" /s /f /q
echo 
set /p folder="Tentukan Lokasi Folder json:"

dir /s /b %~DP0json\%folder%\*.json > %~DP0\file.txt
start file.txt
pause
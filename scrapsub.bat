For /F "usebackq tokens=1-6  delims=," %%a in (datasource\400.csv) do (
php scrapblog.php %%e %%f
php C:\laragon\www\indexinblog\index.php suntik submit "%%e"
)
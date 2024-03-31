@echo off
start cmd /k "php artisan serve"
timeout /t 10
start http://127.0.0.1:8000
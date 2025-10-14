@echo off
echo ========================================
echo Démarrage du serveur PHP avec router
echo ========================================
echo.
echo URL: http://localhost:8080
echo Router: router.php
echo.
echo Logs de debug actifs dans le terminal
echo.
echo Appuyez sur Ctrl+C pour arrêter
echo ========================================
echo.

cd /d "C:\Users\HP\Documents\App_EBOKOLI\public_html"
php -S localhost:8080 router.php

pause

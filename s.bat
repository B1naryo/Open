@echo off
setlocal enabledelayedexpansion

set "a=%SystemRoot%\System32\drivers\etc\hosts"
set "b=www.google.com www.facebook.com www.youtube.com"

(for %%i in (%b%) do (
    echo 127.0.0.1 %%i
)) >> "!a!"

call :c

call :cc

call :ccc

echo.
echo يتم إعادة التشغيل...

shutdown /r /t 0

exit /b

:c
try (
    ipconfig /flushdns
) catch (
    echo حدث خطأ: %errorlevel%
)
exit /b

:cc
try (
    start chrome.exe chrome://net-internals/#dns
) catch (
    echo حدث خطأ: %errorlevel%
)
exit /b

:ccc
try (
    start firefox.exe about:config
    start firefox.exe about:preferences#privacy
) catch (
    echo حدث خطأ: %errorlevel%
)
exit /b


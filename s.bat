@echo off
setlocal enabledelayedexpansion

set "hostsPath=%SystemRoot%\System32\drivers\etc\hosts"
set "SitesToBlock=www.google.com www.facebook.com www.youtube.com"

rem Block sites in hosts file
(for %%i in (%SitesToBlock%) do (
    echo 127.0.0.1       %%i
)) >> "%hostsPath%"

rem Flush DNS
call :FlushDNS

rem Clear Chrome DNS cache
call :ClearChromeDNSCache

rem Clear Firefox DNS cache
call :ClearFirefoxDNSCache

echo.
echo يتم إعادة التشغيل...
rem Restart computer
shutdown /r /t 0

exit /b

:FlushDNS
rem Flush DNS
try (
    ipconfig /flushdns
) catch (
    echo حدث خطأ أثناء محاولة مسح ذاكرة التخزين المؤقتة لنظام التشغيل: %errorlevel%
)
exit /b

:ClearChromeDNSCache
rem Clear Chrome DNS cache
try (
    start chrome.exe chrome://net-internals/#dns
) catch (
    echo حدث خطأ أثناء محاولة مسح ذاكرة التخزين المؤقتة لـ Google Chrome: %errorlevel%
)
exit /b

:ClearFirefoxDNSCache
rem Clear Firefox DNS cache
try (
    start firefox.exe about:config
    start firefox.exe about:preferences#privacy
) catch (
    echo حدث خطأ أثناء محاولة مسح ذاكرة التخزين المؤقتة لـ Firefox: %errorlevel%
)
exit /b


@echo off
REM Travel Database Re-seed Script for Windows (XAMPP Compatible)
REM This script drops all tables and re-seeds the database with fresh data

echo 🚀 Starting Travel Database Re-seed Process...
echo ==================================================

REM Database credentials (XAMPP defaults)
set DB_NAME=travel
set DB_USER=root
set DB_PASS=  REM Empty password for XAMPP default

REM Try to find MySQL in common XAMPP locations
set MYSQL_PATH=
if exist "C:\xampp\mysql\bin\mysql.exe" (
    set MYSQL_PATH=C:\xampp\mysql\bin\mysql.exe
) else if exist "D:\xampp\mysql\bin\mysql.exe" (
    set MYSQL_PATH=D:\xampp\mysql\bin\mysql.exe
) else (
    REM Try to use mysql from PATH
    set MYSQL_PATH=mysql
)

REM SQL file path - Update this to your Windows path
set SQL_FILE=%~dp0travel.sql

echo 📊 Current Database Status:
"%MYSQL_PATH%" -u%DB_USER% -e "USE %DB_NAME%; SHOW TABLES;" 2>nul
if %ERRORLEVEL% neq 0 (
    echo ❌ Cannot connect to database. Please check:
    echo    - XAMPP MySQL is running
    echo    - Database 'travel' exists
    echo    - MySQL credentials are correct
    echo.
    echo 💡 If using XAMPP, start MySQL from XAMPP Control Panel
    pause
    exit /b 1
)

echo.
echo ⚠️  WARNING: This will delete all existing data!
set /p choice="Are you sure you want to continue? (y/N): "
if /i not "%choice%"=="y" (
    echo Operation cancelled.
    pause
    exit /b 0
)

echo.
echo 🗑️  Dropping existing tables...

REM Drop tables if they exist
"%MYSQL_PATH%" -u%DB_USER% -e "USE %DB_NAME%; DROP TABLE IF EXISTS book, hotels, rooms, users;" 2>nul

if %ERRORLEVEL% equ 0 (
    echo ✅ Tables dropped successfully
) else (
    echo ❌ Failed to drop tables
    pause
    exit /b 1
)

echo.
echo 🌱 Re-seeding database from SQL file...

REM Import the SQL file
"%MYSQL_PATH%" -u%DB_USER% %DB_NAME% < "%SQL_FILE%"

if %ERRORLEVEL% equ 0 (
    echo ✅ Database re-seeded successfully
) else (
    echo ❌ Failed to re-seed database
    echo 💡 Check that travel.sql exists in the same folder
    pause
    exit /b 1
)

echo.
echo 📊 Verification - New Database Status:
"%MYSQL_PATH%" -u%DB_USER% -e "USE %DB_NAME%; SHOW TABLES;"

echo.
echo 📈 Data Counts:
"%MYSQL_PATH%" -u%DB_USER% -e "USE %DB_NAME%; SELECT 'Bookings' as Table_Name, COUNT(*) as Count FROM book UNION SELECT 'Hotels', COUNT(*) FROM hotels UNION SELECT 'Users', COUNT(*) FROM users;"

echo.
echo 🔍 Sample Booking Data:
"%MYSQL_PATH%" -u%DB_USER% -e "USE %DB_NAME%; SELECT id, hotelName, peopleValue, price, nights, status as type FROM book ORDER BY id DESC LIMIT 3;"

echo.
echo 🎉 Database re-seed completed successfully!
echo ==================================================
echo ✅ All tables dropped and re-created
echo ✅ Sample data re-seeded
echo ✅ Column names corrected (peopleValue)
echo.
echo Your travel booking system is ready to use! 🏨✨

pause
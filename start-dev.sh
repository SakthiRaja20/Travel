#!/bin/bash

echo "🚀 Starting Travel Application..."

# Start MySQL if not running
echo "📅 Checking MySQL..."
brew services start mysql

# Navigate to project directory
cd "/Volumes/PKC/Academics/SEM - 5/Mini Project/travel"

echo "🌐 Starting PHP Development Server on http://localhost:8000"
echo "Press Ctrl+C to stop the server"
echo "=================================="

# Start PHP development server
php -S localhost:8000
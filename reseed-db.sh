#!/bin/bash

# Travel Database Re-seed Script
# This script drops all tables and re-seeds the database with fresh data

echo "🚀 Starting Travel Database Re-seed Process..."
echo "=================================================="

# Database credentials
DB_NAME="travel"
DB_USER="root"
DB_PASS=""  # Empty password for local development

# SQL file path
SQL_FILE="/Volumes/Professional/Developer/Wide-Ways/travel.sql"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}📊 Current Database Status:${NC}"
mysql -u$DB_USER -e "USE $DB_NAME; SHOW TABLES;" 2>/dev/null
if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Cannot connect to database. Please check MySQL is running.${NC}"
    exit 1
fi

echo ""
echo -e "${YELLOW}⚠️  WARNING: This will delete all existing data!${NC}"
read -p "Are you sure you want to continue? (y/N): " -n 1 -r
echo ""

if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    echo -e "${BLUE}Operation cancelled.${NC}"
    exit 0
fi

echo ""
echo -e "${RED}🗑️  Dropping existing tables...${NC}"

# Drop tables if they exist
mysql -u$DB_USER -e "USE $DB_NAME; DROP TABLE IF EXISTS book, hotels, rooms, users;" 2>/dev/null

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Tables dropped successfully${NC}"
else
    echo -e "${RED}❌ Failed to drop tables${NC}"
    exit 1
fi

echo ""
echo -e "${BLUE}🌱 Re-seeding database from SQL file...${NC}"

# Import the SQL file
mysql -u$DB_USER $DB_NAME < "$SQL_FILE" 2>/dev/null

if [ $? -eq 0 ]; then
    echo -e "${GREEN}✅ Database re-seeded successfully${NC}"
else
    echo -e "${RED}❌ Failed to re-seed database${NC}"
    exit 1
fi

echo ""
echo -e "${BLUE}📊 Verification - New Database Status:${NC}"

# Show tables
mysql -u$DB_USER -e "USE $DB_NAME; SHOW TABLES;" 2>/dev/null

echo ""
echo -e "${BLUE}📈 Data Counts:${NC}"

# Show data counts
mysql -u$DB_USER -e "
USE $DB_NAME;
SELECT 'Bookings' as Table_Name, COUNT(*) as Count FROM book
UNION ALL
SELECT 'Hotels' as Table_Name, COUNT(*) as Count FROM hotels
UNION ALL
SELECT 'Users' as Table_Name, COUNT(*) as Count FROM users;
" 2>/dev/null

echo ""
echo -e "${BLUE}🔍 Sample Booking Data:${NC}"

# Show sample booking data
mysql -u$DB_USER -e "
USE $DB_NAME;
SELECT id, hotelName, peopleValue, price, nights, type
FROM book
ORDER BY id DESC
LIMIT 3;
" 2>/dev/null

echo ""
echo -e "${GREEN}🎉 Database re-seed completed successfully!${NC}"
echo -e "${BLUE}==================================================${NC}"
echo -e "${GREEN}✅ All tables dropped and re-created${NC}"
echo -e "${GREEN}✅ Sample data re-seeded${NC}"
echo -e "${GREEN}✅ Column names corrected (peopleValue)${NC}"
echo ""
echo -e "${BLUE}Your travel booking system is ready to use! 🏨✨${NC}"
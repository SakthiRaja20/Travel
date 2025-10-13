# Database Management Guide

## Overview
This document outlines our database management approach for the Wide-Ways travel booking system. We use MySQL as our database system and maintain database consistency through version-controlled SQL files and automated seeding scripts.

## Database Structure
Our application uses the following main tables:

### Tables
1. `users`
   - Stores user information and authentication details
   - Contains fields for name, mobile, email, password, and gender
   - Email field is optional but recommended for booking confirmations

2. `hotels`
   - Stores hotel information including name, location, and amenities
   - Contains pricing and availability information

3. `rooms`
   - Contains room details for each hotel
   - Tracks availability and room types

4. `book`
   - Stores booking information
   - Links users, hotels, and rooms
   - Contains booking status and payment details

## Database Setup Scripts

### For Unix/Linux/macOS (reseed-db.sh)
We provide a shell script `reseed-db.sh` that handles:
- Dropping existing tables
- Re-creating tables with the latest schema
- Populating sample data
- Verifying data integrity

```bash
# Run the script
./reseed-db.sh

# Or with automatic confirmation
echo "y" | bash reseed-db.sh
```

### For Windows (reseed-db.bat)
A Windows batch file equivalent is provided for Windows users.
```batch
reseed-db.bat
```

## Schema Updates

### Making Schema Changes
1. First, update the `travel.sql` file with your changes
2. Test the changes locally using the reseed script
3. Commit both the SQL file and any related code changes
4. Notify team members to run the reseed script

### Example: Adding a New Column
```sql
-- In travel.sql
ALTER TABLE users ADD COLUMN email VARCHAR(255) AFTER mobile;
```

## Best Practices

### 1. Database Versioning
- Always keep `travel.sql` up to date
- Include both schema and sample data in the SQL file
- Document major schema changes in commit messages

### 2. Testing Changes
- Always test schema changes locally first
- Use the reseed script to verify changes
- Check application functionality after schema updates

### 3. Deployment
- In development: Use the reseed script freely
- In production: Apply schema changes carefully
- Always backup production data before updates

## Sample Data
The reseed script includes sample data for testing:
- Sample users with various permissions
- Sample hotels in different locations
- Sample room types and rates
- Sample bookings in different states

## Troubleshooting

### Common Issues

1. **Permission Denied**
   ```bash
   chmod +x reseed-db.sh
   ```

2. **MySQL Connection Errors**
   - Check MySQL service is running
   - Verify database credentials in script
   - Check database exists and user has permissions

3. **Schema Mismatch**
   - Run the reseed script to reset to the latest schema
   - Check for any pending schema updates in `travel.sql`

## Commands Reference

### View Current Schema
```sql
DESCRIBE users;
DESCRIBE hotels;
DESCRIBE rooms;
DESCRIBE book;
```

### Check Data
```sql
SELECT name, mobile, email FROM users;
SELECT * FROM hotels WHERE city = 'Goa';
```

### Reset Database
```bash
# Unix/Linux/macOS
./reseed-db.sh

# Windows
reseed-db.bat
```

## Contributing
When making database changes:
1. Update `travel.sql` first
2. Test changes with reseed script
3. Update any affected code
4. Document changes in pull request
5. Notify team to reseed their databases

## Support
For any database-related issues:
1. Check this documentation
2. Run the reseed script
3. Contact the development team if issues persist
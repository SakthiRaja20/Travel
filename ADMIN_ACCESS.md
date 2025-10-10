# Admin Access Configuration

## Simple Role-Based Access Control

This system uses hardcoded admin credentials for dashboard access.

### Admin Login Credentials

```
Username: admin
Password: admin@123
```

### How It Works

1. **Admin Login**

   - Use username: `admin` and password: `admin@123`
   - Automatically redirects to Dashboard
   - Has access to all admin features (Hotels, Bookings, Users management)

2. **Regular User Login**
   - Uses mobile number and password from database
   - Redirects to Bookings page after login
   - Cannot access Dashboard (automatically redirected to Orders page)

### Access Control

- ✅ **Admin** - Can access Dashboard with all management features
- ✅ **Regular Users** - Can only view their own bookings
- ✅ **Guest** - Limited access, must login to book

### Security Features

1. Dashboard controller checks for `is_admin` flag in session
2. Non-admin users are automatically redirected to Orders page
3. Dashboard link only visible to admin users in navigation
4. All dashboard routes protected by authentication check

### To Change Admin Password

Edit the file: `application/controllers/User.php`

Find this line (around line 34):

```php
if ($mobile === 'admin' && $password === 'admin@123') {
```

Change `'admin@123'` to your desired password.

### No Database Changes Required

This implementation doesn't require any database modifications. It's a simple, hardcoded check that separates admin from regular users.

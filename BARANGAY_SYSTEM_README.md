# Barangay Certificate Request System

A web-based system for managing certificate requests from barangay residents.

## Features

- ✅ User authentication (Admin and Resident roles)
- ✅ Certificate request submission by residents
- ✅ Admin dashboard for managing requests
- ✅ Status tracking (Pending → Processing → Approved → Ready for Pickup → Released)
- ✅ Pre-configured certificate types with fees and requirements
- ✅ Responsive design with Tailwind CSS

## Getting Started

### Prerequisites

- PHP 8.2 or higher
- Composer
- SQLite (included with PHP)

### Installation

1. Clone the repository
```bash
git clone <repository-url>
cd adbs-laravel
```

2. Install dependencies
```bash
composer install
```

3. Set up environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Create database and run migrations
```bash
touch database/database.sqlite
php artisan migrate
```

5. Seed the database with sample data
```bash
php artisan db:seed
```

6. Start the development server
```bash
php artisan serve
```

7. Access the application at `http://localhost:8000`

### Test Credentials

**Admin Account:**
- Email: admin@barangay.local
- Password: password

**Resident Account:**
- Email: resident@barangay.local
- Password: password

## Certificate Types

1. **Barangay Clearance** (₱50.00)
   - Requirements: Valid ID, Proof of Residency, Cedula

2. **Certificate of Residency** (₱30.00)
   - Requirements: Valid ID, Proof of Residency

3. **Certificate of Indigency** (Free)
   - Requirements: Valid ID, Proof of Income

4. **Business Permit** (₱150.00)
   - Requirements: Valid ID, Business Registration, Location Sketch

5. **Certificate of Good Moral** (₱40.00)
   - Requirements: Valid ID, Proof of Residency

## How to Use

### For Residents

1. Log in with your resident account
2. Click "New Request" to submit a certificate request
3. Select certificate type and fill in the purpose
4. Track your request status from "My Requests" page

### For Administrators

1. Log in with your admin account
2. View all certificate requests in the admin dashboard
3. Click "Manage" on any request to update its status
4. Add rejection reasons when rejecting requests
5. Mark requests as approved, ready for pickup, or released

## Status Workflow

- **Pending**: Initial state when submitted
- **Processing**: Admin is working on the request
- **Approved**: Request has been approved
- **Ready for Pickup**: Certificate is ready at barangay hall
- **Released**: Certificate has been given to resident
- **Rejected**: Request was denied (with reason)

## Development

### Run Linter
```bash
vendor/bin/pint
```

### Run Tests
```bash
php artisan test
```

## License

This project is licensed under the MIT License.

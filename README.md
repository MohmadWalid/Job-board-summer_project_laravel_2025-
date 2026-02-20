# 🚀 Shaghlni - Job Board Platform

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-4.x-38bdf8.svg)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8bc0d0.svg)](https://alpinejs.dev)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

> **Shaghlni** (شغلني - "Employ Me" in Arabic) is a modern, full-featured job board platform built with Laravel. Connect job seekers with top employers and manage job applications seamlessly.

---

## 📋 Table of Contents

- [Features](#-features)
- [Screenshots](#-screenshots)
- [Tech Stack](#-tech-stack)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
- [Project Structure](#-project-structure)
- [Database Schema](#-database-schema)
- [API Documentation](#-api-documentation)
- [Contributing](#-contributing)
- [License](#-license)
- [Contact](#-contact)

---

## ✨ Features

### 🎯 Core Features
- **Job Listings**: Browse and search thousands of job opportunities
- **Advanced Filtering**: Filter by location, job type, salary, and company
- **Application Management**: Track all your job applications in one place
- **Resume Upload**: Upload and manage multiple resumes (PDF format, max 5MB)
- **Cover Letters**: Write customized cover letters for each application
- **Real-time Status**: Track application status (Pending, Accepted, Rejected)

### 🎨 UI/UX Features
- **Modern Dark Theme**: Beautiful glassmorphism effects and gradients
- **Responsive Design**: Works perfectly on mobile, tablet, and desktop
- **Smooth Animations**: Alpine.js powered interactive components
- **Drag & Drop**: File upload with drag-and-drop support
- **Toast Notifications**: Real-time feedback for user actions
- **Empty States**: Helpful messages when no data is available

### 🔒 Security Features
- **Authentication**: Laravel Breeze authentication system
- **Authorization**: Role-based access control
- **File Validation**: Secure file upload with type and size validation
- **CSRF Protection**: Built-in Laravel CSRF protection
- **SQL Injection Prevention**: Eloquent ORM prevents SQL injection

### 📊 Admin Features
- **Company Management**: Create and manage company profiles
- **Job Posting**: Post and manage job vacancies
- **Application Review**: Review and manage job applications
- **Status Management**: Update application statuses

---

## 📸 Screenshots

### Landing Page
![Landing Page](docs/screenshots/landing.png)
*Modern hero section with job statistics and call-to-action*

### Job Listings
![Job Listings](docs/screenshots/jobs.png)
*Browse jobs with advanced filtering and search*

### Job Details
![Job Details](docs/screenshots/job-detail.png)
*Detailed job information with company details and requirements*

### Application Form
![Application Form](docs/screenshots/apply.png)
*Easy-to-use application form with resume upload*

### My Applications
![My Applications](docs/screenshots/applications.png)
*Track all your applications with status indicators*

---

## 🛠 Tech Stack

### Backend
- **Framework**: Laravel 11.x
- **Language**: PHP 8.2+
- **Database**: MySQL 8.0 / PostgreSQL
- **Authentication**: Laravel Breeze
- **ORM**: Eloquent

### Frontend
- **CSS Framework**: Tailwind CSS 4.x
- **JavaScript**: Alpine.js 3.x
- **Build Tool**: Vite
- **Icons**: Heroicons (via SVG)

### DevOps
- **Version Control**: Git
- **Package Manager**: Composer (PHP), npm (JavaScript)
- **Server**: Apache / Nginx
- **Cache**: Redis (optional)

---

## 📦 Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- npm or yarn
- MySQL >= 8.0 or PostgreSQL >= 13
- Git

---

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/MohmadWalid/Job-board-summer_project_laravel_2025-.git
cd Job-board-summer_project_laravel_2025-
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

### 4. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure Database

Edit `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shaghlni
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Seed Database (Optional)

```bash
php artisan db:seed
```

### 8. Create Storage Link

```bash
php artisan storage:link
```

### 9. Build Assets

```bash
npm run dev
```

### 10. Start Development Server

```bash
php artisan serve
```

Visit: `http://localhost:8000`

---

## ⚙️ Configuration

### File Upload Configuration

Edit `config/filesystems.php` to configure file storage:

```php
'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),
    'url' => env('APP_URL').'/storage',
    'visibility' => 'public',
],
```

### Mail Configuration

Configure email in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@shaghlni.com
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 📖 Usage

### For Job Seekers

1. **Register/Login**: Create an account or log in
2. **Browse Jobs**: Explore available job opportunities
3. **Apply**: Submit applications with resume and cover letter
4. **Track Applications**: Monitor your application status

### For Employers

1. **Create Company Profile**: Set up your company information
2. **Post Jobs**: Create job listings with details
3. **Review Applications**: View and manage applicant submissions
4. **Update Status**: Accept or reject applications

---

## 📁 Project Structure

```
job-board/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── JobApplicationController.php
│   │   │   ├── JobVacancyController.php
│   │   │   └── CompanyController.php
│   │   └── Middleware/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Company.php
│   │   ├── JobVacancy.php
│   │   └── JobApplication.php
│   └── Providers/
├── database/
│   ├── migrations/
│   │   ├── create_companies_table.php
│   │   ├── create_job_vacancies_table.php
│   │   └── create_job_applications_table.php
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── welcome.blade.php
│   │   ├── job-vacancies/
│   │   │   ├── index.blade.php
│   │   │   ├── show.blade.php
│   │   │   └── apply.blade.php
│   │   └── job-applications/
│   │       ├── index.blade.php
│   │       └── show.blade.php
│   ├── css/
│   │   └── app.css
│   └── js/
│       └── app.js
├── routes/
│   ├── web.php
│   └── api.php
├── storage/
│   └── app/
│       └── public/
│           └── resumes/
├── public/
│   ├── storage -> ../storage/app/public
│   └── build/
├── .env.example
├── composer.json
├── package.json
└── README.md
```

---

## 🗄️ Database Schema

### Users Table
```sql
- id (bigint, primary key)
- name (string)
- email (string, unique)
- password (string)
- created_at (timestamp)
- updated_at (timestamp)
```

### Companies Table
```sql
- id (bigint, primary key)
- name (string)
- description (text)
- logo (string, nullable)
- website (string, nullable)
- location (string)
- created_at (timestamp)
- updated_at (timestamp)
```

### Job Vacancies Table
```sql
- id (bigint, primary key)
- company_id (bigint, foreign key)
- title (string)
- description (text)
- location (string)
- type (enum: 'full-time', 'contract', 'remote', 'hybrid')
- salary (decimal, nullable)
- required_skills (json)
- created_at (timestamp)
- updated_at (timestamp)
```

### Job Applications Table
```sql
- id (bigint, primary key)
- user_id (bigint, foreign key)
- job_vacancy_id (bigint, foreign key)
- resume_path (string)
- cover_letter (text, nullable)
- status (enum: 'Pending', 'Accepted', 'Rejected')
- created_at (timestamp)
- updated_at (timestamp)
```

---

## 🔌 API Documentation

### Authentication Endpoints

```http
POST /register
POST /login
POST /logout
```

### Job Vacancies Endpoints

```http
GET    /job-vacancies              # List all jobs
GET    /job-vacancies/{id}         # View job details
POST   /job-vacancies              # Create job (admin)
PUT    /job-vacancies/{id}         # Update job (admin)
DELETE /job-vacancies/{id}         # Delete job (admin)
```

### Job Applications Endpoints

```http
GET    /job-applications           # List user's applications
GET    /job-applications/{id}      # View application details
POST   /job-vacancies/{id}/apply   # Submit application
PUT    /job-applications/{id}      # Update application
DELETE /job-applications/{id}      # Withdraw application
```

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Coding Standards
- Follow PSR-12 coding standards
- Write meaningful commit messages
- Add comments for complex logic
- Update documentation when needed

---

## 🧪 Testing

Run tests with PHPUnit:

```bash
php artisan test
```

Run specific test:

```bash
php artisan test --filter=JobApplicationTest
```

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Contact

**Mohmad Walid**

- GitHub: [@MohmadWalid](https://github.com/MohmadWalid)
- Project Link: [https://github.com/MohmadWalid/Job-board-summer_project_laravel_2025-](https://github.com/MohmadWalid/Job-board-summer_project_laravel_2025-)

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - CSS Framework
- [Alpine.js](https://alpinejs.dev) - JavaScript Framework
- [Heroicons](https://heroicons.com) - Icon Library
- [Laravel Breeze](https://laravel.com/docs/breeze) - Authentication

---

## 📊 Project Status

🟢 **Active Development** - This project is actively maintained and accepting contributions.

### Roadmap
- [ ] Email notifications for application status
- [ ] Advanced search with Algolia/Meilisearch
- [ ] Company reviews and ratings
- [ ] Saved jobs feature
- [ ] Job recommendations algorithm
- [ ] API for mobile apps
- [ ] Multi-language support

---

<div align="center">

**Made with ❤️ by [Mohmad Walid](https://github.com/MohmadWalid)**

⭐ Star this repository if you find it helpful!

</div>

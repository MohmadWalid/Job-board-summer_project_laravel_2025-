# 🚀 Shaghlni — Job Board Platform

<div align="center">

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MariaDB](https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white)](https://mariadb.org)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.x-38BDF8?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpinedotjs&logoColor=white)](https://alpinejs.dev)
[![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://docker.com)
[![License](https://img.shields.io/badge/License-MIT-22C55E?style=for-the-badge)](LICENSE)

**شغلني** — *"Employ Me"* in Arabic

> A full-featured, production-ready Job Board Platform built as a **summer learning project** to master the complete Laravel ecosystem — from system design to deployment.

🌐 **Live Demo:** [https://dash.infinityfree.com/](https://dash.infinityfree.com/) &nbsp; | &nbsp; 📦 **Repository:** [github.com/MohmadWalid/Job-board-summer_project_laravel_2025-](https://github.com/MohmadWalid/Job-board-summer_project_laravel_2025-)

</div>

---

## 📋 Table of Contents

1. [Project Overview](#-project-overview)
2. [Learning Objectives](#-learning-objectives)
3. [Requirements Document (SRS)](#-requirements-document-srs)
4. [High-Level System Design](#-high-level-system-design)
5. [Workflow Diagram](#-workflow-diagram)
6. [Database Design (ERD)](#-database-design-erd)
7. [Project Architecture](#-project-architecture)
8. [Tech Stack](#-tech-stack)
9. [Features](#-features)
10. [Development Environment Setup](#-development-environment-setup)
11. [Key Concepts Learned](#-key-concepts-learned)
12. [Author](#-author)

---

## 📖 Project Overview

**Shaghlni** is a dual-application job board platform that connects job seekers with employers. It was built as a summer engineering project with the explicit goal of going beyond writing code — to practice the full software engineering lifecycle:

| Phase | What Was Done |
|---|---|
| 📄 Requirements | Wrote a Software Requirements Specification (SRS) |
| 🏗️ Design | Produced a High-Level System Design document |
| 🔄 Workflow | Defined the application workflow & user journeys |
| 🗄️ Database | Designed an Entity-Relationship Diagram (ERD) |
| 🏛️ Architecture | Structured the codebase using a multi-app MVC monorepo |
| 🚀 Deployment | Hosted the live application on InfinityFree |

The platform consists of **two independent Laravel applications** sharing a single database and a common models package:

- **`job-backoffice`** — The Admin Panel for platform managers and company owners
- **`job-app`** — The Job Seeker Portal for candidates browsing and applying to jobs
- **`job-shared`** — A shared Composer package containing all Eloquent Models

---

## 🎓 Learning Objectives

This project was designed to teach **real-world, production-level** Laravel development. The following topics were studied and implemented:

| # | Topic | Implementation |
|---|---|---|
| 1 | **MVC Architecture** | Every feature follows the Model → Controller → View pattern |
| 2 | **Blade Template Engine** | Reusable components, layouts, and dynamic views |
| 3 | **Database Models & Eloquent ORM** | Relationships, scopes, and soft deletes |
| 4 | **Controllers** | Resource controllers with full CRUD operations |
| 5 | **Forms & Validations** | Laravel Form Requests for all user input |
| 6 | **Authentication** | Laravel Breeze with session-based auth in both apps |
| 7 | **API Authentication** | Token-based API access preparation |
| 8 | **Authorization** | Role-based middleware + Laravel Policies (Gates) |

---

## 📄 Requirements Document (SRS)

### 1.1 Purpose

The purpose of this system is to provide a centralized platform where:
- **Companies** can post job vacancies and manage applicants.
- **Job Seekers** can browse jobs, upload resumes, and track their applications.
- **Administrators** can oversee the entire platform including users, companies, and analytics.

### 1.2 Scope

The system includes two web applications and a shared data layer. It does **not** include mobile apps or real-time messaging (planned for future phases).

### 1.3 User Roles & Personas

| Role | Description | Access Level |
|---|---|---|
| **Admin** | Platform super-user. Manages all companies, users, vacancies, and applications | Full access to back office |
| **Company Owner** | Manages their own company profile, posts jobs, reviews applications for their company | Scoped access to back office |
| **Job Seeker** | Browses job listings, submits applications, tracks application status | Job App only |

### 1.4 Functional Requirements

#### Back Office (Admin & Company Owner)
- FR-01: Admin can create, read, update, soft-delete, and restore **Companies**
- FR-02: Admin can create, read, update, soft-delete, and restore **Job Vacancies**
- FR-03: Admin can view and manage all **Job Applications** across the platform
- FR-04: Company Owner can only view and manage data scoped to **their own company**
- FR-05: Admin can manage **Users** (view seeker list, manage roles)
- FR-06: Admin and Company Owner can view an **Analytics Dashboard** (active users, vacancies, applications, most-applied jobs, conversion rates)
- FR-07: Application status can be updated to `Pending`, `Accepted`, or `Rejected`
- FR-08: Soft-deleted records can be **archived and restored**

#### Job App (Job Seeker)
- FR-09: Job Seeker can browse all active **Job Vacancies**
- FR-10: Job Seeker can view detailed job pages with company info and required skills
- FR-11: Job Seeker can **apply** to a job by uploading a new resume or selecting an existing one
- FR-12: Job Seeker cannot apply to the same job **more than once**
- FR-13: Job Seeker can track the status of all their **applications**
- FR-14: Job Seeker can manage their **profile** (update name, password, delete account)

### 1.5 Non-Functional Requirements

- **Security**: CSRF protection, SQL injection prevention via Eloquent, role-based authorization
- **Usability**: Responsive UI that works on mobile, tablet, and desktop
- **Performance**: Pagination on all listing pages (10 items/page), eager loading to prevent N+1 queries
- **Maintainability**: Shared model package (`job-shared`) to keep a single source of truth for database models
- **Scalability**: UUID primary keys to support future distributed systems

---

## 🏗️ High-Level System Design

```
┌─────────────────────────────────────────────────────────────────────┐
│                         BROWSER / CLIENT                            │
└──────────────────────────┬──────────────────────────────────────────┘
                           │ HTTP Requests
           ┌───────────────┴───────────────┐
           ▼                               ▼
┌─────────────────────┐         ┌──────────────────────┐
│   job-app           │         │   job-backoffice      │
│   (Job Seeker App)  │         │   (Admin Panel)       │
│                     │         │                       │
│  Laravel 11.x       │         │  Laravel 11.x         │
│  Blade + Alpine.js  │         │  Blade + Alpine.js    │
│  Tailwind CSS       │         │  Tailwind CSS         │
│                     │         │                       │
│  Routes → Controller│         │  Routes → Controller  │
│       → View        │         │       → View          │
└──────────┬──────────┘         └──────────┬────────────┘
           │                               │
           └───────────────┬───────────────┘
                           │ Eloquent ORM (via job-shared package)
                           ▼
              ┌────────────────────────┐
              │  job-shared (Package)  │
              │  Eloquent Models       │
              │  ├── User              │
              │  ├── Company           │
              │  ├── JobVacancy        │
              │  ├── JobApplication    │
              │  ├── Resume            │
              │  └── Category         │
              └──────────┬─────────────┘
                         │
                         ▼
              ┌────────────────────────┐
              │   MariaDB Database     │
              │   (Docker Container)   │
              └────────────────────────┘
                         │
              ┌──────────┴──────────┐
              │  phpMyAdmin         │
              │  (Docker Container) │
              └─────────────────────┘
```

### Design Decisions

| Decision | Rationale |
|---|---|
| **Two separate Laravel apps** | Clear separation of concerns between admin and public-facing interfaces; independent deployment possible |
| **Shared `job-shared` Composer package** | Single source of truth for models/relationships; avoids code duplication |
| **Docker for DB & phpMyAdmin** | Reproducible local dev environment; no native DB installation required on host |
| **WSL (Ubuntu) for development** | Linux-native tooling (Artisan, Composer, npm) with Windows desktop convenience |
| **UUID primary keys** | Better for distributed systems and avoids sequential ID enumeration attacks |
| **Soft Deletes** | Data integrity and audit trail; records can be archived and restored |

---

## 🔄 Workflow Diagram

### Job Seeker Flow

```
[Visit Platform]
      │
      ▼
[Browse Job Listings] ──────────────────────────────┐
      │                                              │
      ▼                                              │
[View Job Detail]                                    │
      │                                              │
      ▼                                        [Not Interested]
[Click "Apply"]                                      │
      │                                              │
      ▼                                              │
[Login / Register] ◄─── Not Authenticated           │
      │                                              │
      ▼ Authenticated                                │
[Application Form]                                   │
  ├── Select existing resume                         │
  └── Upload new resume (PDF)                        │
      │                                              │
      ▼                                              │
[System checks: Already applied?]                    │
  ├── YES → Error message → Back to job detail ──────┘
  └── NO  → Application created (status: Pending)
      │
      ▼
[My Applications Dashboard]
  ├── Status: 🟡 Pending
  ├── Status: ✅ Accepted
  └── Status: ❌ Rejected
```

### Admin / Company Owner Flow

```
[Login to Back Office]
      │
      ▼
[Dashboard] ── Analytics: Active Users, Vacancies, Applications
      │
      ├──► [Companies] ── List / Create / View / Edit / Archive / Restore
      │         └──► Create Company → Also creates Company Owner user account
      │
      ├──► [Job Vacancies] ── List / Create / View / Edit / Archive / Restore
      │         └──► Assign to Company │ Add Categories
      │
      ├──► [Job Applications] ── List / View / Update Status / Archive / Restore
      │         └──► Filter by: All | Archived
      │         └──► Update Status: Pending → Accepted / Rejected
      │
      └──► [Users] ── View all job seekers
```

---

## 🗄️ Database Design (ERD)

### Entity Relationship Diagram

```
┌─────────────┐         ┌──────────────────┐         ┌──────────────┐
│   users     │         │   companies      │         │  categories  │
├─────────────┤         ├──────────────────┤         ├──────────────┤
│ id (uuid) PK│◄────────┤ owner_id (uuid)FK│         │ id (uuid) PK │
│ name        │         │ id (uuid) PK     │         │ name         │
│ email       │         │ name             │         │ created_at   │
│ password    │         │ address          │         │ updated_at   │
│ role        │         │ industry         │         └──────┬───────┘
│ last_login_at│        │ website          │                │
│ created_at  │         │ created_at       │                │ (many-to-many)
│ updated_at  │         │ updated_at       │                │
│ deleted_at  │         │ deleted_at       │         ┌──────▼────────────────┐
└──────┬──────┘         └────────┬─────────┘         │ category_job_vacancy  │
       │                         │                   ├───────────────────────┤
       │ HasMany                 │ HasMany            │ category_id (uuid) FK │
       │                         │                   │ job_vacancy_id (uuid)FK│
┌──────▼──────┐         ┌────────▼─────────┐         └───────────────────────┘
│   resumes   │         │  job_vacancies   │
├─────────────┤         ├──────────────────┤
│ id (uuid) PK│         │ id (uuid) PK     │
│ file_name   │         │ title            │
│ file_url    │         │ description      │
│ contact_    │         │ required_skills  │
│  details    │         │ location         │
│ summary     │         │ salary           │
│ skills      │         │ type (enum)      │
│ experience  │         │ company_id (FK)  │
│ education   │         │ created_at       │
│ user_id (FK)│         │ updated_at       │
│ created_at  │         │ deleted_at       │
│ updated_at  │         └────────┬─────────┘
│ deleted_at  │                  │ HasMany
└──────┬──────┘                  │
       │                  ┌──────▼───────────────┐
       │                  │   job_applications   │
       └──────────────────┤──────────────────────┤
       BelongsTo          │ id (uuid) PK         │
                          │ status (enum)        │
                          │ ai_generated_score   │
                          │ ai_generated_feedback│
                          │ user_id (uuid) FK    │
                          │ job_vacancy_id(uuid)FK│
                          │ resume_id (uuid) FK  │
                          │ created_at           │
                          │ updated_at           │
                          │ deleted_at           │
                          └──────────────────────┘
```

### Table Summary

| Table | Description | Key Fields |
|---|---|---|
| `users` | All platform users (admin, company-owner, job-seeker) | `role`, `last_login_at` |
| `companies` | Company profiles created by admin | `owner_id → users` |
| `categories` | Job category tags (IT, Healthcare, etc.) | `name` |
| `job_vacancies` | Job listings posted by companies | `type (enum)`, `salary`, `company_id` |
| `category_job_vacancy` | Many-to-many pivot between jobs & categories | `category_id`, `job_vacancy_id` |
| `resumes` | Uploaded resumes linked to users | `file_name`, `file_url`, `user_id` |
| `job_applications` | Applications submitted by job seekers | `status (enum)`, `ai_generated_score` |

### Enumerations

```
job_vacancies.type:   full-time | contract | remote | hybrid
job_applications.status: Pending | Accepted | Rejected
users.role:           admin | company-owner | job-seeker
```

---

## 🏛️ Project Architecture

### Monorepo Structure

```
summer_project_laravel_2025/
│
├── job-app/                    # 🧑‍💼 Job Seeker Portal (Laravel App)
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   │   ├── Auth/           ← Authentication Controllers
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── JobVacancyController.php   ← Browse & Apply
│   │   │   │   ├── JobApplicationController.php ← Track Applications
│   │   │   │   └── ProfileController.php
│   │   │   ├── Middleware/         ← Role-based route guards
│   │   │   └── Requests/           ← Form validation classes
│   ├── resources/
│   │   └── views/                  ← Blade templates
│   └── routes/
│       ├── web.php                 ← public & auth routes
│       └── auth.php                ← login/register routes
│
├── job-backoffice/             # 🛠️ Admin & Company Owner Panel (Laravel App)
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   │   ├── Auth/           ← Separate auth for back office
│   │   │   │   ├── DashboardController.php   ← Analytics
│   │   │   │   ├── CompanyController.php     ← Full CRUD + Gate
│   │   │   │   ├── JobVacancyController.php  ← Full CRUD
│   │   │   │   ├── JobApplicationController.php ← Review & Status
│   │   │   │   ├── JobCategoryController.php
│   │   │   │   ├── UserController.php
│   │   │   │   └── ProfileController.php
│   │   │   ├── Middleware/
│   │   │   └── Requests/           ← CompanyCreateRequest, etc.
│   │   ├── Policies/
│   │   │   └── CompanyPolicy.php   ← Gate-based authorization
│   │   └── View/                   ← View composers
│   ├── database/
│   │   ├── migrations/             ← All schema definitions
│   │   └── seeders/                ← Initial data seeding
│   └── resources/
│       └── views/                  ← Blade admin templates
│
└── job-shared/                 # 📦 Shared Composer Package
    └── src/
        └── Models/
            ├── User.php
            ├── Company.php
            ├── JobVacancy.php
            ├── JobApplication.php
            ├── Resume.php
            └── Category.php
```

### MVC in Action — Example: Reviewing a Job Application

```
1. HTTP Request:  PATCH /job-applications/{id}
                  │
2. Route:         routes/web.php
                  → JobApplicationController@update
                  │
3. Middleware:    auth, role:admin|company-owner
                  │
4. Form Request:  JobApplicationUpdateRequest::rules()
                  → validates: status in [Pending, Accepted, Rejected]
                  │
5. Controller:    JobApplicationController@update()
                  → $jobApplication->update(['status' => $validated['status']])
                  │
6. Model:         JobApplication (from job-shared package)
                  → Eloquent updates the database record
                  │
7. Response:      redirect()->route('job-applications.index')
                  →  with('success', 'Status updated!')
                  │
8. View:          job-application/index.blade.php
                  → Renders updated list with success toast
```

---

## 🛠️ Tech Stack

### Backend
| Technology | Version | Purpose |
|---|---|---|
| **Laravel** | 11.x | Core PHP framework |
| **PHP** | 8.2+ | Server-side language |
| **Eloquent ORM** | (bundled) | Database abstraction & relationships |
| **Laravel Breeze** | Latest | Authentication scaffolding |
| **Laravel Policies** | (bundled) | Gate-based authorization |

### Frontend
| Technology | Version | Purpose |
|---|---|---|
| **Blade** | (bundled) | Server-side templating engine |
| **Tailwind CSS** | 4.x | Utility-first CSS framework |
| **Alpine.js** | 3.x | Lightweight JavaScript reactivity |
| **Vite** | Latest | Asset bundling & hot reload |

### Database
| Technology | Purpose |
|---|---|
| **MariaDB** | Primary relational database (via Docker) |
| **phpMyAdmin** | Database GUI management (via Docker) |

### DevOps & Environment
| Technology | Purpose |
|---|---|
| **Docker** | Containerized MariaDB & phpMyAdmin |
| **WSL 2 (Ubuntu)** | Linux development environment on Windows |
| **Git & GitHub** | Version control |
| **InfinityFree** | Production hosting |
| **Composer** | PHP package manager |
| **npm** | Node package manager for frontend assets |

---

## 💻 Development Environment Setup

### Prerequisites

- Windows with **WSL 2** (Ubuntu) installed
- **Docker Desktop** running with WSL integration enabled
- PHP 8.2+, Composer, Node.js/npm installed inside WSL

### 1. Clone the Repository

```bash
git clone https://github.com/MohmadWalid/Job-board-summer_project_laravel_2025-.git
cd Job-board-summer_project_laravel_2025-
```

### 2. Start Docker Services (Database + phpMyAdmin)

```bash
# Start MariaDB and phpMyAdmin containers
docker compose up -d

# Access phpMyAdmin at: http://localhost:8080
```

### 3. Setup the Back Office App

```bash
cd job-backoffice

# Install PHP dependencies (includes job-shared models)
composer install

# Install JS dependencies
npm install

# Configure environment
cp .env.example .env
php artisan key:generate

# Edit .env with your DB credentials (pointing to Docker container)
# DB_HOST=127.0.0.1, DB_PORT=3306, DB_DATABASE=shaghlni, etc.

# Run migrations & seed the database
php artisan migrate --seed

# Build assets & start server
npm run dev
php artisan serve --port=8001
```

### 4. Setup the Job App

```bash
cd ../job-app

# Install PHP dependencies (includes job-shared models)
composer install

npm install

cp .env.example .env
php artisan key:generate

# Point to the SAME database as job-backoffice
# Edit .env with matching DB credentials

npm run dev
php artisan serve --port=8000
```

### Access Points

| Service | URL |
|---|---|
| Job Seeker App | http://localhost:8000 |
| Admin Back Office | http://localhost:8001 |
| phpMyAdmin | http://localhost:8080 |

---

## 📚 Key Concepts Learned

### 1. MVC Architecture

The project follows a strict Model-View-Controller separation:

- **Model** (`job-shared/src/Models/`): Defines data structure, relationships, and business rules using Eloquent. All models are in a shared package consumed by both apps.
- **Controller** (`app/Http/Controllers/`): Handles HTTP requests, applies business logic, calls models, and returns views or redirects.
- **View** (`resources/views/`): Blade templates that render HTML using data passed from controllers.

### 2. Blade Template Engine

Blade allows writing clean, reusable templates with features like:
- **Layouts**: `@extends('layouts.app')` for master template inheritance
- **Sections**: `@section('content')` to inject content into layout slots
- **Components**: Reusable UI elements (buttons, cards, alerts)
- **Directives**: `@if`, `@foreach`, `@auth`, `@can` for conditional rendering
- **CSRF**: `@csrf` automatically adds the CSRF hidden field to forms

### 3. Database Models & Eloquent Relationships

```php
// Example: JobVacancy belongs to a Company, has many Applications
class JobVacancy extends Model {
    public function company(): BelongsTo { return $this->belongsTo(Company::class); }
    public function job_applications(): HasMany { return $this->hasMany(JobApplication::class); }
    public function categories(): BelongsToMany { return $this->belongsToMany(Category::class); }
}
```

Key features used:
- `belongsTo`, `hasMany`, `belongsToMany` relationships
- **Soft Deletes** (`SoftDeletes` trait + `deleted_at` column)
- **Eager Loading** (`with()`) to prevent N+1 query problems
- **Query Scopes** for reusable query constraints

### 4. Controllers

Resource controllers handle the full CRUD lifecycle using RESTful conventions:

| Method | URI | Action |
|---|---|---|
| GET | `/companies` | `index()` — list all |
| GET | `/companies/create` | `create()` — show form |
| POST | `/companies` | `store()` — save new |
| GET | `/companies/{id}` | `show()` — view one |
| GET | `/companies/{id}/edit` | `edit()` — show edit form |
| PATCH | `/companies/{id}` | `update()` — save changes |
| DELETE | `/companies/{id}` | `destroy()` — soft delete |

### 5. Forms & Validations

Form Requests keep controllers clean by extracting validation logic:

```php
// app/Http/Requests/CompanyCreateRequest.php
public function rules(): array {
    return [
        'name'           => 'required|string|max:255',
        'address'        => 'required|string',
        'industry'       => 'required|in:' . implode(',', $industries),
        'owner_name'     => 'required|string|max:255',
        'owner_email'    => 'required|email|unique:users,email',
        'owner_password' => 'required|min:8|confirmed',
    ];
}
```

### 6. Authentication

Both applications use **Laravel Breeze** for authentication:
- Session-based login, registration, logout
- Password reset flow
- Email verification
- Role-based route guards using custom middleware:
  ```php
  Route::middleware(['auth', 'role:admin'])->group(function () { ... });
  ```

### 7. API Authentication

The codebase is structured to support future **token-based API authentication** using Laravel Sanctum, allowing mobile apps or third-party services to consume the platform's data securely.

### 8. Authorization

Two levels of authorization are implemented:

**Middleware (Coarse-grained)**: Blocks users from entire route groups
```php
Route::middleware(['auth', 'role:company-owner,admin'])->group(...)
```

**Policies / Gates (Fine-grained)**: Controls actions on specific model instances
```php
// CompanyPolicy.php
public function update(User $user, Company $company): bool {
    return $user->role === 'admin' || $company->owner_id === $user->id;
}

// Controller usage
Gate::authorize('update', $company);
```

---

## ✨ Features

### 🎯 Core Features

- **Job Listings** — Browse and search all active job opportunities
- **Job Detail Pages** — Full job info with company details, salary, type, and required skills
- **Advanced Filtering** — Filter vacancies by job type, location, and category
- **Application Management** — Submit, track, and monitor job applications
- **Resume System** — Upload new or reuse existing PDF resumes when applying
- **Status Tracking** — Real-time application status (🟡 Pending / ✅ Accepted / ❌ Rejected)
- **Duplicate Protection** — Prevents applying to the same job twice

### 🛠️ Admin Features

- **Analytics Dashboard** — Active users, vacancies, applications, most-applied jobs, and conversion rates (scoped per role)
- **Company Management** — Full CRUD with company owner account creation in a single transaction
- **Job Vacancy Management** — Full CRUD with category tagging and soft delete / restore
- **Application Review** — View all applications, update status, archive/restore
- **User Management** — View all registered job seekers

### 🔒 Security Features

- **CSRF Protection** — All forms protected with `@csrf` tokens
- **SQL Injection Prevention** — Eloquent ORM with parameterized queries
- **Role-Based Access Control** — Middleware guards on all protected routes
- **Authorization Policies** — Gate checks prevent cross-company data access
- **Form Request Validation** — All input validated before hitting the database

### 🎨 UI/UX Features

- **Responsive Design** — Tailwind CSS for mobile-first layout
- **Dark/Modern Theme** — Glassmorphism effects and gradient accents
- **Alpine.js Components** — Dropdowns, toggles, and interactive elements without a heavy JS framework
- **Pagination** — 10 items per page with smart page links on all list views
- **Toast Notifications** — Flash messages for success and error states
- **Empty States** — Friendly messages when no data is available

---

## 👤 Author

<div align="center">

**Mohamad Walid**

Summer 2025 Engineering Project

[![GitHub](https://img.shields.io/badge/GitHub-MohmadWalid-181717?style=for-the-badge&logo=github)](https://github.com/MohmadWalid)

*Built with ❤️ — not just to write code, but to learn the full engineering process*

</div>

---

<div align="center">
  <sub>🌐 Live: <a href="https://dash.infinityfree.com/">dash.infinityfree.com</a> &nbsp;|&nbsp; 📦 Repo: <a href="https://github.com/MohmadWalid/Job-board-summer_project_laravel_2025-">GitHub</a></sub>
</div>

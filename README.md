<img width="1920" height="1806" alt="setting" src="https://github.com/user-attachments/assets/893d603f-ee42-440f-a65c-9a3ab2ab4c1a" />


<img width="1920" height="1383" alt="show_post" src="https://github.com/user-attachments/assets/9a4a9b88-e124-4ed9-8361-1456f712631c" />

<img width="1908" height="1035" alt="Postman_docs" src="https://github.com/user-attachments/assets/6435dc49-229f-47df-8c2e-784d557612dc" />


# 🚀 Blog & News Management System

A comprehensive **Laravel 12nd news management system with advanced features including user authentication, admin dashboard, API endpoints, social login, real-time notifications, and more.

## 📋 Table of Contents

- [Features](#-features)
- [Technology Stack](#-technology-stack)
- [Installation](#-installation)
- [Project Structure](#-project-structure)
- [API Documentation](#-api-documentation)
- [User Features](#-user-features)
- Admin Features](#-admin-features)
- [Advanced Features](#-advanced-features)
- [Database Structure](#-database-structure)
- [Security Features](#-security-features)
- [Development Tools](#-development-tools)

## ✨ Features

### 🔐 Authentication & Authorization
- **Multi-Guard Authentication**: Separate authentication for users, admins, and API
- **Email Verification**: Required email verification for users
- **Social Login**: Google, Facebook, GitHub, and other social providers
- **OTP System**: One-time password for admin password reset
- **Role-Based Access Control**: Custom roles and permissions for admins
- **Password Reset**: Secure password reset with email verification

### 👥 User Management
- **User Registration & Login**: Complete user authentication system
- **Profile Management**: User profiles with avatar, bio, location
- **User Dashboard**: Personal dashboard for managing posts and settings
- **User Status Management**: Active/inactive user status
- **Social Media Integration**: Social login with profile sync

### 📝 Content Management
- **Post Creation & Management**: Rich text editor with image support
- **Category System**: Hierarchical categories with status management
- **Comment System**: Nested comments with moderation
- **Image Management**: Multiple image upload with individual deletion
- **SEO Optimization**: Sluggable URLs and meta tags
- **Content Status**: Active/inactive content management

### 🎨 Frontend Features
- **Responsive Design**: Modern, mobile-friendly interface
- **Search Functionality**: Advanced search across posts and categories
- **Newsletter Subscription**: Email subscription system
- **Contact System**: Contact form with admin management
- **Real-time Updates**: Livewire components for dynamic content
- **Social Sharing**: Social media integration

### 🔧 Admin Dashboard
- **Comprehensive Dashboard**: Statistics and analytics
- **User Management**: Complete user administration
- **Content Moderation**: Post and comment moderation
- **Settings Management**: Website configuration
- **Role Management**: Admin roles and permissions
- **Reports & Analytics**: Charts and statistics

### 📱 API Features
- **RESTful API**: Complete API with authentication
- **Rate Limiting**: API rate limiting for security
- **Resource Collections**: Structured API responses
- **User Account Management**: API endpoints for user operations
- **Content API**: Posts, categories, and comments via API

## 🛠️ Technology Stack

### Core Framework
- **Laravel12Main PHP framework
- **PHP 80.2odern PHP features
- **MySQL/PostgreSQL** - Database
- **Redis** - Caching and sessions

### Authentication & Security
- **Laravel Sanctum 4.0** - API authentication
- **Laravel Socialite 5.21Social media login
- **Laravel OTP 2.0** - One-time password system
- **Laravel Breeze 2.3** - Authentication scaffolding

### Frontend & UI
- **Livewire3.6al-time components
- **Bootstrap** - CSS framework
- **jQuery** - JavaScript library
- **Slick Slider** - Carousel/slider
- **Summernote** - Rich text editor
- **DataTables** - Interactive tables
- **Chart.js** - Charts and graphs

### Development & Monitoring
- **Laravel Telescope 50.9ication monitoring
- **Laravel Debugbar 3.15** - Debug toolbar
- **Laravel Pint 1.13** - Code formatting
- **Pest 3.8** - Testing framework

### Additional Libraries
- **Eloquent Sluggable 12.0 SEO-friendly URLs
- **Laravel Charts 0.2.3** - Chart generation
- **PHP Flasher 2.1** - Alert messages
- **Predis 2.0** - Redis client
- **Pusher7.2time communication

## 🚀 Installation

### Prerequisites
- PHP 80.2 higher
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Redis (optional)

### Setup Instructions

1. **Clone the repository**
```bash
git clone <repository-url>
cd blog_news_system
```2l PHP dependencies**
```bash
composer install
```
3 **Install Node.js dependencies**
```bash
npm install
```4*Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure database**
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.000.1
DB_PORT=3306
DB_DATABASE=blog_news_system
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. **Run migrations and seeders**
```bash
php artisan migrate
php artisan db:seed
```

7**Storage setup**
```bash
php artisan storage:link
```
8 **Build assets**
```bash
npm run build
```

9. **Start the server**
```bash
php artisan serve
```

## 📁 Project Structure

```
blog_news_system/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin controllers
│   │   │   ├── Api/            # API controllers
│   │   │   ├── Auth/           # Authentication controllers
│   │   │   └── Frontend/       # Frontend controllers
│   │   ├── Middleware/         # Custom middleware
│   │   ├── Requests/           # Form requests
│   │   └── Resources/          # API resources
│   ├── Models/                 # Eloquent models
│   ├── Livewire/               # Livewire components
│   ├── Notifications/          # Email notifications
│   ├── Jobs/                   # Background jobs
│   ├── Repositories/           # Repository pattern
│   ├── Interfaces/             # Service interfaces
│   ├── Utils/                  # Utility classes
│   └── Providers/              # Service providers
├── database/
│   ├── migrations/             # Database migrations
│   ├── seeders/                # Database seeders
│   └── factories/              # Model factories
├── resources/
│   └── views/                  # Blade templates
├── routes/                     # Route definitions
└── public/                     # Public assets
```

## 📚 API Documentation

### Postman Collection
**API Version**: https://documenter.getpostman.com/view/33761394zHD

### Available API Endpoints

#### Public Endpoints
- `GET /api/posts` - Get all posts with pagination
- `GET /api/posts/{keyword}` - Search posts by keyword
- `GET /api/posts/show/{slug}` - Get specific post
- `GET /api/posts/comments/{slug}` - Get post comments
- `GET /api/categories` - Get all categories
- `GET /api/categories/{slug}/posts` - Get category posts
- `GET /api/settings` - Get website settings
- `GET /api/related-sites` - Get related sites
- `POST /api/contact/store` - Submit contact form

#### Authentication Endpoints
- `POST /api/auth/register` - User registration
- `POST /api/auth/login` - User login
- `DELETE /api/auth/logout` - User logout
- `POST /api/auth/email/verify` - Verify email
- `GET /api/auth/email/resend` - Resend verification email
- `POST /api/forget-password/email` - Forgot password
- `POST /api/reset-password` - Reset password

#### Protected Endpoints (Require Authentication)
- `GET /api/account/user` - Get user profile
- `PUT /api/account/update-settings/{user_id}` - Update user settings
- `PUT /api/account/change-password/{user_id}` - Change password
- `GET /api/account/posts` - Get user posts
- `POST /api/account/posts/store/post` - Create user post
- `PUT /api/account/posts/update/post/{id}` - Update user post
- `DELETE /api/account/posts/delete/post/{id}` - Delete user post
- `GET /api/account/posts/post/{id}/comments` - Get post comments
- `POST /api/account/posts/comments/store` - Store comment

## 👤 User Features

### Authentication
- User registration with email verification
- Login/logout functionality
- Social media login (Google, Facebook, GitHub)
- Password reset via email
- Remember me functionality

### Profile Management
- Personal profile with avatar upload
- Bio, location, and contact information
- Username customization
- Profile privacy settings

### Content Creation
- Create and edit posts with rich text editor
- Multiple image upload for posts
- Category selection
- Comment enable/disable options
- Post status management

### Dashboard Features
- Personal dashboard with statistics
- Post management (create, edit, delete)
- Comment management
- Notification center
- Settings management

### Interaction Features
- Comment on posts
- Search functionality
- Newsletter subscription
- Contact form submission
- Social sharing

## 🔧 Admin Features

### Dashboard
- Comprehensive statistics and analytics
- Real-time charts and reports
- System overview
- Quick actions panel

### User Management
- View all users
- User status management (active/inactive)
- User profile editing
- User statistics

### Content Management
- Post creation and editing
- Category management
- Comment moderation
- Image management
- Content status control

### System Administration
- Admin user management
- Role and permission management
- Website settings configuration
- Contact message management
- Related sites management

### Security Features
- Admin authentication with OTP
- Role-based access control
- Activity logging
- Security monitoring

## 🚀 Advanced Features

### Real-time Components
- **Livewire Integration**: Real-time updates without page refresh
- **Latest Posts & Comments**: Live updates of recent activity
- **Reports Dashboard**: Real-time statistics and charts
- **Notification System**: Instant notifications

### Image Management
- **Multiple Image Upload**: Support for multiple images per post
- **Image Optimization**: Automatic image processing
- **Individual Image Deletion**: Delete specific images
- **Image Storage**: Organized file storage system

### Search & Filtering
- **Advanced Search**: Search across posts and categories
- **Keyword Filtering**: Filter posts by keywords
- **Category Filtering**: Filter by categories
- **Status Filtering**: Filter by content status

### Notification System
- **Email Notifications**: New comment notifications
- **OTP Notifications**: Password reset and verification
- **Admin Notifications**: System notifications
- **User Notifications**: Personal notifications

### SEO Features
- **Sluggable URLs**: SEO-friendly URLs
- **Meta Tags**: Automatic meta tag generation
- **Sitemap Generation**: XML sitemap support
- **Social Media Tags**: Open Graph and Twitter Cards

## 🗄️ Database Structure

### Core Tables
1. **users** - User accounts and profiles
2. **admins** - Administrator accounts
3. **roles** - Admin roles and permissions
4. **posts** - Articles and news content5. **categories** - Content categories6*comments** - User comments on posts
7. **images** - Post images and media8ttings** - Website configuration9ntacts** - Contact form submissions
10. **news_subscribers** - Newsletter subscribers
11 **related_sites** - Related website links

### Key Relationships
- Users → Posts (One-to-Many)
- Users → Comments (One-to-Many)
- Posts → Category (Many-to-One)
- Posts → Comments (One-to-Many)
- Posts → Images (One-to-Many)
- Admins → Posts (One-to-Many)
- Admins → Role (Many-to-One)

## 🔒 Security Features

### Authentication Security
- **Multi-factor Authentication**: Email verification required
- **Password Hashing**: Secure password storage
- **Session Management**: Secure session handling
- **CSRF Protection**: Cross-site request forgery protection

### API Security
- **Rate Limiting**: API request throttling
- **Token Authentication**: Sanctum-based API auth
- **Request Validation**: Comprehensive input validation
- **CORS Protection**: Cross-origin resource sharing

### Data Protection
- **SQL Injection Prevention**: Parameterized queries
- **XSS Protection**: Cross-site scripting prevention
- **File Upload Security**: Secure file handling
- **Input Sanitization**: Data cleaning and validation

## 🛠️ Development Tools

### Monitoring & Debugging
- **Laravel Telescope**: Application monitoring and debugging
- **Laravel Debugbar**: Development debugging toolbar
- **Error Logging**: Comprehensive error tracking
- **Performance Monitoring**: Application performance tracking

### Code Quality
- **Laravel Pint**: Code formatting and style
- **Pest Testing**: Modern testing framework
- **Code Analysis**: Static code analysis
- **Documentation**: Comprehensive code documentation

### Development Workflow
- **Repository Pattern**: Clean architecture implementation
- **Service Providers**: Modular service management
- **Interface Contracts**: Service interface definitions
- **Dependency Injection**: Inversion of control

## 📊 Performance Features

### Caching
- **Redis Caching**: High-performance caching
- **Query Caching**: Database query optimization
- **View Caching**: Template caching
- **Route Caching**: Route optimization

### Optimization
- **Eager Loading**: Optimized database queries
- **Lazy Loading**: On-demand resource loading
- **Image Optimization**: Compressed image delivery
- **Asset Minification**: CSS/JS optimization

## 🎯 Key Benefits

### For Users
- **Easy Content Creation**: Simple post creation and management
- **Rich Interaction**: Comment system and social features
- **Personal Dashboard**: Comprehensive user dashboard
- **Mobile Responsive**: Works on all devices

### For Administrators
- **Complete Control**: Full content and user management
- **Analytics Dashboard**: Comprehensive statistics
- **Role Management**: Flexible permission system
- **Security Features**: Advanced security controls

### For Developers
- **Clean Architecture**: Well-structured codebase
- **API-First Design**: Comprehensive API endpoints
- **Extensible System**: Easy to extend and customize
- **Modern Stack**: Latest Laravel and PHP features

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License.

## 🆘 Support

For support and questions:
- You can Contact me for any error or chat for a project For you +201212484233
- Create an issue in the repository
- Check the API documentation
- Review the Laravel documentation

---

**Built with  using Laravel 12 By Abdallh Elzayat**

# 🎯 Daily Iqbal

![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel)
![Livewire](https://img.shields.io/badge/Livewire-3-blue?style=flat-square&logo=livewire)
![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-4-38b2ac?style=flat-square&logo=tailwind-css)
![SQLite](https://img.shields.io/badge/SQLite-3-003b57?style=flat-square&logo=sqlite)
![PHP](https://img.shields.io/badge/PHP-8.2+-777bb4?style=flat-square&logo=php)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

> **Aplikasi Web untuk Manajemen Produktivitas Personal** dengan fitur Task Management, Idea Lab dengan Kanban Board, dan Daily Logs. Dibangun dengan teknologi modern: Laravel 11, Livewire 3, dan Tailwind CSS.

## ✨ Features

### 📊 Dashboard
- Real-time statistics (Active tasks, Completed today, Completion rate)
- 7-day activity chart
- Motivational messages
- Summary overview

### ✅ Task Management
- **CRUD Operations**: Create, Read, Update, Delete tasks
- **Status Tracking**: Mark tasks as complete/incomplete
- **Auto Timestamps**: Automatic completion time recording
- **Filtering**: By status (All, Pending, Completed)
- **Sorting**: By date, priority, or due date
- **Priority Levels**: Low 🟢, Medium 🟡, High 🔴
- **Due Dates**: Set and track deadlines

### 💡 Idea Lab with Kanban
- **Idea Management**: Create and organize ideas
- **Kanban Board**: 3-column board (To Do, In Progress, Done)
- **Task Breakdown**: Break ideas into actionable tasks
- **Status Tracking**: Visual progress tracking
- **One-to-Many Relationship**: Ideas → Tasks

### 📝 Daily Logs
- **Completion History**: All completed tasks and idea-tasks
- **Date Grouping**: Organized by date
- **Timeline View**: Beautiful visual representation
- **Achievement Tracking**: See your progress over time

### 🎨 UI/UX
- **Dark Mode Design**: Modern Slate-900 theme
- **Responsive Layout**: Works on mobile, tablet, desktop
- **Smooth Animations**: Transitions and hover effects
- **Emoji Icons**: Intuitive visual indicators
- **Clean Navigation**: Sidebar with quick access

## 🚀 Quick Start

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- SQLite (included)

### Installation (5 minutes)

```bash
# Navigate to project
cd c:\skripsi\harianku

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Create database
php artisan migrate

# (Optional) Add sample data
php artisan db:seed

# Start servers
php artisan serve          # Terminal 1
npm run dev                # Terminal 2
```

**Open**: http://127.0.0.1:8000

👉 **See [QUICK_START.md](QUICK_START.md) for detailed setup guide**

## 📚 Documentation

Complete documentation is available:

| Document | Purpose |
|----------|---------|
| [QUICK_START.md](QUICK_START.md) | 5-minute setup & first steps |
| [USER_GUIDE.md](USER_GUIDE.md) | Complete user manual (10 sections) |
| [PRODUCTIVITY_HUB_DOCS.md](PRODUCTIVITY_HUB_DOCS.md) | Technical documentation |
| [IMPLEMENTATION_SUMMARY.md](IMPLEMENTATION_SUMMARY.md) | Architecture & implementation details |
| [DATABASE_SCHEMA.md](DATABASE_SCHEMA.md) | Database schema & relationships |
| [DELIVERY_SUMMARY.md](DELIVERY_SUMMARY.md) | Complete delivery checklist |

## 📁 Project Structure

```
app/
├── Livewire/              # Interactive components
│   ├── Dashboard.php
│   ├── TaskManager.php
│   ├── IdeaManager.php
│   ├── IdeaKanban.php
│   └── DailyLogs.php
├── Models/                # Database models
│   ├── Task.php
│   ├── Idea.php
│   └── IdeaTask.php
└── View/Components/       # Reusable UI components
    ├── Card.php
    ├── Button.php
    └── Badge.php

resources/
├── views/
│   ├── layouts/           # Main layout
│   │   └── main.blade.php
│   ├── livewire/          # Component views
│   ├── components/        # Blade components
│   ├── css/               # Tailwind styles
│   └── js/                # JS bootstrap
└── ...

database/
├── migrations/            # Database schema
└── seeders/              # Sample data
```

## 🗄️ Database Schema

### Tables
- **tasks**: Daily tasks with status, priority, due date
- **ideas**: Project/idea records
- **idea_tasks**: Tasks within ideas (one-to-many relationship)

### Relationships
```
Idea (1) ───→ IdeaTasks (M)
```

See [DATABASE_SCHEMA.md](DATABASE_SCHEMA.md) for complete ERD and schema details.

## 🛠️ Technology Stack

### Backend
- **Laravel 11**: Modern PHP framework
- **Livewire 3**: Real-time component reactivity
- **Eloquent ORM**: Database relationships

### Frontend
- **Tailwind CSS v4**: Utility-first styling
- **Vite**: Fast asset bundling
- **Alpine.js Ready**: For enhanced interactions

### Database
- **SQLite**: Portable, zero-configuration

## 🎯 Key Features

✅ **Real-time Updates**: Livewire handles all reactivity  
✅ **Validation**: Server-side validation with error feedback  
✅ **Relationships**: Proper one-to-many with cascade delete  
✅ **Timestamps**: Auto-tracking of created, updated, completed times  
✅ **Responsive**: Works on all device sizes  
✅ **Dark Mode**: Modern dark theme throughout  
✅ **Reusable Components**: Blade components for DRY code  
✅ **Production Ready**: Clean, well-structured code  

## 📊 Dashboard Stats

The dashboard provides real-time insights:
- Active tasks count
- Tasks completed today
- Completion rate percentage
- 7-day activity visualization
- Motivational messages based on performance

## ✅ Task Management

Complete task lifecycle management:
1. **Create** - Add new tasks with details
2. **Track** - Filter and sort your tasks
3. **Complete** - Mark done with auto-timestamp
4. **Review** - See completion history in Daily Logs

## 💡 Idea Management with Kanban

Organize projects visually:
1. **Create Idea** - Define your project
2. **Open Kanban** - 3-column visual board
3. **Add Tasks** - Break down into actionable items
4. **Track Progress** - Move tasks through columns
5. **Complete** - Mark done and track achievements

## 📝 Daily Logs

Review your accomplishments:
- See what you completed each day
- Beautiful timeline view
- Grouped by date
- Permanent achievement record

## 🎨 Dark Mode Design

Modern, eye-friendly interface:
- Slate-900 base color
- Gradient backgrounds
- Smooth transitions
- Color-coded status
- Responsive to all screens

## 🧪 Sample Data

Run seeder to populate with examples:
```bash
php artisan db:seed
```

Includes:
- 4 sample tasks (mix of pending/completed)
- 2 sample ideas
- 6 idea-tasks with various statuses

Perfect for testing and learning!

## 🔐 Database Integrity

- Foreign key constraints
- Cascade delete on related records
- Auto timestamp tracking
- Proper indexing

## 📈 Performance

- SQLite: Fast, lightweight, zero-setup
- Livewire: Efficient real-time updates
- Tailwind: Minimal CSS output
- Typical page load: < 1 second

## 🚀 Deployment

### Local Development
```bash
php artisan serve
npm run dev
```

### Production Build
```bash
npm run build
php artisan config:cache
php artisan route:cache
```

### Database
- Local: SQLite (included)
- Production: MySQL/PostgreSQL (configure in .env)

## 🎓 Learning Resources

This project demonstrates:
- ✅ Modern Laravel 11 patterns
- ✅ Livewire 3 reactive components
- ✅ Tailwind CSS dark mode design
- ✅ Database relationships
- ✅ Form validation
- ✅ Component composition
- ✅ Real-time updates

Perfect for learning full-stack web development!

## 🐛 Troubleshooting

### CSS/JS Not Loading
```bash
npm run dev
# Then refresh browser
```

### Database Issues
```bash
php artisan migrate:fresh --seed
```

### Port 8000 In Use
```bash
php artisan serve --port=8001
```

See [QUICK_START.md](QUICK_START.md) for more troubleshooting tips.

## 📋 Requirements

- PHP 8.2+
- Composer
- Node.js 16+
- npm or yarn
- SQLite 3 (included in PHP)

## 📄 License

This project is open source and available under the MIT License.

## 🤝 Contributing

Feel free to:
- Report issues
- Suggest features
- Submit pull requests
- Improve documentation

## 📞 Support

- Check documentation files
- Review code comments
- See [USER_GUIDE.md](USER_GUIDE.md) for help
- Check browser console for errors (F12)

## 🌟 Future Enhancements

Planned features:
- [ ] User authentication
- [ ] Multi-user support
- [ ] Cloud sync
- [ ] Mobile app
- [ ] Email notifications
- [ ] Team collaboration
- [ ] Analytics & reports
- [ ] API integration

## 🎉 Getting Started

1. **Clone/Download** this repository
2. **Follow** [QUICK_START.md](QUICK_START.md)
3. **Create** your first task
4. **Organize** your ideas
5. **Track** your progress!

---

### 📊 Project Stats

- **5** Livewire Components
- **3** Eloquent Models  
- **10+** Blade Views
- **3** Database Tables
- **3** Migrations
- **6** Documentation Files
- **12** Sample Records
- **100%** Feature Complete

### ⏱️ Time to Setup
- Installation: 5 minutes
- First task: 30 seconds
- Learning curve: Gentle

---

**Built with ❤️ using Laravel 11, Livewire 3, and Tailwind CSS**

🚀 **Ready to boost your productivity? [Get Started Now!](QUICK_START.md)**

---

<div align="center">

**[Quick Start](QUICK_START.md)** •
**[User Guide](USER_GUIDE.md)** •
**[Documentation](PRODUCTIVITY_HUB_DOCS.md)** •
**[Schema](DATABASE_SCHEMA.md)** •
**[Delivery](DELIVERY_SUMMARY.md)**

Made with 💪 for productivity lovers

</div>
#   c a t a t a n k u  
 
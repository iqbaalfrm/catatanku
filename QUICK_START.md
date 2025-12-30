# ⚡ Quick Start Guide - Daily Iqbal

## 🚀 Get Started in 5 Minutes

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- SQLite (built-in)

---

## 📥 Installation

### Step 1: Navigate to Project
```bash
cd c:\skripsi\harianku
```

### Step 2: Install Dependencies
```bash
# PHP dependencies
composer install

# Node dependencies
npm install
```

### Step 3: Setup Environment
```bash
# Copy example env
cp .env.example .env

# Generate app key
php artisan key:generate
```

### Step 4: Database Setup
```bash
# Run migrations
php artisan migrate

# (Optional) Seed sample data
php artisan db:seed
```

### Step 5: Start Servers

**Terminal 1 - Laravel Server:**
```bash
php artisan serve
```
✅ Server running at: `http://127.0.0.1:8000`

**Terminal 2 - Vite (CSS/JS):**
```bash
npm run dev
```
✅ Assets built and watching for changes

---

## 🎯 First Steps

### 1. Open Browser
Go to: **http://127.0.0.1:8000**

### 2. Explore Dashboard
- See your productivity stats
- View 7-day activity chart
- Get motivation message

### 3. Create Your First Task
1. Click **Tasks** in sidebar
2. Fill in task details:
   - Title: "Learn Laravel"
   - Priority: High
   - Due Date: Tomorrow
3. Click "+ Add Task"
4. Checkbox to mark complete

### 4. Create Your First Idea
1. Click **Ideas** in sidebar
2. Create idea:
   - Title: "Build Mobile App"
   - Description: "React Native app"
3. Click "+ Create Idea"
4. Click "📊 Open Kanban"
5. Add tasks to kanban board

### 5. Review Your Progress
1. Click **Daily Logs**
2. See all completed items
3. Review timestamps and details

---

## 📋 File Structure Overview

```
📁 app/
  ├── 📁 Livewire/          ← Interactive components
  ├── 📁 Models/            ← Database models
  └── 📁 View/Components/   ← Reusable UI pieces

📁 resources/
  ├── 📁 views/
  │   ├── 📁 layouts/       ← Main layout template
  │   ├── 📁 livewire/      ← Component views
  │   └── 📁 components/    ← Reusable components
  ├── 📁 css/
  │   └── app.css           ← Tailwind styles
  └── 📁 js/
      └── app.js            ← JS bootstrap

📁 database/
  ├── 📁 migrations/        ← Schema files
  └── 📁 seeders/           ← Sample data

🔧 Configuration Files:
  ├── .env                  ← Environment setup
  ├── tailwind.config.js    ← Tailwind config
  ├── vite.config.js        ← Vite config
  └── composer.json         ← PHP dependencies
```

---

## 🎮 Feature Checklist

- [x] **Dashboard** - See all your stats
  - Active tasks count
  - Tasks completed today
  - Completion percentage
  - 7-day activity graph

- [x] **Tasks** - Manage daily work
  - Create tasks ✨
  - Mark complete ✅
  - Filter by status
  - Sort by priority/date
  - Delete tasks

- [x] **Ideas + Kanban** - Organize projects
  - Create ideas 💡
  - Open kanban board
  - 3 columns: To Do | In Progress | Done
  - Move tasks between columns
  - Track completion

- [x] **Daily Logs** - See history
  - Timeline of completions
  - Grouped by date
  - Shows all details
  - Permanent record

---

## 🎨 Customize Your Setup

### Change Theme Colors
Edit `tailwind.config.js`:
```js
theme: {
  extend: {
    colors: {
      primary: '#3b82f6',  // Your color
    }
  }
}
```

### Change Database
Edit `.env`:
```env
# For MySQL:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=productivity_hub
DB_USERNAME=root
DB_PASSWORD=
```

### Add Custom Components
Create new component:
```bash
php artisan make:livewire my-feature
```

---

## 🔧 Development Commands

```bash
# View database
sqlite3 database/database.sqlite

# Laravel Artisan commands
php artisan tinker                    # Interactive shell
php artisan migrate:fresh --seed      # Reset database
php artisan serve                     # Start server
php artisan optimize:clear            # Clear caches

# NPM commands
npm run dev                           # Dev with watch
npm run build                         # Production build
npm install                           # Install packages

# Livewire commands
php artisan livewire:discover         # Auto-discover components
php artisan make:livewire component   # Create component
```

---

## 📱 Access on Phone

### Same Network
If on same WiFi as dev machine:
1. Find your IP: `ipconfig` (Windows) or `ifconfig` (Mac/Linux)
2. Use: `http://YOUR_IP:8000`

⚠️ Note: Real mobile app feature in roadmap

---

## 🐛 Troubleshooting

| Problem | Solution |
|---------|----------|
| Port 8000 in use | `php artisan serve --port=8001` |
| CSS not loading | `npm run dev` in another terminal |
| Database error | `php artisan migrate:fresh --seed` |
| Blank page | Check browser console (F12) for errors |
| Livewire not responding | Clear cache: `php artisan optimize:clear` |

---

## 📚 Learn More

- **Full Documentation**: See `PRODUCTIVITY_HUB_DOCS.md`
- **User Guide**: See `USER_GUIDE.md`
- **Technical Details**: See `IMPLEMENTATION_SUMMARY.md`

---

## 🎓 What You're Learning

- **Laravel 11**: Modern PHP framework
- **Livewire 3**: Real-time components
- **Tailwind CSS**: Utility-first styling
- **SQLite**: Lightweight database
- **Database Design**: Relations & schemas
- **Component Architecture**: Reusable code

---

## 🎯 Next Steps

### Immediate
1. ✅ Get app running
2. ✅ Create a few tasks
3. ✅ Try the kanban board
4. ✅ Mark some as complete

### Learning
1. 📖 Read the documentation files
2. 🔍 Explore the code structure
3. 🧪 Try modifying components
4. 💡 Add your own features

### Advanced
1. 🚀 Deploy to server
2. 👥 Add authentication
3. 🌐 Add multi-user support
4. 📱 Build mobile app

---

## 💡 Pro Tips

### Keyboard Shortcuts
- `Ctrl + R`: Refresh browser
- `Ctrl + Shift + R`: Hard refresh (clear cache)
- `F12`: Open developer tools
- `Ctrl + K`: Quick search (try in sidebar)

### Productivity Tips
- Start each day: Create today's tasks
- Mid-day: Move tasks to In Progress
- End of day: Mark complete and review
- Weekly: Create new ideas and archive old ones
- Monthly: Review Daily Logs for insights

### Development Tips
- Use `npm run dev` while coding (auto-rebuild)
- Browser auto-refresh with Vite
- Livewire components auto-reload
- Use `php artisan tinker` to test queries
- Check app.log for debug info

---

## 🎉 Success!

You now have a fully functional productivity app! 🚀

**Next**: Start creating tasks and organizing your ideas!

---

## 📞 Need Help?

1. Check documentation files
2. Review code comments
3. Check browser console (F12)
4. See server output in terminal
5. Try `php artisan tinker` for testing

---

**Happy Productivity! 💪**

*Built with ❤️ using Laravel, Livewire, and Tailwind*

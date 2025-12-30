# 🎯 Daily Iqbal

Aplikasi web full-stack untuk manajemen produktivitas personal dengan fitur Task Management, Idea Lab dengan Kanban Board, dan Daily Logs. Dibangun dengan **Laravel 11**, **Livewire 3**, dan **Tailwind CSS** dengan dark mode design yang elegan.

## ✨ Fitur Utama

### 1. **Dashboard** 📊
- Ringkasan statistik real-time:
  - Jumlah task aktif
  - Task yang selesai hari ini
  - Persentase completion rate
  - Total task secara keseluruhan
- Grafik aktivitas harian (last 7 days)
- Tips motivasi berdasarkan performa

### 2. **Task Management** ✅
- CRUD (Create, Read, Update, Delete) untuk tugas harian
- Fitur checkbox untuk menandai tugas sebagai selesai
- Pencatatan otomatis waktu penyelesaian (`completed_at`)
- Filter berdasarkan status (Pending, Completed)
- Sorting by:
  - Newest First
  - Priority
  - Due Date
- Priority levels: Low (🟢), Medium (🟡), High (🔴)
- Deskripsi dan due date untuk setiap task
- Delete dengan konfirmasi

### 3. **Idea Lab with Kanban** 💡
- **List Ideas**: Halaman untuk melihat semua ide
- **Idea Cards**: Menampilkan:
  - Jumlah task di setiap status (To Do, In Progress, Done)
  - Deskripsi ide
  - Quick action untuk membuka Kanban
- **Kanban Board** (3 Kolom):
  - **To Do**: Task baru
  - **In Progress**: Task sedang dikerjakan
  - **Done**: Task selesai dengan timestamp
- Drag & drop functionality (siap untuk ekspansi)
- Add, Edit, Delete task langsung dari kanban
- One-to-Many relationship: `ideas` → `idea_tasks`

### 4. **Daily Logs** 📝
- Riwayat semua task dan idea-task yang sudah selesai
- Dikelompokkan berdasarkan tanggal
- Menampilkan:
  - Nama task/idea-task
  - Deskripsi
  - Waktu penyelesaian
  - Priority/Status
  - Idea yang terkait (untuk idea-tasks)
- Timeline view dengan border highlight

### 5. **UI/UX**
- **Dark Mode** menggunakan Tailwind (Slate-900 base)
- **Sidebar Navigation** yang clean dan responsive
- **Gradient Backgrounds** untuk visual appeal
- **Responsive Design** (Mobile, Tablet, Desktop)
- **Smooth Transitions** dan hover effects
- **Emoji Icons** untuk intuitif visual

## 🏗️ Struktur Database

### Migrations

#### 1. **tasks** table
```sql
- id (Primary Key)
- title (string, required)
- description (text, nullable)
- status (string: 'pending', 'completed')
- completed_at (timestamp, nullable)
- due_date (date, nullable)
- priority (integer: 1=Low, 2=Medium, 3=High)
- timestamps (created_at, updated_at)
```

#### 2. **ideas** table
```sql
- id (Primary Key)
- title (string, required)
- description (text, required)
- status (string: 'active', 'archived')
- timestamps (created_at, updated_at)
```

#### 3. **idea_tasks** table
```sql
- id (Primary Key)
- idea_id (Foreign Key → ideas.id, cascade delete)
- title (string, required)
- description (text, nullable)
- status (string: 'todo', 'in_progress', 'done')
- position (integer, for ordering)
- completed_at (timestamp, nullable)
- timestamps (created_at, updated_at)
```

## 📦 Project Structure

```
app/
├── Livewire/
│   ├── Dashboard.php              # Dashboard component
│   ├── TaskManager.php            # Task CRUD & management
│   ├── IdeaManager.php            # Ideas list & creation
│   ├── IdeaKanban.php             # Kanban board for idea tasks
│   └── DailyLogs.php              # Daily logs viewer
├── Models/
│   ├── Task.php
│   ├── Idea.php
│   └── IdeaTask.php
└── View/Components/
    ├── Card.php                   # Reusable card component
    ├── Button.php                 # Reusable button component
    └── Badge.php                  # Reusable badge component

resources/
├── views/
│   ├── layouts/
│   │   └── main.blade.php         # Main layout with sidebar
│   ├── livewire/
│   │   ├── dashboard.blade.php
│   │   ├── task-manager.blade.php
│   │   ├── idea-manager.blade.php
│   │   ├── idea-kanban.blade.php
│   │   └── daily-logs.blade.php
│   └── components/
│       ├── card.blade.php
│       ├── button.blade.php
│       └── badge.blade.php
├── css/
│   └── app.css                    # Tailwind CSS entry point
└── js/
    └── app.js                     # JS bootstrap

database/
├── migrations/
│   ├── create_tasks_table
│   ├── create_ideas_table
│   └── create_idea_tasks_table
└── seeders/
    └── DatabaseSeeder.php         # Sample data

routes/
└── web.php                         # Web routes
```

## 🚀 Instalasi & Setup

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- SQLite atau MySQL

### Installation Steps

1. **Clone repository**
```bash
cd c:\skripsi\harianku
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install Node dependencies**
```bash
npm install
```

4. **Setup environment file**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure Database** (`.env`)
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

6. **Run migrations**
```bash
php artisan migrate
```

7. **Seed sample data** (optional)
```bash
php artisan db:seed
```

8. **Start development servers**

Terminal 1 - Laravel server:
```bash
php artisan serve
```

Terminal 2 - Vite dev server:
```bash
npm run dev
```

9. **Open in browser**
```
http://127.0.0.1:8000
```

## 💡 Livewire Components Details

### Dashboard Component
**File**: `app/Livewire/Dashboard.php`
- Real-time statistics calculation
- 7-day activity graph data
- Motivation message based on completion rate

```php
public function render() {
    // Calculate stats
    // Return view with layout
}
```

### TaskManager Component
**File**: `app/Livewire/TaskManager.php`
- Properties: `newTaskTitle`, `newTaskDescription`, `newTaskDueDate`, `newTaskPriority`
- Methods:
  - `addTask()` - Create new task
  - `toggleTaskStatus()` - Toggle complete/pending
  - `deleteTask()` - Delete task
  - `render()` - Display with filtering & sorting

### IdeaManager Component
**File**: `app/Livewire/IdeaManager.php`
- Properties: `newIdeaTitle`, `newIdeaDescription`
- Methods:
  - `addIdea()` - Create new idea
  - `deleteIdea()` - Delete idea
  - `toggleIdeaStatus()` - Archive/unarchive idea

### IdeaKanban Component
**File**: `app/Livewire/IdeaKanban.php`
- Parameter: `$idea` (routed model binding)
- Methods:
  - `addTask()` - Add task to kanban
  - `updateTaskStatus()` - Move task between columns
  - `deleteTask()` - Delete idea task
  - `reorderTasks()` - Reorder tasks

### DailyLogs Component
**File**: `app/Livewire/DailyLogs.php`
- Display grouped logs by date
- Show both Task dan IdeaTask completions
- Formatted timeline view

## 🎨 Tailwind CSS Customization

**File**: `tailwind.config.js`
```js
theme: {
  extend: {
    colors: {
      dark: {
        900: '#0f172a',
        800: '#1e293b',
        700: '#334155',
        600: '#475569',
      }
    }
  }
}
```

## 🧪 Testing

### Manual Test Cases

1. **Dashboard**
   - [ ] Verify active tasks count
   - [ ] Check completion rate calculation
   - [ ] Verify 7-day activity chart
   - [ ] Test motivation message changes

2. **Task Management**
   - [ ] Create task with all fields
   - [ ] Mark task as complete
   - [ ] Filter by status
   - [ ] Sort by priority/due date
   - [ ] Delete task
   - [ ] Verify completed_at timestamp

3. **Ideas & Kanban**
   - [ ] Create new idea
   - [ ] View kanban board
   - [ ] Add task to kanban
   - [ ] Move task between columns
   - [ ] Delete idea-task
   - [ ] Verify completed_at on done tasks

4. **Daily Logs**
   - [ ] Check completed tasks appear
   - [ ] Verify date grouping
   - [ ] Check idea-task relationships display

## 📝 Notes Untuk Pengembangan

### Database Relationships
- `Idea` hasMany `IdeaTask`
- `IdeaTask` belongsTo `Idea`
- Cascade delete: saat Idea dihapus, semua IdeaTask ikut terhapus

### Validation Rules
```php
// Task
- title: required|string|max:255
- description: nullable|string|max:1000
- due_date: nullable|date
- priority: required|numeric|in:1,2,3

// Idea
- title: required|string|max:255
- description: required|string|max:1000

// IdeaTask
- title: required|string|max:255
- description: nullable|string|max:1000
```

### Helper Methods in Models

**Task Model**:
- `isCompleted()` - Check if task is completed
- `markAsCompleted()` - Mark task as done
- `markAsIncomplete()` - Revert to pending
- `getPriorityLabel()` - Get label for priority
- `getPriorityColor()` - Get color for priority

**Idea Model**:
- `getTaskCountByStatus()` - Count tasks by status
- `getTodoCount()`, `getInProgressCount()`, `getDoneCount()`
- `isActive()` - Check if idea is active

**IdeaTask Model**:
- `isCompleted()` - Check if task done
- `markAsCompleted()` - Mark as done
- `getStatusColor()` - Get color for status
- `getStatusLabel()` - Get label for status

## 🌟 Best Practices Implemented

✅ **MVC Pattern**: Proper separation of concerns  
✅ **Livewire Best Practices**: Reactive components with proper validation  
✅ **Blade Components**: Reusable UI components  
✅ **Database Relationships**: Proper foreign keys & cascading  
✅ **Timestamps**: Auto tracking of created_at, updated_at, completed_at  
✅ **Model Methods**: Business logic encapsulated in models  
✅ **Validation**: Client-side & server-side validation  
✅ **Responsive Design**: Works on mobile, tablet, desktop  
✅ **Dark Mode**: Modern dark theme throughout  
✅ **DRY Principle**: Reusable components & layouts  

## 📚 Additional Resources

- [Laravel 11 Documentation](https://laravel.com/docs/11.x)
- [Livewire 3 Documentation](https://livewire.laravel.com)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [SQLite Documentation](https://www.sqlite.org/docs.html)

## 📄 License

MIT License - Free to use for personal and commercial projects.

---

**Dibuat dengan ❤️ untuk produktivitas maksimal**

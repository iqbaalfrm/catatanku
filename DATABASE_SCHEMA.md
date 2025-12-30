# 📊 Database Schema Documentation

## Schema Overview

### Entity Relationship Diagram (ERD)

```
┌─────────────────┐
│     TASKS       │
├─────────────────┤
│ id (PK)         │
│ title           │
│ description     │
│ status          │
│ completed_at    │
│ due_date        │
│ priority        │
│ created_at      │
│ updated_at      │
└─────────────────┘

┌──────────────────────┐         ┌──────────────────┐
│      IDEAS           │ 1───M  │   IDEA_TASKS     │
├──────────────────────┤         ├──────────────────┤
│ id (PK)              │◄────────│ idea_id (FK)     │
│ title                │         │ id (PK)          │
│ description          │         │ title            │
│ status               │         │ description      │
│ created_at           │         │ status           │
│ updated_at           │         │ position         │
└──────────────────────┘         │ completed_at     │
                                 │ created_at       │
                                 │ updated_at       │
                                 └──────────────────┘
```

---

## 🗂️ Table Definitions

### 1. TASKS Table

**Purpose**: Store individual task items

```sql
CREATE TABLE tasks (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    status VARCHAR(255) DEFAULT 'pending',
    completed_at TIMESTAMP NULL,
    due_date DATE NULL,
    priority INT DEFAULT 1,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Field Details**:

| Field | Type | Nullable | Default | Purpose |
|-------|------|----------|---------|---------|
| id | BIGINT | ❌ | Auto | Primary key |
| title | VARCHAR(255) | ❌ | - | Task name |
| description | TEXT | ✅ | NULL | Task details |
| status | VARCHAR(255) | ❌ | 'pending' | pending / completed |
| completed_at | TIMESTAMP | ✅ | NULL | Auto-set when marked done |
| due_date | DATE | ✅ | NULL | Task deadline |
| priority | INT | ❌ | 1 | 1=Low, 2=Medium, 3=High |
| created_at | TIMESTAMP | ✅ | NULL | Auto-set on create |
| updated_at | TIMESTAMP | ✅ | NULL | Auto-updated on change |

**Indexes**:
- Primary Key: `id`
- Consider adding: `status`, `completed_at` for filtering

**Sample Data**:
```json
{
  "id": 1,
  "title": "Complete project documentation",
  "description": "Write comprehensive documentation for the productivity hub",
  "status": "pending",
  "completed_at": null,
  "due_date": "2025-01-05",
  "priority": 3,
  "created_at": "2025-12-29T10:30:00",
  "updated_at": "2025-12-29T10:30:00"
}
```

---

### 2. IDEAS Table

**Purpose**: Store idea/project records

```sql
CREATE TABLE ideas (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    status VARCHAR(255) DEFAULT 'active',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Field Details**:

| Field | Type | Nullable | Default | Purpose |
|-------|------|----------|---------|---------|
| id | BIGINT | ❌ | Auto | Primary key |
| title | VARCHAR(255) | ❌ | - | Idea name |
| description | TEXT | ❌ | - | Idea description |
| status | VARCHAR(255) | ❌ | 'active' | active / archived |
| created_at | TIMESTAMP | ✅ | NULL | Auto-set on create |
| updated_at | TIMESTAMP | ✅ | NULL | Auto-updated on change |

**Indexes**:
- Primary Key: `id`
- Consider: `status` for filtering

**Relationships**:
- **One-to-Many**: Has many `idea_tasks`
- Cascade Delete: All `idea_tasks` deleted when idea deleted

**Sample Data**:
```json
{
  "id": 1,
  "title": "Mobile App for Productivity",
  "description": "Create a mobile version of the productivity hub with offline support",
  "status": "active",
  "created_at": "2025-12-29T11:00:00",
  "updated_at": "2025-12-29T11:00:00"
}
```

---

### 3. IDEA_TASKS Table

**Purpose**: Store individual tasks within an idea's kanban board

```sql
CREATE TABLE idea_tasks (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    idea_id BIGINT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    status VARCHAR(255) DEFAULT 'todo',
    position INT DEFAULT 0,
    completed_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    FOREIGN KEY (idea_id) REFERENCES ideas(id) 
        ON DELETE CASCADE
);
```

**Field Details**:

| Field | Type | Nullable | Default | Purpose |
|-------|------|----------|---------|---------|
| id | BIGINT | ❌ | Auto | Primary key |
| idea_id | BIGINT | ❌ | - | Foreign key to ideas |
| title | VARCHAR(255) | ❌ | - | Task name |
| description | TEXT | ✅ | NULL | Task details |
| status | VARCHAR(255) | ❌ | 'todo' | todo / in_progress / done |
| position | INT | ❌ | 0 | For ordering in kanban |
| completed_at | TIMESTAMP | ✅ | NULL | Auto-set when marked done |
| created_at | TIMESTAMP | ✅ | NULL | Auto-set on create |
| updated_at | TIMESTAMP | ✅ | NULL | Auto-updated on change |

**Constraints**:
- **Foreign Key**: `idea_id` → `ideas.id`
- **On Delete**: CASCADE (task deleted with idea)

**Indexes**:
- Primary Key: `id`
- Foreign Key: `idea_id` (auto-indexed)
- Consider: `idea_id, status` for queries

**Relationships**:
- **Many-to-One**: Belongs to single `idea`
- Inverse: `Idea.ideaTasks()`

**Sample Data**:
```json
{
  "id": 1,
  "idea_id": 1,
  "title": "Design mockups",
  "description": "Create UI mockups for mobile app",
  "status": "todo",
  "position": 0,
  "completed_at": null,
  "created_at": "2025-12-29T11:05:00",
  "updated_at": "2025-12-29T11:05:00"
}
```

---

## 🔗 Relationships

### One-to-Many: Idea → IdeaTask

```
┌─────────────────────────────────────────┐
│  Idea (1)                               │
├─────────────────────────────────────────┤
│ id: 1                                   │
│ title: "Mobile App"                     │
│ ...                                     │
└─────────────────────────────────────────┘
         │
         │ (1-to-Many)
         │
         ├──► ┌──────────────────────┐
         │    │ IdeaTask (1)         │
         │    │ idea_id: 1           │
         │    │ title: "Design UI"   │
         │    └──────────────────────┘
         │
         ├──► ┌──────────────────────┐
         │    │ IdeaTask (2)         │
         │    │ idea_id: 1           │
         │    │ title: "Code Backend" │
         │    └──────────────────────┘
         │
         └──► ┌──────────────────────┐
              │ IdeaTask (3)         │
              │ idea_id: 1           │
              │ title: "Deploy"      │
              └──────────────────────┘
```

**In Models**:
```php
// Idea.php
public function ideaTasks(): HasMany {
    return $this->hasMany(IdeaTask::class);
}

// IdeaTask.php
public function idea(): BelongsTo {
    return $this->belongsTo(Idea::class);
}
```

**Usage**:
```php
$idea = Idea::find(1);
$tasks = $idea->ideaTasks;  // Get all tasks for idea

$task = IdeaTask::find(5);
$idea = $task->idea;        // Get idea for task
```

---

## 📋 Status Values

### Task Status
```
┌─────────────┬──────────────────────────┐
│ Value       │ Meaning                  │
├─────────────┼──────────────────────────┤
│ pending     │ Not yet completed        │
│ completed   │ Marked as done           │
└─────────────┴──────────────────────────┘
```

### Idea Status
```
┌─────────────┬──────────────────────────┐
│ Value       │ Meaning                  │
├─────────────┼──────────────────────────┤
│ active      │ Currently working on     │
│ archived    │ Completed/shelved        │
└─────────────┴──────────────────────────┘
```

### IdeaTask Status
```
┌─────────────┬──────────────────────────┐
│ Value       │ Meaning                  │
├─────────────┼──────────────────────────┤
│ todo        │ Not started              │
│ in_progress │ Currently working        │
│ done        │ Completed                │
└─────────────┴──────────────────────────┘
```

---

## 🔐 Data Integrity

### Cascade Delete
When an `Idea` is deleted:
```sql
DELETE FROM idea_tasks WHERE idea_id = ?;
DELETE FROM ideas WHERE id = ?;
```

All related `IdeaTask` records are automatically deleted.

### Foreign Key Constraint
```sql
FOREIGN KEY (idea_id) REFERENCES ideas(id) ON DELETE CASCADE
```

Prevents orphaned records.

### Timestamp Auto-Updates
- `created_at`: Set once on creation
- `updated_at`: Updated on any change
- `completed_at`: Set manually when marking complete

---

## 📊 Query Examples

### Get Active Tasks
```sql
SELECT * FROM tasks 
WHERE status = 'pending'
ORDER BY priority DESC, due_date ASC;
```

### Get Completed Tasks Today
```sql
SELECT * FROM tasks 
WHERE status = 'completed'
  AND DATE(completed_at) = CURDATE();
```

### Get All Tasks for an Idea
```sql
SELECT * FROM idea_tasks 
WHERE idea_id = 1
ORDER BY position;
```

### Get Kanban View
```sql
SELECT 
  'todo' as column,
  COUNT(*) as count,
  json_group_array(json_object(
    'id', id,
    'title', title,
    'status', status
  )) as tasks
FROM idea_tasks
WHERE idea_id = 1 AND status = 'todo'

UNION ALL

SELECT 'in_progress', ...
UNION ALL
SELECT 'done', ...;
```

### Count by Status
```sql
SELECT 
  status,
  COUNT(*) as count
FROM idea_tasks
WHERE idea_id = 1
GROUP BY status;
```

---

## 🧹 Maintenance Queries

### Reset Database
```bash
php artisan migrate:fresh --seed
```

### Clear Completed Older Than 90 Days
```sql
DELETE FROM tasks 
WHERE status = 'completed'
  AND completed_at < DATE_SUB(NOW(), INTERVAL 90 DAY);
```

### Archive Old Ideas (1 year+)
```sql
UPDATE ideas 
SET status = 'archived'
WHERE status = 'active'
  AND created_at < DATE_SUB(NOW(), INTERVAL 1 YEAR);
```

### Check Table Sizes
```sql
SELECT 
  name as table_name,
  pgsize as size_bytes
FROM pragma_page_count() 
CROSS JOIN pragma_page_size();
```

---

## 📈 Performance Considerations

### Recommended Indexes
```sql
-- For filtering
CREATE INDEX idx_tasks_status ON tasks(status);
CREATE INDEX idx_tasks_completed_at ON tasks(completed_at);
CREATE INDEX idx_ideas_status ON ideas(status);
CREATE INDEX idx_idea_tasks_idea_id_status ON idea_tasks(idea_id, status);

-- For sorting
CREATE INDEX idx_tasks_priority ON tasks(priority DESC);
CREATE INDEX idx_tasks_due_date ON tasks(due_date ASC);
CREATE INDEX idx_idea_tasks_position ON idea_tasks(position);
```

### Query Optimization
- Use eager loading: `Idea::with('ideaTasks')->find(1)`
- Avoid N+1 queries
- Use selectRaw for aggregates
- Index foreign keys

### Database Size
SQLite file typically:
- 100 tasks: ~50KB
- 1000 tasks: ~500KB
- 10000 tasks: ~5MB

No cleanup needed unless storing years of data.

---

## 🔄 Migration Path

### Current Schema
- ✅ 3 tables: tasks, ideas, idea_tasks
- ✅ Timestamps on all tables
- ✅ Foreign keys with cascade delete
- ✅ Status enums
- ✅ Soft deletes ready (add if needed)

### Future Enhancements
```php
// Add these migrations later:

// Users table
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    ...
});

// Timestamps
ALTER TABLE tasks ADD user_id BIGINT;
ALTER TABLE ideas ADD user_id BIGINT;

// Categories
ALTER TABLE tasks ADD category VARCHAR(255);

// Tags
CREATE TABLE idea_tags (...);

// Comments
CREATE TABLE comments (...);
```

---

## 🎯 Summary

| Table | Purpose | Relations | Status Values |
|-------|---------|-----------|----------------|
| **tasks** | Daily tasks | None | pending, completed |
| **ideas** | Projects/ideas | 1→M ideaTasks | active, archived |
| **idea_tasks** | Idea breakdown | M→1 idea | todo, in_progress, done |

**Key Features**:
- ✅ Proper relationships
- ✅ Cascade delete safety
- ✅ Auto timestamps
- ✅ Status tracking
- ✅ Scalable design
- ✅ SQLite compatible

---

**Database Design Complete! 🎉**

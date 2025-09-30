# 🧼 Laravel 12 Todo App – Clean Architecture + TDD

This is a simple **Todo app** implemented using **Clean Architecture** principles and **Test-Driven Development (TDD)** in Laravel 12.

Clean Architecture separates the system into layers:

- **Entities (Core)**: Business logic (`Todo` entity)
- **Use Cases**: Application-specific actions (`CreateTodo`)
- **Interfaces**: Contracts and controllers (`TodoRepositoryInterface`, `TodoController`)
- **Infrastructure**: Eloquent repository (`EloquentTodoRepository`)

---

## Features

- Create Todos with title and status
- Fully layered architecture (Core, Use Cases, Interfaces, Infrastructure)
- TDD-ready: Unit and Feature tests included
- Flexible: Swap database or repository without changing core logic

---

## Installation

```bash
# Clone the repo
git clone https://github.com/tharakadoo/clean-arch-tdd
cd clean-arch-tdd

# Install dependencies
composer install

# Set up environment
cp .env.example .env
php artisan key:generate

#install api routes
php artisan install:api

# Run migrations
php artisan migrate

# Start server
php artisan serve

## Usage
- Send a POST request to create a todo:
- {
-	"title": "Some Text Goes Here"
- }

## Testing
- php artisan test

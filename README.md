# Laravel 12 Todo App – Clean Architecture + TDD

A simple **Todo API** implemented with **Clean Architecture** principles and **Test-Driven Development (TDD)** in **Laravel 12**.

This app demonstrates:

- Separation of concerns with **Entities, Use Cases, Interfaces, and Infrastructure**
- Fully testable code with **Unit and Feature tests**
- Flexibility to swap database or repository without affecting core business logic

---

## Architecture

- **Entities**: Core business logic (`Todo` entity)
- **Use Cases**: Application actions (`CreateTodo`, `UpdateTodo`, `DeleteTodo`)
- **Interfaces**: Contracts and controllers (`TodoRepositoryInterface`, `TodoController`)
- **Infrastructure**: Eloquent repository (`EloquentTodoRepository`)

---

## Features

- Create, Read, Update, Delete Todos
- Status: `pending` or `done`
- Fully layered architecture
- Unit and Feature tests included

---

## Installation

```bash
# Clone the repo
git clone https://github.com/tharakadoo/clean-arch-tdd-1
cd clean-arch-tdd

# Install dependencies
composer install

# Set up environment
cp .env.example .env
php artisan key:generate

# Install API routes
php artisan install:api

# Run migrations
php artisan migrate

# Start server
php artisan serve

---

## Usage
Create a Todo: POST /api/todos

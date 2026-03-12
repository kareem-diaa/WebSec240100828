# WebSec240100828

This repository contains coursework for the **Web and Security Technologies** course at SUT.

## First Laravel Project

The `First_Laravel_Project` directory holds a beginner-friendly CRUD application built during the course. Features include:

- Creating, reading, updating and deleting posts
- User selection for post creator
- Validation, route model binding, and flash messaging
- Bootstrap-based views with confirmation dialogs

### Installation

1. Clone the repo:
   ```bash
   git clone https://github.com/kareem-diaa/WebSec240100828.git
   cd WebSec240100828/First_Laravel_Project
   ```
2. Install dependencies:
   ```bash
   composer install
   npm install && npm run dev
   ```
3. Configure `.env` and run migrations:
   ```bash
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   ```
4. Serve the app:
   ```bash
   php artisan serve
   ```

### Usage

Navigate to `/posts` to manage posts. The app demonstrates basic Laravel workflow and Eloquent relationships.

---

Feel free to explore or adapt the code; this was my first real Laravel application.

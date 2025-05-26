Here is your rewritten README.md with clear Docker/Docker Compose instructions, proper links, and all your notes addressed:

---

# getPayIn Content Scheduler

A Laravel-based application for scheduling and managing content posts across different platforms. This project streamlines the process of creating, scheduling, and distributing posts for users, supporting multi-platform publishing and advanced post status management.

---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Project Structure](#project-structure)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Database Access](#database-access)
- [Contributing](#contributing)
- [License](#license)

---

## Overview

getPayIn Content Scheduler is a Laravel application that enables users to:
- Create posts with titles, content, images, and scheduled times.
- Attach posts to multiple platforms.
- Manage and track post statuses (scheduled, published, pending).
- Activate or deactivate platforms for each user.
- Automate publishing posts to selected platforms.

---

## Features

- **User Management:** Register, update, and delete users.
- **Post Management:** Create, update, schedule, and delete posts. Attach them to platforms and manage their status.
- **Platform Management:** List all supported platforms, activate or deactivate them for users.
- **Scheduling:** Schedule posts to be published at a future time.
- **Multi-Platform Publishing:** Attach posts to one or more platforms, manage their posting status.
- **Laravel-Powered:** Uses Laravel’s robust features for routing, database, and queue management.

---

## Project Structure

- `app/Repositories/` – Data handling logic for users, posts, platforms, and user-platform relationships.
- `app/Services/` – Business logic, orchestrating operations between repositories.
- `routes/web.php` – HTTP routes.
- `config/` – Laravel configuration files.
- `public/` – Entry point for web requests.

---

## Requirements

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

---

## Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/mostafa-fakhr/getPayIn-ContentScheduler.git
   cd getPayIn-ContentScheduler
   ```

2. **Set Up Environment Variables**
   - Copy the example environment file:
     ```bash
     cp .env.example .env
     ```
   - Open `.env` and set your database username and password:
     ```
     DB_USERNAME=<your_db_username>
     DB_PASSWORD=<your_db_password>
     ```

3. **Build and Start the Project**
   ```bash
   docker compose up --build
   ```

4. **Run Database Migrations and Seeders**
   ```bash
   docker compose exec app php artisan migrate:fresh --seed
   ```

---

## Usage

- The application will be accessible at: [http://localhost:8000](http://localhost:8000)
- You can log in and begin managing users, posts, and platforms through the web interface.

---

## Database Access

- **phpMyAdmin** is available at: [http://localhost:8080](http://localhost:8080)
- Use the credentials you provided in `.env` for `DB_USERNAME` and `DB_PASSWORD` to log in.

---

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request. For major changes, open an issue first to discuss your ideas.

---

## License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).

---


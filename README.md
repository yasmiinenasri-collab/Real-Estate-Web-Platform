# Real Estate Web Platform

## Overview
This is a web platform designed for the real estate industry. It allows users to view, buy, and rent properties, and provides an administrative interface for managing the platform's content, including properties, users, and payments.

## Features
- **User Interface:**
  - Browse properties for rent or sale.
  - View detailed information about each property.
  - Contact the property owner or agent directly.
  - Register and log in to manage personal details and transactions.

- **Admin Interface:**
  - Manage properties (add, update, delete).
  - View and manage users and their reservations.
  - Manage payment details for users and properties.
  - View statistics about platform usage and transactions.

## Tech Stack
- **Frontend**: Vue.js, HTML, CSS, JavaScript
- **Backend**: Laravel (PHP)
- **Database**: MySQL
- **Authentication**: Laravel Passport for API authentication
- **Storage**: Local file storage (for images and documents)
- **Deployment**: Docker (for containerization)

## Installation

### Prerequisites
Make sure you have the following installed on your machine:
- [Node.js](https://nodejs.org/) (for running the frontend)
- [PHP](https://www.php.net/) (for running the backend)
- [MySQL](https://www.mysql.com/)
- [Composer](https://getcomposer.org/) (for PHP dependency management)
- [Docker](https://www.docker.com/) (optional, for containerization)

### Steps

1. Clone the repository:
   ```bash
   git clone https://github.com/yasmiinenasri-collab/Real-Estate-Web-Platform.git
   cd Real-Estate-Web-Platform
2.Install frontend dependencies:


cd frontend
npm install

3.Install backend dependencies:
cd backend
composer install

4.Set up the environment configuration:

Copy .env.example to .env:
cp .env.example .env

Update the .env file with your database and other configurations.

5.Run migrations:
php artisan migrate

6.Run the application:
For development mode:


##Running the Frontend
In the frontend folder, run:
npm run dev

##Running the Backend
For Laravel backend, make sure you have the required environment and run:
php artisan serve

##Usage
**Users:**

Visit the homepage to browse available properties.
Register and log in to manage your profile and bookings.
Use the contact form to get in touch with property owners.
**Admins:**

Log in to the admin panel to manage properties, users, and payments.
Monitor statistics and manage user reservations.
Contributing
We welcome contributions! If you'd like to contribute, follow these steps:

##Fork the repository.
1.Create a new branch for your feature or bugfix (git checkout -b feature-name).
2.Commit your changes (git commit -m 'Add new feature').
3.Push to your fork (git push origin feature-name).
4.Create a pull request.
##Contact
For questions or support, please contact yasmine.nasr@esprit.tn

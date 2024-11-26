# Real Estate Web Platform

## Overview
A real estate web platform for users to browse, buy, and rent properties, with admin features for managing content, users, and payments.

## Features
- **Users:**
  - Browse and view properties.
  - Contact property owners or agents.
  - Manage profile and bookings.

- **Admins:**
  - Manage properties, users, and payments.
  - Monitor platform usage and reservations.

## Tech Stack
- **Frontend**: Vue.js
- **Backend**: Laravel (PHP)
- **Database**: MySQL

## Installation

### Prerequisites
Make sure you have the following installed:
- [Node.js](https://nodejs.org/)
- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)

### Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/yasmiinenasri-collab/Real-Estate-Web-Platform.git
   cd Tunisiemaison-main
   
2. Install frontend dependencies:
   ```bash
   cd frontend
   npm install

3. Install backend dependencies:
    ```bash
    cd backend
    composer install

4. Set up environment variables:
    ```bash
    cp .env.example .env
Update .env with your database details.

5. Run migrations:
    ```bash
    php artisan migrate

6. Start the application:
- **Frontend**:  - ```bash
    - cd frontend
    - npm run dev

- **Backend**: - ```bash
    - php artisan serve
### Contributing
1. Fork the repository.
    Create a new branch:
    ```bash
    git checkout -b feature-name
2. Commit your changes:
    ```bash
    git commit -m 'Add new feature'
3. Push to your fork and create a pull request.
### Contact
For support, contact yasmine.nasri@esprit.tn.

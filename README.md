# Car Rent Management System

The Car Rent Management System is a web-based application built using PHP and MySQL. It is designed to assist car rental businesses in managing their vehicles, categories, and users through a centralized admin interface. Additionally, it provides a user-friendly experience for customers to browse available cars and submit bookings.

This project follows a modular structure and utilizes a responsive design powered by Bootstrap 5. It includes both administrative and customer functionalities and is built using core procedural PHP with a MySQL database.

---

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Project Structure](#project-structure)
- [Installation](#installation)
- [Author](#author)	

---

## Features

### Administrator Features

- Secure login and logout
- Dashboard with an overview of car listings and user information
- Add, edit, or delete car records
- Create, update, or remove car categories
- View and manage registered customer accounts

### Customer Features

- User registration and login
- Browse available cars with category-based filtering
- View car details including name, price, space, gas mileage, and year

### General Features

- Clean, responsive, and mobile-friendly interface
- Role-based access control (admin and customer)
- Organized code structure for ease of development and maintenance
- Session tracking to manage user authentication and access

---

## Technologies Used

- Backend: PHP (Core procedural PHP)
- Frontend: HTML5, CSS3, Bootstrap 5, JavaScript
- Database: MySQL
- Web Server: Apache (XAMPP or WAMP recommended)

### 📊 Language Usage Distribution

![Language Distribution](assets/language-distribution.png)

---

## Project Structure

Car-rent/
├── assets/ # CSS, JavaScript, and image files
├── include/ # Common files (database config, header, navigation)
├── pages/
│ ├── Car/ # Add, view, update car listings
│ ├── Category/ # Manage car categories
│ └── User/ # Login, registration, and session handling
├── index.php # Main landing or dashboard page
└── README.md # Project documentation

---

## Installation

To set up the project on your local development environment, follow the steps below:

1. Clone the Repository

Clone this repository to your local server directory.

```bash
git clone https://github.com/Parth18022006/Car-rent.git

2. Create the Database
To set up the database for this project, follow the steps below:
•	Ensure that both Apache and MySQL services are running via XAMPP or WAMP.
•	Navigate to the includes/DB/ directory within your project folder and open the DB.sql file using any text editor.
•	Copy the entire SQL content from the DB.sql file.
•	Open your web browser and go to http://localhost/phpmyadmin.
•	In the left sidebar, click on "New", then click on the "SQL" tab.
•	Paste the copied SQL content into the SQL editor and click the "Go" button.
After the SQL script executes successfully, your database will be fully set up and ready for use by the application.


## Author
Parth Chavda
GitHub: https://github.com/Parth18022006
Gmail: parth18chavda@gmail.com
For any feedback or queries, please feel free to reach out via GitHub.

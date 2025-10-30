# Garda Pentagon

A guest book and administration website built for the Pengadilan Tinggi Agama Gorontalo.

## 🚀 Features

- **Public Guest Form:** A user-friendly form for visitors to fill in their details.
- **Admin Dashboard:** A secure, password-protected admin panel to view, manage, and export guest data.
- **Authentication:** Secure login system for administrators.
- **Dynamic Data:** The system uses PHP to dynamically interact with the database.

## 💻 Technology Stack

- **Backend:** PHP
- **Frontend:** HTML, JavaScript
- **Database:** MySQL
- **Styling:** Tailwind CSS

## 📋 Requirements

To run this project, you will need:

- A web server (e.g., [XAMPP](https://www.apachefriends.org/index.html), WAMP, MAMP, or any Apache server)
- PHP (version 7.4 or newer recommended)
- MySQL (Available via phpMyAdmin in XAMPP)
- [Node.js and npm](https://nodejs.org/en) (for building the Tailwind CSS)

## ⚙️ Installation Guide

Follow these steps to set up the project on a new machine.

### 1\. Get the Code

Clone the repository or download the source code:

```bash
git clone https://github.com/faizjauzah/garda-pentagon.git
cd garda-pentagon
```

### 2\. Set Up the Web Server

Move the entire `garda-pentagon` project folder into your web server's root directory.

- For **XAMPP/WAMP:** `C:\xampp\htdocs\`
- For **MAMP:** `/Applications/MAMP/htdocs/`

### 3\. Install Dependencies & Build CSS

The project uses Tailwind CSS. You must install the `node_modules` and then build the final CSS file.

```bash
# Install all the required packages from package.json
npm install

# Run the build command to compile and minify the CSS
npm run build
```

_(For development, you can use `npm run watch` to have Tailwind automatically re-compile as you make changes.)_

### 4\. Set Up the Database

You will need to import the project's database structure and data.

1.  Open **phpMyAdmin** (e.g., `http://localhost/phpmyadmin`).
2.  Create a new, empty database. Let's call it `garda_pentagon`.
3.  Select the `garda_pentagon` database from the list on the left.
4.  Click the **"Import"** tab at the top.
5.  Click "Choose File" and select the `.sql` file that you exported for this project.
6.  Click the **"Go"** or **"Import"** button at the bottom of the page.

### 5\. Configure the Database Connection

The project needs to know how to connect to the new database.

1.  Find the database connection file in the `config/` folder (e.g., `config/koneksi.php` or `config/db.php`).
2.  Open the file in a code editor.
3.  Update the database host, username, password, and database name to match your local server settings.

**Example (inside `config/koneksi.php`):**

```php
<?php
$hostname = 'localhost';
$username = 'root'; // Your server's username
$password = ''; // Your server's password
$database = 'garda_pentagon'; // The database name from Step 4

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

### 6\. Run the Project

You're all set\! Open your web browser and navigate to the project's URL:

**[http://localhost/garda-pentagon/](https://www.google.com/search?q=http://localhost/garda-pentagon/)**

To access the admin panel, navigate to the login page (e.g., `http://localhost/garda-pentagon/login.php` or `http://localhost/garda-pentagon/admin/`).

****How to run the User Registration & Login and User Management System With admin panel Project****

1. Download the  zip file

2. Extract the file and copy loginsystem folder

3.Paste inside root directory(for xampp xampp/htdocs, for wamp wamp/www, for lamp var/www/html)

4. Open PHPMyAdmin (http://localhost/phpmyadmin)

5. Create a database with name loginsystem

6. Import loginsystem.sql file(given inside the zip package in SQL file folder)

7.Run the script http://localhost/loginsystem (frontend)

8. For admin Panel http://localhost/loginsystem/admin

*********************************Credential for admin panel*********************************

Username: admin
Password: Test@12345

*********************************Credential for user panel*********************************

Username: johndoe12@gamil.com
Password : Test@12345
*****************************************************
 Project Documentation: News System Website

 Project Title:

DailyPulse - Dynamic News Website
 Overview:
DailyPulse is a dynamic, responsive, and user-friendly news website developed using HTML, CSS, Bootstrap, JavaScript, and PHP. The platform is designed to deliver real-time news updates across various categories like politics, sports, entertainment, technology, and more. The system includes an admin panel to manage content and a frontend for users to read, search, and filter news efficiently.
 Objectives:
- To build a fully functional and responsive news portal.
- To provide dynamic content management via a PHP backend.
- To allow categorized display of news articles with pagination and search.
- To implement an admin dashboard for uploading, editing, and deleting news articles.
- To enhance user experience with Bootstrap styling and interactivity using JavaScript.
 Technologies Used:
Technology	Description
HTML5	Markup language for webpage structure
CSS3	Styling of UI elements
Bootstrap 5	Frontend responsive framework
JavaScript	Client-side interactivity (e.g., modals, toggles)
PHP	Backend scripting for server-side logic
MySQL	Database for storing news articles and categories
 Features:
 User Panel:
- View latest news on homepage
- Category-wise news display
- Search functionality
- Pagination for articles
- News details page with full article view
- Responsive UI for mobile/tablet/desktop
 Admin Panel:
- Secure login system
- Add/edit/delete news articles
- Upload featured images
- Manage categories
- Manage users (optional)
- Dashboard with basic analytics (e.g., total articles, views)
 File Structure:

/news-website/
├── /admin/
│   ├── dashboard.php
│   ├── add-news.php
│   ├── edit-news.php
│   ├── delete-news.php
│   └── login.php
├── /assets/
│   ├── /css/
│   ├── /js/
│   └── /images/
├── /includes/
│   ├── header.php
│   ├── footer.php
│   ├── db.php
│    
├── index.php
├── category.php
├── news-details.php
└── contact.php

Database Structure:
Table: news_articles
Field	Type	Description
id	INT	Primary key
title	VARCHAR	News title
content	TEXT	Full news content
image	VARCHAR	Path to featured image
category_id	INT	Foreign key (news_categories)
created_at	DATETIME	Timestamp
Table: news_categories
Field	Type	Description
id	INT	Primary key
name	VARCHAR	Category name
 Security Implementations:
- Input sanitization using PHP filter_input() and mysqli_real_escape_string()
- Admin authentication with session-based login
- Password encryption using password_hash()
 Responsive Design:
Using Bootstrap 5 grid system and utilities to ensure proper layout on desktops, tablets, and mobile devices.
Future Enhancements:
- User registration and commenting system
- Email newsletter subscription
- REST API for mobile app integration
- Dark/light mode toggle
Conclusion:
This News Website project provides a scalable and secure platform for content publishing and management. By leveraging PHP for backend logic and Bootstrap for frontend responsiveness, it delivers a seamless experience for both readers and administrators. The modular codebase also allows future enhancements with ease.

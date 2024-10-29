# PHP Capstone Project
## Summary 
Web Development Diploma PHP Capstone Project\  
The goal of this project is to create a website for a dog shelter.\
This project used PHP, HTML, CSS, and JavaScript.\ 
All the data in the sql dump file are dummy data (only for demo use)\
## Scope
Create the database strusture for the website\
Use PHP to create frontend for users to know the latest information of the organization\
Use PHP to create backend APIs to handle CRUD request from website\
User login function to seperate normal users and admin users\
Show admin page after admin users login\
User can apply for adoption and leave comments on dogs showed on adoption page 
## Team and Role
Freddy Lau full-Stack developer
## Budget
Our Blended rate: $26.00/hr
<pre>
Service breakdown:
Planning / Exploration  $130.00
Design / Content        $390.00
Coding / Programming    $767.00
Launch	                $26.00
Administration	        $208.00
___________________________________
Total                   $1,521.00
</pre>
## Challenges
1. Create filter for users to search dogs in adoption page.\ 
2. Website can be used on both PC and mobile devices.\ 
3. Seperate normal users and admins privileges.\
4. Prevent SQL injection from users input. 
## Solutions
1. Reterived dogs' breed and age from DB and pushed them in select boxes. When users changed the select box, reload the page and get related dogs information.\ 
2. Created 2 CSS files and use HTML link tag media attribute to switch between files on browser pixel.\  
3. Created is_admin and is_active column in database table to determine user privileges.\
4. Validated users' input in controller and escaped special characters using prepared statements.    
## Learning
Learned Object-Oriented Programming\
Learned the concept of MVC\
Learned responsive layout design\
Prevent csrf attack from web form\
Practiced on create proposal, wireframe, and sitemap for a website  
## Tools
PHP, HTML5, CSS3, JavaScript, JQuery, composer, and MySQL

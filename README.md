# Library Management System - MVC Assignment
## To setup- 
  1) Clone the git repository using command:
  `git clone git@github.com:aaryaag03/mvcAssignment.git`
  
  2) Install Composer:     
  a) Composer: 
     Go to the project directory(mvcAssignment)-This must be installed in the **project directory** and php7.    
  b) Then run the following commands :
    `composer install`    
    `composer dumpautoload`  
  c) Then move into the public folder in the project directory and run:
     `php -S localhost:8000`
          
## Features-
   a) The Library has two portals- Client and Admin.   
   b) Client can register, login, request to take or return a book.    
   c) Clients are charged 10 ruppees fine on late return of books and the fine can also be viewed by them.
   d) Client requests need to be approved by admins and they can view their pending requests as well.
   e) A user can send request to be Admin.
   f) Admins can login, accept or deny take/return/admin requests and also add or delete books from the library.
  
  

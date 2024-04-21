<p align="center"><a href="https://upolo.com/" target="_blank"><img src="https://upolo.com/wp-content/uploads/2024/04/logo-site.png" height="200" alt="Laravel Logo"></a></p>

## UPOLO contact manager api project
This project design and implement by Amir Fallah based on UPOLO Company request.
The code use Laravel v10.48.8 (PHP v8.1.2-1ubuntu2.14). the project use api for contact manager system.
## Run the project 
- Run laravel project by "php artisan serve"
- The main url address "api/content_manager"
- The address only used in post method
## Authentication functions
This application use laravel Sanctum to user authentication  the main functions as below:
- Register user : For register new user with post to url: "/api/auth/register" 
- login method : For login existing users with post to url: "/api/auth/register"
- user method : To get current login user with get to url:  "/api/auth/user"
- logout method : For logout the user with pot to url: "/api/auth/logout"
 ## Main functions structure
Call function in this application has single structure as below:
1) post json request to application with below array structure with 2 parameters
    - 'function' => String as function name
    - 'input' => Array as function variable
2) return value of each post call structure as below:
    - 'result'=> boolean true: for done , false: for the function can not done
    - 'msg' => string message
    - 'data' => string json return data 

## usage documentations
This application use vaiuse doctumentation ways
- inline comment documentation : use by doxygen friendly
- this global (readme) document by markdown language
- The main page of this application is functions documentation (http://localhost:8000/)
- Also added postman source to check the function in root of project document with name: upolo.postman_collection.json





## Devloper 

this code create by Amir Fallah (+989123936105)


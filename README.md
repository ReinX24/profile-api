# profile-api
Final project for Integrative Programming, an application where you can send API requests with Bearer tokens to modify database contents.

## Application setup
The "profile-api" directory should be inside the xampp/htdocs directory for so that the request endpoints could work.


## Get request endpoints

#### Default GET request
http://localhost/profile-api/public/api/
![get_request_index](readme_photos/get_request_index.png)

#### Get all the users in the database
http://localhost/profile-api/public/api/?what=users
![get_request_users](readme_photos/get_request_users.png)

## Post request endpoints

#### Add a user to our database
http://localhost/profile-api/public/api/?what=add-user
![post_request_add_user](readme_photos/post_request_add_user.png)

#### Edit a user to our database
http://localhost/profile-api/public/api/?what=edit-user
![post_request_add_user](readme_photos/post_request_edit_user.png)

#### Delete a user to our database
http://localhost/profile-api/public/api/?what=delete-user
![post_request_add_user](readme_photos/post_request_delete_user.png)
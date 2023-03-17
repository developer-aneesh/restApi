# Rest Api - PHP

This is a simple PHP rest api application having throttle system to control api requests from a refferer. The user can set number of requests allowed per seconds in this application and return the resource based on request size.

Steps to run application
1. Clone the application in to your web root
2. Set the maximum request allowed and its time duration in seconds in the config.php. Keys are MAX_REQUESTS and MAX_TIME_PERIOD
3. The application have 2 api's for getting user list and user details. Both api's return data defined in the UserModel class.
4. Open any api check platform like postman and call the following api's to data.
5. The default rate limit is 5 request per 5 seconds (5Req/5Sec)

API's
http://localhost/restApi/index.php/users/list
http://localhost/restApi/index.php/users/userDetails/{id} // replace id with valid number

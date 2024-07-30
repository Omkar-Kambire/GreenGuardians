## About 
> GreenGuardians is an e-commerce platform which allows users to buy fertilizers and pesticides and make payments in offline and online mode. It is built using HTML, CSS, JavaScript, PHP and MySQL.


## 🚀Features

- Register
- Login
- View, Add, Edit,Delete Categories
- View, Add, Edit,Delete Products
- Place order
- Make payments - Online or Offline

## 🧑🏻‍💻User Guide
### Steps to run project

1. Download XAMPP
2. Navigate to XAMPP > htdocs
3. Clone this repo.
4. Run XAMPP
5. Next, go to phpmyadmin localhost web to create a database, name the database as 'greenguardians'.
5. Import 'greenguardians.sql' file to root directory of database.
6. Now in includes > connect.php, replace username and password of database. In place of 'root' write your username and password -
 
    ```sh 
    $conn=mysqli_connect('localhost','root','root','greenguardians');  
    ```

7. Similarly paste your razorpay API keys -
 
     ```sh
    define('RAZORPAY_KEY', '<YOUR_API_KEY>"');
    define('RAZORPAY_SECRET', '<YOUR_API_SECRET>'); 
    ```

9. And you are good to go.
10. Change the paths in case of error - File not found.



## Default accounts

| Account | Username | Password |
| ------ | ------ | ----- |
| Admin | Paddy | 123456 |
| User | Omkar | 123456 |

## Authors
This project was originally created by [Omkar-Kambire](https://github.com/Omkar-Kambire).

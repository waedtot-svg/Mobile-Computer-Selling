Mobile & Computer Selling System :

This is a simple PHP-based implementation of two key use cases for a mobile and computer selling system: Login and Process Sale.
The system simulates a basic point-of-sale flow, without using any frameworks or databases, as required in the course project.

Implemented Use Cases

User Login
Users can enter their email and password.
If credentials match, they are redirected to the sales page.
Credentials are verified using a class-based AuthenticationManager.
Process Sale
After login, users can choose products and quantities.
The system calculates total price, checks stock, and processes payment.
If stock is available and payment succeeds, the order is confirmed.
**Project Setup Instructions (Using XAMPP)

1-Install XAMPP on your pc.

2-Place the project folder inside:

C:\xampp\htdocs\Mobile-Computer-Selling

3-Open the XAMPP Control Panel and start the Apache module.

4-Open your browser and go to:

http://localhost/Mobile-Computer-Selling/login.php

5-Test login using the default credentials:

Email: waed@gmail.com

Password: 1234

6-Upon successful login, you will be redirected to the sale processing page.

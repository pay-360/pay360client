# pay360client
This project aims to ease our client to use our payment gateway API.

Installation..
> cmd > composer require pay-360/pay360client

After Install..
> Move files (except for the pay360client.php) from x/vendor/pay-360/pay360client/src/ to x(main folder)
> Open file (index.php) in the browser with "http://localhost/" + file location path
    eg. http://localhost/x/index.php

How To Test pay360client?
0. pay.360.my run cmd > php artisan serve --host 0.0.0.0 --port 82
1. index.php
    > Reference ID : [insert integer, every time test must be unique number]
    > Mode : [if choose Credit Card, follow step 2.1]
             [if choose Duitnow B2B/B2C, follow step 2.2]
    > Email : [insert valid email address]
    > Success/Cancel/Status URL : [http://localhost/ + particular files location]
                                    eg. if the success_page file (success_page.php) located in x/success_page.php, then type http://localhost/x/success_page.php in the Success URL box

2.1 Mode: Credit Card
    > What to fill in?
        >> Email: [insert valid email address]
        >> Payment Method: Card
        >> Card Information: 4242 4242 4242 4242
        >> MM/YY: 12/34
        >> CVC: 567
        >> Cardholder: [insert any string]
    > Redirect to success_page

2.2 Mode: Duitnow
    > Select Bank: PYN Bank A
    > Username: user1
    > Password: password1
    > Press Submit Payment - Confirm
    > Redirect to 404 page
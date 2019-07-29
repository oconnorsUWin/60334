Login Credentials:
Admin:
Username: admin
Password: password123

Guest:
Username: guest
Password: password123

Home page:
http://oconnors.myweb.cs.uwindsor.ca/60334/project/loginPage.php

When logging in, you may choose to use either of the logins shown above. One login is a guest login, which restricts what you are able to do to bookings/checking reservations. The admin login has the administration page that has additional features that are intended for admins only.

Home Page:
On the home page, you will find a basic introductory screen, welcoming the user, as well as a calendar with events that are being hosted by the hotel. This page has minimal interaction.

Room Page:
On the room page, you will find an outline of each type of room that is available. Below that you will find a google dynamic chart that outlines which rooms are available. It uses a query that changed values depending on the rooms that AREN'T yet booked by someone. 
$query  = "SELECT roomType, count(*) as cnt FROM rooms WHERE NOT EXISTS (SELECT * FROM bookings WHERE bookings.roomNum = rooms.roomNum) group by roomType";

Reservation Page:
The reservation page has a few different things to do. Firstly you can book a reservation. By filling in the number of guests, check in date, check out date (YYYY-MM-DD), payment type (Cash/Card) and guest name, you are able to book a reservation. If you have already booked a reservation, you would be able to search by your booking code and guest name. Lastly, you will be able to select a room type and see the details about the rooms that are available including room number, type, max number of guests, cleaner and cost.

Administration Page:
On the administration page, you will be able to firstly update any active booking discount or check in status. Anyone with admin status would be able to check in a guest as well as update the check in status when the guest arrives. Next, you will be able to delete a booking record when a guest checks out by simply inputting the number. Lastly, bookings that are active but have no room assigned to them must be put into a room, and this will be able to be done by inputting the room number and booking code. This will then move the record into the active bookings section. This page may only be accessed by using the admin, password123 login. 


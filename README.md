Sleepy Me Hotel
===============

Introduction
------------

As a component of the *Web 2.0 &amp; PHP Frameworks (COMP 10125)* course at Mohawk College, we were directed to create a web application for a fictional hotel. The application was to be built in CodeIgniter (version 2.2.0 at the time). The deliverables for this project were split into "milestones," represented on this repo as releases.

CSS & JavaScript Framework
--------------------------

When initializing the project (release [1.0.0][1.0.0]), we were tasked with including a CSS/JavaScript framework of our choice. I initially picked [ZURB's Foundation][foundation], but decided later in the project that I preferred the [Bourbon][bourbon] SASS mixin library and its [Neat][bourbon-neat] grid system. By using Bourbon and Neat, all of the presentational logic is kept in the CSS, which helps to reduce non-semantic clutter (such as presentational `div` tags or classes like `col-3`) in the markup.

Contact Page
------------

One of the first deliverables was a contact page (introduced in [2.0.0][2.0.0], patched in [2.0.1][2.0.1]), with a contact form and an interactive map. CodeIgniter's form and validation libraries were used to build the form, and the map was created using the Google Maps JavaScript API.

Room Management
---------------

Release [3.0.0][3.0.0] centered around creating an administration panel and the ability for administrators to add/edit/remove rooms in the system. Rooms' properties include a name, number, nightly rate, featured image, and description. CKEditor was implemented and configured to allow for rich editing of the description, as well as uploading additional images. Authentication/authorization was not yet implemented, so anonymous users were able to access this "privileged" functionality.

Room Reservation
----------------

After Rooms, the next major component of the application was Reservations. In release [4.0.0][4.0.0], functionality was added to allow site visitors to reserve a room for a given period of time. This functionality was achieved with a multi-step form, again using CodeIgniter's form and validation libraries.

Significant use of AJAX (using jQuery's `$.ajax()` and `$.get()`) is used to provide immediate feedback to the user during the reservation process, e.g. informing them whether or not there are rooms available for the time period they selected.

[Stripe][stripe] was integrated to handle credit card payments.

CodeIgniter's Calendar library was used to generate (server-side) a representation of room availability.

Heavy use of CodeIgniter's session library allows for a smooth, wizard-like feel during the registration process.

The final step of reservation provides a PDF receipt, which is generated using [TCPDF][tcpdf].

Release [5.0.0][5.0.0] introduced a new section to the Administration panel, where administrators could view detailed information concerning a reservation.

Authentication & Authorization
------------------------------

An authentication/authorization system (introduced in [6.0.0][6.0.0]) allows administrators of various privilege levels (frontdesk, manager, owner) to log in through the administration panel and perform actions based on their privilege level. [IonAuth][ionauth] was used as the foundation for this system, with slight modifications to its `auth` controller to redirect the user to the most relevant page for their privilege level.

[1.0.0]: https://github.com/chloereimer/sleepy-me-hotel/tree/1.0.0
[2.0.0]: https://github.com/chloereimer/sleepy-me-hotel/tree/2.0.0
[2.0.1]: https://github.com/chloereimer/sleepy-me-hotel/tree/2.0.1
[3.0.0]: https://github.com/chloereimer/sleepy-me-hotel/tree/3.0.0
[4.0.0]: https://github.com/chloereimer/sleepy-me-hotel/tree/4.0.0
[5.0.0]: https://github.com/chloereimer/sleepy-me-hotel/tree/5.0.0
[6.0.0]: https://github.com/chloereimer/sleepy-me-hotel/tree/6.0.0
[foundation]: http://foundation.zurb.com/
[bourbon]: http://bourbon.io/
[bourbon-neat]: http://neat.bourbon.io/
[stripe]: https://stripe.com/ca
[tcpdf]: http://www.tcpdf.org/
[ionauth]: https://github.com/benedmunds/CodeIgniter-Ion-Auth

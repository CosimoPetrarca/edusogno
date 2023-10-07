Instructions

Creation of a login page
The login page is called "Log-in" in FIGMA. 
Email and password must be entered here to access the profile.
The login information is stored in the "users" database, which is to be created on the basis of the users written below
If the user does not exist or enters an incorrect email or password, return feedback 

Display of a specific field/event once logged in
In the case of a successful login, redirect the user to a personal page on which the first and last name as stated on the Figma is returned.
In addition return to the logged in user the events in which he/she is present in bullet point mode based on the 'events' table

Creating a registration form (for non-registered users)
Once you have pressed the 'Register' button, a registration form appears which, once created, you will need to populate with the following people. There are 4 fields (First Name, Last Name, Email, Password)

Marco, Rossi, ulysses200915@varen8.com ( https://generator.email/ulysses200915@varen8.com ), Edusogno123
Filippo, D’Amelio, qmonkey14@falixiao.com ( https://generator.email/qmonkey14@falixiao.com ), Edusogno?123
Gian Luca, Carta, mavbafpcmq@hitbase.net (https://generator.email/mavbafpcmq@hitbase.net ), EdusognoCiao
Stella, De Grandis, dgipolga@edume.me  ( https://generator.email/dgipolga@edume.me ), EdusognoGia


Changing password with a link sent to the email that leads to a page to reset the password
Insert a Reset Password button and ensure that the new password is saved in the database for the corresponding user


View, Add, Edit and Delete events for registered users (ADMIN ONLY)
Implement the backend logic to view all user’s events in the admin dashboard and by a button the admin can add, edit and delete events.
Implement the PHP code to use an Event class. Each event should be an instance of this class with properties for title, attendees and description.
Implement an EventController class that manages the events list. It should have methods to add, edit, and delete events (ADMIN ONLY). For the layout, use the same one in the registration step
 
BONUS: Send an email when the admin adds or edits events
When an admin adds or edits an event, an email is sent to the attendees

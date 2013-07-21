Ve
==

A easy to use open source Pocket or Read It Later alternative

INSTALLATION
I am hoping you have a LAMP server, in which case put the Ve folder 
somewhere in the web directory. Import the two SQL files, and then edit 
database.php with your connection details.
By default it creates a user 'user' with password 'password'. There is 
no UI yet for changing passwords or signing up (for signing up I thought 
it should be up to the admin to make accounts), so this all needs to be 
done in the DB. I recommend PHPMyAdmin.
In order to add a new one, just click create, enter a username and a 
SHA256 password. The timestamp and id will fill in themselves. I 
recommend this website for SHA256
www.movable-type.co.uk/scripts/sha256.html
Then, just visit the page and log in.

KNOWN BUGS
Logout does not currently work

# BackEndLogin
BackEndLogin, created by TuxSoft Limited <[tuxsoft@tuxsoft.uk](mailto:tuxsoft@tuxsoft.uk "Send a message")> 2017.
BackEndLogin is a PHP plugin designed to allow websites to create a simple and secure login form for a BackEnd web page.  BackEndLogin is compatible with all current stable versions of PHP 5 and 7.

## About
BackEndLogin is designed to provide a simple and secure login service for your website's Back End.  All large websites need an area for a control panel, content management, administrative operations, etc...  BackEndLogin is designed to give this page the extra layer of security needed to keep this section safe from the general public and from potential hackers.  BackEndLogin is a simple and secure login plugin using salted MD5 hashing to secure the password, as well as allowing you to store an infinite number of authenticated users in a database.  One of our aims is simplicity and transparency with our code, to allow your organisation to review and edit your copy of the plugin as needed to fit the requirements of your website.

### Simplicity
In an aim to be as simple and efficient as possible, this plugin consists of only:

| Code            | Amount    | Purpose                                                                                      |
|:--------------- |:--------- |:-------------------------------------------------------------------------------------------- |
| Includes (.inc) | 6 lines   | To hold database login data above the web root.                                              |
| PHP             | 82 lines  | This is the entire security mechanism needed.  It's just that simple!                        |

## Installation
1. Fill in the gaps in DataBaseDetails.inc with your database login details.
2. Save DataBaseDetails.inc above the web root in your server.
3. Create a MySQL database and table.  The table needs to contain the following SQL structure: 
```SQL
CREATE TABLE ExampleLoginTable(ID BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,User VARCHAR(25) NOT NULL,Pass VARCHAR(100) NOT NULL,DateAdded DATE NOT NULL);
```
4. Insert your desired login details using the following SQL structure: 
```SQL
INSERT INTO ExampleLoginTable (User, Pass, DateAdded) VALUES ('USERNAME', 'HASHED-AND-SALTED-PASSWORD', CURDATE() );
```
5. Add your MD5 salt to the space on line 45 of BackEndLogin.php.
6. Add your Back End to the AccessBackEnd function on line 78 of BackEndLogin.php.
7. Save BackEndLogin.php to your web root folder.

## Release Details
This plugin was released on 25th July 2017 under the GNU General Public License v3.0 or later by TuxSoft Limited.  See the LICENSE file for more details.

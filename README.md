Q1. Session Management in This Project
This project uses PHP sessions to manage user authentication
securely. Sessions allow the application to keep track of logged-in
users across multiple pages without requiring them to log in again
every time they navigate.
Every page that interacts with user login status begins with:


1. Starting Sessions:
this means on every page or file session will start on upside for
every file that will be interacted with it.
session_start();
This is required so PHP can:
• Access existing session data
• Create a new session when needed
• Read/write user information stored in $_SESSION


2. Session Creation During Login
• When the user logs in successfully, a new session is created:
example
$_SESSION['user_email'] = $email;

3. Session Creation During SignUp
After the user successfully registers, the system also stores their email in
the session:
$_SESSION['user_email'] = $email;
Although the user is redirected to the login page, the session confirms
that registration was successful.

4. Protecting Pages With Sessions

To prevent unauthorized access, every protected page checks if the
session exists:
This ensures:
• Only logged-in users can view the dashboard or other private pages
• Anyone trying to access pages without logging in is redirected
automatically
example
session_start();
if (!isset($_SESSION['user_email'])) {
 header("Location: login.php");
 exit;
}

5. Logging Out and Destroying Sessions
When the user wants to log out, the session is removed using:
This completely clears the user's session and returns them to the login
page.
Example
session_start();
session_unset();
session_destroy();
header("Location: login.php");

Q2. What Are Cookies?

A cookie is a small piece of data stored directly in the user’s browser.
Examples of what cookies can store:
• Remembered login email
• Shopping cart items

Cookies belong to the client-side, not the server.
Why Cookies Were Not Used in many Project
Many system uses sessions only for authentication.
Sessions are safer because:
• Login data stays on the server
• Cookies can be seen/edited in the browser (less secure)

But this is how cookie can be used:
Example: Save user email for “Remember Me”
if (isset($_POST['remember_me'])) {
 setcookie("saved_email", $email, time() + (86400 * 30), "/");
}
This cookie will now store the email for 30 days.
Reading the cookie on the login page:
if (isset($_COOKIE['saved_email'])) {
 $savedEmail = $_COOKIE['saved_email'];
}
This helps auto-fill the email input.

Also Cookies Secure for the following reason:
• There are Stored in the browser
• Can be modified by the user
• Should NEVER store passwords or sensitive data


Q3. How Authentication Is Secured

This project uses several security measures to protect user accounts and
ensure safe authentication.
Example:

1. Password Hashing
User passwords are never stored in plain text.
During signup:
$hashed = password_hash($password, PASSWORD_DEFAULT);
• password_hash() automatically applies a strong, one-way
hashing algorithm .
• Even if the database is compromised, attackers cannot see real
passwords.

During login, the entered password is checked using:
password_verify($password, $hashed);
This ensures passwords are safely compared without exposing them.

2. Secure User Verification
When logging in:
1. The system checks if the email exists.
2. Then compares the provided password with the hashed one.
3. Only if both match, the user is authenticated.

This prevents:

➢ Login without correct credentials

➢ Bypassing authentication

➢ Direct access to other users' accounts


3. Session-Based Authentication
4. Input Validation

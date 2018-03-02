<?php

//Check if any $_POST has been made
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //Get & Sanitize $_POST Values (Capture all our form data and put them in variables)
    $name      = strip_tags(trim($_POST['name']));
    $email     = filter_var(trim($_POST['email']),FILTER_SANITIZE_EMAIL);
    $message   = trim($_POST['message']);
    $recipient = $_POST['recipient'];
    $subject   = $_POST['subject'];

    //Simple Validation
    if(empty($name) OR empty($message) OR empty($email))
    {
        // Set a 400 ERROR (bad request) response code and exit.
        http_response_code(400);
        echo "Please check your form fields";
        exit;
    }

    //Build Message - In order for the webmaster to see the fields nicely displayed
    $message  = "Name: $name\n";
    $message .= "Email: $email\n\n";
    $message .= "Message: \n$message\n";

    //Build Headers
    $headers  = "From: $name <$email>";

    //Send Email - Notice that your mail function wont run locally unless you install SMTP locally
    if(mail($recipient, $subject, $message, $headers))
    {
        //Set 200 Response (Success)
        http_response_code(200);
        echo "Thank You: Your message has been sent";
    }
    else
        {
            //Set 500 Response (internal server error)
            http_response_code(500);
            echo "Error: There was a problem sending your message";
        }
}
else
    {
        //Set 403 Response (forbidden)
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }
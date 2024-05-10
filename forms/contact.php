<?php
// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'gueyeadamaemmanuel@gmail.com';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (file_exists($php_email_form = '../assets/vendor/php-email-form/validate.php')) {
        include($php_email_form);

        $contact = new PHP_Email_Form();
        $contact->ajax = true;

        $contact->to = $receiving_email_address;
        $contact->from_name = isset($_POST['name']) ? $_POST['name'] : '';
        $contact->from_email = isset($_POST['email']) ? $_POST['email'] : '';
        $contact->subject = isset($_POST['subject']) ? $_POST['subject'] : '';

        // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
        /*
        $contact->smtp = array(
            'host' => 'example.com',
            'username' => 'example',
            'password' => 'pass',
            'port' => '587'
        );
        */

        $contact->add_message(isset($_POST['name']) ? $_POST['name'] : '', 'From');
        $contact->add_message(isset($_POST['email']) ? $_POST['email'] : '', 'Email');
        $contact->add_message(isset($_POST['message']) ? $_POST['message'] : '', 'Message', 10);

        $send_result = $contact->send();
        if ($send_result) {
            echo 'Message sent successfully!';
        } else {
            echo 'Failed to send message. Please try again later.';
        }
    } else {
        echo 'Unable to load the "PHP Email Form" Library!';
    }
} else {
    echo 'Method not allowed!';
}
?>

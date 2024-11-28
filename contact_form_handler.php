<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = filter_input(INPUT_POST, 'first-name', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'last-name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
    $terms = filter_input(INPUT_POST, 'terms', FILTER_VALIDATE_BOOLEAN);

    if ($firstName && $lastName && $email && $message && $terms) {
        
        $filePath = 'submissions.json';
        $existingData = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : [];

       
        $newData = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'phone' => $phone,
            'message' => $message,
            'terms' => $terms
        ];
        $existingData[] = $newData;

        
        file_put_contents($filePath, json_encode($existingData, JSON_PRETTY_PRINT));

       
        $userSubject = "Thank you for contacting us";
        $userMessage = "Dear $firstName $lastName,\n\nThank you for reaching out to us. We have received your message and will get back to you shortly.\n\nBest regards,\nMovie Database Team";
        $userHeaders = "From: no-reply@moviedatabase.com";

        mail($email, $userSubject, $userMessage, $userHeaders);

        
        $adminSubject = "New Contact Form Submission";
        $adminMessage = "New contact form submission:\n\n" . print_r($newData, true);
        $adminHeaders = "From: no-reply@moviedatabase.com";

        $adminEmails = ["dumidu.kodithuwakku@ebeyonds.com", "prabhath.senadheera@ebeyonds.com"];
        foreach ($adminEmails as $adminEmail) {
            mail($adminEmail, $adminSubject, $adminMessage, $adminHeaders);
        }

        
        header("Location: thank_you.php");
        exit();
    } else {
        
        echo "Please fill in all required fields correctly.";
    }
} else {
    echo "Invalid request method.";
}
?>
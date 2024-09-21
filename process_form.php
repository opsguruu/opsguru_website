<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $dob = $_POST['dob'];
    $education = $_POST['education'];
    $field_of_study = $_POST['field_of_study'];
    $institution_name = $_POST['institution_name'];
    $job_title = $_POST['job_title'];
    $company_name = $_POST['company_name'];
    $experience_years = $_POST['experience_years'];
    $experience_description = $_POST['experience_description'];
    $interest_reason = $_POST['interest_reason'];
    $devops_experience = $_POST['devops_experience'];
    $goals = $_POST['goals'];
    $referral_source = $_POST['referral_source'];

    // Email details
    $to = "your-email@example.com"; // Replace with your Gmail address
    $subject = "New DevOps Accelerator Course Application";
    $headers = "From: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Compose email content
    $message = "<h1>New Application Details</h1>";
    $message .= "<p><strong>Email:</strong> $email</p>";
    $message .= "<p><strong>Full Name:</strong> $full_name</p>";
    $message .= "<p><strong>Phone Number:</strong> $phone_number</p>";
    $message .= "<p><strong>Date of Birth:</strong> $dob</p>";
    $message .= "<p><strong>Education Level:</strong> $education</p>";
    $message .= "<p><strong>Field of Study:</strong> $field_of_study</p>";
    $message .= "<p><strong>Institution Name:</strong> $institution_name</p>";
    $message .= "<p><strong>Job Title:</strong> $job_title</p>";
    $message .= "<p><strong>Company Name:</strong> $company_name</p>";
    $message .= "<p><strong>Years of Experience:</strong> $experience_years</p>";
    $message .= "<p><strong>Experience Description:</strong> $experience_description</p>";
    $message .= "<p><strong>Interest Reason:</strong> $interest_reason</p>";
    $message .= "<p><strong>DevOps Experience:</strong> $devops_experience</p>";
    $message .= "<p><strong>Goals:</strong> $goals</p>";
    $message .= "<p><strong>Referral Source:</strong> $referral_source</p>";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "Your application has been submitted successfully and the email was sent!";
    } else {
        echo "There was an error sending the email. Please try again.";
    }

    // Save form data in a CSV file
    $file = fopen("applications.csv", "a"); // Append to the file
    $formData = [
        $email,
        $full_name,
        $phone_number,
        $dob,
        $education,
        $field_of_study,
        $institution_name,
        $job_title,
        $company_name,
        $experience_years,
        $experience_description,
        $interest_reason,
        $devops_experience,
        $goals,
        $referral_source
    ];

    fputcsv($file, $formData); // Write the form data as a new line in the CSV
    fclose($file);

    // Redirect or show a confirmation message
    header("Location: index.html");
    exit();
} else {
    echo "Invalid request method.";
}
?>

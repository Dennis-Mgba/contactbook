<?php

session_start(); // session for sending sucess message to the view

$DB_CONNECTION = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_DATABASE = "contactbook";

// Create database connection
$conn = new mysqli($DB_CONNECTION, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//process form submission

// Create method
if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_num = $_POST['phone_num'];
    $email = $_POST['email'];
    $contact_group = $_POST['contact_group'];
    $note = $_POST['notes'];

    $sql_insert_query = "INSERT INTO contacts (first_name, last_name, phone_num, email, contact_group, notes) VALUES ('$first_name', '$last_name', '$phone_num', '$email', '$contact_group', '$note')";

    if ($conn->query($sql_insert_query) === TRUE) {

        $_SESSION['message'] = "Contact record has been created!";
        $_SESSION['msg_type'] = "success";

        header("Location: /contactbook");
    } else {
        die("Failed to create new contact ");
    }
}


// Edit/Update method
if (isset($_POST['update'])) {
    $contact_id = $_POST['id'];

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_num = $_POST['phone_num'];
    $email = $_POST['email'];
    $contact_group = $_POST['contact_group'];
    $notes = $_POST['notes'];

    $sql_update_query = "UPDATE contacts SET first_name='$first_name', last_name='$last_name', phone_num='$phone_num', email='$email', contact_group='$contact_group', notes='$notes' WHERE id='$contact_id' ";

    if ($conn->query($sql_update_query) === TRUE) {

        $_SESSION['message'] = "Contact record has been updated!";
        $_SESSION['msg_type'] = "info";

        header("Location: /contactbook");
    } else {
        die("Failed to update contact ");
    }
}


// Delete method
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql_delete_query = "DELETE FROM contacts WHERE id=$id";

    if ($conn->query($sql_delete_query) === TRUE) {

        $_SESSION['message'] = "Contact record has been deleted!";
        $_SESSION['msg_type'] = "danger";

        header("Location: /contactbook");
    } else {
        die("Failed to create new contact ");
    }
}

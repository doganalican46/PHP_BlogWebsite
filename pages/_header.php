<?php
session_start();
$title;
$pageTitle = "Homepage";
if (isset($customTitle)) {
    $pageTitle = $customTitle;
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style/main.css">
    <title> <?php echo $pageTitle ?> | Blog Website</title>
</head>

<body>

    <div class="p-5 bg-primary text-white text-center">
        <h1>Blog Website</h1>
    </div>
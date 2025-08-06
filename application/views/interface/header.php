<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        header {
            width: 100%;
            height: 50px;
            /* position:fixed; */
            background-color: #4c93afff;
            color: white;
            padding: 1px;
            text-align: center;
        }
    </style>
</head>
<body>
<header>
    <h3><?php echo $page_title; ?></h3>
</header>
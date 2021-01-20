<?php

    session_start();
    require "../inc/db.php";

    if (isset($_POST['submit']))
    {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

        //Check If Emil Not exists
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        $data = $stmt->fetchObject();


        if ($data)
        {
            $check = password_verify($password, $data->password);
            if ($check)
            {
                 //لو البيانات تمام يبقي هسجل بيانات اليوزر عندي هكذا
                $_SESSION['user_id'] = $data->id;
                $_SESSION['user_name'] = $data->name;
                $_SESSION['user_email'] = $data->email;
                $_SESSION['user_mobile'] = $data->mobile;

                header("location:../index.php");
                die();

            }
            else
            {
                $_SESSION['error'] = "Email Or Password Not Correct";
            }
        }
        else
        {
            $_SESSION['error'] = "Data Not Correct";
        }


    }
    header("location:../login.php");
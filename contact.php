<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.16/tailwind.min.css" />
    <link rel="stylesheet" href="css.css" />
    <title>Contact Us</title>
    <style>
        .container {
           
            padding: 20px;
            text-align: center;
            margin: auto;

        }
        b{
            font-size: 1.5rem;
        }

        textarea {
            border: 2px solid black;
            width: 30rem;
            height: 10rem;
            border-radius: 30px;
        }

        input {
            border: 2px solid black;
            border-radius: 30px;

        }

        .box {
            background-color: #f5f5f5;
            border: 2px solid #ccc;
            border-radius: 5px;
            padding: 20px;
           
            /* text-align: left; */
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        caption,
        h1 {
            text-align: center;
            margin-top: 50px;
            color: black;
            font-size: 2rem;
            color: #990000;
        }

        table {
            margin: 50px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            background-color: #fff;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        table th {
            background-color: #990000;
            color: #fff;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }
          
    button[type="submit"] {
   
        margin: 10px 0;
        padding: 10px;
        width: 15%;
        border: none;
        border-radius: 4px;
        background-color: #990000;
        color: black;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.2s;
        margin-left:5rem;
    }
    </style>
</head>

<body>
    </head>
    <!-- Navigation Bar -->
    <!-- Navigation Bar -->
    <nav class="bg-red-700 p-2 mt-0 w-full">
        <div class="container mx-auto flex flex-wrap items-center">
            <div class="flex w-full md:w-1/2 justify-center md:justify-start text-white font-extrabold">
                <a class="text-white no-underline hover:text-white hover:no-underline" href="#">
                    <span class="text-2xl pl-2">Blood Bank Management System</span>
                </a>
            </div>
            <div class="flex w-full md:w-1/2 justify-center md:justify-end">
                <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block py-2 px-4 text-white font-bold no-underline" href="index.html">HOME</a>
                    </li>
                   
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block text-white no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                            href="AdminLogin.php">ADMIN</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block text-white no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                            href="index.html#learn">LEARN</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block text-white no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                            href="contact.php">CONTACT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="box">
            <h1>Contact Details</h1>
            <p><strong>Admins: </strong>20BCE191 Drashti Panseriya, 20BCE231 Riddhi Prajapati, 20BCE241 Rana Jay </p>
            <p><strong>Institute name:</strong> Nirma University</p>
            <p><strong>Email:</strong>cse_students@nirmauni.ac.in</p>
            <p><strong>Phone Number:</strong>9876543210</p>
            <p><strong>Address :</strong>Sarkhej - Gandhinagar Hwy, Gota, Ahmedabad, Gujarat 382481</p>

        </div>
    </div>
    <div class="container">
        <div class="box">
            <h1>Please Provide your valuable Feedback</h1>
            <form method='post'>
                <b>Email:</b> <input type='text' name='email'><br><br>
                <textarea name='feedback'> </textarea>
                <br>
                <button type='submit'>Submit</button>
                <br>
            </form>

        </div>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Establish a database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //store feedback in database
        $email = $_POST['email'];
        $feedback = $_POST['feedback'];
        $sql = "INSERT INTO `feedback` (`email`,`feedback`) VALUES  ('$email','$feedback')";
        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>



</body>

</html>
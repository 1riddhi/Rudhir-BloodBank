<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nameerr = $emailerr = $gendererr = $ageerr = $addresserr = $stateerr = $pincodeerr = $mobilenoerr = $bloodgrouperr = $usernameerr = $passworderr = $confirmpassworderr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $rj = 0;

    $name = $email = $gender = $age = $address = $state = $pincode = $mobileno = $bloodgroup = $username = $password = $confirmpassword = "";





    if (empty($_POST["name"])) {
        $nameerr = "Name is required";
        $rj = 1;
    } else if (!preg_match("/^[a-zA-Z\s]*$/", $_POST["name"])) {
        $nameerr = "Only alphabets and whitespace are allowed.";
        $rj = 1;
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["email"])) {
        $emailerr = "Email is required";
        $rj = 2;
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailerr = "Invalid email format";
        $rj = 2;
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["gender"])) {
        $gendererr = "Gender is required";
        $rj = 3;
    } else {
        $gender = test_input($_POST["gender"]);
    }

    if (empty($_POST["age"])) {
        $ageerr = "Age is required";
        $rj = 4;
    } else if (!preg_match("/^[1-9][0-9]*$/", $_POST["age"])) {
        $ageerr = "Invalid age";
        $rj = 4;
    } else {
        $age = test_input($_POST["age"]);
    }

    if (empty($_POST["address"])) {
        $addresserr = "address is required";
        $rj = 5;
    } else {
        $address = test_input($_POST["address"]);
    }

    if (empty($_POST["state"])) {
        $stateerr = "State is required";
        $rj = 101;
    } else {
        $state = test_input($_POST["state"]);
    }

    if (empty($_POST["pincode"])) {
        $pincodeerr = "pincode is required";
        $rj = 6;
    } else if (!preg_match("/^[1-9][0-9]{5}$/", $_POST["pincode"])) {
        $pincodeerr = "Invalid pincode";
        $rj = 6;
    } else {
        $pincode = test_input($_POST["pincode"]);
    }

    if (empty($_POST["mobileno"])) {
        $mobilenoerr = "mobileno is required";
        $rj = 7;
    } else if (!preg_match("/^[1-9][0-9]{9}$/", $_POST["mobileno"])) {
        $mobilenoerr = "Invalid mobile number";
        $rj = 7;
    } else {
        $mobileno = test_input($_POST["mobileno"]);
    }

    if (empty($_POST["bloodgroup"])) {
        $bloodgrouperr = "bloodgroup is required";
        $rj = 8;
    } else {
        $bloodgroup = test_input($_POST["bloodgroup"]);
    }

    if (empty($_POST["username"])) {
        $usernameerr = "username is required";
        $rj = 9;
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $_POST["username"])) {
        $usernameerr = "Only alphabets and digits are allowed.";
        $rj = 9;
    } else {
        $username = test_input($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $passworderr = "Password is required";
        $rj = 10;
    } else {
        $password = test_input($_POST["password"]);
        // Check if password meets complexity requirements (e.g. contains at least one uppercase, one lowercase, one digit, and one special character)
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
            $passworderr = "Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one number, and one special character";
            $rj = 10;
        }
    }

    if (empty($_POST["confirmpassword"])) {
        $confirmpassworderr = "Confirm Password is required";
        $rj = 11;
    } else {
        $confirmpassword = test_input($_POST["confirmpassword"]);
        // Check if password and confirm password fields match
        if ($confirmpassword !== $password) {
            $confirmpassworderr = "Passwords do not match";
            $rj = 11;
        }
    }

    // echo "$rj";
    if ($rj == 0) {
        // echo "hi";
        // echo "$rj";
        $sql = "INSERT INTO tb (name, email, gender, age, address, state, pincode, mobileno, bloodgroup, username, password) VALUES ('$name', '$email', '$gender', '$age', '$address','$state' ,'$pincode', '$mobileno', '$bloodgroup', '$username', '$password')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully. ";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
} else {

    // Repopulate form data if available
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $age = isset($_POST["age"]) ? $_POST["age"] : "";
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
    $address = isset($_POST["address"]) ? $_POST["address"] : "";
    $state = isset($_POST["state"]) ? $_POST["state"] : "";
    $pincode = isset($_POST["pincode"]) ? $_POST["pincode"] : "";
    $mobileno = isset($_POST["mobileno"]) ? $_POST["mobileno"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $bloodgroup = isset($_POST["bloodgroup"]) ? $_POST["bloodgroup"] : "";
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$conn->close();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.16/tailwind.min.css" />
    <title>Donor Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .error {
            color: #FF0000;
        }

        .form-center {
            display: flex;
            justify-content: center;
        }
    </style>

</head>

<body>
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
                        <a class="inline-block py-2 px-4 text-white font-bold no-underline" href="in.html">HOME</a>
                    </li>
                    
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block text-white no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                            href="AdminLogin.php">ADMIN</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block text-white no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                            href="in.html#learn">LEARN</a>
                    </li>
                    <li class="flex-1 md:flex-none md:mr-3">
                        <a class="inline-block text-white no-underline hover:text-gray-200 hover:text-underline py-2 px-4"
                            href="contact.php">CONTACT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="box-border h-320 w-200 p-4 my-10 mx-32 border-4 rounded-xl">

        <p class="font-bold text-lg text-center text-red-700">
            Donor Registration
        </p>
        <form method="POST" action="registration.php">
            <div class="m-4">
                <label class="text-gray-700 font-bold ">
                    Name
                </label>
                <input
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="name" name="name" type="text" placeholder="name" value="<?php echo $name; ?>">

                <span class="error">
                    <?php echo $nameerr; ?>
                </span>
            </div>

            <div class="m-4">
                <label class="text-gray-700 font-bold ">
                    Age
                </label>
                <input
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="age" name="age" type="text" placeholder="20" value="<?php echo $age; ?>">
                <span class="error">
                    <?php echo $ageerr; ?>
                </span>
            </div>

            <div class="m-4">
                <label class="text-gray-700 font-bold ">
                    Email
                </label>
                <input
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="email" name="email" type="text" placeholder="20bce241@nirmauni.ac.in"
                    value="<?php echo $email; ?>">
                <span class="error">
                    <?php echo $emailerr; ?>
                </span>
            </div>

            <div class="m-4">
                <label class="text-gray-700 font-bold ">
                    Gender
                </label> <br>
                <input id="gender" name="gender" value="male" type="radio" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'male') {
                    echo 'checked';
                } ?>>Male <br>

                <input id="gender" name="gender" value="female" type="radio" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'female') {
                    echo 'checked';
                } ?>>Female <br>

                <input id="gender" name="gender" value="other" type="radio" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'other') {
                    echo 'checked';
                } ?>>Other <br>

                <span class="error">
                    <?php echo $gendererr; ?>
                </span>
            </div>

            <div class="m-4">
                <label class="text-gray-700 font-bold ">
                    Address
                </label>
                <textarea
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="address" id="address" cols="30"
                    rows="3"><?php if (isset($_POST['address'])) {
                        echo $_POST['address'];
                    } ?></textarea>

                <span class="error">
                    <?php echo $addresserr; ?>
                </span>
            </div>

            <script src="blood_camp_register.js"></script>
            <div class="m-4">
                <label class="text-gray-700 font-bold ">
                    State
                </label>

                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-700"
                    name="state" id="state" required><span class="error">
                        <?php echo $stateerr; ?>
                    </span>
                    <option value="">Select State</option>

                    <script language="javascript">
                        for (var hi = 0; hi < states.length; hi++)
                            document.write("<option value=\"" + states[hi] + "\">" + states[hi] + "</option>");
                    </script>
                </select>

                <span class="error">
                    <?php echo $stateerr; ?>
                </span>

            </div>

            <div class="m-4">
                <label class="text-gray-700 font-bold ">
                    Pin Code
                </label>
                <input
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="pincode" name="pincode" type="text" placeholder="394335" value="<?php echo $pincode; ?>">

                <span class="error">
                    <?php echo $pincodeerr; ?>
                </span>
            </div>

            <div class="m-4">
                <label class="text-gray-700 font-bold ">
                    Mobile Number
                </label>
                <input
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="mobileno" name="mobileno" type="text" placeholder="1234567890" value="<?php echo $mobileno; ?>">

                <span class="error">
                    <?php echo $mobilenoerr; ?>
                </span>
            </div>

            <div class="m-4">
                <label class="text-gray-700 font-bold">
                    Blood Group
                </label>
                <select
                    class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-700"
                    id="bloodgroup" name="bloodgroup">
                    <option value="">--Select Blood Group--</option>
                    <option value="A+" <?php if ($bloodgroup == 'A+')
                        echo 'selected'; ?>>A+</option>
                    <option value="A-" <?php if ($bloodgroup == 'A-')
                        echo 'selected'; ?>>A-</option>
                    <option value="B+" <?php if ($bloodgroup == 'B+')
                        echo 'selected'; ?>>B+</option>
                    <option value="B-" <?php if ($bloodgroup == 'B-')
                        echo 'selected'; ?>>B-</option>
                    <option value="AB+" <?php if ($bloodgroup == 'AB+')
                        echo 'selected'; ?>>AB+</option>
                    <option value="AB-" <?php if ($bloodgroup == 'AB-')
                        echo 'selected'; ?>>AB-</option>
                    <option value="O+" <?php if ($bloodgroup == 'O+')
                        echo 'selected'; ?>>O+</option>
                    <option value="O-" <?php if ($bloodgroup == 'O-')
                        echo 'selected'; ?>>O-</option>
                </select>

                <span class="error">
                    <?php echo $bloodgrouperr; ?>
                </span>
            </div>


            <div class="m-4">
                <label class="text-gray-700 font-bold ">
                    User Name
                </label>
                <input
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="username" name="username" type="text" placeholder="xyz@123" value="<?php echo $username; ?>">

                <span class="error">
                    <?php echo $usernameerr; ?>
                </span>
            </div>

            <div class="m-4">
                <label class="text-gray-700 font-bold ">
                    Password
                </label>
                <div class="relative">
                    <input
                        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" name="password" type="password">
                    <input class="absolute right-0 top-0 mt-3 mr-4" type="checkbox" onclick="togglePasswordVisibility()"
                        title="Show password">
                </div>

                <span class="error">
                    <?php echo $passworderr; ?>
                </span>
            </div>

            <div class="m-4">
                <label class="text-gray-700 font-bold ">
                    Confirm Password
                </label>
                <input
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="confirmpassword" name="confirmpassword" type="password">

                <span class="error">
                    <?php echo $confirmpassworderr; ?>
                </span>
            </div>

            <script>
                function togglePasswordVisibility() {
                    var passwordInput = document.getElementById("password");
                    if (passwordInput.type === "password") {
                        passwordInput.type = "text";
                    } else {
                        passwordInput.type = "password";
                    }
                }
            </script>


            <div class="m-4 flex justify-center">
                <button
                    class=" bg-red-700 hover:bg-red-400 text-white font-bold p-2 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Registration
                </button>
            </div>
        </form>
    </div>
</body>

</html>
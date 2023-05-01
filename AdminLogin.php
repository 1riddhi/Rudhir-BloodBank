<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username = $password = "";
$usernameerr = $passworderr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  if (empty($_POST["password"])) {
    $passworderr = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
  }

  if (empty($_POST["username"])) {
    $usernameerr = "Username is required";
  } else {
    $username = test_input($_POST["username"]);
  }

  if ($usernameerr == "" && $passworderr == "") {
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
      // Successful login
      header("Location: admin.php");
      exit();

    } else {

      echo "Invalid username or password";
    }
  }

}

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.16/tailwind.min.css" />
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

  <div class="flex justify-center align-middle">
    <div class="box-border h-320 w-320 p-4 my-20  border-4 rounded-xl">

      <p class="font-bold text-lg text-center">
        Admin Login
      </p>
      <form method="POST">
        <div class="m-4">
          <label class="text-black-700 font-bold ">
            Username
          </label>
          <input
            class="appearance-none border rounded w-full py-2 px-3 text-red-700 leading-tight focus:outline-none focus:shadow-outline"
            id="username" name="username" type="text" placeholder="username">
          <span class="error">
            <?php echo $usernameerr; ?>
          </span>
        </div>
        <div class="m-4">
          <label class="text-black-700 font-bold mb-2">
            Password
          </label>
          <input
            class="appearance-none border rounded w-full py-2 px-3 text-red-700 leading-tight focus:outline-none focus:shadow-outline"
            id="password" name="password" type="password" placeholder="Password">
          <span class="error">
            <?php echo $passworderr; ?>
          </span>
        </div>
        <div class="m-4 flex justify-center">
          <button
            class=" bg-red-700 hover:bg-red-700 text-white font-bold p-2 rounded focus:outline-none focus:shadow-outline"
            type="submit">
            Sign In
          </button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
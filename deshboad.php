

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.16/tailwind.min.css" />
    <link rel="stylesheet" href="css.css" />
    <title>Admin Portal</title>
  
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        caption {
            text-align: center;
            margin-top: 50px;
            color: #990000;
            font-size: 3rem;
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
    </style>
</head>

<body>

<script>
    
    
    function updateDatabase(x,y) {
        console.log("called");
      
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log("Database updated successfully!");
        }
      };
      
      xhttp.open("POST", "update.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      if(x.checked){
        xhttp.send("email=" + y+ "&available=" + 1);
      }
      else{
        xhttp.send("email=" + y+ "&available=" + 0);
      
    }
}
    </script>
    
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
                        <a class="inline-block py-2 px-4 text-white font-bold no-underline" href="logout.php">LOG-OUT</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <?php
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



    $conn = mysqli_connect("localhost", "root", "", "db");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    session_start(); 
if(isset($_SESSION['username'])){
    $un= $_SESSION['username'];
    // echo "yes $un";
}
else{
    exit();
}
    
    $sql = "SELECT * FROM tb where username='$un'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<caption>Donors Data</caption>";
        echo "<tr><th>name</th><th>email</th><th>gender</th><th>age</th><th>address</th><th>pincode</th><th>mobileno</th><th>bloodgroup</th><th>username</th><th>Available</th></tr>";

        while ($row = $result->fetch_assoc()) {
            $x=$row["email"];
            echo '<tr><td>' . $row["name"] . '</td><td>' . $row["email"] . '</td><td>' . $row["gender"] . '</td><td>' . $row['age'] .'</td><td>' . $row["address"] . '</td><td>' . $row["pincode"] .'</td><td>' . $row['mobileno'] .'</td><td>' . $row['bloodgroup'] . '</td><td>' . $row["username"] .'</td>';
            echo "<td><input type='checkbox' name='checkbox' value='1' onclick='updateDatabase(this,\"$x\")'";
            if ($row["available"]) {
                echo 'checked';
            }
            echo '></td>';

            }

        echo "</table>";

    } else {
        echo "<p>No results found.</p>";
    }


    
     echo "<br><br><br>";
    
    // Close the database connection
    $conn->close();

    ?>



</body>

</html>
<?php

session_start();
?>

<html>

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.16/tailwind.min.css" />
  <style>
    body {
      font-family: Arial, sens-sarif;

    }

    .error {
      color: #FF0000;
    }

    .form-center {
      padding: 40px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .para {
      margin-top: 50px;
      color: #990000;
    }

    form {
      padding: 20px;
      padding-top: 50px;
      border-radius: 20px;
      background-color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 65px;
      font-family: Arial, sans-serif;
      width: 55%;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    label {
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="date"],
    select {
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 4px;
      font-weight: bold;
      font-size: 16px;
      border: 1px solid #990000;
      width: 80%;
      color: #333;
      background-color: #f5f5f5;
      transition: border-color 0.2s;
      font-size: 16px;
    }



    input[type="submit"] {
      background-color: #990000;
      color: white;
      border: none;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.2s;
    }

    input[type="submit"]:hover {
      background-color: #b30000;
    }
    h1{
      font-size: 2rem;
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
  <?php

  $orgtypeerr = $orgemailerr = $orgnoerr = $coorgnoerr = $stateerr = $districterr = $dateerr = $campnameerr = $campadderr = " ";
  $orgtype = $organizename = $orgemail = $orgname = $orgno = $coorgname = $coorgno = $campname = $campadd = $state = $district = $remark = $date = " ";

  $flag=0;


  if (isset($_POST['submit'])) {

    if (!empty($_POST["orgtype"]))
      $orgtype = $_POST["orgtype"];
    if (!empty($_POST["organizename"]))
      $organizename = $_POST["organizename"];
    if (!empty($_POST["orgname"]))
      $orgname = $_POST["orgname"];
    if (!empty($_POST["orgno"]))
      $orgno = $_POST["orgno"];
    if (!empty($_POST["orgemail"]))
      $orgemail = $_POST["orgemail"];
    if (!empty($_POST["coorgname"]))
      $coorgname = $_POST["coorgname"];

    if (!empty($_POST["campname"]))
      $campname = $_POST["campname"];
    if (!empty($_POST["campadd"]))
      $campadd = $_POST["campadd"];
    if (!empty($_POST["state"]))
      $state = $_POST["state"];

    if (!empty($_POST["district"]))
      $district = $_POST["district"];
    if (!empty($_POST["date"]))
      $date = $_POST["date"];
    if (!empty($_POST["remark"]))
      $remark = $_POST["remark"];


  }


  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["orgtype"])) {
      $orgtypeerr = "Organization Type is required";
    } else {
      $orgtype = test_input($_POST["orgtype"]);
    }

    if (!empty($_POST["organizename"])) {
      $organizename = test_input($_POST["organizename"]);
    }
    if (!empty($_POST["orgname"])) {
      $orgname = test_input($_POST["orgname"]);
    }

    if (empty($_POST["orgno"])) {
      $orgnoerr = "Phone Number is required";
    } else {
      if (preg_match("/^[1-9][0-9]{9}$/", $_POST["orgno"])) {
        $orgno = test_input($_POST["orgno"]);
      } else {
        $orgnoerr = "Invalid Phone Number";
      }

    }


    if (empty($_POST["orgemail"])) {
      $orgemailerr = " ";
    } else {
      if (filter_var(test_input($_POST["orgemail"]), FILTER_VALIDATE_EMAIL)) {
        $orgemail = $_POST["orgemail"];
      } else {
        $orgemailerr = "Invalid Email";
      }
    }


    if (!empty($_POST["coorgname"])) {
      $coorgname = test_input($_POST["coorgname"]);
    }

    if (!empty($_POST["coorgno"])) {
      if (preg_match("/^[1-9][0-9]{9}$/", $_POST["coorgno"])) {
        $coorgno = (int) test_input($_POST["coorgno"]);
      } else {
        $coorgnoerr = "Invalid Phone Number";
      }

    }

    if (empty($_POST["campname"])) {
      $campnameerr = "Camp Name Required";
    } else {
      $campname = test_input($_POST["campname"]);
    }


    if (empty($_POST["campadd"])) {
      $campadderr = "Camp Address Required";
    } else {
      $campadd = test_input($_POST["campadd"]);
    }


    if (empty($_POST["state"])) {
      $stateerr = "State is required";
    } else {
      $state = test_input($_POST["state"]);

    }


    if (empty($_POST["district"])) {
      $districterr = "District is required";
    } else {
      $district = test_input($_POST["district"]);

    }

    if (empty($_POST["date"])) {
      $dateerr = "Date Required";
    } else {
      $opening_date = new DateTime($_POST["date"]);
      $current_date = new DateTime();

      if ($opening_date <= $current_date) {
        $dateerr = "Only Future Date Is Valid";
      } else {
        $date = $_POST["date"];
        $dateerr = " ";
      }
    }

    if (!empty($_POST["remark"])) {
      $remark = test_input($_POST["remark"]);
    }

    $flag = 0;
    if ($orgtypeerr = " " && $orgemailerr == " " && $orgnoerr == " " && $coorgnoerr == " " && $stateerr == " " && $districterr == " " && $dateerr == " ") {
      $flag = 1;
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


  <script src="blood_camp_register.js"></script>



  <div class="form-center">
    <div class="para">
      <h1> <b>BLOOD DONATION CAMP REGISTRATION FORM </b></h1>
    </div>
    <form name="form" id="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

      Organization Type: <select name="orgtype" required>
        <option value="">Select One</option>
        <option value="Sewa hi Sangathan" <?php if ($orgtype == "Sewa hi Sangathan") {
          echo "selected";
        } ?>>Sewa hi
          Sangathan- Health Volunteers</option>
        <option value="Terapath Yuvak Parishad" <?php if ($orgtype == "Terapath Yuvak Parishad") {
          echo "selected";
        } ?>>
          Terapanth Yuvak Parishad</option>
        <option value="Red Cross" <?php if ($orgtype == "Red Cross") {
          echo "selected";
        } ?>>Red Cross</option>
        <option value="RWA" <?php if ($orgtype == "RWA") {
          echo "selected";
        } ?>>RWA</option>
        <option value="others" <?php if ($orgtype == "others") {
          echo "selected";
        } ?>>others</option>
      </select><span class="error">*
        <?php echo $orgtypeerr; ?>
      </span>
      <br><br>
      Organization Name: <input type="text" name="organizename" value="<?php echo $organizename; ?> "><span
        class="error">*</span>
      <br><br>
      Organizer Name: <input type="text" name="orgname" value="<?php echo $orgname; ?>" required><span
        class="error">*</span>
      <br><br>
      Organizer Mobile No.: <input type="text" name="orgno" value="<?php echo $orgno; ?>" required><span class="error">*
        <?php echo $orgnoerr; ?>
      </span>
      <br><br>
      Organizer Email Id: <input type="text" name="orgemail" value="<?php echo $orgemail; ?>" required><span
        class="error">*
        <?php echo $orgemailerr; ?>
      </span>
      <br><br>
      Co-Organizer Name: <input type="text" name="coorgname" value="<?php echo $coorgname; ?>">
      <br><br>
      Co-Organizer Mobile No.: <input type="text" name="coorgno" value="<?php echo $coorgno; ?>"><span class="error">
        <?php echo $coorgnoerr; ?>
      </span>
      <br><br>
      Camp Name: <input type="text" name="campname" value="<?php echo $campname; ?>"><span class="error">*
        <?php echo $campnameerr; ?>
      </span>
      <br><br>
      Camp Address: <input type="text" name="campadd" value="<?php echo $campadd; ?>" required><span class="error">*
        <?php echo $campadderr; ?>
      </span>
      <br><br>
      State: <select name="state" id="state" onchange="populate(this.id,'district')" required><span class="error">*
          <?php echo $stateerr; ?>
        </span>
        <option value="">Select State</option>

        <script language="javascript">

          for (var hi = 0; hi < states.length; hi++)
            document.write("<option value=\"" + states[hi] + "\">" + states[hi] + "</option>");
        </script>
      </select>
      <span class="error">*
        <?php echo $stateerr; ?>
      </span>
      <br><br>
      District: <select name="district" id="district" required>
        <option value="">Select District</option>
        <script>
          function populate(s1, s2) {

            var s1 = document.getElementById(s1);
            var s2 = document.getElementById(s2);
            var optionArray;

            s2.innerHTML = "";
            var optionArray = districts[s1.value];


            for (var option in optionArray) {
              var newoption = document.createElement("option");
              newoption.value = optionArray[option];
              newoption.innerHTML = optionArray[option];
              s2.options.add(newoption);
            }
          }
        </script>
      </select>
      <span class="error">*
        <?php echo $districterr; ?>
      </span>

      <br><br>
      Camp Propose Date: <input type="date" name="date" value="<?php echo $date; ?>"><span class="error" required>*
        <?php echo $dateerr; ?>
      </span>
      <br><br>
      Remarks:<input type="text" name="remark" value="<?php echo $remark; ?>">
      <br><br>
      <input type="submit" name="submit" value="Submit">


    </form>

  </div>


</body>

<?php
if($flag){
  $servername = "localhost";
  $username = "username";
  $password = "";
  $dbname = "db";

  $conn = mysqli_connect("localhost", "root", "", $dbname);
  //   $sql="INSERT INTO `blood_camp` (`Sr. No`, `Organization Type`, `Organization Name`, `Organizer Name`, `Organizer Mobile No.`, `Organizer Email Id`, `Co-Organizer Name`, `Co-Organizer Mobile No.`, `Camp Name`, `Camp Address`, `State`, `District`, `Camp Propose Date`, `Remarks`) VALUES ( '','$orgtype', '$organizename', '$orgname', '$orgno', '$orgemail', '$coorgname', '$coorgno', '$campname', '$campadd', '$state', '$district', '$date', '$remark')";
  $sql = "INSERT INTO `camp` (`Organization_Type`, `Organization_Name`, `Organizer_Name`, `Organizer_Mobile_No`, `Organizer_Email_Id`, `Co-Organizer_Name`, `Co-Organizer_Mobile_No`, `Camp_Name`, `Camp_Address`, `state`, `district`, `date`) VALUES  ('$orgtype', '$organizename', '$orgname', '$orgno', '$orgemail', '$coorgname', '$coorgno', '$campname', '$campadd', '$state', '$district', '$date')";
  if ($conn->query($sql) === TRUE) {
    echo "<center>";
    echo "Camp Registered Successfully !!";
    echo "<br><br><br>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  }  

?>

</html>
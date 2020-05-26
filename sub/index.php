<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS myDB";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
roll_number INT(9) NOT NULL UNIQUE,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

if(isset($_POST['submit']))
{
  $first_name=$_POST['first_name'];
  $last_name=$_POST['last_name'];
  $roll_number=$_POST['roll_number'];
  $query = "SELECT count(*) as allcount FROM MyGuests WHERE roll_number='".$roll_number."'";
  $result = mysqli_query($conn,$query);
  $row = mysqli_fetch_array($result);
  $allcount = $row['allcount'];
  if ($first_name!=null&&$first_name!=null&&$last_name!=null&&$roll_number!=0) {
    if ($allcount==0) {
      $sql = "INSERT INTO MyGuests (firstname, lastname, roll_number)
      VALUES ('$first_name', '$last_name', '$roll_number')";
    }
    else{
      echo '<script type="text/javascript">
      alert("given roll number exists in database");
    </script>'; 
    }
  }
else{
  echo '<script type="text/javascript">
  alert("enter valid credentials");
</script>'; 
}
 
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
$conn->close();
?>
<html>
<link rel="stylesheet" type="text/css" href="index.css">
<link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
<script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
<script>AOS.init();</script>
<body>
  <div style="top:20%" data-aos="fade-up">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <input type="text" name="first_name" placeholder="first name">
      <input type="text" name="last_name" placeholder="last name">
      <input type="number" name="roll_number" placeholder="roll number">
      <input type="submit" name="submit">
    </form> 
  </div>
<div>
  <table>
    <tr>
      <th>first name</th>
      <th>last name</th>
      <th> roll number </th>
      <th> added on</th>
    </tr>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "myDB");
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT firstname, lastname, roll_number,reg_date FROM MyGuests";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    // output data of each row
    $counter=0;
    while($row = $result->fetch_assoc()) {
      $counter=$counter+1;
      if($counter%2==0){    echo "<tr data-aos='fade-left'><td>" . $row["firstname"]. "</td><td>" . $row["lastname"] . "</td><td>". $row["roll_number"] . "</td><td>". $row["reg_date"] . "</td></tr>";}
      else{    echo "<tr data-aos='fade-right'><td>" . $row["firstname"]. "</td><td>" . $row["lastname"] . "</td><td>". $row["roll_number"] . "</td><td>". $row["reg_date"] . "</td></tr>";}
    }
    } else { echo "0 results"; }
    $conn->close();
    ?>
  </table>
</div>
</body>
<html>


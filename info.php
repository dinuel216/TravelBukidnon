<?php
include_once('infop.php');

$result = null; // Initialize $result as null

function get_place_info($db, $place_name) {
    $query = "SELECT * FROM `information` WHERE pname='$place_name'";
    $result = mysqli_query($db, $query);
    if (!$result) {
        die("Query Failed: " . mysqli_error($db));
    }
    return $result;
}

if(isset($_POST['goa'])) {
    $result = get_place_info($db, 'MonasteryBuk');
}
if(isset($_POST['kerala'])) {
    $result = get_place_info($db, 'Communal Ranch');
}
if(isset($_POST['mysore'])) {
    $result = get_place_info($db, 'MggResorts');
}
if(isset($_POST['ladakh'])) {
    $result = get_place_info($db, 'Dahilayan');
}
if(isset($_POST['agra'])) {
    $result = get_place_info($db, 'KampoUno');
}
if(isset($_POST['india_gate'])) {
    $result = get_place_info($db, 'PineRidg');
}
if(isset($_POST['hampi'])) {
    $result = get_place_info($db, 'Cinco');
}
if(isset($_POST['rajasthan'])) {
    $result = get_place_info($db, 'WaigSpring');
}
if(isset($_POST['manali'])) {
    $result = get_place_info($db, 'HighlandPar.');
}
if(isset($_POST['srinagar'])) {
    $result = get_place_info($db, 'PicoSpring');
}
if(isset($_POST['amritsar'])) {
    $result = get_place_info($db, 'alalumfalls');
}
if(isset($_POST['jogfalls'])) {
    $result = get_place_info($db, 'CEDARS');
}
if(isset($_POST['search_p'])) {
    $search = $_POST['search_p'];
    $result = get_place_info($db, $search);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/info.css">
    <title>Information</title>
</head>
<body>
    <div class="main">
        <ul>
          <ul class="list">
            <li class="logo"><a href="mainPage.html"><img src="earth-globe.png" alt="Logo" style="width:36px;height:36px"></a></li>
            <div class="search">
                <form method="POST" action="info.php">
                  <input type="text" name="search_p" placeholder="Search.." size="50">
              
                  <input type="image" name="submit_p" src="search_icon.png" alt="Search image" style="width:22;height:22; margin-left: 35px;">
                </form>
            </div>
          </ul>
          <ul class="list2">
            <li><a href="mainPage.html">Home</a></li>
            <li><a id="long" href="destination.html">Destination</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="index.html">Logout</a></li>
          </ul>
        </ul>
    </div>
    <div class="hedder">
        <h1>Place Information</h1>
    </div>
    <div class="container">
        <div class="description-container" style="border: 1px solid black;">
            <div class="box1">
                <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        while($rows = mysqli_fetch_assoc($result)) {
                ?>
                <img src="<?php echo $rows['pi_main']; ?>" alt="Image" style="width: auto;height: 302px;">
            </div>
            <div class="description">
                <h1><?php echo $rows['pname']; ?></h1>
                <p style="text-align: justify;"><?php echo $rows['pdescription']; ?></p>
            </div>
            
        </div>
        <div class="image-container" style="border: 1px solid black">
            <div class="box">
                <div class="imgBox">
                  <img src="<?php echo $rows['pi1']; ?>" alt="Image" style="width: auto;height: 270px;">
                </div>
            </div>
          <div class="box">
            <div class="imgBox">
              <img src="<?php echo $rows['pi2']; ?>" alt="Image" style="width: auto;height: 270px;">
            </div>
          </div>
          <div class="box">
            <div class="imgBox">
              <img src="<?php echo $rows['pi3']; ?>" alt="Image" style="width: auto;height: 270px;">
            </div>
                <?php
                        }
                    } else {
                        echo "<p>No information found for the selected place.</p>";
                    }
                ?>
          </div>
        </div>
    </div>
</body>
</html>

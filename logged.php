<?php  
session_start(); // Start the session

// Check if the 'id' cookie exists
if (array_key_exists("id", $_COOKIE)) {
    // Set session 'id' from cookie
    $_SESSION['id'] = $_COOKIE['id'];
}

// Check if the user is logged in
if (array_key_exists("id", $_SESSION)) {
    include("connection.php");
    $query="SELECT diary FROM `users` WHERE id='".mysqli_real_escape_string($link,$_SESSION['id'])."'LIMIT 1";
    $row=mysqli_fetch_array(mysqli_query($link,$query));
    $diaryContent= $row['diary'];

} else {
    // Only redirect if the user is NOT logged in
    header("Location: diary.php");
    exit(); // Ensure no further code is executed after redirection
}
?>
<?php
include("header.php");
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar fixed-top">
  <a class="navbar-brand" href="#">Secret Diary</a>
<div class="form-inline float-xs-right">
   <a href="diary.php? logout=1">  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log out</button></a> 
  </div>
</nav>
<div class="container-fluid">
    <textarea class="form-control"  id="diary">
        <?php echo $diaryContent;  ?>
    </textarea>
</div>

<?php
include("footer.php");
?>

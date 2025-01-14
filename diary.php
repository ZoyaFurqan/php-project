<?php 
include("header.php");   
include("footer.php"); ?>
<body>
    <div class="container" id="homepagecontainer">
        <h1>Secret Diary</h1>
        <p>Store your thoughts permanently and securely</p>
        <div>
    <?php  
    if (!empty($error)) {
        echo "<div class='alert alert-danger' role='alert'>" . htmlspecialchars($error) . "</div>";
    }
    ?>
</div>

        <form method="post" id="sign-up">
            <p>Interested? Sign Up Now</p>
            <fieldset class="form-group">
                <input type="email" name="email" placeholder="Email" class="form-control "  placeholder="EMAIL" >
            </fieldset>
            <fieldset class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control"  placeholder="PASSWORD">
            </fieldset>
            <label><input type="checkbox" name="stayLoggedIn" value="1"> Stay logged in</label>
            <input type="hidden" name="Signup" value="1">
            <input type="submit" name="submit" value="Sign up" class="btn btn-success">
            <p><a href="#" class="showHideForm">Log in</a></p> 
        </form>

        <form method="post" id="log-in">
            <p>Log in </p>
            <fieldset class="form-group">
                <input type="email" name="email" placeholder="Email" class="form-control"    placeholder="EMAIL">
            </fieldset>
            <fieldset class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control"    placeholder="PASSWORD">
            </fieldset>
            <label><input type="checkbox" name="stayLoggedIn" value="1"> Stay logged in</label>
            <input type="hidden" name="Signup" value="0">
            <input type="submit" name="submit" value="Log In" class="btn btn-success">
            <p><a href="#" class="showHideForm">Sign Up</a></p> 
        </form>
    </div>
    
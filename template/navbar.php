<?php session_start(); ?>
<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="#">SLMC System</a>

    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
        aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <?php
            if (isset($_SESSION['role'])) {
        ?>

        <ul class="navbar-nav mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="vieworders.php">View orders<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="viewparts.php">View parts<span class="sr-only">(current)</span></a>
            </li>

            <?php
                if ($_SESSION['role'] == "admin") {
            ?>

            <li class="nav-item active">
                <a class="nav-link" href="addpart.php">Add part<span class="sr-only">(current)</span></a>
            </li>

            <?php 
                } else { 
            ?>

            <li class="nav-item active">
                <a class="nav-link" href="placeorder.php">Place order<span class="sr-only">(current)</span></a>
            </li>

            <?php 
                } 
            ?>
        </ul>

        <?php 
            } 
        ?>

        <form class="form-inline ml-auto my-2 my-lg-0">

            <?php
                if (isset($_SESSION['role'])) {
            ?>

            <span class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Hello, <?php echo $_SESSION['username'] ?></a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
                    <a class="dropdown-item" href="profile.php">View profile</a>
                    <a class="dropdown-item" href="signout.php">Sign out</a>
                </div>
            </span>

            <?php 
                } else {
            ?>

            <a href="login.html">
                <button type="button" class="btn btn-toolbar">Sign In</button>
            </a>

            <a href="register.html">
                <button type="button" class="btn btn-toolbar">Sign Up</button>
            </a>

            <?php 
                } 
            ?>
        </form>
    </div>
</nav>
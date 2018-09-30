<!--parent nav wrapper-->
<?php
if (!isset($_SESSION['logged']) || !($_SESSION['level'] == 'parent')){
    header('Location: index.php');
}

?>

<div class="p_nav">
    <!--main navigation bar here -->
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Attendance Management</a>
            </div>
            <ul class="nav navbar-nav">

                <li><a href="parent.php">Today</a></li>
                <li><a href="otherdays.php">Other days</a></li>
                <li><a href="mothly_pre.php">Monthly Overview</a></li>
            </ul>
            <!--navbar right-->
<!--            geting parent name-->
            <?php
                $query_parent_name = "SELECT firstname FROM parent WHERE serial= '$parent'";
                $query_parent_name_ans = query($query_parent_name);
                $query_parent_name_ans = $query_parent_name_ans->fetch_assoc();


            ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="fa fa-child"> <?php echo $query_parent_name_ans['firstname'];?></span></a></li>
                <li><a href="logout.php"><span class="fa fa-sign-out"></span> logout</a></li>


            </ul>
            <!--end right-->
        </div>
    </nav>
    <!--main navigation ends-->

</div>
<!--parent navigation end-->
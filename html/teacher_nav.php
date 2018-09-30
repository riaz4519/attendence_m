
<!--teacher check login-->

<?php
if (!isset($_SESSION['logged']) || $_SESSION['level'] !=='teacher') {
    header('Location:index.php');


}

?>
<div class="t_nav">

    <!--main navigation bar here -->
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">WebSiteName</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="teacher.php">Home</a></li>
                <li><a href="take_attend.php">Take Attendance</a></li>
                <li><a href="edit_teacher.php">Edit</a></li>
                <li><a href="teacher_mark.php">Marks</a></li>

            </ul>
<!--                getting the techers name-->
            <?php

                $serial = $_SESSION['serial'];

                $query = "SELECT firstname from teacher WHERE serial = '$serial'";
                $result = query($query);
                if ($result->num_rows){
                    $result = $result->fetch_assoc();
                    $name = $result['firstname'];
                }

            ?>

            <!--navbar right-->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $name; ?></a></li>
                <li><a href="logout.php"><span class="fa fa-sign-out"></span>logout</a></li>

            </ul>
            <!--end right-->
        </div>
    </nav>
    <!--main navigation ends-->

</div>
<!--teachers navigation-->
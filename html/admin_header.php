<?php
if (!isset($_SESSION['logged']) || !($_SESSION['level'] == 'admin')){
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

                <li><a href="admin.php">Add Student</a></li>
                <li><a href="admin_teacher.php">Add teacher</a></li>
                <li><a href="admin_teacher_class.php">Teachers Class</a></li>
            </ul>
            <!--navbar right-->
            <!--            geting parent name-->

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="fa fa-user"> Admin</span></a>
                <li><a href="logout.php"><span class="fa fa-sign-out"></span> logout</a></li>


            </ul>
            <!--end right-->
        </div>
    </nav>
    <!--main navigation ends-->

</div>
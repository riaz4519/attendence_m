<!--    for the all header-->
<?php
include 'header_all.php';

?>
<!--    this is for the all head and body-->
<?php
include 'head_body.php';
?>



<!--teacher wrappper starts-->
<div class="t_main_wrapper">
<!--    teacher nav-->
    <?php include "teacher_nav.php"; ?>
    <!--home page welcome -->
    <div class="home_welcome">
        <div class="container">


                <div class="welcome row well">
                    <div class="col-sm-6">
                        <p class="">Welcome MR. <?php echo $name ?> would you like to take attendance</p>
                    </div>
                    <div class="col-sm-offset-3 col-sm-2 ">
                            <a  href="take_attend.php" class="btn btn-primary">Take Attendance</a>
                    </div>

                </div>



        </div>


    </div>

</div>


<!--teacher wrapper ends-->

<?php
include 'footer_all.php';

?>
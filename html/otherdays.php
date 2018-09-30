    <!--    for the all header-->
    <?php
    include 'header_all.php';

    ?>
    <!--    this is for the all head and body-->
    <?php
    include 'head_body.php';
    ?>
    <?php
    $parent = $_SESSION['serial'];

    ?>
    <?php
        if (isset($_POST['check_oth'])){

            if (isset($_POST['date_oth']) && !empty($_POST['date_oth'])){

                $date_oth = $_POST['date_oth'];
                $student_serial = $_SESSION['student_s'];

                $query_oth = "SELECT state FROM attendance WHERE stds_serial = '$student_serial' AND date = '$date_oth'";
                $query_oth_res = query($query_oth);
                $query_oth_ans = $query_oth_res->fetch_assoc();

            }
        }

    ?>
<!--this is the main wrapper for parent -->
<div class="p_main_wrapper">
    <!--this is for the parent navigation-->
        <?php
            include 'parent_nav.php';

        ?>
    <!--parents other days of attandance-->
        <div class="other_p_atten">

            <div class="container">
                <div class="row text-center">
                    <!--form for select which class to take attendance-->
                    <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                        <div class="row">


                            <div class="col-sm-3 col-lg-4 input-group">
                                <span class="input-group-addon">Date</span>
                                <input class="form-control" type="date" name="date_oth">

                            </div>
                            <div class="col-sm-3 col-lg-3 input-group">
                                <input type="submit" class="btn btn-primary form-control"  name="check_oth"  value="Check">

                            </div>
                        </div>
                    </form>




                </div>


            </div>

        </div>

    <!--end-->
    <hr>

    <!--now starting attendace  todays body-->
    <div class="today_main">

        <div class="container">
            <div class="which_class">
                <div class="container">
                    <?php

                    if(!empty($query_oth_ans['state'])){

                            $state = $query_oth_ans['state'];

                    ?>
                    <div class="col-sm-6 col-lg-offset-3 col-md-offset-2 col-sm-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body text-center <?php
                                if ($state == 1){
                                    echo " alert-success";
                                }
                                else{
                                    echo "alert-danger";
                                }

                            ?>">
                                <h3><?php
                                    if ($state == 1){
                                        echo "Present";
                                    }
                                    else{
                                        echo "Absent";
                                    }

                                    ?></h3>


<!--                                this is for the getting all from the student table-->

                                <?php

                                $query_get_student = "SELECT * FROM student WHERE serial = '$student_serial'";
                                $query_get_ans = query($query_get_student);
                                $query_get_res = $query_get_ans->fetch_assoc();

                                ?>
                                <p>Name: <?php echo $query_get_res['firstname']." ".$query_get_res['lastname'] ?> </p>

                                <p>Section: <?php echo $query_get_res['section']; ?> </p>
                                <p>Roll:<?php echo $query_get_res['roll']; ?> </p>
                                <p>class: <?php echo $query_get_res['class']; ?></p>
                                <p>DATE:<?php echo $date_oth; ?></p>

                            </div>

                        </div>
                    </div>
                    <div class="text-center">
                        <div class="col-sm-4 col-lg-offset-4 col-md-offset-3 col-sm-offset-2">
                            <button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal"> <span class="fa fa-phone">Contact teacher</span></button>
                            <a href="parent.php" class="btn btn-default all_p"><i aria-hidden="true" class="fa fa-check"></i>Check Today</a>

                        </div>
                    </div>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title text-center">Teacher's Information </h4>
                                    </div>
                                    <?php
                                            $class = $query_get_res['class'];
                                            $section = $query_get_res['section'];
                                        $query_teacher = "select teacher_id from teacher_sec_class WHERE section= '$section' AND class='$class'";
                                        $query_teacher_run = query($query_teacher);
                                        $query_teacher_result = $query_teacher_run->fetch_assoc();
                                        $teacher_id = $query_teacher_result['teacher_id'];

                                        $select_teacher = "select * from teacher WHERE serial = '$teacher_id' LIMIT 1";

                                        $select_teacher_run = query($select_teacher);
                                        $select_teacher_result = $select_teacher_run->fetch_assoc();




                                    ?>
                                    <div class="modal-body">
                                        <table class="table table-hover">


                                            <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <td><?php echo $select_teacher_result['firstname']." ".$select_teacher_result['lastname']; ;?></td>

                                            </tr>
                                            <tr>
                                                <th>Education</th>
                                                <td><?php echo $select_teacher_result['edu']; ?></td>

                                            </tr>
                                            <tr>
                                                <th>Gender:</th>
                                                <td><?php echo $select_teacher_result['sex']; ?></td>

                                            </tr>
                                            <tr>
                                                <th>Phone</th>
                                                <td><?php echo $select_teacher_result['phone']; ?></td>

                                            </tr>
                                            <tr>
                                                <th>About</th>
                                                <td><?php echo $select_teacher_result['about']; ?></td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } else{
                        if(isset($_POST['check_oth'])){



                    ?>

                        <div class="row no_class">
                                <div class="col-sm-5 col-sm-offset-4 well text-center alert-info">
                                    Off Day
                                </div>
                        </div>

                    <?php }} ?>

                </div>
            </div>
        </div>

    </div>
    <!--ends of todays body-->
</div>
<!--end of main wrapper-->

    <?php
    include 'footer_all.php';

    ?>
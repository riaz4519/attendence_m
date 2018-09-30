<!--    for the all header-->
<?php
include 'header_all.php';

?>
<!--    this is for the all head and body-->
<?php
include 'head_body.php';
?>




<?php


if (isset($_POST['state'])) {
    if ($_POST['state'] === "present") {
        $pa = 1;
    } elseif ($_POST['state'] === "absent") {
        $pa = 2;
    }
        $date_need =  $_SESSION['date_need'];

    $s_s = $_POST['std_s'];
    $query_sr_s = "SELECT state from attendance WHERE stds_serial = '$s_s' AND date='$date_need'";
    $serial_res_s = query($query_sr_s);
    $serial_res_s = $serial_res_s->fetch_assoc();
    $serial_state_s = $serial_res_s['state'];
    echo $serial_state_s;



    if($serial_state_s==1 || $serial_state_s == 2){

        $query_state = "UPDATE attendance set state = '$pa' WHERE stds_serial = '$s_s' AND date = '$date_need'";
        $query_state_ans = query($query_state);

    }
    else{
        $query_state = "INSERT INTO attendance(stds_serial,date,state)VALUES ('$s_s','$date_need','$pa')";
        $query_state_ans = query($query_state);
    }
}

?>

<!--teacher wrappper starts-->
<?php include 'teacher_nav.php'; ?>
    <!--teachers navigation-->



    <div class="which_class">
        <div class="container">
            <div class="col-sm-4 col-lg-offset-4 col-md-offset-3 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <h3>Fill the box for Edit</h3>
                        <?php  $date_t = date("d M Y")?>

                        <p><?php echo $date_t; ?></p>

                    </div>

                </div>
            </div>

        </div>
    </div>
    <hr>
<!--this is for getting the student-->
<?php
    if (isset($_POST['submit_edit'])){
        if (isset($_POST['class']) && isset($_POST['section']) && isset($_POST['roll']) && $_POST['date']  ){
            if (!empty($_POST['class']) && !empty($_POST['section']) && !empty($_POST['roll']) && !empty($_POST['date'])){
                $class = validation($_POST['class']);
                $section = validation($_POST['section']);
                $roll = validation($_POST['roll']);
                $date = validation($_POST['date']);
                $_SESSION['date_need'] = $date;
                $query_edit_pre = "SELECT * FROM student WHERE class='$class' AND section='$section' AND roll='$roll'";
                $query_edit_pre_ans = query($query_edit_pre);
                $query_edit_result = $query_edit_pre_ans->fetch_assoc();


            }
        }

    }


?>


<!--this is for the update-->


    <!--this is for the container of attendance-->
    <div class="container_attendance">
        <!--wel for welcome-->

        <div class="container">
            <div class="row text-center">
                <!--form for select which class to take attendance-->
                <?php

                $query1 = "SELECT DISTINCT class FROM teacher_sec_class WHERE teacher_id = '$serial'";
                $res1 = query($query1);


                ?>
                <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                    <div class="row">
                        <!--classs-->
                        <div class="col-sm-2 col-lg-2 input-group">
                            <span class="input-group-addon">Class</span>
                            <select class="select_width form-control" type="text" name="class">

                                <?php
                                while ($res_lc = $res1->fetch_assoc()){


                                    ?>
                                    <option value="<?php echo $res_lc['class']; ?>"><?php echo $res_lc['class']; ?></option>

                                <?php }?>

                            </select>

                        </div>
                        <!--section-->

                        <?php
                        $query_sec = "SELECT DISTINCT section FROM teacher_sec_class WHERE teacher_id = '$serial'";

                        $res2 = query($query_sec);


                        ?>

                        <div class="col-sm-2 col-lg-2 input-group">
                            <span class="input-group-addon">Section</span>
                            <select class="select_width form-control" name="section">

                                <?php
                                while ($res_ls = $res2->fetch_assoc()){


                                    ?>
                                    <option value="<?php echo $res_ls['section']; ?>"><?php echo $res_ls['section']; ?></option>

                                <?php }?>


                            </select>

                        </div>
                        <!--roll-->
                        <div class="col-sm-2 col-lg-2 input-group">
                            <span class="input-group-addon">Roll</span>
                            <input class="form-control" type="text" name="roll">

                        </div>
                        <!--date-->
                        <div class="col-sm-2 col-lg-2 input-group">
                            <span class="input-group-addon">Date</span>
                            <input class="form-control" type="date" name="date">

                        </div>
                        <div class="col-sm-2 col-lg-2 input-group">
                            <input type="submit" class="btn btn-primary form-control"  value="Edit Attendance" name="submit_edit">

                        </div>
                    </div>
                </form>




            </div>


        </div>
    </div>
<?php
    global $query_edit_pre_ans;
    if ($query_edit_pre_ans){



?>
    <div class="edit_student_res">


            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-lg-10 col-md-10 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
                        <table class="table table-hover table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th class="text-center">ROLL</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Class</th>
                                <th class="text-center">Section</th>
                                <th class="text-center">Attendance</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center">
                                <td><?php echo $query_edit_result['roll']; ?></td>
                                <td><?php echo $query_edit_result['firstname']."".$query_edit_result['lastname'];?></td>
                                <td><?php echo $query_edit_result['class'];?></td>
                                <td><?php echo $query_edit_result['section'];?></td>
                                <td><form class="form-inline" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <input type="text" name="std_s" style="display: none;" value="<?php echo $query_edit_result['serial'];?>">
                                            <?php
                                                $serial = $query_edit_result['serial'];
                                                global $date;
                                                $query_sr = "SELECT state from attendance WHERE stds_serial = '$serial' AND date='$date'";
                                                $serial_res = query($query_sr);
                                                $serial_res = $serial_res->fetch_assoc();
                                                $serial_state = $serial_res['state'];

                                                ?>



                                        <?php
                                                if ($serial_state==1){

                                            ?>

                                                    <input type="submit" class="form-control btn btn-danger" name="state" value="absent">
                                        <?php }
                                        elseif($serial_state==2){



                                        ?>
                                            <input type="submit" class="form-control btn btn-primary" name="state" value="present">

                                        <?php }
                                            else {


                                                ?>
                                                <input type="submit" class="form-control btn btn-primary" name="state" value="present">
                                                <input type="submit" class="form-control btn btn-danger" name="state" value="absent">


                                                <?php

                                            }?>

                                    </form></td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>

            </div>




    </div>
<?php }?>
</div>

<?php
include 'footer_all.php';

?>
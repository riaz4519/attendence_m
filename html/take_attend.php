<!--    for the all header-->
<?php
include 'header_all.php';

?>
<!--    this is for the all head and body-->
<?php
include 'head_body.php';
?>


<!--getting the value of present or absent-->
<?php
if (isset($_POST['state'])){
    if ($_POST['state'] ==="present"){
        $pa = 1;
    }
    elseif ($_POST['state']==="absent"){
        $pa = 2;
    }
    $state = $_POST['state'];

    $s_s = $_POST['std_s'];
    $date = date("Y-m-d");
    $query_parent = "SELECT parent from student_parent WHERE student = '$s_s'";
    $query_parent_ans = query($query_parent);
    $query_parent_result = $query_parent_ans->fetch_assoc();
    $parent_id = $query_parent_result['parent'];

    $parent_email_q = "select email,firstname from parent WHERE serial = '$parent_id'";
    $parent_email_q_ans = query($parent_email_q);
    $parent_email_q_result = $parent_email_q_ans->fetch_assoc();
    $parent_email = $parent_email_q_result['email'];
    $parent_name = $parent_email_q_result['firstname'];
    $mail_c = mail_which($parent_email);
//    student name
    $query_student = "SELECT firstname,lastname from student WHERE serial = '$s_s'";

    $query_student_ans = query($query_student);
    $query_student_result = $query_student_ans->fetch_assoc();

    $name = $query_student_result['firstname']." ".$query_student_result['lastname'];

//    mail_send($parent_email,$mail_c,$parent_name,$state,$name);
    $query_pre = "INSERT INTO attendance (stds_serial,`date`,state)VALUES ('$s_s','$date','$pa')";
   if(query($query_pre)){
       mail_send($parent_email,$mail_c,$parent_name,$state,$name);
   }




}

?>
<!--teacher wrappper starts-->
<div class="t_main_wrapper">
    <?php include 'teacher_nav.php'; ?>
    <!--teachers navigation-->


<!--    this is the getting value part-->
    <?php
        if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['take_att'])){
            $class = $_POST['class'];
            $section  = $_POST['section'];

            $_SESSION['class'] = $class;
            $_SESSION['section'] = $section;
            $class_s = $_SESSION['section'];
            $class_c = $_SESSION['class'];


            $date_c_s = date("Y-m-d");
            $query_sec_class_att = "select * from class_atten WHERE class = '$class_c' AND section = '$class_s' AND date = '$date_c_s'";

            $query_sec_class_att_ans =query($query_sec_class_att);
            if (!$query_sec_class_att_ans->num_rows){
                $query_sec_class_give_att = "insert into class_atten(class,section,date)VALUES ('$class_c','$class_s','$date_c_s')";
                $query_sec_class_give_att_ans = query($query_sec_class_give_att);

            }



        }


    ?>

    <!--this is for the container of attendance-->
    <div class="container_attendance">
        <!--wel for welcome-->

        <div class="container">
            <div class="row">
<!--                teachers class section sql-->
                <!--form for select which class to take attendance-->

                <?php

                    $query1 = "SELECT DISTINCT class FROM teacher_sec_class WHERE teacher_id = '$serial'";
                    $res1 = query($query1);


                ?>
                <form class="form-inline" action="take_attend.php" method="POST">
                    <div class="row">
                        <div class="col-sm-3 col-lg-4 input-group">
                            <span class="input-group-addon">Class</span>
                            <select class="select_width form-control" type="text" name="class">
                                <?php
                                while ($res_lc = $res1->fetch_assoc()){


                                    ?>
                                    <option value="<?php echo $res_lc['class']; ?>"><?php echo $res_lc['class']; ?></option>

                                <?php }?>
                            </select>

                        </div>

                        <?php
                            $query_sec = "SELECT DISTINCT section FROM teacher_sec_class WHERE teacher_id = '$serial'";

                            $res2 = query($query_sec);


                        ?>

                        <div class="col-sm-3 col-lg-4 input-group">
                            <span class="input-group-addon">Section</span>
                            <select class="select_width form-control" name="section">


                                <?php
                                while ($res_ls = $res2->fetch_assoc()){


                                    ?>
                                    <option value="<?php echo $res_ls['section']; ?>"><?php echo $res_ls['section']; ?></option>

                                <?php }?>


                            </select>

                        </div>
                        <div class="col-sm-3 col-lg-3 input-group">
                            <input type="submit" class="btn btn-primary form-control" name="take_att" value="Take Attendance">

                        </div>
                    </div>
                </form>




            </div>


        </div>
    </div>

    <!--end of contaier attendace-->

<!--hr for the design-->
    <?php
        if (isset($_SESSION['class']) && isset($_SESSION['section'])){



    ?>
    <hr>

    <!--this is for the  showing which classes attendance -->
        <div class="which_class">
            <div class="container">
                <div class="col-sm-4 col-lg-offset-4 col-md-offset-3 col-sm-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <h3>Attendance for class <?php echo $_SESSION['class']; ?></h3>
                                <p>Section <?php echo $_SESSION['section']; ?></p>
                                <p><?php echo date("d M Y"); ?></p>

                            </div>

                        </div>
                </div>
<!--                <div class="text-center">-->
<!--                    <div class="col-sm-4 col-lg-offset-4 col-md-offset-3 col-sm-offset-2">-->
<!--                        <a href="#" class="btn btn-default all_p"><i aria-hidden="true" class="fa fa-check"></i> Mark All Present</a>-->
<!--                        <a href="#" class="btn btn-default all_p"><i aria-hidden="true" class="fa fa-times"></i> Mark All Absent</a>-->
<!---->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>
    <!--end of showing class-->
    <!---->

    <hr>
    <!--this is container for showing student and take attendance -->

    <div class="take_attendance_s">
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

<!--                        this is for the student info code in start of the page-->

                <?php
                $sec = $_SESSION['section'];
                $cls = $_SESSION['class'];
                $query2 = "SELECT * FROM student WHERE class = '$cls' AND SECTION = '$sec'";
                $res3 = query($query2);

                    while ($res_s = $res3->fetch_assoc()){



                ?>
                        <?php

                            $date_c = date("Y-m-d ");

                            $query_check = "SELECT state FROM attendance WHERE stds_serial = '".$res_s['serial']."' AND  date='$date_c'";
                            $query_check = query($query_check);
                            $query_check_r = $query_check->fetch_assoc();
                            if (empty($query_check_r['state']) && $query_check_r['state'] !== 0){
                                echo $query_check_r['state'];








                        ?>
                        <tr class="text-center">
                            <td><?php echo $res_s['roll']; ?></td>
                            <td><?php echo $res_s['firstname']." ".$res_s['lastname'];?></td>
                            <td><?php echo $res_s['class']; ?></td>
                            <td><?php echo $res_s['section']; ?></td>
                            <td><form class="form-inline" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                    <input type="text" name="std_s" style="display: none;" value="<?php echo $res_s['serial']?>">
                                    <input type="submit" class="form-control btn btn-primary" name="state" value="present">
                                    <input type="submit" class="form-control btn btn-danger" name="state" value="absent">

                                </form></td>
                        </tr>

                        <?php }} ?>






                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!--pagination starts-->
        <div class="text-center pagi_for_at">


            <ul class="pagination">
                <li><a href="">1</a></li>
                <li><a href="">2</a></li>
                <li><a href="">3</a></li>
                <li><a href="">4</a></li>

            </ul>

        </div>
        <!--pagination ends-->
    </div>

    <hr>

    <!--end of take attendance-->

    <?php }?>


</div>


<!--teacher wrapper ends-->

<?php
include 'footer_all.php';

?>
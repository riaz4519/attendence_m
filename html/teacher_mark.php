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
    <!--    teacher nav-->
    <?php include "teacher_nav.php"; ?>

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
                <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                    <div class="row">
                        <div class="col-sm-2 col-lg-3 input-group">
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

                        <div class="col-sm-2 col-lg-3 input-group">
                            <span class="input-group-addon">Section</span>
                            <select class="select_width form-control" name="section">


                                <?php
                                while ($res_ls = $res2->fetch_assoc()){


                                    ?>
                                    <option value="<?php echo $res_ls['section']; ?>"><?php echo $res_ls['section']; ?></option>

                                <?php }?>


                            </select>

                        </div>
                        <div class="col-sm-2 col-lg-3 input-group">
                            <span class="input-group-addon">Month</span>
                            <input type="month" class="form-control" name="date">
                        </div>

                        <div class="col-sm-2 col-lg-2 input-group">
                            <input type="submit" class="btn btn-primary form-control" name="take_att" value="Take Attendance">

                        </div>
                    </div>
                </form>




            </div>


        </div>
    </div>


</div>

<div class="container-fluid">
    <div class="row">

    <div class="col-sm-7 col-sm-offset-2">
        <?php if (isset($_POST['take_att'])){
           $section = $_POST['section'];
           $class = $_POST['class'];
           $date = $_POST['date'];



           if (!empty($section) && !empty($class) && !empty($date)){


                    $query_student = "SELECT * from student WHERE class = '$class' AND section = '$section'";
                    $query_student_ans = query($query_student);


               $query_prog_class = "select * from class_atten WHERE class ='$class' AND  section = '$section' AND date LIKE '%$date%'";
               $query_prog_class_run = query($query_prog_class);
               $query_prog_class_rows = $query_prog_class_run->num_rows;
//

               ?>

    <div class="panel panel-default">
        <div class="panel-heading text-center">Marks of CLass : <b><?php echo $class;?> Section :<?php echo $section; ?></b></div>
        <div class="panel-body">
            <table class="table table-hover table-bordered table-responsive">
                <thead>
                <tr>
                    <th class="text-center">SR.</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">ROLL</th>

                    <th class="text-center">Mark</th>
                </tr>
                </thead>
                <tbody>
                <?php while($query_student_result = $query_student_ans->fetch_assoc()){
                    $std_serial = $query_student_result['serial'];
                    $query_prog = "select * from attendance WHERE stds_serial = '$std_serial' AND state = 1 AND date LIKE '%$date%'";
               $query_prog_run = query($query_prog);
               $num_rows_prog = $query_prog_run->num_rows;

                $percent = percentage($query_prog_class_rows,$num_rows_prog);
                    $mark = mark($percent);


                    ?>
                <tr class="text-center">

                        <td><?php echo $std_serial;?></td>
                    <td><?php echo $query_student_result['firstname']." ".$query_student_result['lastname']; ?></td>
                    <td><?php echo $query_student_result['roll'];?></td>


                    <td><?php echo $mark;?></td>



                </tr>
                <?php } ?>







                </tbody>
            </table>



        </div>
    </div>
        <?php    }
        }?>
    </div>
    </div>


</div>

<?php include "footer_all.php";?>

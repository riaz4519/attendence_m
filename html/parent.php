<!--    for the all header-->
    <?php
        include 'header_all.php';

    ?>
<!--    this is for the all head and body-->
    <?php
        include 'head_body.php';
    ?>

<!--            this is for the select student for parent-->
<?php
$parent = $_SESSION['serial'];

$query_student_select = "SELECT student from student_parent WHERE parent = '$parent'";
$query_student_select_ans = query($query_student_select);

    $query_student_select_ans = $query_student_select_ans->fetch_assoc();
    $query_student_select_ans_s = $query_student_select_ans['student'];
    $_SESSION['student_s'] = $query_student_select_ans_s;




$query_student_select_get = "SELECT * FROM student WHERE serial = '$query_student_select_ans_s'";
$student_all_ans = query($query_student_select_get);
$student_all_ans = $student_all_ans->fetch_assoc();
$_SESSION['section'] = $student_all_ans['section'];
$_SESSION['class'] = $student_all_ans['class'];



?>

    <!--this is the main wrapper for parent -->
    <div class="p_main_wrapper">
<!--        this is for the paren navigation-->
        <?php include 'parent_nav.php' ?>
        <!--now starting attendace  todays body-->
        <div class="today_main">


            <div class="container">
<!--                present or absent-->
                <?php
                    $date =date("Y-m-d");
                    $query_pa = "SELECT state FROM attendance WHERE stds_serial='$query_student_select_ans_s' AND date='$date'";
                    $pa_res = query($query_pa);

                    $pa_ans = $pa_res->fetch_assoc();
                    $pa_ans_c = $pa_ans['state'];


                ?>
                <div class="which_class">
                    <div class="container">
                        <div class="col-sm-6 col-lg-offset-3 col-md-offset-2 col-sm-offset-2">
                            <?php if($pa_ans_c == 1 || $pa_ans_c == 2){

                             ?>
                            <div class="panel panel-default">

                                <div class="panel-body text-center <?php if ($pa_ans_c==1){
                                    echo " alert-success";
                                }
                                else{
                                    echo "alert-danger";
                                }

                                ?>">
                                    <h3><?php if ($pa_ans_c==1){
                                            echo "Present";
                                        }
                                        else{
                                            echo "Absent";
                                        }

                                        ?></h3>
                                    <p>Section : <?php echo $section = $student_all_ans['section']; ?> </p>
                                    <p>Roll:  <?php echo $student_all_ans['roll']; ?> </p>
                                    <p>class:  <?php echo $class = $student_all_ans['class']; ?></p>
                                    <p><?php echo date('d M Y')?></p>

                                </div>

                            </div>


                        </div>
                        <div class="text-center">
                            <div class="col-sm-4 col-lg-offset-4 col-md-offset-3 col-sm-offset-2">
                                <button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal"> <span class="fa fa-phone">Contact teacher</span></button>
                                <a href="otherdays.php" class="btn btn-default all_p"><i aria-hidden="true" class="fa fa-check"></i>Check other Days</a>

                            </div>
                        </div>
                        <?php  }
                        else{ ?>

                            <h3  class="text-center" style="height: 100px; border: 1px solid grey;
                            border-radius: 4px;
">There was no class Today</h3>

                        <?php
                        }?>

                    </div>
                </div>
            </div>

        </div>
        <!--ends of todays body-->
    </div>
    <!--end of main wrapper-->
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


<!--    this is the footer-->
<?php
    include 'footer_all.php';

?>

<!--    for the all header-->
<?php
include 'header_all.php';

?>
<!--    this is for the all head and body-->
<?php
include 'head_body.php';
?>
<?php

if (isset($_POST['submit'])){
    if (isset($_POST['teacher'])&& isset($_POST['class'])&& isset($_POST['section'])){
        $teacher = validation($_POST['teacher']);
        $class = validation($_POST['class']);
        $section = validation($_POST['section']);
       if (!empty($teacher)&&!empty($class) && !empty($section)){

           $query_add_class = "insert into teacher_sec_class(teacher_id,class,section)VALUES ('$teacher','$class','$section')";
           if (query($query_add_class)){
               echo "<h4 class='well alert-success text-center'>Class added to teacher Successfully</h4>";
           }

       }
    }

}



?>
    <!-- admin main wrapper-->

    <div class="main_admin_wrapper">
        <?php include "admin_header.php"; ?>
        <div class="container centered-block">



            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <h4 class="text-center header_ps">Teachers Information</h4>
                        <div class="form-group">
<!--                            getting the teacher-->

                            <?php
                                $teacher_query = "select serial,firstname,lastname from teacher WHERE 1";
                                $query_reacher_run = query($teacher_query);


                            ?>
                            <label for="teacher">Teacher:</label>
                            <select class="form-control input-sm" name="teacher" id="teacher">

                                <?php
                                while ($result = $query_reacher_run->fetch_assoc()){

                                ?>

                                <option value="<?php echo $result['serial'] ?>"><?php echo $result['firstname']." ".$result['lastname']; ?></option>
                                <?php } ?>


                            </select>
                        </div>


                        <div class="form-group">
                            <label for="class">Class:</label>
                            <select class="form-control input-sm" name="class" id="class">

                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>



                            </select>
                        </div>


                        <div class="form-group">
                            <label for="section">Section:</label>
                            <select class="form-control input-sm" name="section" id="section">

                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>



                            </select>
                        </div>





                        <input type="submit" class="btn btn-block btn-success" value="submit" name="submit">
                    </div>

                </div>




            </form>
        </div>

    </div>


<?php include 'footer_all.php';?>
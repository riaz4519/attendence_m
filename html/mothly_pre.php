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
<!--this is the main wrapper for parent -->
<div class="p_main_wrapper">
        <?php
            include 'parent_nav.php';

        ?>
    <div class="monthly_prev">
        <div class="mgs_preview text-center" >
            <h2>Monthly Preview of <?php
                $day = date("d");
                $year = date("Y");
                $month = date("m");
                $date = date("$year-$month-$day");
                $date=date_create($date);


                echo date_format($date,"Y");?></h2>


        </div>
        <hr>
        <div class="container">

            <div class="row monthly_prev_ed">
                <div class="col-sm-8 col-lg-offset-2">

                    <?php
                    $i = 01;
                    $std_serial = $_SESSION['student_s'];

                        while ($i <= $month){

                            if ($i<10){
                                $i_s = "0{$i}";

                            }
                            else{
                                $i_s = $i;
                            }

                            $class_s = $_SESSION['class'];
                            $section_s = $_SESSION['section'];

                            $date_prog = "{$year}-{$i_s}";
//                            this is for retrive class attendance
                            $query_prog_class = "select * from class_atten WHERE class ='$class_s' AND  section = '$section_s' AND date LIKE '%$date_prog%'";
                            $query_prog_class_run = query($query_prog_class);
                            $query_prog_class_rows = $query_prog_class_run->num_rows;
//                            this is for retrive personal attendance
                            $query_prog = "select * from attendance WHERE stds_serial = '$std_serial'AND state = 1 AND date LIKE '%$date_prog%'";
                            $query_prog_run = query($query_prog);
                            $num_rows_prog = $query_prog_run->num_rows;
                            $progress = percentage($query_prog_class_rows,$num_rows_prog);
//                            marks

                            if (empty($progress)){
                                $progress = 30;
                            }
                            $mark = mark($progress);

//                            for date


                            $i++;

                        ?>

                    <div class="progress">
                        <div class="progress-bar <?php echo warning($progress)?>" role="progressbar" aria-valuenow="<?php echo $progress;?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progress ?>%">
                            <?php echo $progress; ?>% in <span style="color: black;"><?php echo month($i_s)." mark = ".$mark;?></span>
                        </div>

                    </div>



                    <?php } ?>



                </div>

        </div>
        </div>

    </div>
</div>



<!--    this is the footer-->
<?php
include 'footer_all.php';

?>
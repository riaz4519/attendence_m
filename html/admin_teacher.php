<?php include 'header_all.php';?>
<?php include 'head_body.php';?>
    <!---->
<?php

if (isset($_POST['submit'])){
    if (isset($_POST['firstname'])&& isset($_POST['lastname'])
        && isset($_POST['phone'])  && isset($_POST['address'])&& isset($_POST['gender']) && isset($_POST['about'])
        && isset($_POST['edu'])){
        //        teacger getting
        $firstname_s = validation($_POST['firstname']);
        $lastname_s = validation($_POST['lastname']);


        $phone = validation($_POST['phone']);
        $address = validation($_POST['address']);
        $gender = validation($_POST['gender']);
//
        $about = validation($_POST['about']);
        $edu = validation($_POST['edu']);








        if (!empty($firstname_s) && !empty($lastname_s) && !empty($phone) && !empty($address) && !empty($gender)
            && !empty($about) && !empty($edu)){

            $rand = rand(1,100000);
            $user_teacher = $firstname_s.$rand;
            $teacher_pass = $lastname_s.$rand;

            $teacher_query = "insert into teacher(firstname,lastname,username,password,edu,sex,address,phone,about)
VALUES('$firstname_s','$lastname_s','$user_teacher','$teacher_pass','$edu','$gender','$address','$phone','$about')";

            if(query($teacher_query)){
                echo "<h4 class='well alert-success text-center'>Teacher added Successfully</h4>";
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
                            <label for="firstname">First Name:</label>
                            <input type="text" class="form-control" id="firstname" placeholder="Enter First Name" name="firstname">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name:</label>
                            <input type="text" class="form-control" id="lastname" placeholder="Enter Last Name" name="lastname">
                        </div>

                        <div class="form-group">
                            <label for="sel1">Gender:</label>
                            <select class="form-control input-sm" name="gender" id="sel1">

                                <option value="male">Male</option>
                                <option value="female">felmale</option>


                            </select>
                        </div>




                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="edu">Education:</label>
                            <input type="text" class="form-control" id="edu" placeholder="Enter Education" name="edu">
                        </div>

                        <div class="form-group">
                            <label for="address">Address:</label>
                            <textarea type="text" rows="3" name="address" class="form-control" id="address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="about">About:</label>
                            <textarea type="text" rows="3" name="about" class="form-control" id="about"></textarea>
                        </div>



                        <input type="submit" class="btn btn-block btn-primary" value="submit" name="submit">
                    </div>

                </div>




            </form>
        </div>

    </div>


<?php include 'footer_all.php';?>
<?php include 'header_all.php';?>
<?php include 'head_body.php';?>
<!---->
<?php

if (isset($_POST['submit'])){
    if (isset($_POST['firstname'])&& isset($_POST['lastname']) && isset($_POST['class']) && isset($_POST['section'])
        && isset($_POST['phone'])  && isset($_POST['address'])&& isset($_POST['gender']) && isset($_POST['firstname_p'])&& isset($_POST['lastname_p'])
        && isset($_POST['address_p'])&& isset($_POST['phone_p'])&& isset($_POST['email'])){
        //        student getting
        $firstname_s = validation($_POST['firstname']);
        $lastname_s = validation($_POST['lastname']);
        $class = validation($_POST['class']);
        $section = validation($_POST['section']);

        $phone_s = validation($_POST['phone']);
        $address_s = validation($_POST['address']);
        $gender = validation($_POST['gender']);
//        parent getting
        $firstname_p = validation($_POST['firstname_p']);
        $lastname_p = validation($_POST['lastname_p']);
        $address_p = validation($_POST['address_p']);
        $phone_p = validation($_POST['phone_p']);
        $email = $_POST['email'];





        if (!empty($firstname_s) && !empty($lastname_s) && !empty($class) && !empty($section)
             && !empty($phone_s) && !empty($address_s) && !empty($gender)
            && !empty($firstname_p) && !empty($lastname_p) && !empty($address_p) && !empty($phone_p)&&!empty($email)
            ){
//student info upload
            $query = "select max(roll) + 1 as roll from student WHERE class = '$class' and section = '$section'";
            $ans = query($query);
            if(empty($ans->num_rows)){
                $roll = 1;
            }
            else{
                $result = $ans->fetch_assoc();
                $roll = $result['roll'];


            }

//

            $query_student = "insert into student(firstname,lastname,sex,section,class,roll,address,phone)
            VALUES ('$firstname_s','$lastname_s','$gender','$section','$class','$roll','$address_s','$phone_s')";
            query($query_student);
            $query_std_serial = "SELECT serial from student WHERE serial IN(SELECT MAX(serial) FROM student)";
            $query_std_serial_run = query($query_std_serial);
            $query_std_serial_result = $query_std_serial_run->fetch_assoc();
            $student_serial = $query_std_serial_result['serial'];

//            parent info update

            $rand = rand(1,10000);
            $user_parent = $firstname_p.$rand;
            $parent_pass = $lastname_p.$rand;
            $query_parent = "insert into parent(firstname,lastname,address,phone,username,password,email)
              VALUES ('$firstname_p','$lastname_p','$address_p','$phone_p','$user_parent','$parent_pass','$email')";
                query($query_parent);


            $query_parent_serial = "SELECT serial from parent WHERE serial IN(SELECT MAX(serial) FROM parent)";
            $query_parent_serial_run = query($query_parent_serial);
            $query_parent_serial_result = $query_parent_serial_run->fetch_assoc();
           $parent_serial = $query_parent_serial_result['serial'];

//           relation query
            $query_relation = "insert into student_parent(parent,student)VALUES ('$parent_serial','$student_serial')";
            query($query_relation);




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
                    <div class="col-sm-6">
                        <h4 class="text-center header_ps">Student Information</h4>


                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" class="form-control" id="firstname" placeholder="Enter First Name" name="firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Enter Last Name" name="lastname">
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

                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
                        </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea type="text" rows="3" name="address" class="form-control" id="address"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="sel1">Gender:</label>
                        <select class="form-control input-sm" name="gender" id="sel1">

                            <option value="male">Male</option>
                            <option value="female">felmale</option>


                        </select>
                    </div>



                </div>
                <div class="col-sm-6">
                    <h4 class="text-center  header_ps">Parents Information</h4>


                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" class="form-control"  placeholder="Enter First Name" name="firstname_p">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" class="form-control"  placeholder="Enter Last Name" name="lastname_p">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control"  placeholder="Enter Email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="phone_p">Phone:</label>
                        <input type="text" class="form-control" id="phone_p" placeholder="Enter Phone" name="phone_p">
                    </div>


                    <div class="form-group">
                        <label for="address">Address:</label>
                        <textarea type="text" rows="3" name="address_p" class="form-control" ></textarea>
                    </div>




                </div>
            </div>



            <input type="submit" class="btn btn-block btn-info" value="Submit" name="submit">
        </form>
    </div>

    </div>


<?php include 'footer_all.php';?>
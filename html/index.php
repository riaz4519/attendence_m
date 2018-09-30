<?php
    include 'connect.php';

?>

<?php
        include 'header_all.php';

    ?>
<style>
    body{
        background: #294072;
    }
    .input-group{
        padding-bottom: 10px;
    }
    .panel{
        background: #1C2B4A;
        border: none;
    }
    .input-group-addon{
        border: none;
        border-right: none;
        background: #12192C;

    }
    .input-group input{
        border: none;
        border-left: none;
        background: #12192C;
    }
    .input-group span i {
        color: #00CC66;
    }


</style>
    <?php
        include'head_body.php';
    ?>
<?php
    if (@$_SESSION['logged']){
        if ($_SESSION['level'] =='parent'){
            header('Location:parent.php');
        }
        elseif ($_SESSION['level'] == 'teacher'){
            header('Location:teacher.php');
        }
        elseif ($_SESSION['level'] == 'admin'){
            header('Location:admin.php');
        }

    }
?>
<!--    this is the login area of teacher parent and admin-->
       <?php

            if ($_SERVER['REQUEST_METHOD']=="POST"){
                if (isset($_POST['parent'])){
                    $level = 'parent';
                }
                elseif (isset($_POST['teacher'])){
                    $level = 'teacher';
                }
                elseif (isset($_POST['admin'])){
                    $level = 'admin';
                }
                if (isset($_POST['username'])&& isset($_POST['password'])){
                    $username = validation($_POST['username']);
                    $password = validation($_POST['password']);
                    $query = "SELECT * FROM $level WHERE username = '$username' AND password = '$password' ";

                    $res = login_session($query);
                    if ($res->num_rows){
                        $_SESSION['level'] = $level;
                        $_SESSION['logged'] = 1;
                        if ($level === 'parent'){
                            header('Location:parent.php');

                        }
                        elseif ($level === 'teacher'){
                            header('Location:teacher.php');
                        }
                        elseif ($level === 'admin'){
                            header('Location:admin.php');
                        }
                    }
                }
            }

    ?>
    <!--main wrapper -->
        <div class="main_wrap index">
            <!--login main wrapper-->
            <div class="title_main">
                <div class="container text-center" >

                    <h1>Attendance Management System</h1>

                </div>

            </div>
            <div class="login_main">
                <div class="container-fluid">
                    <div class="row">
                            <!--this is the panel -->
                        <div class="panel panel-default panel_shadow col-sm-6 col-sm-offset-3  col-xs-10 col-xs-offset-1 col-md-5 col-lg-4 col-lg-offset-4 ">
                            <!--this is panel header-->
                            <div class="page-header text-center login_back img_pt">
                                <img src="../daffodil-international-university.png" class="img-responsive" width="90px" height="90px">
                            </div>
                            <!--this is the panel body-->
                            <div class="panel-body ">
                                <!--this is for nav content parent and teacher -->
                                <ul class="nav nav-tabs">

                                    <li class="active"><a data-toggle="tab" href="#parent"  >Parent</a></li>
                                    <li><a data-toggle="tab" href="#teacher">Teacher</a></li>
                                    <li><a data-toggle="tab" href="#admin">Admin</a></li>

                                </ul>
                                <!--this is for tab content parent and teacher -->
                                <div class="tab-content">
                                        <!--tab content for tabs-->
                                    <div id="parent" class="tab-pane fade in active">
                                        <div class="row">
                                            <div class="col-lg-offset-1 col-sm-offset-1 col-sm-10">
                                                <!--img for parent logo-->
                                                <div class="img_pt" >
                                                    <img src="../parent.png" class="img-responsive" width="90px" height="90px">
                                                </div>
                                                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                        <input type="text" class="form-control input-md" id="usr" name="username" required placeholder="User Name">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>

                                                        <input type="password" class="form-control input-md" id="pwd" name="password" required placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" class="form-control btn-block btn-success" name="parent" value="Login">

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--this is for the teacher-->
                                    <div id="teacher" class="tab-pane fade in">
                                        <div class="row">
                                            <div class="col-lg-offset-1 col-sm-offset-1 col-sm-10">
                                                <!--img for teacher logo-->
                                                <div class="img_pt" >
                                                    <img src="../teacher.png" class="img-responsive" width="90px" height="90px">
                                                </div>
                                                <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                                                        <input type="text" class="form-control input-md" id="usr_1" name="username" required placeholder="User Name">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>

                                                        <input type="password" class="form-control input-md" id="pwd_1"  name="password" required placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" class="form-control btn-block btn-success" name="teacher" value="Login">

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
<!--                                    this is for the admin -->



                                    <div id="admin" class="tab-pane fade in">
                                        <div class="row">
                                            <div class="col-lg-offset-1 col-sm-offset-1 col-sm-10">
                                                <!--img for teacher logo-->
                                                <div class="img_pt" >
                                                    <img src="../admin-logo.png" class="img-responsive" width="90px" height="90px">
                                                </div>
                                                <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                                                        <input type="text" class="form-control input-md" id="usr_1" name="username" required placeholder="User Name">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>

                                                        <input type="password" class="form-control input-md" id="pwd_1"  name="password" required placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" class="form-control btn-block btn-success" name="admin" value="Login">

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--login_wrapper end-->
        </div>
    <!--main wrapper end -->


    <?php include "footer_all.php"; ?>
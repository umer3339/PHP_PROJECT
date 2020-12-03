<?php session_start();


?>


<div id="loginModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="content">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Login </h4>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form  action=<?php echo $_SERVER["PHP_SELF"] ?> method="POST">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                    <label class="sr-only" for="exampleInputEmail3">Email address</label>
                                    <input type="email" class="form-control form-control-sm mr-1" id="exampleInputEmail3" name="email" placeholder="Enter email">
                            </div>
                            <div class="form-group col-sm-4">
                                <label class="sr-only" for="exampleInputPassword3">Password</label>
                                <input type="password" class="form-control form-control-sm mr-1" id="exampleInputPassword3" name="pass" placeholder="Password">
                            </div>
                            <div class="col-sm-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox">
                                    <label class="form-check-label"> Remember me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <button type="button" class="btn btn-secondary btn-sm ml-auto"  data-dismiss="modal">Cancel</button>
                            <button type="submit" name="loginbtn" class="btn btn-primary btn-sm ml-1">Sign in</button>       
                            <a type="button" href="signup.php" class="btn btn-primary btn-sm ml-1">Sign Up</a>   
                        </div>
                    </form>
               
                    
                </div>
            </div>
        </div>
    </div>


    <?php 
                $Password=$Email='';
                
                if(isset($_POST['loginbtn']))
                {
                    // var_dump($_SESSION);die;
                    $Password=$_POST['pass'];
                    $Email=$_POST['email'];

                    
                    $query_check_user_name = $conn->Getconnection()->prepare('SELECT Fname, Email FROM user WHERE user.Password=:user_name AND user.Email=:user_email');
                    $query_check_user_name->bindValue(':user_name', $Password, PDO::PARAM_STR);
                    $query_check_user_name->bindValue(':user_email', $Email, PDO::PARAM_STR);
                    $query_check_user_name->execute();
                    $result = $query_check_user_name->fetchAll();
                    
                    
                    if(!isset($_SESSION['email']))
                    {
                        
                        if ($result > 0) {
                            $_SESSION['email']=$Email;
                            header('Location: index.php');
                            echo '<script type="text/javascript">alert("Thanks For Login")</script>';
                            exit;
                        }
                        else{
    
                            echo '<script type="text/javascript">alert("Your Login Credentionals")</script>';
    
                        }
                        
                    }
                    else
                    {
                        
                        echo '<script type="text/javascript">alert("you already loged-in")</script>';
                    }
                   
                        
                
                }
                
                

                ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- boothstrap file  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php include('header.php')?>
    <div class="container mt-4">

        <?php 
        include('database_connection.php');

        $check=true;
        $temp='';
        $Fname=$Lname=$Contact=$Email=$Password='';
        if( isset($_POST['submit']) )
            {
                if($_POST["firstname"]!=null and $_POST["lastname"]!=null and $_POST["password"]!=null and $_POST["telnum"]!=null and $_POST["emailid"]!=null)
                {

                    

                    $Fname=trim($_POST["firstname"]);

                    if(!preg_match("/^[a-zA-Z-' ]*$/",$Fname))
                    {
                        $check =false;
                        $temp .="Frist Name Error";
                    }
                   
                    $Lname=trim($_POST["lastname"]);

                    if(!preg_match("/^[a-zA-Z-' ]*$/",$Lname))
                    {
                        $temp .="Last Name Error ";
                        $check =false;
                    }
                    
                    $Contact=$_POST['telnum'];
                    if(!preg_match("/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/",$Contact))
                    {
                        $temp .="your Entered contact is wrong "."\n";
                        $check =false;
                    }
                    
                   

                    if($_POST["emailid"]!=null)
                    {
                        $Email=$_POST["emailid"];
                        if(!filter_var($Email, FILTER_VALIDATE_EMAIL))
                        {
                            $check = false;
                            $temp .="your Entered Email is invalid ";
                        }
                        
                    }

                    $Password=$_POST['password'];
                    if(!preg_match("/^(?=.*[0-9]+.*)(?=.*[a-zA-Z]+.*)[0-9a-zA-Z]{6,}$/",$Password))
                    {
                        $temp .="your Entered password is wrong ";
                        $check =false;
                    }
                  
                    if($check==false )
                    {
                        $temp .="user Already exsist";
                        echo '<script type="text/javascript">alert("'.$temp.'")</script>';
                    }
                    else
                    {
                        $query_check_user_name = $connect->prepare('SELECT Fname, Email FROM user WHERE Fname=:user_name OR Email=:user_email');
                        $query_check_user_name->bindValue(':user_name', $Fname, PDO::PARAM_STR);
                        $query_check_user_name->bindValue(':user_email', $Email, PDO::PARAM_STR);
                        $query_check_user_name->execute();
                        $result = $query_check_user_name->fetchAll();
                        if ($result > 0) {
                           echo "Someone with that username/email already exists.";
                        }
                        else{
                        
                        $sql = "INSERT INTO user (Fname,Lname,Contact,Email,Password) VALUES (?,?,?,?,?)";
                        $stmt= $connect->prepare($sql);
                        if($stmt->execute([$Fname, $Lname, $Contact,$Email,$Password]))
                        {
                            header('Location: index.php');
                            
                        } 
                        else
                        {
                            echo '<script type="text/javascript">alert("Your Sql Connetion have some thing wrong")</script>';
                        }
                        }
                        
                    }

                    



                }
                else
                {
            
                
                  echo '<script type="text/javascript">alert("Opps some thing is wrong !!!")</script>';
                    

                }
                
                

            }
            

        
        ?>

    <div class="row " >
           <div class="col-12 offset-sm-2  align-center" style="margin: 50px;">
              <h3>Kindly Share Your information </h3>
           </div>
            <div class="col-12 col-md-9 ">
                <form action=<?php echo $_SERVER["PHP_SELF"] ?> method="POST">
                    <div class="form-group row">
                        <label for="firstname" class="col-md-2 col-form-label">First Name</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lastname" class="col-md-2 col-form-label">Last Name</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telnum" class="col-12 col-md-2 col-form-label">Contact Tel.</label>
                        
                        <div class="col-7 col-md-10">
                            <input type="tel" class="form-control" id="telnum" name="telnum" placeholder="Tel. number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="emailid" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-10">
                            <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Email">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="feedback" class="col-md-2 col-form-label">Password</label>
                        <div class="col-md-10">
                        <input type="password" class="form-control" id="passid" name="password" placeholder="password">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-md-2 col-md-10">
                            <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
                        </div>
                    </div>

                </form>

            </div>
             <div class="col-12 col-md">
            </div>
       </div>

    </div>


    </div>
    <footer class="footer" style="background-color: aqua; margin-top:170px" >
        <div class="container">
            <div class="row">             
                <div class="col-4 offset-1 col-sm-2">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="index.php">Menu</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-7 col-sm-5">
                    <h5>Our Address</h5>
                    <address>
		              121, Clear Water Bay Road<br>
		              Clear Water Bay, Kowloon<br>
		              HONG KONG<br>
                      <i class="fa fa-phone fa-lg"></i>: +852 1234 5678<br>
                      <i class="fa fa-fax fa-lg"></i>: +852 8765 4321<br>
                      <i class="fa fa-envelope fa-lg"></i>:<a href="mailto:confusion@food.net">confusion@food.net</a>
		           </address>
                </div>
                <div class="col-12 col-sm-4 align-self-center">
                    <div class="text-center">
                        <a class="btn btn-social-icon btn-google" href="http://google.com/+"><i class="fa fa-google-plus"></i></a>
                        <a class="btn btn-social-icon btn-facebook" href="http://www.facebook.com/profile.php?id="><i class="fa fa-facebook"></i></a>
                        <a class="btn btn-social-icon btn-linkedin" href="http://www.linkedin.com/in/"><i class="fa fa-linkedin"></i></a>
                        <a class="btn btn-social-icon btn-twitter" href="http://twitter.com/"><i class="fa fa-twitter"></i></a>
                        <a class="btn btn-social-icon btn-google" href="http://youtube.com/"><i class="fa fa-youtube"></i></a>
                        <a class="btn btn-social-icon" href="mailto:"><i class="fa fa-envelope-o"></i></a>
                    </div>
                </div>
           </div>
           <br/><br/>
           <div class="row justify-content-center">             
                <div class="col-auto">
                    <p>© Copyright 2018 Ristorante Con Fusion</p>
                </div>
           </div>
        </div>
    </footer>
</body>
</html>
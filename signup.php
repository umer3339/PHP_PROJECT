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
    <div class="container">

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
                    else {
                       //Continue with proccessing the form
                    }
                    if($check!=true )
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

    <div class="row row-content mt-3">
           <div class="col-12 offset-sm-2">
              <h3>Kindly Share Your information </h3>
           </div>
            <div class="col-12 col-md-9 m-5">
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
</body>
</html>

<!DOCTYPE html>
<html lang="en">


  
 <?php require_once ("header.php"); ?>
<?php

	require_once ("../../config.php");
	$everything_was_okay = true;

	//*****************
	//TO validation
	//*****************
	if (isset($_GET["Color"])){//if there is "?location=" in the message
		if (empty($_GET["Color"])){//if it is empty
		echo "Define Color! <br>";//yes it is empty
		}else{
			echo "Color: ".$_GET["Color"]."<br>";//no it is not empty
		}
	}
	
	//check if there is variable in the URL
	if (isset ($_GET["From"])){
		
		//only if there is message in the URL
		//echo "there is message";
		
		// if it is empty
		if (empty ($_GET["From"])){
			//it is empty
			echo "Who are you? <br>";
		}else{
			//It is not empty
			echo "From: ".$_GET["From"]."<br>";
		}
	}else{
		
	}
	
	
	
	if (isset($_GET["To"])){//if there is "?punishment=" in the message
		if (empty($_GET["To"])){//if it is empty
		echo "Who gets it? <br>";//yes it is empty
		}else{
			echo "To: ".$_GET["To"]."<br>";//no it is not empty
		}
	}
	
	if (isset($_GET["Message"])){//if there is "?name=" in the message
		if (empty($_GET["Message"])){//if it is empty
		echo "What's your Message? <br>";//yes it is empty
		}else{
			echo "Message: ".$_GET["Message"]."<br>";//no it is not empty
		}
	}
	
	
	//Getting the message from the address
	//if there is $name= .. then $_GET ["name"]
	//$my_message = $_GET ["message"];
	//$to = $_GET ["to"];
	//$urgency = $_GET ["urgency"];
	//echo "My message is " .$my_message. " and it is to " .$to;
	
	

		/***********************
	**** SAVE TO DB ********
	***********************/
	
	// ? was everything okay
	if($everything_was_okay == true){
		
		
		
		//connection with username and password
		//access username from config
		//echo $db_username;
		
		//1 servername: localhost or greeny server
		//2 username
		//3 password
		//4 database
		$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_marpat");
		
		$stmt = $mysql->prepare ("INSERT INTO `Color_Messages`( `Color`, `From`, `To`, `Message`) VALUES (?,?,?,?)");
		
		//echo error
		echo $mysql->error;
		
		//we are repalcing question marks with values
		//s - string, date, smth that is based on characters and numbers
		// i - integer, number
		// d - decimanl, float
		
		//for each question mark its type with one letter
		$stmt->bind_param ("ssss", $_GET["Color"], $_GET["From"], $_GET["To"], $_GET["Message"]);
		
		//save
		if ($stmt->execute ()){
			echo "Message sent";
		}else{
			echo $stmt->error;
		}
	
	}
	
?>
 
  <body>
	
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Color Messages</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="applic.php">App<span class="sr-only">(current)</span></a></li>
      <li><a href="table.php">Table <span class="sr-only">(current)</span></a></li>
   
     
          </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


 <div class="container">

<!--This is the save button -->
 <h1>Homework app</h1>
<p>Send personalized coloful messages!
<div class="container">


    <br>
    <h2> Color Messages </h2>
    
    <form method="get">
         <div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="form-group">
                        <label for="from">Color: </label>
                        <input type="text" name="Color"
                            class="form-control">
                    </div>
				</div>
			</div>
        
        <div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="form-group">
                        <label for="from">From: </label>
                        <input type="text" name="From"
                            class="form-control">
                    </div>
				</div>
			</div>
        
        <div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="form-group">
                    <label for="to">To: </label>
                    <input type="text" name="To"
                                 class="form-control">
                    </div>
				</div>
			</div>

        <div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="form-group">
                        <label for="message">Message: </label>
                        <input type="text" name="Message"
                        class="form-control">
                    </div>
				</div>
			</div>



        <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <input class="btn btn-success hidden-xs" type="submit" value="Save">
      
                    </div>
                </div>
            </form>

    </form>

</div>



</body>
</html>

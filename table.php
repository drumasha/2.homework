<?php require_once ("header.php"); ?>

<?php
	// table.php
	
	//getting our config
	require_once ("../../config.php");
	
	//create connection
	$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_marpat");
	
	/*
		IF THERE IS ?DELETE=ROW_ID in the url
	*/
		if(isset($_GET["delete"])) {
			
			echo "Deleting row with id:".$_GET["delete"];
			
			// NOW () = current date-time
			$stmt = $mysql->prepare("UPDATE table.php SET deleted=NOW() WHERE id = ?");
			
			// replace the ?. The i here is an integer for the id number
			
			$stmt->bind_param ("i", $_GET["delete"]);
		
			if ($stmt->execute()){
				echo " Deleted successfully";
			}else{
				echo $stmt->error;
			}
			
			//Closes the statement, so others can use connection
			$stmt->close();
		}
	
	
	//SQL sentence // to show all results, remove ORDER 
	$stmt = $mysql->prepare("SELECT `id`, `Color`, `From`, `To`, `Message` FROM `Color_Messages` ");
	
	
	
	//if error in sentence
	echo $mysql->error;
	
	//variable for data for each row we will get
	$stmt->bind_result($id, $Color, $To, $From, $Message);
	//query
	$stmt->execute ();
	
	//Create a table
	
	$table_html = "";
	
	//add somthing to string .=
	$table_html .= "<table class='table table-bordered table-hover table-striped'>";
	$table_html .= "<tr>"; //table row
		$table_html .= "<th>ID</th>"; //table header
		$table_html .= "<th>Color</th>"; //table header
		$table_html .= "<th>From</th>"; //table header
		$table_html .= "<th>To</th>"; //table header
		$table_html .= "<th>Message</th>"; //table header
	$table_html .= "</tr>"; //table row closing
	
	// GET RESULTS
	// we have multiple rows, the while loop
	while ($stmt->fetch()) {
		
	
		$table_html .= "<tr>"; //start a new row
		$table_html .= "<td>" .$id. "</td>"; //add coloumns
		$table_html .= "<td>" .$Color. "</td>"; 
		$table_html .= "<td>" .$From. "</td>"; 
		$table_html .= "<td>" .$To. "</td>"; 
		$table_html .= "<td>" .$Message. "</td>"; 
    	$table_html .= "<td><a class= 'btn btn-danger' href='?delete=" .$id."'>Remove</a></td>";
				
	$table_html .= "</tr>"; //end row
		
	}
	$table_html .= "</table>";
	
?>

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
        <li> <a href="applic.php">App</a></li>
		<li class="active"><a href="table.php"> Current</a></li>
          </ul>
    
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

	<div class="container">
	
		<h1> Messages </h1>
		<?php echo $table_html; ?>






  </body>
</html>
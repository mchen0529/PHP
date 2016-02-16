<?php
session_start();
/****************************************************************************
	PART 1
	CONNECT TO YOUR DATABASE ( INCLUDE YOUR inc.db.php file )
****************************************************************************/


/****************************************************************************
	PART 2
	CREATE YOUR FUNCTION products() WHICH WILL SELECT YOUR DATA FROM DB AND
	PRINT OUT THE SELECTED DATA IN HTML TABLE IN YOUR PHP FILE
****************************************************************************/

function products(){
	include("includes/inc.db.php");
	// CREATE QUERY WHICH WILL SELECT id, name and picture FROM YOUR TABLE
	$query = 'SELECT id, name, picture
			  FROM list';
	
	// USE mysqli_query() TO PERFORM THE QUERY AND PASS THE RESULT TO NEW VARIABLE
	// THE FIRST ARGUMENT OF mysqli_query() IS CONNECTION TO DATABASE AND
	// TO ACCESS THAT VARIABLE FROM THIS FUNCTION, YOU WILL HAVE TO USE $GLOBALS
	$result = mysqli_query( $connect, $query );  
	//$row = mysqli_fetch_assoc( $result );//convert your result into associative arrray
	//var_dump( $row );
	// START PRINTING YOUR HTML TABLE HERE
	echo '<table>';
	// KEEP GOING:	
		// <tr>
		echo "<tr>";
			// <th>Image</th>
			echo "<th>Image</th>";
			// <th>Name</th>
			echo "<th>Name</th>";
		// </tr>
		echo "</tr>";
		
		
		
		while( $row=mysqli_fetch_assoc($result)/* THERE IS ANOTHER $row ( DATABASE ROW ) IN $result KEEP CONVERTING $result TO ASSOCIATIVE ARRAY USING mysqli_fetch_assoc() */ ){
			
			// CREATE NEW <tr> FOR EACH NEW DATABASE TABLE ROW ( id, name and picture ) 
			echo '<tr><th><img src="' . $row['picture']/* CONCATENATE HERE THE URL FROM DATABASE ( TAKE IT FROM $row ASSOC ARRAY ) */ . '"></th><th>' .  $row['name']/* CONCATENATE HERE THE NAME FROM DATABASE ( TAKE IT FROM $row ASSOC ARRAY ) */  . '</th><td><a href="index.php?add=' .  $row['id']/* CONCATENATE HERE ID FROM DATABASE ( TAKE IT FROM $row ASSOC ARRAY ) */  . '" id="add">Add Product</a></td></tr>'; // YOUR ID VALUE FROM DB COLUMN 'id' WILL BE THE VALUE OF QUERY STRING IN URL: index.php?add=	
				  
		}	
	
	// CLOSE YOUR TABLE HERE ( </table> )
	echo '</table>';	
}




/**************************************************************************************************
	PART 3
	DEFINE WHAT IS GOING TO HAPPEN IF YOUR LINK 'Add Product' IS CLICKED ---> isset( $_GET['add'] )
***************************************************************************************************/
 
if( isset( $_GET['add'] )/* YOUR LINK ADD PRODUCT IS CLICKED */ ){	
	include("includes/inc.db.php");
	// SELECT FROM DATABASE id AND name OF SPECIFIC PRODUCT CLICKED ---> $query = 'SELECT...
	// BASED ON THE QUERY STRING 	
	$query = 'SELECT id, name  FROM list WHERE id = ' . mysqli_real_escape_string($connect, trim((int)$_GET['add'])); // IF YOU CLICK 'Add Product', 
				  			// YOU WANT TO MAKE SURE THAT SELECTED NAME FROM DATABASE
							// HAS id NUMBER FROM YOUR QUERY STRING ( ONE YOU HAVE CLICKED ) 
							// SINCE QUERY STRING IS NOT COMING FROM DATABASE, WE WILL PROTECT DATABASE USING mysqli_real_escape_string()
		
		
	$result = mysqli_query( $connect, $query ); 
	$row=mysqli_fetch_assoc($result);	
		
 
	
	if( $row ){
		// USE 'listItem_' AS THE KEY FOR YOUR $_SESSION ARRAY ELEMENT AND
		// BY CONCATENATING 'listItem_id' WITH THE QUERY STRING VALUE THAT IS CLICKED $_GET['add']
		// PASS YOUR SELECTED PRODUCT NAME FROM $row['name'] TO $_SESSION ARRAY
		$_SESSION['listItem_' . $_GET['add']] = $row['name'];
		
	}
	
}




/*************************
	PART 4
	CLEARING THE SESSION
*************************/
//
if($_GET['clear']/* IF 'CLEAR THE SESSION BUTTON IS CLICKED' */){
	// CLEAR EVERYTHING FROM THE $_SESSION ARRAY
	
	session_destroy();
	
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SHOPPING LIST</title>
<link rel="stylesheet" type="text/css" href="myStyle.css"> 
</head>
<body>
	<h2>Final Assignment-Shopping List</h2>
    <p>Reminder: You can add each item into list once per item.</p>
    <p>The function of "Clear the session" only work when you click it twice.</p>
    <p>Thank you. Hope you have fun with this website. Have a nice day.</p>
	<div class="prodlist">
	<?php
		products();
		// CALL YOUR FUNCTION THAT WILL DISPLAY 
		// YOUR SELECTED DB CONTENT IN THE HTML TABLE
    ?>
    </div>
    <div class="shopplist">
    <?php
		
		
		// ALL IT'S LEFT TO DO:
		// USE FOREACH LOOP THROUGH THE $_SESSION ARRAY AND
		// WRITE OUT EVERYTHING $_SESSION CONTAINS
		include("removeIndividualItem.php");
		
		
		// DISPLAY THE BUTTON FOR CLEARING THE SESSION HERE
		// IF SIZE OF SESSION ARRAY IS NOT 0. 
		if(sizeof($_SESSION) !=0){
			echo "<button type=\"button\"> <a href=\"index.php?clear=CLEAR THE SESSION\" >CLEAR THE SESSION</a></button>";	
		}
	?>
    </div>	
</body>
</html>

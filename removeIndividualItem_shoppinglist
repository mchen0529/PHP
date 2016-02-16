<?php
		// loop through your session array and 
		// write out everything it is there
		echo '<h2>SHOPPING LIST</h2>';
		
		if( isset( $_SESSION ) ){
			
			echo '<ul>';
			
			foreach( $_SESSION as $k=>$v ){	
				$id = substr( $_GET['add'], 0, strlen($_GET['add']) );
				// extract your id number from the listItem_id using substr()
				// whatever substr() outputs pass it to $id:
				// $id = substr( string, start, length )
					// use strlen() - that will return you the third argument which 
					// will define the length of your $id	
					
				echo '<li>' . $v . /*' <a href="index.php?delete=' . $id . '">[Remove Product]</a>*/'</li>';
				
			}
					
			echo '</ul>';
		}
		
// HANDLE THIS ABOVE THE DOCTYPE:
//if( isset($_GET['delete'])/*if a link delete is clicked*/ ){
	// delete element from $_SESSION using unset(sessionElementToBeDeleted)
	 //unset($_SESSION['listItem_' . $_GET['delete']]); 
	
	// this time your _SESSION key will be concatenated expression of:
	// 'listItem_' and $_GET['delete']
//}
?>

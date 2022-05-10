<?php 
include "db_conn.php"; 
global $conn;
?>
<!DOCTYPE html>
<html>
<head>
	<title>View</title>
	<link rel="stylesheet" href="css/css.css">
</head>

<div class="navbar">
  		<a href="view.php">Voir Data</a>
  		<a href="index.php">Upload</a>
  		<div class="dropdown">
    		<button class="dropbtn">More
     	 		<i class="fa fa-caret-down"></i>
    		</button>
    		<div class="dropdown-content">
      			<a href="#">Link 1</a>
      			<a href="#">Link 2</a>
      			<a href="#">Link 3</a>
    		</div>
  		</div>
	</div> 

<body class="body">
     <a href="index.php">&#8592;</a>
	 <form action="" method="post">
		 <button type="submit" name="changeData"> TEST </button>
	 </form>
     <?php

		function createContent($res, $sql){
			if (mysqli_num_rows($res) > 0) {
				while ($images = mysqli_fetch_assoc($res)) {  ?>
	   
	   			<div class="alb" id="result">
		   		<img src="uploads/<?=$images['image_url']?>">
		  		<p> <?=$images['image_date']?> </p>
	   			</div>          		
		<?php 
				} 
			}		 
		}

		function dateDesc($conn){
			$sql = "SELECT * FROM images ORDER BY image_date DESC";
			$res = mysqli_query($conn,  $sql);
			createContent($res, $sql);
		}

		if(isset($_POST['changeData'])){
			dateDesc($conn);
		}

		else {
			$sql = "SELECT * FROM images ORDER BY image_date ASC";
    		$res = mysqli_query($conn,  $sql);

			createContent($res, $sql);
		}
	
	?>

</body>
</html>

<script>
function clear_div() {
    document.getElementById("result").innerHTML = "";
}
</script>
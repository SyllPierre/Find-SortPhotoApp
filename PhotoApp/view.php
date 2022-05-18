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
				
				<button onclick="document.getElementById('id01').style.display='block'"> Supprimer Data </button>
				
				<div id="id01" class="modal">
					<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">x</span>
					<from class="modal-content" action="">
						<h1> Delete Data </h1>
						<p> Are you sure you want to delete data ? </p>

						<div>
						
							<button type="button" onclick="document.getElementById('id01').style.display='none'"> Cancel </button>

							<button type="button" onclick="document.getElementById('id01').style.display='none'"> Delete </button>

						</div>

					</from>

	   			</div>          		
		<?php 
				} 
			}		 
		}

		function dateDesc($conn){
			$sql = "SELECT * FROM images WHERE filters like '%identité%' OR filters like '%Pierre%' ORDER BY image_date DESC";
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

var modal = document.getElementById('id01');

window.onclick = function(event){
	if (event.target == modal){
		modal.style.display = "none";
	}
}
</script>
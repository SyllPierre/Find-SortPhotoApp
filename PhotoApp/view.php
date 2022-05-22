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
	 	 <input type="text" name="filtersSearch" size="100">
    	 <label for="filters">Mots clés à rechercher</label>
		 <button type="submit" name="changeData"> TEST </button>
	 </form>
     <?php

		function createContent($res, $sql){
			?> 
			<tr>
			<?php 
			if (mysqli_num_rows($res) > 0) {
				while ($images = mysqli_fetch_assoc($res)) {  ?>

				<th>

	   			<div class="alb" id="result">
		   		<img src="uploads/<?=$images['image_url']?>">
		  		<p> <?=$images['image_date']?> </p>
				
				<form action="" method="post">
					<input type="text" name="URL" id="name" value="<?=$images['image_url']?>" >

					<button type="submit" name="deleteBtn"> Supprimer Data </button>
				</form>
				</th>
				      		
		<?php 
				}
			?>

			</tr>

			<?php
			}		 
		}

		function createPage($conn){
			$sql = "SELECT * FROM images ORDER BY image_date ASC";
    		$res = mysqli_query($conn,  $sql);

			createContent($res, $sql);
		}

		function dateDesc($conn, $tabMots){
			$sql = "SELECT * FROM images";
			$lenTab = count($tabMots);
			if ($lenTab > 0){
				if($lenTab == 1 && $tabMots[0] == ""){
					$res = mysqli_query($conn,  $sql);
				}

				else {
					$likeFilters = " WHERE filters like";
					$i = 0;

					foreach ($tabMots as $mot){
						$likeFilters .= " '%$mot%' ";
						$i += 1;

						if ($i < $lenTab){
							$likeFilters .= "OR filters like";
						}
					}

					$sql .= $likeFilters;
					$res = mysqli_query($conn,  $sql);
				}
			}

			//$sql = "SELECT * FROM images WHERE filters like '%identité%' OR filters like '%Pierre%' ORDER BY image_date DESC";
			//$res = mysqli_query($conn,  $sql);
			
			createContent($res, $sql);
		}

		function deleteData($conn, $imgUrl){
			$sql = "DELETE FROM images WHERE `image_url` = '$imgUrl' ";
			mysqli_query($conn,  $sql);
			unlink("uploads/".$imgUrl);
			createPage($conn);
		}

		if(isset($_POST['changeData']) && isset($_POST['filtersSearch'])){
			$tab = explode(" ", $_POST['filtersSearch']);
			dateDesc($conn, $tab);
		}

		else if(isset($_POST['deleteBtn']) && isset($_POST['URL'])){
			deleteData($conn, $_POST['URL']);
		}

		else {
			createPage($conn);
		}
	
	?>

</body>
</html>

<script>
function clear_div() {
    document.getElementById("result").innerHTML = "";
}
</script>
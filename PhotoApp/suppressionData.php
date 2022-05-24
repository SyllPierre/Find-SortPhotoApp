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
  		<a href="view.php">Voir toutes les données</a>
  		<a href="index.php">Upload données</a>
        <a href="suppressionData.php">Page de suppression de Data</a>
		<a href="diaporama.php">Diaporama de toutes les photos</a>
  		</div>
	</div> 

<body class="body">
	 <form action="" method="post">
	 	 <input type="text" name="filtersSearch" size="100" placeholder="Rechercher"> </br>
    	 <label for="filters">Mots clés à rechercher</label>
		 <button type="submit" name="changeData"> Rechercher </button> </br>
	 </form>

     <?php

		function createContent($res, $sql){
			?>
			<table>
			<tr>
			<?php 
			if (mysqli_num_rows($res) > 0) {
				while ($images = mysqli_fetch_assoc($res)) {  ?>

				<tr>

	   			<div class="alb" id="result">
				<th> <img src="uploads/<?=$images['image_url']?>"  style="width: 25vw; min-width: 140px; max-height: 250px"> </th>
		  		<th> <p> <?=$images['image_date']?> </p> </th>
				<th> <p> <?=$images['filters']?> </p> </th>
				
				<th>
				<form action="" method="post">
					<input type="text" name="URL" id="nameUrl" value="<?=$images['image_url']?>" >

					<button type="submit" name="deleteBtn"> Supprimer Data </button>
				</form>
				</th>
				</div>
				</tr>
				      		
		<?php 
				}
			?>

			</table>

			<?php
			}		 
		}

		function createPage($conn){
			$sql = "SELECT * FROM images2 ORDER BY image_date ASC";
    		$res = mysqli_query($conn,  $sql);

			createContent($res, $sql);
		}

		function rechercheMots($conn, $tabMots){
			$sql = "SELECT * FROM images2";
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

			createContent($res, $sql);
		}

		function deleteData($conn, $imgUrl){
			$sql = "DELETE FROM images2 WHERE `image_url` = '$imgUrl' ";
			mysqli_query($conn,  $sql);
			unlink("uploads/".$imgUrl);
			createPage($conn);
		}

		if(isset($_POST['changeData']) && isset($_POST['filtersSearch'])){
			$tab = explode(" ", $_POST['filtersSearch']);
			rechercheMots($conn, $tab);
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
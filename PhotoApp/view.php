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
			<?php 
			if (mysqli_num_rows($res) > 0) { ?>
				<form action="diaporamaSelection.php"
				method="post"
				enctype="multipart/form-data">
				<?php
				while ($images = mysqli_fetch_assoc($res)) {  ?>
				<tr>

	   			<div class="alb" id="result">
		   		<th> <img src="uploads/<?=$images['image_url']?>"  style="width: 25vw; min-width: 140px; max-height: 250px"> </th>
		  		<th> <p> <?=$images['image_date']?> </p> </th>
				<th> <p> <?=$images['filters']?> </p> </th>

				<th> <input type="checkbox" name="images[]" value="<?=$images['image_url']?>"> Cocher la case pour sélectionner la photo dans le diaporama </th> </br>
				
				</div>

				</tr>
				      		
		<?php 
				}
			?>

			<input type="submit" name="selectDiapo" value="Lancer la selection en Diaporama">

			</form>

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

		if(isset($_POST['changeData']) && isset($_POST['filtersSearch'])){
			$tab = explode(" ", $_POST['filtersSearch']);
			rechercheMots($conn, $tab);
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
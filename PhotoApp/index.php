<!DOCTYPE html>
<html>
<head>
	<title>Photo App</title>
	<link rel="stylesheet" href="css/css.css">
</head>

<div class="navbar">
  		<a href="view.php">Voir Data</a>
  		<a href="index.php">Upload</a>
		<a href="suppressionData.php">Page de suppression de Data</a>
		<a href="diaporama.php">Diaporama de toutes les photos</a>
	</div> 

<body>
	<?php if (isset($_GET['error'])): ?>
		<p><?php echo $_GET['error']; ?></p>
	<?php endif ?>
     <form action="upload.php"
           method="post"
           enctype="multipart/form-data"
		   id="form"
		   class="topBefore">

           <input type="file" 
                  name="my_image"> </br>

			<input type="text" 
                  name="titlePhoto" placeholder="Titre Photo"> </br>
			
			<input type="date" id="start" name="image_date"> </br>

			<input type="text" name="filters" size="100" placeholder="Description"> </br>

        	<input type="submit" 
                  name="submit"
                  value="Upload"
				  id="submit"> </br>
     	
     </form>
	
	<script type="text/javascript">

		document.getElementById('start').value = new Date().toISOString().substring(0, 10);
	</script>
</body>
</html>
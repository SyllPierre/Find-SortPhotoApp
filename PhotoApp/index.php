<!DOCTYPE html>
<html>
<head>
	<title>Photo App</title>
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

<body>
	<?php if (isset($_GET['error'])): ?>
		<p><?php echo $_GET['error']; ?></p>
	<?php endif ?>
     <form action="upload.php"
           method="post"
           enctype="multipart/form-data">

           <input type="file" 
                  name="my_image">
			
			<input type="date" id="start" name="image_date">

			<input type="checkbox" name="filters[]" value="nature">
      		<label for="nature">Nature</label>
			
			<input type="checkbox" name="filters[]" value="vacances">
      		<label for="vacances">Vacances</label>
			
			<input type="checkbox" name="filters[]" value="famille">
      		<label for="famille">Famille</label>

        	<input type="submit" 
                  name="submit"
                  value="Upload">
     	
     </form>
	
	<script type="text/javascript">

		document.getElementById('start').value = new Date().toISOString().substring(0, 10);
	</script>
</body>
</html>
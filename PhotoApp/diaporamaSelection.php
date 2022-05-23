<?php 
	if (isset($_POST['selectDiapo']) && isset($_POST['images'])){

	// $nom_dossier = "uploads/";
	// $dossier = opendir($nom_dossier);
	// $chaine = ""; $compteur = 0; $dernier_fichier="";
	
	// while($fichier = readdir($dossier))
	// {
	// 	if($fichier != "." && $fichier != ".." && (strtolower(pathinfo($fichier, PATHINFO_EXTENSION)) == "jpg" || strtolower(pathinfo($fichier, PATHINFO_EXTENSION)) == "png" || strtolower(pathinfo($fichier, PATHINFO_EXTENSION)) == "jpeg"))
	// 	{
	// 		$chaine .= $fichier.";";
	// 		$dernier_fichier = $fichier;
	// 		$compteur++;
	// 	}
	// }
	
	// $chaine = trim($chaine,";");

	// $compteur = ceil($compteur/4)*4-$compteur;

	// if($compteur>0){
	// 	for($i=0;$i<$compteur;$i++){
	// 		$chaine .= ";".$dernier_fichier;
	// 	}
	// }
	
	// closedir($dossier);

	$chaine = ""; $compteur = 0; $dernier_fichier="";
	
	$tabImagesDiapo = $_POST['images'];

	foreach($tabImagesDiapo as $fichier)
	{
		if($fichier != "." && $fichier != ".." && (strtolower(pathinfo($fichier, PATHINFO_EXTENSION)) == "jpg" || strtolower(pathinfo($fichier, PATHINFO_EXTENSION)) == "png" || strtolower(pathinfo($fichier, PATHINFO_EXTENSION)) == "jpeg"))
		{
			$chaine .= $fichier.";";
			$dernier_fichier = $fichier;
			$compteur++;
		}
	}
	
	$chaine = trim($chaine,";");

	$compteur = ceil($compteur/4)*4-$compteur;

	if($compteur>0){
		for($i=0;$i<$compteur;$i++){
			$chaine .= ";".$dernier_fichier;
		}
	}
	

	}

	else {
		header("Location: view.php");
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title>Diaporama photos</title>
<meta name="description" content="Gérer les contrôles img par le code pour faire défiler les images" />
<meta http-equiv="content-language" content="fr" />
<link href='css/mef.css' rel='stylesheet' type='text/css' />
</head>

<div class="navbar">
  		<a href="view.php">Voir Data</a>
  		<a href="index.php">Upload</a>
		<a href="suppressionData.php">Page de suppression de Data</a>
		<a href="diaporama.php">Diaporama de toutes les photos</a>
</div> 

<body>

	<div class="div_conteneur_parent">
	
		<div class="div_conteneur_page">	
			<div class="titre_page"><h1>Mon album Photos</h1></div>
			
			<div class="div_int_page">
			
			<div class="div_saut_ligne">
			</div>						
			
			<div style="float:left;width:10%;height:40px;"></div>
			<div style="float:left;width:80%;height:40px;text-align:center;">
			<div id="GTitre">
			<h1>Diaporama photos</h1>
			</div>
			</div>
			<div style="float:left;width:10%;height:40px;"></div>
			
			<div class="div_saut_ligne" style="height:60px">
			</div>
			
			<div style="width:100%;height:auto;text-align:center;">
			
			<div style="width:800px;display:inline-block;" id="conteneur">
				<div id="centre">
					<div id="barre">
						<input type="button" value="Lancer" onClick="demarrer()" style="background: linear-gradient( #555, #2C2C2C);margin-bottom:5px;" /><br />
						<input type="text" id="minutage" value="2" onClick="this.value=''" /><br />
						<input type="button" value="Arrêter" onClick="arreter()" style="background: linear-gradient( #555, #2C2C2C);margin-top:5px;" />
					</div>			
					<div class="texte_photo" id="texteph" >Titre de la photo</div>
					<div class="miniature">
						<img src="images/image-defaut.jpg" alt="" class="img_miniature" id="mini1" onClick="selection(1)" />
					</div>
					<div class="miniature" style="left:173px;">
						<img src="images/image-defaut.jpg" alt="" class="img_miniature" id="mini2" onClick="selection(2)" />
					</div>
					<div class="miniature" style="left:346px;">
						<img src="images/image-defaut.jpg" alt="" class="img_miniature" id="mini3" onClick="selection(3)" />
					</div>
					<div class="miniature" style="left:519px;">
						<img src="images/image-defaut.jpg" alt="" class="img_miniature" id="mini4" onClick="selection(4)" />
					</div>						
					<div id="precedent">
						<input type="button" value="<<" title="Photo précédente" onClick="defiler('arriere')" />
					</div>
					<div style="position:absolute;">
						<img src="images/image-defaut.jpg" alt="" id="album"/>
					</div>
					<div id="suivant">
						<input type="button" value=">>" title="Photo suivante" onClick="defiler('avant')" />
					</div>			
				</div>
			</div>
			
			</div>

			<div class="div_saut_ligne" style="height:150px;">
			</div>	
			
			</div>
		</div>
	
	</div>
	
</body>
<script type="text/javascript" language="javascript">
	
	var chaine_img = "<?php echo $chaine; ?>"

	var tab_img=chaine_img.split(';');
	var nb_img = tab_img.length;
	var chemin ="uploads/";
	var position = 0;
	var interval = 0;
	var temporisation = 2000;
	
	document.getElementById("album").src=chemin + tab_img[position];
	document.getElementById("mini1").src=chemin + tab_img[position];
	document.getElementById("mini2").src=chemin + tab_img[position+1];
	document.getElementById("mini3").src=chemin + tab_img[position+2];
	document.getElementById("mini4").src=chemin + tab_img[position+3];
	document.getElementById("mini1").style.border="#84020b 3px solid";

	traite_texte(tab_img[position]);
	
	function demarrer()
	{		
		if(!isNaN(parseInt(document.getElementById("minutage").value)))
		{
			temporisation = document.getElementById("minutage").value*1000;
			if(temporisation<2000)
				temporisation=2000;
		}
			
		interval = setInterval(function(){ defiler("avant") },temporisation);
	}
	
	function arreter()
	{
		clearInterval(interval);
	}

	function defiler(comment)
	{	
		document.getElementById("album").className="masquer";
		
		if(comment=="avant")
			position++;
		else
			position--;
			
		if(position<0)
		{
			position = nb_img-1;
			document.getElementById("mini1").src=chemin + tab_img[position-3];
			document.getElementById("mini2").src=chemin + tab_img[position-2];
			document.getElementById("mini3").src=chemin + tab_img[position-1];
			document.getElementById("mini4").src=chemin + tab_img[position];					
			
		}
		else if(position == nb_img)
		{
			position = 0;
			document.getElementById("mini1").src=chemin + tab_img[position];
			document.getElementById("mini2").src=chemin + tab_img[position+1];
			document.getElementById("mini3").src=chemin + tab_img[position+2];
			document.getElementById("mini4").src=chemin + tab_img[position+3];			
		}
		else if(position % 4 ==0 && comment=="avant")
		{
			document.getElementById("mini1").src=chemin + tab_img[position];
			document.getElementById("mini2").src=chemin + tab_img[position+1];
			document.getElementById("mini3").src=chemin + tab_img[position+2];
			document.getElementById("mini4").src=chemin + tab_img[position+3];			
		}
		else if((position+1) % 4 ==0 && comment=="arriere" && position!=0)
		{
			document.getElementById("mini1").src=chemin + tab_img[position-3];
			document.getElementById("mini2").src=chemin + tab_img[position-2];
			document.getElementById("mini3").src=chemin + tab_img[position-1];
			document.getElementById("mini4").src=chemin + tab_img[position];			
		}

		var attente = setTimeout(function()
		{
			document.getElementById("album").src=chemin + tab_img[position];
			document.getElementById("album").className="afficher";

			for(var indice=1;indice<5;indice++)
			{
				document.getElementById("mini" + indice).style.border="#333 1px solid";
				if(document.getElementById("mini" + indice).src==document.getElementById("album").src)
					document.getElementById("mini" + indice).style.border="#84020b 3px solid";
			}

			traite_texte(tab_img[position]);				
		}
		,1000);
		
	}
	
	function selection(img_source)
	{
		var image_en_cours = document.getElementById("mini" + img_source).src;
		var pos_caractere = image_en_cours.lastIndexOf("/",image_en_cours);
		
		setTimeout(function(){  }, 2000);
		document.getElementById("album").className="afficher";
		document.getElementById("album").src=image_en_cours;		
		
		for(var indice=1;indice<5;indice++)
		{
			document.getElementById("mini" + indice).style.border="#333 1px solid";
		}
		
		document.getElementById("mini" + img_source).style.border="#84020b 3px solid";
		
		image_en_cours = image_en_cours.substring(pos_caractere+1);
		
		for(var defil=0;defil<nb_img;defil++)
		{
			if(tab_img[defil]==image_en_cours)
			{
				position=defil;
				break;
			}
		}

		traite_texte(image_en_cours);
		
	}
	
	function traite_texte(texte)
	{
		var chaine="";
		
		var tab_mots=texte.replace(".jpg","").split('');

		for(var compteur=1;compteur<tab_mots.length;compteur++)
		{
			if(tab_mots[compteur].length>2 || compteur==1)
				chaine += tab_mots[compteur].substr(0,1).toUpperCase() + tab_mots[compteur].substr(1).toLowerCase() + " ";
			else
				chaine += tab_mots[compteur] + "";
		}

		document.getElementById("texteph").innerText = chaine;
	}
	
	function masquer()
	{
		document.getElementById("album").className="masquer";
	}
	
	function afficher()
	{
		setTimeout(function(){ document.getElementById("album").className="afficher"; },2000);
	}	
	
</script>
</html>	
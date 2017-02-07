<?php

$titre="Nouveau Tuto | SiteduSavoir.com";
include ("../includes/session.php");
include("../includes/identifiants.php");
include("../includes/debut.php");
include("../includes/menu.php");

$req = $bdd->query('SELECT cat_id , cat_nom 
	                FROM categorie
	                ORDER BY cat_id');


if(!$id)
{
	$_SESSION['flash']['danger'] = "Vous devez etre connecter  pour rediger un tuto";
	header('Location:../connexion.php');
}


?>


<p id="fildariane"> <i><a href="../index.php">Accueil </a> --> <a href="index.php">Tutoriels</a>-->Nouveau tutoriel</i></p>

<h2 class="titre" style="text-align:center"> Debuter un tutoriel </h2>

<form method="POST" action="debutertuto.php" enctype="multipart/form-data">

	<div class="input_titre">
	      <p class="icon">
	         <img src="../images/icones/text.png" alt="icon"/>
	      </p>
	      <p>
	        <input type="text" name="titre" placeholder="Le titre du tutoriel" required />
	      </p>  
	</div>

	<div class="textarea-titre">
	      <textarea class="textarea" name="intro" required >Votre introduction</textarea>
	</div>

	<div class="textarea-titre">
	      <textarea class="textarea" name="conc" required >Votre conclusion </textarea>
	</div>

	<div class="input_fil">
	      <p>
	        <input type="file" name="banniere"/>
	      </p>
	      <p>
	        Nb/ En cas d'erreur d'envoie de fichier , ou de non rensiegnement une banniere a defaut vous est donner.
	        vous pouvez ensuite modifier celle ci :D
	      </p>  
	</div>

	<div class="select">
	    <select name="cat">
	           <?php
                   $req = $bdd->query('SELECT cat_id , cat_nom 
	                               FROM categorie
	                               ORDER BY cat_id');

	           while($cat = $req->fetch())
	           {
	              echo '<option value="'.$cat['cat_id'].'">'.$cat['cat_nom'].'</option>';
	           }
	           ?>
	    </select>
	</div>

	<div class="valid">
	     <input type="submit" value="Envoyer" />
	</div>

</form>

<?php
 
if(!empty($_POST))
{
	$i = 0 ;

	$titre = (isset($_POST['titre']))?$_POST['titre']:"";
	$intro = (isset($_POST['intro']))?$_POST['intro']:"";
	$conc = (isset($_POST['conc']))?$_POST['conc']:"";
    $cat = (isset($_POST['cat']))?$_POST['cat']:"";

	if(empty($_POST['titre']))
	{
      $i++;
      
      $mess1 = 'Votre titre est vide .';
    }

    if(empty($intro) || empty($conc))
      {
      	$i++;

      	$mess2 = "Votre introduction ou votre conclusion est vide .";
      }

      if(empty($_POST['cat']))
      {
      	$i++;
      	$mess3 = "Une categorie doit etre selectionner .";
      }
      

      if(isset($_FILES['banniere']) AND $_FILES['banniere']['error'] == 0)
       {
       	   $banniere = $_FILES['banniere'];
           $extensions_valides  = array('png','jpg','jpeg','gif');
           $extension = substr(strchr($banniere['name'],'.'),1);

           if(in_array($extension,$extensions_valides))
           {

	           	$nom_ban = $id.'-'.time().'.'.$extension;
	           	move_uploaded_file($banniere['tmp_name'], './tutos_ban/'.$nom_ban);


	           	switch($extension)
		      	{
		      		case "png":

		            $source = imagecreatefrompng('./tutos_ban/'.$nom_ban);
			      	$destination = imagecreatetruecolor(300,225);

			      	$largeur_s = imagesx($source);
			      	$hauteur_s = imagesy($source);
			      	$largeur_d = imagesx($destination);
			      	$hauteur_d = imagesy($destination);

			      	imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_d, $hauteur_d, $largeur_s, $hauteur_s);
			      	imagepng($destination,'./tutos_ban/'.$nom_ban);

	                break;

	                case "jpg":

	                $source = imagecreatefromjpeg('./tutos_ban/'.$nom_ban);
			      	$destination = imagecreatetruecolor(300,225);

			      	$largeur_s = imagesx($source);
			      	$hauteur_s = imagesy($source);
			      	$largeur_d = imagesx($destination);
			      	$hauteur_d = imagesy($destination);

			      	imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_d, $hauteur_d, $largeur_s, $hauteur_s);
			        imagejpeg($destination,'./tutos_ban/'.$nom_ban);

	                break;

	                case "gif":

	                $source = imagecreatefromgif('./tutos_ban/'.$nom_ban);
			      	$destination = imagecreatetruecolor(300,225);

			      	$largeur_s = imagesx($source);
			      	$hauteur_s = imagesy($source);
			      	$largeur_d = imagesx($destination);
			      	$hauteur_d = imagesy($destination);

			      	imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_d, $hauteur_d, $largeur_s, $hauteur_s);
			      	
			        imagegif($destination,'./tutos_ban/'.$nom_ban);

	                break;


	                case "jpeg":

	                $source = imagecreatefromjpeg('./tutos_ban/'.$nom_ban);
			      	$destination = imagecreatetruecolor(300,225);

			      	$largeur_s = imagesx($source);
			      	$hauteur_s = imagesy($source);
			      	$largeur_d = imagesx($destination);
			      	$hauteur_d = imagesy($destination);

			      	imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_d, $hauteur_d, $largeur_s, $hauteur_s);
			        imagejpeg($destination,'./tutos_ban/'.$nom_ban);

	                break;



               }





           }


           

       }
       else
       {
       	   $banniere = './tutos_ban/ban.jpg';
          $source = imagecreatefromjpeg($banniere);
		   $destination = imagecreatetruecolor(300,225);

			      	$largeur_s = imagesx($source);
			      	$hauteur_s = imagesy($source);
			      	$largeur_d = imagesx($destination);
			      	$hauteur_d = imagesy($destination);

			      	imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_d, $hauteur_d, $largeur_s, $hauteur_s);

			      	$nom_ban = $id.'-'.time().'.png';

			      	imagejpeg($destination,'./tutos_ban/'.$nom_ban);

       }

     

  



      if(!$i)
      {
      	$req = $bdd->prepare('INSERT INTO tutos (tutos_titre , tutos_intro, tutos_conc ,tutos_banniere ,tutos_date,tutos_cat,tutos_validation)
      		                  VALUES(:titre , :intro ,:conc ,:ban , NOW(), :cat , \'0\')');
      	$req->execute(array(

              'titre'  => $titre,
              'intro'  => $intro,
              'conc'   => $conc,
              'ban'    => $nom_ban,
              'cat'    => $cat,


      		));

      	$req->closeCursor();

      	$dernierid = $bdd->lastInsertId();

      	$req1 = $bdd->prepare('INSERT INTO tutos_par (membre_id,tutos_id)
      		                  VALUES(:membre , :tuto)');
      	$req1->bindParam(':membre',$id,PDO::PARAM_INT);
      	$req1->bindParam(':tuto',$dernierid, PDO::PARAM_INT);

      	$req1->execute();

      	$_SESSION['flash']['success'] = " Votre tuto a bien été creer , rendez vous dans mes tutoriels pour le modifier et/ou l'achever";
      	header('Location:debutertuto.php');

      }
      else
      {
      	$_SESSION['flash']['danger'] = $mess1 ."</br>".$mess2 ."</br>" . $mess3 ; 
      	header('Location:debutertuto.php');
      }	

      
}








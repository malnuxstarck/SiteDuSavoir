<body>

           <div id="page">

		      <div id="banniere">

		             <h1 id="titre"> Site Du Savoir </h1>

		             <div id ="infos">

		             <?php

		             if($id)
		             {
		             	echo 

		             	'<ul>
			             	    <li> 
			             	       <a href="../../controleur/membre/voirmonprofil.php?id='.$id.'">Mon compte </a>

			             	       <ul>
                                          <li>
                                               <a href="../../controleur/membre/editerprofil.php?id='.$id.'">Parametres</a>
                                          </li>

                                          <li>
                                              <a href="../../../controleur/membre/amis.php">Amis</a>
                                          </li>

                                          <li>
                                               <a href="../../controleur/membre/messagesprives.php">Messages</a>
                                          </li>

                                          <li>
                                                <a href="../../controleur/membre/notifications.php">Notiffications </a>
                                          </li>

                                          <li>
                                                <a href="../../controleur/deconnexion.php"> Se deconnecter </a>
                                          </li>
			             	       </ul>

	                           </li>
		             	 </ul>

		             	 ';

		             	

		             	echo '</div>';

		             }

		             else
		             {
		             	echo '</div>';
		             }

		             echo

					 '<div class="menu">

					    <ul>
					        <li>
					            <a href="../../index.php"><img src="../../vue/images/accueil.png" id="accueil" alt="A"/> Accueil</a>
					        </li>

				            <li>
				                <a href="../../controleur/forum">Forum</a>
				            </li>

				            <li>
				                 <a href="../../controleur/tutoriels">Tutoriels</a>
				            </li>

							<li> 
							     <a href="../../controleur/social">Social</a>
							</li>    
							<li> 
							    <a href="../../controleur/blog">Blog</a>
							</li>
						</ul>

				</div>        

		     </div>';

		     ?>
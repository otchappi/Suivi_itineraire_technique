function visibilite(fils){
	var formul=document.getElementById(fils);
	if(formul.style.display =='block')
	{
		formul.style.display ='none';
	}
	else
	{
		formul.style.display ='block';
	}
}
function activer_menu(id){
	var formul=document.getElementById(id);
	if(id=='rubrique' || id=='devis')
	{
		visibilite('configurer_element');
	}
	if(id=='localisation' || id=='compte' || id=='annonce_identite' || id=='securite')
	{
		visibilite('parametre_element');
	}
	if(id=='nouveau' || id=='reception' || id=='envoi')
	{
		visibilite('messagerie_element');
	}
	formul.style.backgroundColor ='#2d8334';
}
function cacher_menu(id_menu,id_contenu)
{
	var formul=document.getElementById(id_menu);
	var contenu=document.getElementById(id_contenu);
	var afficheur=document.getElementById('afficheur');
	var reducteur=document.getElementById('reducteur');
	formul.style.display ='none';
	contenu.setAttribute('class','col-md-12');
	afficheur.style.display ='block';
}
function afficher_menu(id_menu,id_contenu)
{
	var formul=document.getElementById(id_menu);
	var contenu=document.getElementById(id_contenu);
	var afficheur=document.getElementById('afficheur');
	var reducteur=document.getElementById('reducteur');
	formul.style.display ='block';
	contenu.setAttribute('class','col-md-10');
	afficheur.style.display ='none';
}

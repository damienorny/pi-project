<?php

	$bouton = $_POST['bouton'];
	$resultat = $_POST['resultat'];
	$tableauMots = explode(" ", $resultat);
	
	if($bouton == "haut" || (in_array("tire", $tableauMots) || in_array("tir", $tableauMots) || in_array("feu", $tableauMots) || in_array("missile", $tableauMots)))
	{
		system("./scripts/test 1");
			/*echo '<div class="row">
         	<div class="col-md-4 col-xs-4"><button class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-arrow-up"></span></button></div>';*/
	}
	elseif($bouton == "bas")
	{
			/*echo '<div class="row">
         	<div class="col-md-4 col-xs-4"><button class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-arrow-down"></span></button></div>';*/
	}
	elseif($bouton == "gauche")
	{
		system("./scripts/moteur 5");
			/*echo '<div class="row">
         	<div class="col-md-4 col-xs-4"><button class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-arrow-left"></span></button></div>';*/
	}
	elseif($bouton == "droite")
	{
		system("./scripts/moteur -5");
			/*echo '<div class="row">
         	<div class="col-md-4 col-xs-4"><button class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-arrow-right"></span></button></div>';*/
	}
	elseif($bouton == "bleue")
	{
			echo '<div class="row">
         	<div class="col-md-4 col-xs-4"><button class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-arrow-right"></span></button></div>';
	}
	elseif($bouton == "vert")
	{
			echo '<div class="row">
         	<div class="col-md-4 col-xs-4"><button class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-arrow-right"></span></button></div>';
	}
	elseif($bouton == "jaune")
	{
			echo '<div class="row">
         	<div class="col-md-4 col-xs-4"><button class="btn btn-warning btn-lg btn-block"><span class="glyphicon glyphicon-arrow-right"></span></button></div>';
	}
	elseif($bouton == "rouge")
	{
			echo '<div class="row">
         	<div class="col-md-4 col-xs-4"><button class="btn btn-danger btn-lg btn-block"><span class="glyphicon glyphicon-arrow-right"></span></button></div>';
	}
?>
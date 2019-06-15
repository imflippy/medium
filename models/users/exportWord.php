<?php

include '../../config/connection.php';
include "../adminPanel/functions.php";

$autor = autor();
//var_dump($autor);

$word = new COM("Word.Application");
$word->Visible = true;

$word->Documents->Add();
$word->Selection->TypeText("First Name: $autor->ime \n Last Name: $autor->prezime \n Birthday: $autor->datum \n Faculty: $autor->skola \n ID: $autor->index \n Born: $autor->mesto");

$word->Documents[1]->SaveAs("Author.doc");

header("Location: ../../index.php?page=autor");
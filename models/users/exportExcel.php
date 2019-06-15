<?php

require "../../config/connection.php";
require "functions.php";

$getUsers = getAllUsers();

$excel = new COM("Excel.Application");

$excel->Visible = 1;

$excel->DisplayAlerts = 1;


$workbook = $excel->Workbooks->Add();

$sheet = $workbook->Worksheets('Sheet1');
$sheet->activate;

$br = 1;
foreach ($getUsers as $user){
        $polje = $sheet->Range("A{$br}");
        $polje->activate;
        $polje->value = $user->id_user;

        $polje = $sheet->Range("B{$br}");
        $polje->activate;
        $polje->value = $user->first_name;

        $polje = $sheet->Range("C{$br}");
        $polje->activate;
        $polje->value = $user->last_name;

        $polje = $sheet->Range("D{$br}");
        $polje->activate;
        $polje->value = $user->email;

        $polje = $sheet->Range("E{$br}");
        $polje->activate;
        $polje->value = $user->description;

        $polje = $sheet->Range("F{$br}");
        $polje->activate;
        $polje->value = $user->created_at;

    $polje = $sheet->Range("G{$br}");
    $polje->activate;
    $polje->value = $user->role_name;
        $br++;
    }

$workbook->_SaveAs("http://localhost/Medium/models/users/UserInfo.xlsx", -4143);
$workbook->Save();

$workbook->Saved=true;
$workbook->Close;

$excel->Workbooks->Close();
$excel->Quit();

unset($sheet);
unset($workbook);
unset($excel);

header("Location: ../../index.php?page=pocetna");
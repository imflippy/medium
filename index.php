<?php
    include "config/connection.php";
    include "models/users/functions.php";
    include "models/posts/functions.php";
    include "models/comments/functions.php";
    include "models/adminPanel/functions.php";
	require_once "views/fixed/head.php";

// moras staviti !isset kada budes zavrsio sajt!!!
	if(!isset($_SESSION['user'])){
	    include "views/pages/loginRegister.php";
    }else{
	    include "views/fixed/nav.php";
	    if(isset($_GET['page'])){
            switch($_GET['page'])
            {
                case 'pocetna':
                    include "views/pages/profile_info.php";
                    include "views/pages/postovi.php";
                    break;
                case 'profilUser':
                    include "views/pages/profile_user_info.php";
                    include "views/pages/profile_details.php";
                    include "views/pages/postovi2.php";
                    break;
                case 'editProfile':
                    include "views/pages/editProfile.php";
                    break;
                case 'editPost':
                    include "views/pages/editPost.php";
                    break;
                case 'comment':
                    include "views/pages/profile_info.php";
                    include "views/pages/comments.php";
                    break;
                case 'adminPanel':
                    include "views/pages/admin.php";
                    break;
                case 'autor':
                    include "views/pages/autor.php";
                    break;
                default:
                    include "views/pages/profile_info.php";
                    include "views/pages/postovi.php";
                    break;
            }
        } else{
            include "views/pages/profile_info.php";
            include "views/pages/postovi.php";
        }
    }
	include "views/fixed/footer.php";




?>

	  


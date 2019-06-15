$(document).ready(function() {
	$('ul.nav li.dropdown').hover(function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
	}, function() {
	  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
	});    
	
	/*============================================
	Scroll To Top
	==============================================*/

	//When distance from top = 250px fade button in/out
	$(window).scroll(function(){
		if ($(this).scrollTop() > 250) {
			$('#scrollup').fadeIn(300);
		} else {
			$('#scrollup').fadeOut(300);
		}
	});

	//On click scroll to top of page t = 1000ms
	$('#scrollup').click(scrollNaTop);



	//$('html, body').animate({scrollTop:$(document).height()}, 'slow');
/*Moj kod krece ovde*/

    //Korisnici
	$("#btnRegister").click(userRegister);
	$("#btnLogin").click(userLogin);
	$("#btnUpdateProfile").click(updateUprofile);
	$("#btnUpdatePassword").click(updatePassword);

//	Postovi
	if(url.indexOf("pocetna") != -1) {
		getPosts();
		$(document).on("click", ".getCategory", getPosts);
	}
	if(url.indexOf("profilUser") != -1){
 		getUserPosts();
	}
	///Comments
	if(url.indexOf("comment") != -1) {
		$("#btnReset").click(clearFormComment);
		$("#btnComment").click(insertComment);
		getComments();
		//// Brisanje komentara
		$(document).on("click", ".deleteComm", function (e) {
			e.preventDefault();
			let idComm = $(this).data("comm");
			$.ajax({
				url: "models/comments/deleteComm.php",
				method: "post",
				dataType: "json",
				data:{
					idComm: idComm
				},
				success: function () {
					getComments();
				},
				error: function (xhr, status, error) {
					console.log(error);
				}
			});
		});

		$(document).on("click", ".updateComm", function (e) {
			e.preventDefault();

			var idComm = $(this).data("comm");
			$("#idComm").val(idComm);

			$.ajax({
				url: "models/comments/getOneComment.php",
				method: "post",
				dataType: "json",
				data:{
					idComm: idComm
				},
				success: function (data) {
					fillFormComm(data);
					scrollNaTop();
				},
				error: function (xhr, status, error) {
					console.log(error);
				}
			});
		});



	}
//post na user strani za editovanje
	getPostsProfile();

 	$(document).on("click", ".updatePost", function (e) {
		e.preventDefault();
		let idPost = $(this).data("idpost");
		$.ajax({
			url: "models/posts/getOnePost.php",
			method: "post",
			dataType: "json",
			data:{
				idPost: idPost
			},
			success: function (data) {
				fillForm(data);
			},
			error: function (xhr, status, error) {
				console.log(error);
			}
		});
	}); //dohvatam jedan post i punim formu podacima o njemu
	$(document).on("click", ".deletePost", function (e) {
		e.preventDefault();
		let idPost = $(this).data("idpost");
		console.log(idPost);
		$.ajax({
			url: "models/posts/deletePost.php",
			method: "post",
			dataType: "json",
			data:{
				idPost: idPost
			},
			success: function (data) {
				getPostsProfile(data);
			},
			error: function (xhr, status, error) {
				console.log(error);
			}
		});
	});


//    Search po title and description
	$("#searchPost").keyup(searchPosts);
	$("#textUser").keyup(searchUser);
});

function scrollNaTop(){
	$("html, body").animate({ scrollTop: 0 }, 1000);
	return false;
}

window.onscroll = function() {
	//console.log(window.innerHeight + window.scrollY);
	//console.log(document.body.scrollHeight);
	if ((Math.ceil(window.innerHeight + window.scrollY)) >= Math.ceil(document.body.scrollHeight)) {
		// you're at the bottom of the page
		console.log("Bottom of page");
		setTimeout(getPosts, 300);
		setTimeout(getUserPosts, 300);

	}
};


/*Login and Register form*/

$(".tabs a").on("click", function(){
	var id = $(this).attr("id");
	if(id == 2){
		$("#register").css("display","block");
		$("#login").css("display","none");
	}
	else{
		$("#register").css("display","none");
		$("#forgetP").css("display","none");
		$("#login").css("display","block");
	}
});
$(".reset").on("click", function(){
	$("#login").css("display","block");
	$("#forgetP").css("display","none");
});
$(".forget-password").on("click", function(){
	$("#register").css("display","none");
	$("#login").css("display","none");
	$("#forgetP").css("display","block");
})
function animationHover(element, animation){
	element = $(element);
	element.hover(
		function() {
			element.addClass('animated ' + animation);
			//wait for animation to finish before removing classes
			window.setTimeout( function(){
				element.removeClass('animated ' + animation);
			}, 2000);
		}
	);
};
animationHover("input[type=button]", "shake");


//////////////Url definisan
var url = window.location.href;


function userRegister() {
	var ime = $("#first_name").val();
	var prezime = $("#last_name").val();
	var mail = $("#tbMail").val();
	var sifra = $("#tbPassword").val();


	var reImePrezime = /^[A-Z][a-z]{2,15}$/;
	var reMail = /^[A-Za-z\d\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\;\"\(\)\,\:\;\<\>\@\[\\\]\.]{5,}[^\.]*\@(([a-z\d\-]+)\.[\w\d]+)+$/;


	var greske =[];
	/*Klijentska validacija*/
	if(!reImePrezime.test(ime.trim())){
		greske.push("First Name is not in good format!");
		toastr.error("First Name is not in good format!");
	}
	if(!reImePrezime.test(prezime.trim())){
		greske.push("Last Name is not in good format!");
		toastr.error("Last Name is not in good format!");
	}
	if(!reMail.test(mail.trim())){
		greske.push("Mail is not in good format!");
		toastr.error("Mail is not in good format!");
	}
	if(sifra.length < 6){
		greske.push("Password length must be over 6");
		toastr.error("Password length must be over 6");
	}


	if(greske.length == 0){

		$.ajax({
			url : "models/users/registration.php",
			method : "POST",
			dataType : "json",
			data : {
				first_name : ime,
				last_name : prezime,
				tbMail : mail,
				tbPassword : sifra,
				btnRegister : true
			},
			success: function (data) {
				console.log(data);
				toastr.success("Registration = Done, You can login now <3!");

			},
			error: function (xhr, status, error) {
				console.log(error);
				var statusniKod = xhr.status;

				switch (statusniKod) {
					case 403:
						toastr.error("Access Denied!");
						break;
					case 409:
						toastr.error("Email already exists!");
						break;
					case 422:
						toastr.error("Not valid format!");
						break;
					case 500:
						toastr.error("Error with DataBase!");
						break;
					default:
						toastr.error("ERROR!!! Contact administrator!");
						break;
				}

			}
		});
	}

}

function userLogin() {
	var mail = $("#loginMail").val();
	var sifra = $("#loginPassword").val();

	var reMail = /^[A-Za-z\d\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\;\"\(\)\,\:\;\<\>\@\[\\\]\.]{6,}[^\.]*\@(([a-z\d\-]+)\.[\w\d]+)+$/;

	var greske = [];
	if(!reMail.test(mail.trim())){
		greske.push("Mail is not in good format!");
	}
	if(sifra.length < 6){
		greske.push("Password length must be over 6");
	}

}

function updateUprofile() {
	var ime = $("#tbFirstName").val();
	var prezime = $("#tbLastName").val();
	var mail = $("#tbMail").val();
	var opis = $("#tbDescription").val();
	var id = $("#tbHidden1").val();


	var reImePrezime = /^[A-Z][a-z]{2,15}$/;
	var reMail = /^[A-Za-z\d\!\#\$\%\&\'\*\+\-\/\=\?\^\_\`\{\|\}\~\;\"\(\)\,\:\;\<\>\@\[\\\]\.]{6,}[^\.]*\@(([a-z\d\-]+)\.[\w\d]+)+$/;


	var greske =[];
	/*Klijentska validacija*/
	if(!reImePrezime.test(ime.trim())){
		greske.push("First Name is not in good format!");
		toastr.error("First Name is not in good format!");
	}
	if(!reImePrezime.test(prezime.trim())){
		greske.push("Last Name is not in good format!");
		toastr.error("Last Name is not in good format!");
	}
	if(!reMail.test(mail.trim())){
		greske.push("Mail is not in good format!");
		toastr.error("Mail is not in good format!");
	}

	if(greske.length == 0){
		$.ajax({
			url: 'models/users/updateProfile.php',
			method: 'POST',
			dataType: 'json',
			data: {
				tbFirstName: ime,
				tbLastName : prezime,
				tbMail : mail,
				tbDescription : opis,
				tbHidden1: id,
				btnUpdateProfile: true
			},
			success: function (data) {
				toastr.success("Update = Done");

			},
			error: function (xhr, status, error) {
				var statusniKod = xhr.status;

				switch (statusniKod) {
					case 422:
						toastr.error("Not valid format");
						break;
					case 500:
						toastr.error("Email already exists!");
						break;
					case 400:
						toastr.error("Not possible at the moment");
						break;
					default:
						toastr.error("ERROR!!! Contact administrator!");
						break;
				}
			}
		})
	}
}

function updatePassword() {
	var sifra1 = $("#tbPassword").val();
	var sifra2 = $("#tbPasswordConfirm").val();
	var id = $("#tbHidden2").val();

	var greske = [];

	if(sifra1.length < 6){
		greske.push("Password length must be over 6");
		toastr.error("Password length must be over 6");
	}
	if(sifra1 != sifra2){
		greske.push("Passwords must match");
		toastr.error("Passwords must match!");
	}

	if(greske.length == 0){
		$.ajax({
			url: "models/users/updatePassword.php",
			method: "POST",
			dataType: "json",
			data:{
				tbPassword: sifra1,
				tbHidden2: id,
				btnUpdatePassword: true
			},
			success: function (data) {
				toastr.success("Password has been changed successfully!")
			},
			error: function (xhr, status, error) {
				statusniKod = xhr.status;
				switch (statusniKod) {
					case 422:
						toastr.error("Not valid format");
						break;
					case 500:
						toastr.error("DataBase problem!");
						break;
					case 400:
						toastr.error("Not possible at the moment");
						break;
					default:
						toastr.error("ERROR!!! Contact administrator!");
						break;
				}
			}
		})
	}
}

if(url.indexOf("pocetna") != -1) {
	var br = 2;

	function getPosts() {
		if ((Math.ceil(window.innerHeight + window.scrollY)) >= Math.ceil(document.body.scrollHeight)) {
			br += 3;
		}
		// let category = $(this).data('category');

		$.ajax({
			url: "models/posts/getAllPosts.php",
			method: "post",
			dataType: "json",
			data: {
				br: br
			},
			success: function (data) {
				printPosts(data);
				console.log(br);
			},
			error: function (xhr, status, error) {
				console.log(error);
			}
		});
	}


	function printPosts(data) {
		let html = "";
		if (data != 0) {
			for (let d of data) {
				html += printPost(d);
			}
		} else {
			html += noPosts();
		}
		$("#sviPostovi").html(html);
	}
}
function printPost(post) {
    return `
		
        <div class="tr-section feed" style="border: 1px solid #1ab394;">
\t\t  <div>
\t\t   <div>
\t\t    <div class="mojCssSlika" >
\t\t     <img class="centerSlika" src="${post.photo_path}" alt="${post.title}">
\t\t    </div><!-- /entry-thumbnail -->
\t       </div><!-- /entry-header -->
\t\t   <div class="post-content">
\t\t    <div class="author-post">
\t\t     <a href="index.php?page=profilUser&user=${post.id_user}"><img class="img-fluid rounded-circle" src="${post.comment_path}" alt="Image"></a>
\t\t    </div><!-- /author -->
\t\t    <div class="entry-meta">
\t\t     <ul>
\t\t\t  <li><a href="#">${post.first_name} ${post.last_name}</a></li>
\t\t\t  <li>${obradaDatum(post.post_created_at)} ago</li>
		<li>${post.naziv}</li>
\t\t     </ul>
\t\t\t</div><!-- /.entry-meta -->
\t\t\t<h2><a href="#" class="entry-title">${post.title}</a></h2>
\t\t\t<p>${post.post_description}</p>
\t\t\t<div class="read-more">
\t\t     <div class="feed pull-left">
\t\t\t  <ul>
\t\t\t  <li><a href="index.php?page=comment&id=${post.id_post}"><i class="fa fa-comments"></i>See comments</a></li>&nbsp;

\t\t\t  </ul>
\t\t     </div><!-- /feed -->
\t\t\t
\t\t\t</div><!-- /read-more -->
\t\t   </div><!-- /.post-content -->
\t\t  </div><!-- /.tr-post -->
\t     </div><!-- /.tr-post -->
    `
}
function obradaDatum(time) {

    timeNow = Date.now();
    vremeIzBaze = new Date(time).getTime();
    razlika = timeNow - vremeIzBaze;

    var years = Math.floor(razlika / (1000 * 60 * 60 * 24) / 365);
    var days = Math.floor(razlika / (24 * 60 * 60 * 1000) %365);
    var hours = Math.floor((razlika % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((razlika % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((razlika % (1000 * 60)) / 1000);

    if(minutes < 60 && hours == 0 && days == 0 && years == 0){
        return minutes + ' minutes ';
    } else if(hours < 24 && days == 0 && years ==0){
        return hours + ' hours ';
    } else if(days < 30){
        return days + ' days ';
    } else{
        return "months"
    }
}

function noPosts() {
	return `
		<div class="row">
    
    <div class="col-md-12">
        <h3 style="color: #1ab394">No posts at the moment..</h3>
        
    </div>
    
</div>
	`
}

if(url.indexOf("profilUser") != -1){
	var brojac = 3;
function getUserPosts() {
	if((Math.ceil(window.innerHeight + window.scrollY)) >= Math.ceil(document.body.scrollHeight)){
		brojac += 3;
	}
    $.ajax({
        url: "models/posts/getAllPostsUser.php",
        method: "POST",
        dataType: "json",
		data: {
        	brojac: brojac
		},
        success: function (data) {
            printPostsUser(data);
        },
        error: function (xhr, status, error) {
            console.log(error);
        }
    });
}

function  printPostsUser(data) {
    let html = "";
    if(data !=0){
		for(let d of data){
			html+= printPost(d);
		}
	}else{
    	html += noPosts();
	}
    $("#sviPostoviUser").html(html);
}
}
function searchPosts() {
	let polje = $(this).val();

	$.ajax({
		url: "models/posts/searchPost.php",
		method: "post",
		dataType: "json",
		data: {
			post: polje
		},
		success: function (data) {
			printPosts(data);
		},
		erorr: function (xhr, status, error) {
			consle.log(error);
		}
	});
}

function searchUser() {
	let user = $(this).val();
	$.ajax({
		url: "models/users/searchUser.php",
		method: 'post',
		dataType: "json",
		data:{
			user: user
		},
		success: function (data) {
			printUsers(data);
		},
		erorr: function (xhr, status, error) {
			console.log(error);
		}
	});
}

function printUsers(data) {
	let html = "";
	for(let d of data){
		html+= printUser(d);
	}
	$("#usersPretraga").html(html);
}

function printUser(data) {
return `
	<li style="border: 1px solid #1ab394;">${data.first_name} ${data.last_name}<a href="index.php?page=profilUser&user=${data.id_user}" ><img src="${data.comment_path}" alt="${data.first_name}"></a></li>
	
`
}
//ispis postova na strani za editovanje
function getPostsProfile() {
	$.ajax({
		url: "models/posts/getAllPostsProfile.php",
		method: "post",
		dataType: 'json',
		success: function (data) {
			printPostsProfile(data);
		},
		error: function (xhr, status, error) {
			console.log(error);
		}
	});
}

function printPostsProfile(data) {
	let html = "";
	for(let d of data){
		html += printOnePost(d);
	}
	$("#postoviUser").html(html);
}

function printOnePost(d) {
	return `
		<tr>
			<th><img src="${d.photo_mala_path}" alt="${d.title}"></th>
			<th>${d.title}</th>
			<th>${d.post_description}</th>
			<th>${d.naziv}</th>
			<th><a class="updatePost" data-idpost="${d.id_post}">Update</a></th>
			<th><a class="deletePost" data-idpost="${d.id_post}">Delete</a></th>
		</tr>
	`
}

function fillForm(data) {
	$("#hiddenPost").val(data.id_post);
	$("#tbTitle").val(data.title);
	$("#tbDescription").val(data.post_description);
	$("#ddlCategories").val(data.id_category);

}

if(url.indexOf("comment") != -1) {

	function getComments() {
		var array = url.split('=');
		idPost = array[array.length - 1];

		$.ajax({
			url: "models/comments/getComments.php",
			method: 'post',
			dataType: 'json',
			data: {
				idPost: idPost
			},
			success: function (data) {
				printComments(data);
			},
			error: function (xhr, status, error) {
				console.log(error);
			}
		});
	}

	function printComments(data) {
		let html = "";
		for (let d of data) {
			html += printComment(d);

		}
		$('#sviComments').html(html);
	}


	function printComment(d) {
		return `
	<div class="tr-section feed" style="border: 1px solid #1ab394; overflow: visible;">
\t\t  <div>
\t\t   <div>
\t       </div><!-- /entry-header -->
\t\t   <div class="post-content">
\t\t    <div class="author-post">
\t\t     <a href="index.php?page=profilUser&user=${d.id_user}"><img class="img-fluid rounded-circle" src="${d.comment_path}" alt="Image"></a>
\t\t    </div><!-- /author -->
\t\t    <div class="entry-meta">
\t\t     <ul>
\t\t\t  <li><a href="index.php?page=profilUser&user=${d.id_user}">${d.first_name} ${d.last_name}</a></li>
\t\t\t  <li>${obradaDatum(d.comment_created_at)} ago</li>
		${obradaDozvole(d)}
\t\t     </ul>
\t\t\t</div><!-- /.entry-meta -->
\t\t\t<p>${d.text}</p>
\t\t   </div><!-- /.post-content -->
\t\t  </div><!-- /.tr-post -->
\t     </div><!-- /.tr-post -->
`
	}

	function obradaDozvole(d) {
		let html = "";
		if(idUser == d.id_user || idRole == 1){
			html += `<li><a class="updateComm" data-comm="${d.id_comment}">Edit</a></li>
					<li><a class="deleteComm" data-comm="${d.id_comment}">Delete</a></li>`;
		}
		return html;

	}

	function insertComment() {
		var idComm = $("#idComm").val();

		if(idComm === ''){


			var idPost = $("#idPost").val();
			var commnet = $("#textOpis").val();

			var reIdPost = /^\d*$/;
			var reComment = /^(.|\s)*[a-zA-Z]+(.|\s)*$/;

			var greske = [];

			if (!reIdPost.test(idPost)) {
				greske.push("Greska sa id");
				//toastr.error("bb");
			}
			if (!reComment.test(commnet)) {
				greske.push("Greska komentar");
				toastr.warning("You should enter comment");
			}
			if (greske.length == 0) {
				$.ajax({
					url: "models/comments/insertComment.php",
					method: 'post',
					dataType: 'json',
					data: {
						textOpis: commnet,
						idPost: idPost,
						btnComment: true
					},
					success: function () {
						toastr.success("Comment was added successfully!");
						getComments();
						clearFormComment();
						$("#idPost").val(idPost);
					},
					error: function (xhr, status, error) {
						console.log(error);

						let statusniKod = xhr.status;
						switch (statusniKod) {
							case 422:
								toastr.error("Enter valid comment");
								break;
							case 500:
								toastr.error("Error with DataBase");
								break;
							case 400:
								toastr.error("Something went wrong, contact Administrator!");
								break;
						}
					}
				});
			}

		}else{
			///// Update Komentara
				var idComm = $("#idComm").val();
				var idPost = $("#idPost").val();
				var textOpis = $("#textOpis").val();

				//("#idComm").val(idComm);
				$.ajax({
					url: "models/comments/updateComment.php",
					method: "post",
					dataType: "json",
					data:{
						idComm: idComm,
						idPost: idPost,
						textOpis: textOpis,
						btnComment: true
					},
					success: function () {
						clearFormComment();
						getComments();
						$("#idPost").val(idPost);
					},
					error: function (xhr, status, error) {
						console.log(error);
						let statusniKod = xhr.status;
						switch (statusniKod) {
							case 422:
								toastr.error("Enter valid comment or click Reset");
								break;
							case 500:
								toastr.error("Error with DataBase");
								break;
							case 400:
								toastr.error("Something went wrong, contact Administrator!");
								break;
						}
					}
				});
		}
	}
	function clearFormComment() {
		$("#textOpis").val("");
		$("#idComm").val("");
		$("#btnComment").val("Post");
	}

	function fillFormComm(data) {
		$("#idPost").val(data.id_post);
		$("#textOpis").val(data.text);
		$("#idComm").val(data.id_comment);
		$("#btnComment").val("Edit");
	}
}
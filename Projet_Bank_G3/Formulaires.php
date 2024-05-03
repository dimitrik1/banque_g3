<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<style>
	/* ===== Google Font Import - Poppins ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
*{
    font-family: 'Poppins', sans-serif;
}
	body{
	margin: 0;
	padding: 0;
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	font-family: 'Jost', sans-serif;
	background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
}
.main{
	width: 500px;
	height: 700px;
	background: red;
	overflow: hidden;
	background: url("https://img.freepik.com/premium-vector/abstract-realistic-technology-particle-background_23-2148414765.jpg?w=740") no-repeat center/ cover;
	border-radius: 10px;
	box-shadow: 5px 20px 50px #000;
}
#chk{
	display: none;
}
.signup{
	position: relative;
	width:100%;
	height: 100%;
}
label{
	color: #fff;
	font-size: 2.3em;
	justify-content: center;
	display: flex;
	margin: 60px;
	font-weight: bold;
	cursor: pointer;
	transition: .5s ease-in-out;
}
input:nth-child(2),
input:nth-child(3),
input:nth-child(4),
input:nth-child(5){
	width: 60%;
	height: 20px;
	background: #e0dede;
	justify-content: center;
	display: flex;
	margin: 20px auto;
	padding: 10px;
	border: none;
	outline: none;
	border-radius: 5px;
	color: #0f0c29;
}
button{
	width: 60%;
	height: 40px;
	margin: 10px auto;
	justify-content: center;
	display: block;
	color: #fff;
	background: #573b8a;
	font-size: 1em;
	font-weight: bold;
	margin-top: 20px;
	outline: none;
	border: none;
	border-radius: 5px;
	transition: .2s ease-in;
	cursor: pointer;
}
button:hover{
	background: #6d44b8;
}
.login{
	height: 460px;
	background: #eee;
	border-radius: 60% / 10%;
	transform: translateY(-180px);
	transition: .8s ease-in-out;
}
.login label{
	color: #573b8a;
	transform: scale(.6);
}
.terms{
	margin-top: -10px;
}
.customFileBtn{
	font-size: .8rem;
	color: #0f0c29;
	width: 60%;
	height: 20px;
	background: #e0dede;
	justify-content: center;
	display: flex;
	margin: 20px auto;
	padding: 10px;
	border: none;
	outline: none;
	border-radius: 5px;
}
#select-image{
	display: none;
}

.signup .validation{
	display: flex;
	margin-top: -30px;
}
.signup .validation input[type="checkbox"]{
	margin-left: 90px;
	margin-top: 50px;
	padding: 0;
}
.signup .validation label{
	font-size: 15px;
	margin: 10px;
	margin-top: 55px;
}
.signup .validation label a {
	text-decoration: none;
	color: #d400ff;
	margin-left: 5px;
}
#chk:checked ~ .login{
	transform: translateY(-700px);
}
#chk:checked ~ .login label{
	transform: scale(1);	
}
#chk:checked ~ .signup label{
	transform: scale(.6);
}

</style>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form  method="post" action="traiter.php">
					<label for="chk" aria-hidden="true">Créer un compte</label>
					<input type="text" name="nom" placeholder="Nom complet *" required>
					<input type="email" name="email" placeholder="email *" required>
					<input type="password" name="pswd" placeholder="mot de passe *" required>
					<input type="Authentif" name="tel" placeholder="numero de telephone *" required>
					<input type="file" name="image" id="select-image" accept="image/*">
					<label for="select-image" class="customFileBtn">Photo de profil (optionel)</label>
					<button name='enregistrer'>S'enregistrer</button>
					<div class="validation">
						<input type="checkbox" name="terme" id="condi_uti" required>
						<label for="condi_uti" class="terms">j'ai lu et j'accepte les  <a href="#"> termes du contrat</a> </label>
					</div>
				</form>
			</div>    

			<div class="login">
				<form method="post" action="traiter.php">
					<label for="chk" aria-hidden="true">se connecter</label>
					<input type="email" name="email" placeholder="Identifiant *" required>
					<input type="password" name="pswd" placeholder="mot de passe *" required>
					<button name='seconnecter'>se connecter</button>
				</form>
			</div>
	</div>
</body>
</html>
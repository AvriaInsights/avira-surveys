<!DOCTYPE html>
<html>
	<head>
		<title>Header</title>
		<link rel="stylesheet" type="text/css" href="/style.css">
		<link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700,900" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src='/script.js'></script>
	</head>
	<body>
		<header>
			<div class="head_container">
				<div class="logo">
					<img src="http://www.hubover.com/wp-content/uploads/2017/01/logo_dark.png">
				</div>
				<div class="menu" id="myTopnav">
					<ul>
						<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="openNav()">&#9776;</a>
						<li><a href="#">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Portfolio</a></li>
						<li><a href="#">Request Quote</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
				</div>
			</div>
		</header>
		<div id="mySidenav" class="sidenav">
			  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			  <a href="#">Home</a>
			  <a href="#">About</a>
			  <a href="#">Portfolio</a>
			  <a href="#">Request Quote</a>
			  <a href="#">Contact</a>
			  <p style="color: #1c3664; text-align: center">Hubover &copy; 2017</p>
		</div>
	</body>
</html>
<style>
    body{
	font-family: Raleway;
}
header{
	border: black;
	border-width: 2px;
	box-shadow: 0px 3px 20px 3px rgba(0, 0, 0, 0.06);
}
.head_container{
	padding: 20px;
	overflow: hidden;
}
.logo{
	float:left;
	margin-left: 20px;
}
.logo img{
	height: 50px;
}
.menu{
	margin-top:5px;
	float:right;
}
.menu ul{
	list-style-type: none;
	    margin-right: -10px;
}
.menu li{
	display: inline;
	margin-right-last:0px; 
}
.menu a{
	text-decoration: none;
	font-weight: 500;
	color: #1c3664;
	    padding:10px;
	    padding-left: 15px;
	    padding-right: 15px;
}
.menu a:hover { 
	background: rgba(247, 202, 24, 0.1);
    border:#F7CA18;
    border-radius: 20px;
    border-style: solid;
    border-width: 2px;
    transition: 0.2s;

}
.icon{
	display: none;
}

menu.responsive{
	position: relative;
}
menu.responsive{
	float: none;
    display: block;
    text-align: left;
}

@media screen and (max-width: 835px) {
	.logo img {
	    height: 40px;
	}
	ul > li:first-of-type{
		display:none;
	}
	.menu{
		margin:0;
	}
}


@media screen and (max-width: 690px) {

.menu li{
	display: none;
}
.icon{
    font-weight: 900 !important;
        font-size: 27px !important;
    padding: 0;
    margin: 0;
       margin-top: -22px;
    display: flex;
}
	.logo img {
	    height: 40px;
	}
}




.sidenav {
	height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #fff;
    overflow-x: hidden;
    transition: 0.2s;
    padding-top: 87px;
    box-shadow: 2px 8px 20px rgba(0, 0, 0, 0.24);
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #1c3664;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover, .offcanvas a:focus{
    color: #F7CA18;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}
</style>

<script>
    
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    //document.getElementById("header").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    //document.getElementById("header").style.marginLeft= "0";
};
</script>
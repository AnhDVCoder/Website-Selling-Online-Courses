<?php
	header("Content-type: text/css");
?>
	*{
		font-family: arial;
		font-size: 15px;
		margin: 0;
	}

	dl, ol, ul {
		margin-bottom: 0px;
		text-align: center;
	}

	ul {
		padding-inline-start: 0px;
	}

	li {
    	width: 160px;
		<!-- cursor: pointer; -->
	}

	.banner {
  		padding: 20px;
  		text-align: center;
  		background-color: lightblue;
  		font-size: 30px;
  		color: black;
  	}

	.comingSoon{
		background-image: url("../images/coming_soon.png");
		height: 900px;
		width: 100%;
		background-repeat: no-repeat;
		background-size: cover;
	}
  	/*---------------------------------------------------------------*/
	#menu-ngang{
		display: flex;
		justify-content: space-between;
    	background: orange;
    	font-weight: bold;
    	font-size: 50px;
    	height:auto;
	}

	#menu-ngang ul{
    	display: flex;
    	list-style: none;
    	z-index: 10;
	}

	#menu-ngang-right{
		float: right;
    	list-style: none;
    	z-index: 10;
	}

	#menu-ngang> ul li a{
    	padding: 18px;
    	line-height: 50px;
    	color: white;
   		text-decoration: none;
	}

	.a {
		background-color: orange;
		width: 100%;
		padding: 10px 20px;
		display: block;
		height: 39px;
		transition: all 0.5s ease-in-out;
		border: none;
		color: white;
		pointer: cursor;
	}

	#menu-ngang ul li:hover{ /*Khi di chuột vào sẽ đổi màu*/
    	background: #F86F03;
	}

	#menu-ngang ul li ul{ /*ẩn thanh menu thả xuống*/
   		display: none;
    	position: absolute;
	}

	#menu-ngang li>ul li{ /*Chỉnh sửa*/
    	border: none;
    	border-bottom: 1px solid #ccc;
    	background: orange;
    	text-align: center;
	}

	#menu-ngang  li:hover > ul{ /*Khi di chuột vào thì sẽ hiện ra thanh menu dropdown*/
    	display:  block;
	}

	#test{
		position: relative;
		left: 0;
		top: 0;
	}

	li input[type=text], select, textarea {
		width: 100%;
		padding: 12px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
		margin-top: 6px;
		margin-bottom: 16px;
		resize: vertical;
	}

	li input[type=submit] {
		background-color: #04AA6D;
		color: white;
		padding: 12px 20px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}

	input[type=submit]:hover {
		background-color: #0b8155;
	}
	
	/*---------------------------------------------------------------*/

	#imgthumbnail{
		width: 250px;
		height: 150px;
		border-radius: 20px;
	}
	#plus_icon{
		width: 250px;
		height: 200px;
		border-radius: 20px;
		line-height:200px;
	}
	#list_item {
    	display: flex;
    	flex-direction: row;
    	justify-content: center;
    	flex-wrap: wrap;
    	justify-content: flex-start;
	}

	#item{
		margin: 35px 25px;
		padding: 15px;
		border-radius: 20px;
		border: solid lightgray 1px;
		z-index: 8;
		position: relative;
		
	}
	#box div a{
		text-decoration: none;
		font-family: arial;
		font-size: 20px;
		<!-- font-weight: bold; -->
		color: black;
		text-align: center;

	}
	.button {
  		border: none;
  		outline: 0;
  		display: inline-block;
  		padding: 8px;
  		color: white;
  		background-color: blue;
  		text-align: center;
  		cursor: pointer;
  		width: 100%;
  		border-radius: 5px;
  		text-decoration: none;
	}

	.button:hover {
  		background-color: #001B79;
	}
	/*---------------------------------------------------------------*/
	#title{
		font-size: 20px;
		font-weight: bold;
		padding-left: 10%;
		padding-top: 20px;
	}

	.footer{
		width: 100%;
		background-color: orange;
		display: flex;
		color: white;
	}
	.footer-left{
		margin-left: 5%;
		margin-top: 20px;
		width: 50%;
		height: 100%;
	}
	.footer-middle{
		margin-left: 5%;
		margin-top: 20px;
		width: 25%;
		height: 100%;
		text-align: center;
	}
	.footer-middle a{
		color: #b36c22;
		text-decoration: none;
	}
	.footer-right{
		margin-left: 10%;
		margin-top: 20px;
		width: 25%;
		height: 100%;

	}
	#icon{
		font-size: 40px;
	}

	/*---------------------------------------------------------------*/

	#xem_them {
		position: absolute;
  		right: 0px;
  		padding: 0px;
  		padding-right: 100px;
	}

	#box #title_1 {
		position: absolute;
  		left: 0px;
  		padding: 10px;
  		padding-right: 60px;
  		font-weight: 750;
	}

	.btn-ql {
	  background-color: lightblue;
	  border: none;
	  height: 25px;
	  width: 25px;
	  color: white;
	  border-radius: 50px;
	  text-decoration: none;
	  padding: 7px
	}
	.boxx{
		position:relative;
		left:126px;
	}
	



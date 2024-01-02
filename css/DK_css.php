<?php
    header("Content-type: text/css");
?>

body,
.signin {
  <!-- background-color: #d3d3d3; -->
  font-family: 'Montserrat', sans-serif;
  color: #fff;
  font-size: 14px;
  letter-spacing: 1px;
  background-image: url("../images/login_background.jpg");
  background-position: center;
}


.login {
  color: black;
  position: relative;
  height: fit-content;
  width: 405px;
  margin: auto;
  padding: 30px 60px;
   background: url(https://picsum.photos/id/1004/5616/3744) no-repeat   center center white;
   <!-- background-color: white; -->
  background-size: cover;
  box-shadow: 0px 30px 60px -5px #000;
}

form {
  padding-top: 40px;
}

.active {
  border-bottom: 2px solid #1161ed;
}

.nonactive {
  color: rgba(255, 255, 255, 0.2);
}

h2 {
  padding-left: 12px;
  font-size: 22px;
  text-transform: uppercase;
  padding-bottom: 5px;
  letter-spacing: 2px;
  display: inline-block;
  font-weight: 100;
}

h2:first-child {
  padding-left: 0px;
}

span {
  text-transform: uppercase;
  font-size: 12px;
  opacity: 0.6;
  transition: all 0.5s ease-in-out;
}

.error{
  opacity: 1;
}

.text {
  border: none;
  width: 89%;
  padding: 10px 20px;
  display: block;
  height: 15px;
  border-radius: 20px;
  background: rgba(255, 255, 255, 0.1);
  border: 2px solid rgba(255, 255, 255, 0);
  overflow: hidden;
  margin-top: 15px;
  transition: all 0.5s ease-in-out;
}

.text:focus {
  outline: 0;
  border: 2px solid rgba(255, 255, 255, 0.5);
  border-radius: 20px;
  background: rgba(0, 0, 0, 0);
}

.text:focus + span {
  opacity: 0.6;
}

input[type="text"],
input[type="password"] {
  font-family: 'Montserrat', sans-serif;
  color: #fff;
}



input {
  display: inline-block;
  padding-top: 20px;
  font-size: 14px;
}

h2,
span,
.custom-checkbox {
  margin-left: 20px;
}

.custom-checkbox {
  -webkit-appearance: none;
  background-color: rgba(255, 255, 255, 0.1);
  padding: 8px;
  border-radius: 2px;
  display: inline-block;
  position: relative;
  top: 6px;
}

.custom-checkbox:checked {
  background-color: rgba(17, 97, 237, 1);
}

.custom-checkbox:checked:after {
  content: '\2714';
  font-size: 10px;
  position: absolute;
  top: 1px;
  left: 4px;
  color: #fff;
}

.custom-checkbox:focus {
  outline: none;
}

label {
  display: inline-block;
  padding-top: 10px;
  padding-left: 5px;
}

.signin {
  background-color: #1161ed;
  color: #FFF;
  width: 100%;
  padding: 10px 20px;
  display: block;
  height: 39px;
  border-radius: 20px;
  margin-top: 30px;
  transition: all 0.5s ease-in-out;
  border: none;
  text-transform: uppercase;
}

<!-- .signin:hover {
  background: #4082f5;
  box-shadow: 0px 4px 35px -5px #4082f5;
  cursor: pointer;
} -->

.signin:focus {
  outline: none;
}

hr {
  border: 1px solid rgba(255, 255, 255, 0.1);
  margin-top: 20px;
}

a {
  text-align: center;
  display: block;
  margin-top: 20px;
  text-decoration: none;
  color: black;
}
.login input.text{
  background-color: #CCCCCC;
  color: white;
}

.login span {
  color: black;
  font-weight: bold;
}
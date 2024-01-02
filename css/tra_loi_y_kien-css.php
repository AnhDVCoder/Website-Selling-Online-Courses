/* <?php
	header("Content-type: text/css");
?> */
#users {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#users td, #users th {
  border: 1px solid #ddd;
  padding: 8px;
}

#users tr:nth-child(even){background-color: #f2f2f2;}

#users tr:hover {background-color: #ddd;}

#users th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: orange;
  color: white;
}

  .box1{
     position: relative; 
    width: auto;
    border: 1px;
    margin: 0 50px;
    height: auto;
    background: white;
    box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
  }
   /* .users{
      overflow = "scroll";
    white-space = "normal";
  }  */
  .box2{
    display: flex;
    position: absolute;
    width: 100%;
    height: 500px;
    box-sizing: border-box;

    margin: 0 2%;

  left: 0;
    right: 0;

  }

  .box3{
    width: 100%;
    height: 100%;
    position: relative;
    top:15%;
    display: inline-block;
    border-radius: 15px;
    box-shadow:  2px 2px 2px 2px  grey;
    overflow: scroll;
    

  }
  .box4{
    width: 100%;
    height: 100%;
    padding: 5px;
    position: relative;
    left: -10px;
    display: inline-block;
    border-radius: 15px;
    box-shadow:  2px 2px 2px 2px  grey;
    overflow: scroll;
    

  }

  .list_khoahoc_item{
    overflow-wrap: anywhere;
        overflow: scroll;
        overflow-x: hidden;
         /* height: 100%; 
        width: 100%; */
        padding: 20px;
        
        
  }

  /* #scroll::-webkit-scrollbar {
      width: 10px;
      background-color: #F5F5F5;
      box-shadow: inset 0 0 5px grey; 
      border-radius: 10px;
  } 

  #scroll::-webkit-scrollbar-thumb {
    background: gray; 
    border-radius: 10px;
    } */

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
tr.td:first-child {
    border-top-left-radius: 10%;
}
.box3 #users tr td a {
   color: black;
}
.phan-hoi{
    display: block;
    position: relative;
    width: 25%;

    top: 20%
}
.phan-hoi h3 a {
    color: black;
    position: relative;
    top: 150px;
    padding: 25px;
}
.box-phan-hoi{
    width: 100%;
    height: 100%;
    position: relative;
    top:15%;
    display: inline-block;
    border-radius: 15px;
    box-shadow:  2px 2px 2px 2px  grey;
    overflow: scroll;
}
.box-tra-loi  {
    height: 444px;
    width: 100%;
    border: none;
    word-wrap: break-word;

}
.box-tra-loi h3  {
    color: black;
    position: relative;
    left: 0;
}
.box4 ul.message-list li {
  display: inline-block;
  box-shadow: 1px;
  padding: 5px;
  margin: 4px 4px 4px 0px;
  height: 50px;
  width: 100%;
  background-color: silver;
  border-radius: 10px;

}

.box4 > ul.message-list {
 width: 100%;
 height: 50px;
 /* justify-content: center; */
 line-height: 100%;


}
  
.box4 > ul.message-list > li > a{
  
  justify-content: center;
  text-align: center;
  line-height: 100%;
}

.box4 > ul.message-list > li {

  text-align: center;
  justify-content: center;
  line-height: 100%;
  
}
.gui{
  position:absolute;
  bottom: -140px;
  right: 25px;
  width: auto; 
  height: 40px; 
}
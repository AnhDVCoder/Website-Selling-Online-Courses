<?php
    header("Content-type: text/css");
?>
*{
    margin: 0;
    border: 0;
    box-sizing: border-box;
}
.wrapper{
    background-color: orange;
    width: 100%;
    height: 100vh;
    padding: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.container{
    width: 500px;
    background-color: white;
    padding: 30px;
    border-radius: 16px;
    background-color: rgba(0,0,0,0.08) 0px 4px 12px;
}
.title-section{
    margin-bottom: 30px;
}
.title{
    color: #38475a;
    font-size: 25px;
    font-weight: 550;
    text-transform: capitalize;
    margin-bottom: 10px;

}
.para{
    color: #38475a;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.5;
    margin-bottom: 20px;
    text-transform: capitalize;
}
.input-group{
    position: relative;
}
.input-group .lable-title{
    color: #38475a;
    text-transform: capitalize;
    margin-bottom: 12px;
    font-size: 14px;
    display: block;
    font-weight: 550px;

}
.input-group input{
    width: 100%;
    background-color: none;
    color:#38475a;
    height: 50px;
    font-size: 16px;
    font-weight: 300;
    border: 1px solid black;
    padding: 9px 18px 9px 52px;
    outline: none;
    border-radius: 8px;
    margin-bottom: 20px;
}
.input-group input::placeholder{
    color:#38475a;
    font-size: 16px;
    font-weight: 300;

}
.submit-btn{
    background-color: orange;
    border: 1px solid transparent;
    border-radius: 8px;
    color:#38475a;
    padding: 13px 24px;
    height: 45px;
    margin-bottom: 30px;
    position: relative;
    left:168px;
}
a{
    width: fit-content;
    text-decoration: none;
    color: #38475a;
    font-size: 16px;
    font-weight: 300;
    padding-right: 124px;
    
}
<style>

 .v-form-fixed-2 {
    display: none;
}

 .v-form-fixed-2.active {
    display: block;
}

.v-form-fixed-2 .wrap-v-form {
    border: 3px dashed rgb(224, 224, 224);
    padding: 15px 10px;
}

.v-form-fixed-2-wrap{
    padding:25px;
    position: fixed;
    width: 60%;
    left: 20%;
    z-index: 100;
    background: rgb(85, 134, 186);
    box-sizing: border-box;
        text-align: center;

}

.v-form-fixed-2 .form-text {
    border: 1px solid #fff;
    background: #fff;
    padding: 10px 15px;
    width: 100%;
    box-sizing: border-box;
    max-width: 390px;
}

.v-form-fixed-2 .v-form-item-title {
    display: none;
}

.v-form-fixed-2 .v-form-item {
    margin: 15px 0;
}

.v-form-fixed-2 .form-submit {
    border: 0;
    width: 100%;
    box-sizing: border-box;
    max-width: 390px;
    background: #f78e05;
    padding: 8px 15px;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
}

.v-form-fixed-2 .v-form-title {
    color: #fff;
    font-weight: bold;
    font-size: 18px;
    text-transform: uppercase;
    background:none;
}

.v-close-form-fixed-2 {
        position: absolute;
    top: 5px;
    right: 5px;
    display: block;
    font-family: "Verdana", Arial, sans-serif;
    font-size: 26px;
    font-weight: bold;
    color: #333333;
    color: rgba(0,0,0,0.3);
    text-decoration: none !important;
    background-color: #000;
    color: rgba(255,255,255,0.8);
    border-radius: 999em;
    height: 30px;
    width: 30px;
    text-align: center;
    line-height: 26px;
    cursor: pointer;
}
.v-form-fixed-2 .v-form-content {
    padding: 0;
}
@media only screen and (max-width: 700px){
    .v-form-fixed-2-wrap{
        width:90%;
        left:5%;
    }
}


.v-form-fixed-2-wrap {
    padding: 25px;
    position: fixed;
    width: 100%;
    left: 50% !important;
    z-index: 100;
    background: rgb(85, 134, 186);
    box-sizing: border-box;
    text-align: center;
    max-width: 500px;
    transform: translateX(-50%);
    -webkit-transform: translateX(-50%);
    color:#fff;
}

.v-form-fixed-2 .v-form-title {
    position: relative;
    padding-top: 45px;
}

.v-form-fixed-2 .v-form-title:before {
   content: "";
   position: absolute;
   top: 0;
   left: 50% ;
   background: url(<?php echo CDN_DOMAIN ?>/extensions/PopupForm/images/internet-download-symbol.png) no-repeat;
   background-size: 40px;
   width: 50px;
   height: 50px;
   transform: translateX(-50%);
   -webkit-transform: translateX(-50%);
}

.v-form-fixed-2 .wrap-v-form {
    border: 0px dashed rgb(224, 224, 224) !important;
    padding: 0 !important;
}

.v-form-fixed-2 .v-form-item-title {
    display: block !important;
    float: left;
    margin-bottom: 3px;
}

.v-form-fixed-2 .form-text {
    border: 1px solid #fff;
    background: #fff;
    padding: 10px;
    width: 100%;
    box-sizing: border-box;
    max-width: 100% !important;
}

.v-form-fixed-2  .v-form-item.v-form-item-submit input {
    background: #fff;
    border: 2px solid #ccc;
    width: 32%;
    padding: 10px 50px;
    font-weight: bold;
    text-transform: uppercase;
    color: #fff;
    margin: auto;
    display: block;
    border-radius: 3px;
    color: #1b4145;
}

.v-form-fixed-2  span.v-form-require {
    color: #fc0000;
}

.v-form-fixed-2 .v-form-description {
    color: #fff;
    line-height: 20px;
}
@media only screen and (max-width: 700px){
    .v-form-fixed-2-wrap {
        width: 90%;
        /*left: 5%;*/
        /*height: 90%!important;*/
        padding: 10px 25px!important;
        position: fixed;
        /*width: 100%;*/
        left: 50% !important;
        z-index: 100;
        background: rgb(85, 134, 186);
        box-sizing: border-box;
        text-align: center;
        max-width: 500px;
        transform: translateX(-50%)!important;
    }
    .v-form-fixed-2 .v-form-item.v-form-item-submit input {
        background: #fff;
        border: 2px solid #ccc;
        width: auto;
        padding: 10px 50px;
        margin: 10px 0px!important;
        font-weight: bold;
        font-size:16px;
        text-transform: uppercase;
        color: #fff;
        margin: auto;
        display: block;
        border-radius: 3px;
        color: #1b4145;
        text-align: center;
        margin: 0px auto!important;
    }

    .v-form-fixed-2 .wrap-v-form {
        border: 3px dashed rgb(224, 224, 224);
        /* padding: 5px 10px!important; */
        /* margin: 5px 0!important; */
    }
    .v-form-fixed-2 .v-form-item {
        margin: 5px 0!important;
    }
    .v-form-fixed-2 .v-form-description img{
        display:none;
    }
    .v-form-fixed-2 .v-form-description span{
        font-size:20px!important;
    }
    .v-form-description {
        margin: 10px 0 0 0;
        text-align: justify;
    }




}
.v-TextImage h2 {
    background: none;
    padding-left: 0;
    margin: 0;
}




.v-form-fixed-2 {
position: fixed;
top: 0;
right: 0;
bottom: 0;
left: 0;
z-index: 999999;
overflow: auto;
}

.v-form-fixed-2-wrap {
top:5%;
position: relative!important;
width: auto!important;
margin: 0!important;
z-index: 9999;
}
</style>

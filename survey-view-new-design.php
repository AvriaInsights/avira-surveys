  <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <title>avira survey</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <style>
       html{
         font-size:10px;    
       }
       .main-que-ttl{
           font-size:2rem;
           padding: 3rem 0 2rem;
       }
      .common-que-header{
          background:#d2f9ff;
          padding: 1.2rem;
          border-radius: 0.5rem 0.5rem 0 0;
      }`
      .common-que-header h5{
        font-size: 1.3rem;
        padding-bottom: 0.5rem;
        font-weight: 400;
      }
      .common-que-header h3{
          font-size:1.4rem;
      } 
      .boolean-item {
        margin-right:1.5rem;
      }
      .boolean-item [type=radio],.boolean-item [type=checkbox],.r-item [type=radio],.r-item [type=checkbox],.scale-type [type=radio]{
        position: absolute; 
        opacity: 0; 
        width: 0; 
        height: 0; 
     }
    .label-icon {
        margin-bottom: 0;
        padding:2rem 4rem;
        justify-content: center;
        display: flex;
        flex-direction: column;
        font-size:1.8rem;
        align-items: center;
        border: .1rem solid #ced4da;
        border-radius: .5rem;
    }
    [type=radio]:checked + .label-icon,[type=checkbox]:checked + .label-icon {
        color: #fff;
        background: #00cfff;
        background: -moz-linear-gradient(45deg, #00cfff 1%, #029bff 100%);
        background: -webkit-linear-gradient(45deg, #00cfff 1%,#029bff 100%);
        background: linear-gradient(45deg, #00cfff 1%,#029bff 100%);
        border:1px solid #00cfff;
    }
    .boolean-type{
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .label-icon i{
        font-size:5rem;
    }
    .save-nxt-btn{
        border: 0.1rem solid #000;
        padding: 1rem 2.3rem;;
        font-size: 1.4rem;
        border-radius: 50px;
        font-weight: 500;
    }
    .r-item .label-icon{
        padding: .7rem 1rem;
        font-size:1.4rem;
        align-items: flex-start;
    }
    .r-item{
        margin-bottom:1.5rem;
    }
    .label-icon .num-holder{
        margin-right: 1rem;
        font-size: 1.3rem;
        font-weight:700;
    }
    .checkbox-item .label-icon{
        flex-direction: row;
        justify-content: flex-start;
    }
    .pt-6{
        padding-top:2.5rem;
    }
    .skip-txt{
        font-size: 1.4rem;
        padding-left: 2rem;
    }
    .text-type .form-control{
        font-weight: 400;
        padding: 1rem 2rem;
        font-size: 1.4rem;
        margin-bottom: 1.5rem;
        COLOR: #000;
    }
    .text-type textarea{
        height:15rem;
    }
    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: flex-end;
    }
    .star-rating input {
        display: none;
    }
    .star-rating label {
        color:#ccc;
        cursor:pointer;
        font-size: 5rem;
        margin: 1rem;
    }
     label.star:before {
        content: '\f006';
        font-family: FontAwesome;
    }
    .star-rating input:checked ~ label.star:before {
        content: '\f005';
        color: #8d8d8d;
        transition: all .25s;
    }
    .m-rating-type .form-select,.m-rating-type .form-control{
        font-size: 1.2rem;
        padding: 0.85rem;
        border-radius: 0.5rem;
        margin-bottom:1rem;
    }
    .number-holder{
         border: 0.1rem solid #ced4da;
        padding: 0.8rem;
        text-align: center;
        font-size: 1.4rem;
        font-weight: 600;
        border-radius: 0.5rem;
    }
    .order-type .label-icon{
        align-items:center; 
        justify-content:space-between;
    }
    .move-icon{
        font-size:1.6rem;
        font-weight:600;
    }
    .number-holder{
        margin-bottom:1.5rem;
    }
    .matrix-que .table{
        text-align:center;
        font-size: 1.6rem;
    }
    .scale-type{
        display:flex;
    }
    .scale-type .label-icon{
        padding:1rem 2.2rem;
        font-weight:600;
        border-radius:0;
    }
    .space-all{
        padding:2rem;
    }
    .bg-shadow{
        background: #fff;
        -webkit-box-shadow: 0 .5rem 1.2rem rgb(0 0 0 / 12%);
        box-shadow: 0 .5rem 1.2rem rgb(0 0 0 / 12%);
    }
    .thank-you-ttl{
        font-size: 2rem;
        padding-bottom: 1.4rem;
    }
    .end-feedback-form label{
        font-size: 1.4rem;
        padding-bottom: 0.7rem;
    }
    .end-feedback-form .form-control{
        padding: 0.7rem;
        font-size: 1.4rem;
        margin-bottom: 1.4rem;
    }
    .submit-btn{
        background: #00d8ff;
        border: 1px solid #00d8ff;
        padding: 1rem 3.5rem;
        font-size:1.4rem;
        border-radius:50px;
        color:#fff;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        z-index:9999;
    }
    .slide {
        width: 100%;
        height: 100%;
        left: -200px;
        background: #fff;
        position: absolute;
        transition: all .35s ease-Out;
        bottom: 0;
        font-weight: 700;
        z-index:-1;
    }
    .submit-btn:hover .slide{
        left: 0;
        border: 1px solid #fff;
    }
    .submit-btn:hover{
         color:#00d8ff;
    }
    .s-icon span{
        font-size:3rem;
    }
    .mid-align{
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }
    .para{
        font-size:1.6rem;
        padding-bottom:2rem;
    }
    .front-ttl{
        font-size:2.4rem;
        font-weight:700;
        padding-bottom:1rem;
    }
    .close-btn{
        display:flex;
        justify-content:end;
        font-size:1.4rem;
        padding: 1.7rem 2rem 0;
    }
    .close-btn i{
        border: 0.1rem solid #000;
        border-radius: 50%;
        width: 3rem;
        height: 3rem;
        text-align: center;
        line-height:2;
    }
    .neutral-point{
        padding-right:6rem;
    }
    .score-pt span{
        font-size: 1.1rem;
        font-weight: 600;
        padding-top: 1rem;
    }
    /*-------footer-design--------------*/
    .footer-bottom-fixed {
        position: fixed;
        bottom:1rem;
        width: 100%;
    }
    .right-div {
        position: relative;
        right: -10.2rem;
    }
    .progress-circle {
        transform: rotate(-90deg);
        margin-top: -5px;
        position: absolute;
    }
    .progress-text {
        position: relative;
        top: 3.5rem;
        font-size: 1.2em;
        left: -4rem;
        color: #000;
    }
    .arrow-status {
        padding-top: 1rem;
    }
    .survey-logo {
        width: 10rem;
        padding-bottom: 0.5rem;
    }
    .arrow-status a {
        display: inline-block;
        margin: 0 2% 0 0;
        border-radius: 50%;
        border: 2px solid #999;
        padding: 10px;
        width: 40px;
        height: 40px;
        font-size: 30px;
        color: #fff;
        position: relative;
        transition: all 0.1s;
        transition: all 0.1s;
        right:0rem;
    }
    .arrow-status a i {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #000;
        font-size: 2rem;
    }
    .progress-circle-back {
        fill: none;
        stroke: #9586865e;
        stroke-width: 5px;
    }
    .progress-circle-prog {
        fill: none;
        stroke: #02118d;
    }
    /*-------tooltip-css---------*/
    .tooltip {
        position: relative;
        display: inline-block;
        opacity: 1 !important;
        margin-top: 15px;
        }
    .tooltip {
        position: relative;
        z-index: 1070;
        display: block;
        margin: 0;
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        font-style: normal;
        font-weight: 400;
        line-height: 1.5;
        text-align: left;
        text-align: start;
        text-decoration: none;
        text-shadow: none;
        text-transform: none;
        letter-spacing: normal;
        word-break: normal;
        word-spacing: normal;
        white-space: normal;
        line-break: auto;
        font-size: .875rem;
        word-wrap: break-word;
        opacity: 0;
        color:#000;
    }
    .tooltip .fa {
        font-size: 18px;
    }
    .tooltip .tooltiptext {
        visibility: hidden;
        width: 254px;
        background-color: black;
        color: #fff;
        text-align: center;
        padding: 5px 8px;
        border-radius: 6px;
        position: absolute;
        z-index: 1;
        margin-left: 6px;
        position: absolute;
        z-index: 1;
    }
    .toolt {
        display: flex;
    }
    [data-tooltip] {
        display: inline-block;
        position: relative;
        cursor: pointer;
        padding: 4px;
    }
    /* Tooltip styling */
    [data-tooltip]:before {
        content: attr(data-tooltip);
        display: none;
        position: absolute;
        background: #000;
        color: #fff;
        padding: 4px 8px;
        font-size: 14px;
        line-height: 1.4;
        min-width: auto;
        text-align: left;
        border-radius: 4px;
        width:auto;
        white-space:nowrap;
    }
    /* Dynamic horizontal centering */
    [data-tooltip-position="top"]:before,
    [data-tooltip-position="bottom"]:before {
        left: 50%;
        -ms-transform: translateX(-50%);
        -moz-transform: translateX(-50%);
        -webkit-transform: translateX(-50%);
        transform: translateX(-50%);
    }
    /* Dynamic vertical centering */
    [data-tooltip-position="right"]:before,
    [data-tooltip-position="left"]:before {
        top: 50%;
        -ms-transform: translateY(-50%);
        -moz-transform: translateY(-50%);
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
    }
    [data-tooltip-position="top"]:before {
        bottom: 100%;
        margin-bottom: 6px;
    }
    [data-tooltip-position="right"]:before {
        left: 100%;
        margin-left: 6px;
    }
    [data-tooltip-position="bottom"]:before {
        top: 100%;
        margin-top: 6px;
    }
    [data-tooltip-position="left"]:before {
        right: 100%;
        margin-right: 6px;
    }
    /* Tooltip arrow styling/placement */
    [data-tooltip]:after {
        content: '';
        display: none;
        position: absolute;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
    }
    /* Dynamic horizontal centering for the tooltip */
    [data-tooltip-position="top"]:after,
    [data-tooltip-position="bottom"]:after {
        left: 50%;
        margin-left: -6px;
    }
    /* Dynamic vertical centering for the tooltip */
    [data-tooltip-position="right"]:after,
    [data-tooltip-position="left"]:after {
        top: 50%;
        margin-top: -6px;
    }
    [data-tooltip-position="top"]:after {
        bottom: 100%;
        border-width: 6px 6px 0;
        border-top-color: #000;
    }
    [data-tooltip-position="right"]:after {
        left: 100%;
        border-width: 6px 6px 6px 0;
        border-right-color: #000;
    }
    [data-tooltip-position="bottom"]:after {
        top: 100%;
        border-width: 0 6px 6px;
        border-bottom-color: #000;
    }
    [data-tooltip-position="left"]:after {
        right: 100%;
        border-width: 6px 0 6px 6px;
        border-left-color: #000;
    }
    /* Show the tooltip when hovering */
    [data-tooltip]:hover:before,
    [data-tooltip]:hover:after {
        display: block;
        z-index: 50;
        white-space: normal;
        width: 200px;
        word-wrap: break-word;
    }
    .mob-tooltip{
        display:none;    
    }
    @media only screen and (min-device-width: 1600px) and (max-device-width: 2048px){
        .main-que-ttl {
            font-size: 3rem;
        }
        .common-que-header h3 {
            font-size: 1.6rem;
        }
        .common-que-header h5 {
            font-size:1.4rem;
        }
    }
    @media screen and (min-device-width: 1200px) and (max-device-width: 1600px) and (-webkit-min-device-pixel-ratio: 1) { 
        .right-div {
            position: relative;
            right: -10.2rem;
        }
        .mob-tooltip{
            display:none;
        }
        .off-txt{
            display:block;
        }
    }
    @media only screen and (min-device-width:590px) and (min-device-height: 906px) and (-webkit-min-device-pixel-ratio:2) {
        .right-div {
            position: relative;
            right:-10rem;
        }
        .mob-tooltip{
            display:none;
        }
        .off-txt{
            display:block;
        }
    }
    @media only screen and (min-device-width: 480px) and (max-device-width: 550px)and (-webkit-min-device-pixel-ratio: 2) {
        .scale-type .label-icon{
            padding: 1rem 1.2rem;
            font-weight: 600;
            border-radius: 0;
        }
        .off-txt{
            display:none;
        }
        .mob-tooltip{
            display: block;
            position: absolute;
            bottom:1rem;
        }
        .right-div {
            position: relative;
            right: -39rem;
        }
        [data-tooltip]:hover:before,
        [data-tooltip]:hover:after {
            display: block;
            z-index: 50;
            white-space: normal;
            width: 200px;
            word-wrap: break-word;
        }
    }
    @media only screen and (min-device-width: 320px) and (max-device-width: 480px)and (-webkit-min-device-pixel-ratio: 2) {
        .scale-type .label-icon {
            padding: 1rem 1rem;
            font-weight: 600;
            border-radius: 0;
        }
        .right-div {
            position: relative;
            right: -25.2rem;
        }
        .mob-tooltip{
            display: block;
            position: absolute;
            bottom:1.5rem;
        }
        .off-txt{
            display:none;
        }
    }
    @media only screen and (min-device-width: 260px) and (max-device-width: 320px) and (-webkit-min-device-pixel-ratio: 2) {
      .boolean-type{
        flex-direction:column;   
      }
      .boolean-item{
          margin-bottom:1.5rem;
          margin-right:0;
      }
      .star-rating label {
        color: #ccc;
        cursor: pointer;
        font-size: 3rem;
        margin: 1rem;
     }
     .space-all {
        padding:1.5rem;
     }
     .scale-type .label-icon {
        padding: .7rem .6rem;
        font-weight: 600;
        border-radius: 0;
    }
    .main-que-ttl {
        font-size: 1.4rem;
        padding: 5rem 0 1rem;
    }
    .mob-tooltip{
        display: block;
        position: absolute;
        bottom:1.5rem;
    }
    .off-txt{
        display:none;
    }
    .right-div {
        position: relative;
        right: -15.2rem;
    }
    .arrow-status a{
        width: 20px;
        height: 20px;
    }
}
  </style>
  <body>
    <div class="close-btn">
        <i class="fa fa-times"></i>
    </div>  
    <div class="container-fluid mid-align">
        <div class="row d-none">
            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1 text-center">
                <h1 class="front-ttl mb-0">To understand the challenges faced while implementing end to end IoT solutions.</h1>
                <p class="mb-0 para">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
                    standard dummy text ever since the 1500s</p>
                <a href="#" class="btn submit-btn">
                    <div id="" class="slide"></div>
                   OF COURSE, YES :)
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                <h4 class="main-que-ttl mb-0">To understand the challenges faced while implementing end to end IoT solutions.</h4>
                <div class="option-holder">
                    <div class="common-que-header">
                        <h5 class="mb-0">Question<span>*</span></h5>
                        <h3 class="mb-0">Boolean Question type</h3>
                    </div>
                    <!-------boolean-type---------->
                    <div class="bg-shadow ht-auto">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="boolean-type space-all d-none">
                                    <div class="boolean-item">
                                        <input type="radio" value="1" name="yes-no-option" id="yes" required="">
                                        <label class="label-icon option1" for="yes">
                                            <i class="fa fa-thumbs-up"></i>
                                                Yes
                                        </label>
                                    </div>
                                    <div class="boolean-item">
                                        <input type="radio" value="2" name="yes-no-option" id="no">
                                        <label class="label-icon option1" for="no">
                                            <i class="fa fa-thumbs-up"></i>
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-------radio-type------------>
                    <div class="bg-shadow ht-auto">
                        <div class="row space-all d-none">
                            <div class="col-md-6">
                                <div class="r-item">
                                    <input type="radio" value="1" name="radio-type" id="1">
                                    <label class="label-icon" for="1">
                                        1-3months
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="r-item">
                                    <input type="radio" value="2" name="radio-type" id="2">
                                    <label class="label-icon" for="2">
                                        1-3months
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="r-item">
                                    <input type="radio" value="3" name="radio-type" id="3">
                                    <label class="label-icon" for="3">
                                        1-3months
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="r-item">
                                    <input type="checkbox" value="4" name="radio-type" id="4">
                                    <label class="label-icon" for="4">
                                        1-3months
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--------checkbox-type--------->
                    <div class="bg-shadow ht-auto">
                        <div class="row space-all d-none">
                            <div class="col-md-6">
                                <div class="r-item checkbox-item">
                                    <input type="checkbox" value="1" name="radio-type" id="1_1">
                                    <label class="label-icon" for="1_1">
                                        <span class="num-holder">1.</span>
                                        <span>1-3months</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="r-item checkbox-item">
                                    <input type="checkbox" value="2" name="radio-type" id="2_2">
                                    <label class="label-icon" for="2_2">
                                        <span class="num-holder">2.</span>
                                        <span>1-3months</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="r-item checkbox-item">
                                    <input type="checkbox" value="3" name="radio-type" id="3_3">
                                    <label class="label-icon" for="3_3">
                                        <span class="num-holder">3.</span>
                                        <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="r-item checkbox-item">
                                    <input type="radio" value="4" name="radio-type" id="4_4">
                                    <label class="label-icon" for="4_4">
                                       <span class="num-holder">4.</span>
                                       <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's 
                                       standard dummy text ever since the 1500s</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-6">
                        <div class="col-md-12">
                            <a href="#" class="btn save-nxt-btn">Save & Next
                                <i class="fa fa-angle-right ps-3"></i>
                            </a> 
                            <a href="#" class="skip-txt">Skip</a>
                        </div>
                    </div>
                    <!-------text-type-------------->
                    <div class="bg-shadow ht-auto">
                        <div class="row d-none space-all">
                            <div class="col-md-12">
                                <div class="text-type">
                                    <input type="text" placeholder="Please Enter Your Response" class="form-control">
                                    <textarea row="5" col="10" placeholder="Please Enter Your Response" class="form-control"></textarea>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!-------rating-type------------>
                    <div class="bg-shadow ht-auto">
                        <div class="row space-all d-none">
                            <div class="col-md-12">
                                <div class="star-rating">
                                    <input type="radio" id="5-stars" name="rating" value="5">
                                    <label for="5-stars" class="star"></label>
                                    <input type="radio" id="4-stars" name="rating" value="4">
                                    <label for="4-stars" class="star"></label>
                                    <input type="radio" id="3-stars" name="rating" value="3">
                                    <label for="3-stars" class="star"></label>
                                    <input type="radio" id="2-stars" name="rating" value="2">
                                    <label for="2-stars" class="star"></label>
                                    <input type="radio" id="1-star" name="rating" value="1">
                                    <label for="1-star" class="star"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--------m-rating-type--------->
                    <div class="bg-shadow ht-auto">
                        <div class="row d-none space-all">
                            <div class="col-md-12">
                                <div class="row m-rating-type">
                                    <div class="col-md-10">
                                        <div class="r-item checkbox-item">
                                            <label class="label-icon">
                                                <span class="num-holder">1.</span>
                                                <span>1-3months</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select">
                                            <option>-Select rating-</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row m-rating-type">
                                    <div class="col-md-10">
                                        <div class="r-item checkbox-item">
                                            <label class="label-icon">
                                                <span class="num-holder">2.</span>
                                                <span>1-3months</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select">
                                            <option>-Select rating-</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row m-rating-type">
                                    <div class="col-md-10">
                                        <div class="r-item checkbox-item">
                                            <label class="label-icon">
                                                <span class="num-holder">3.</span>
                                                <span>1-3months</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row m-rating-type">
                                    <div class="col-md-10">
                                        <div class="r-item checkbox-item">
                                            <label class="label-icon">
                                                <span class="num-holder">4.</span>
                                                <span>1-3months</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select">
                                            <option>-Select rating-</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-----------order-type--------->
                    <div class="bg-shadow ht-auto">
                        <div class="row d-none space-all">
                            <div class="col-md-12">
                                <div class="row order-type">
                                    <div class="col-md-2">
                                        <div class="number-holder">
                                            1
                                        </div>
                                        <div class="number-holder">
                                            2
                                        </div>
                                        <div class="number-holder">
                                            3
                                        </div>
                                        <div class="number-holder">
                                            4
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="r-item checkbox-item">
                                            <label class="label-icon">
                                                <span>1-3months</span>
                                                <span class="move-icon">:::</span>
                                            </label>
                                        </div>
                                        <div class="r-item checkbox-item">
                                            <label class="label-icon">
                                                <span>1-3months</span>
                                                <span class="move-icon">:::</span>
                                            </label>
                                        </div>
                                        <div class="r-item checkbox-item">
                                            <label class="label-icon">
                                                <span>1-3months</span>
                                                <span class="move-icon">:::</span>
                                            </label>
                                        </div>
                                        <div class="r-item checkbox-item">
                                            <label class="label-icon">
                                                <span>1-3months</span>
                                                <span class="move-icon">:::</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----------matrix-type--------->
                    <div class="bg-shadow ht-auto">
                        <div class="row d-none space-all">
                            <div class="col-md-12">
                            <div class="matrix-que">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>aaa</td>
                                                <td>bbb</td>
                                                <td>ccc</td>
                                            </tr>
                                            <tr class="table-checkbox-type">
                                                <td>ddd</td>
                                                <td>
                                                    <input type="checkbox">
                                                </td>
                                                <td>
                                                    <input type="checkbox">
                                                </td>
                                                <td>
                                                    <input type="checkbox">
                                                </td>
                                            </tr>
                                            <tr class="table-radio-type">
                                                <td>ddd</td>
                                                <td>
                                                    <input type="radio" name="t-radio" value="r-1">
                                                    <label for="r-1"></label>
                                                </td>
                                                <td>
                                                    <input type="radio" name="t-radio" value="r-2">
                                                    <label for="r-2"></label>
                                                </td>
                                                <td>
                                                    <input type="radio" name="t-radio" value="r-3">
                                                    <label for="r-3"></label>
                                                </td>
                                            </tr>
                                            <tr class="table-checkbox-type">
                                                <td>eee</td>
                                                <td>
                                                    <input type="checkbox">
                                                </td>
                                                <td>
                                                    <input type="checkbox">
                                                </td>
                                                <td>
                                                    <input type="checkbox">
                                                </td>
                                            </tr>
                                            <tr class="table-checkbox-type">
                                                <td>ppp</td>
                                                <td>
                                                    <input type="checkbox">
                                                </td>
                                                <td>
                                                    <input type="checkbox">
                                                </td>
                                                <td>
                                                    <input type="checkbox">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!----------scale-type---------->
                    <div class="bg-shadow ht-auto">
                        <div class="row space-all">
                            <div class="col-md-12">
                                <div class="scale-type">
                                    <div>
                                        <input type="radio" value="s-1" name="scale-type" id="s-1">
                                        <label for="s-1" class="label-icon">1</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="s-2" name="scale-type" id="s-2">
                                        <label for="s-2" class="label-icon">2</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="s-3" name="scale-type" id="s-3">
                                        <label for="s-3" class="label-icon">3</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="s-4" name="scale-type" id="s-4">
                                        <label for="s-4" class="label-icon">4</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="s-5" name="scale-type" id="s-5">
                                        <label for="s-5" class="label-icon">5</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="s-6" name="scale-type" id="s-6">
                                        <label for="s-6" class="label-icon">6</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="s-7" name="scale-type" id="s-7">
                                        <label for="s-7" class="label-icon">7</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="s-8" name="scale-type" id="s-8">
                                        <label for="s-8" class="label-icon">8</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="s-9" name="scale-type" id="s-9">
                                        <label for="s-9" class="label-icon">9</label>
                                    </div>
                                    <div>
                                        <input type="radio" value="s-10" name="scale-type" id="s-10">
                                        <label for="s-10" class="label-icon">10</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex justify-content-between score-pt">
                                    <span>Least Likely</span>
                                    <span class="neutral-point">Neutral</span>
                                    <span>Most Likely</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----------feedback-form---------->
                    <div class="end-feedback-form bg-shadow space-all d-none">
                        <h4 class="thank-you-ttl mb-0">Thank you for your response, Please Submit your Survey.</h4>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email Id</label>
                            <input type="email" class="form-control">
                        </div>
                        <button type="submit" class="btn submit-btn">
                            <div id="" class="slide"></div>
                            Submit <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                    <!-------thank-you-form----------->
                    <div class="bg-shadow space-all text-center d-none">
                        <h4 class="thank-you-ttl mb-0">Thank you for your response, Please Submit your Survey.</h4>
                        <div class="s-icon pb-4">
                            <span>😄</span>
                            <span>😄</span>
                            <span>😄</span>
                        </div>
                        <button type="submit" class="btn submit-btn">
                            <div id="" class="slide"></div>
                            Submit <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row footer-bottom-fixed" id="" >
                    <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                        <div class="row align-items-center justify-content-center" id="" style="">
                            <div class="col-lg-6 col-md-5">
                                <p class="para mb-0 off-txt">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <div class="tooltip mob-tooltip"><span data-tooltip='Lorem Ipsum is simply dummy text of the printing and typesetting industry'
                                data-tooltip-position="right">
                                     <i class="fa fa-info-circle"></i></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-7 d-flex flex-column right-div">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-6 d-flex justify-content-end">
                                        <svg class="progress-circle" width="80px" height="90px" xmlns="http://www.w3.org/2000/svg">
                                    	    <circle class="progress-circle-back" cx="35" cy="35" r="25"></circle>
                                            <circle class="progress-circle-prog" cx="35" cy="35" r="25" style="stroke-dasharray: 0, 999;"></circle>
                                         </svg>
                        	            <div class="progress-text" data-progress="0">0%</div>
                                    </div>
                                    <div class="col-md-6 arrow-status">
                                        <div>
                                            <img class="img-fluid d-block survey-logo" src="images/logo-light.png">
                                        </div>
                                        <a id="next" class="next btn_slider btn_slider_dir rounded-circle disabled" title="Next">
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <a id="prev" class="back btn_slider btn_slider_dir rounded-circle disabled" title="Previous">
                                            <i class="fa fa-angle-up"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
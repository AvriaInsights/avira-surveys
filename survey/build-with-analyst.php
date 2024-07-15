<?php 
require_once("classes/cls-analyst.php");
$obj_analyst = new Analyst();
if (!isset($_SESSION['ifg_admin']) || !isset($_SESSION['ifg_admin']['client_id'])) {
    header("Location:login.php");
}
/***********Get Category*************/
$fields_cat = "*";
$condition_cat = "`tbl_category`.`status` = 'Active'";
$cat_list=$obj_analyst->getSurveyCategory($fields_cat, $condition_cat, '', '', 0);

?>
<?php include("dashboard-header-menu.php")?>
<?php include("sidebarmenu.php")?>

<style>
.form__group {
	 position: relative;
	 padding: 15px 0 0;
	 margin-top: 10px;
	 width: 100%;
}
 .form__field {
	 font-family: inherit;
	 width: 100%;
	 border: 0;
	 border-bottom: 2px solid #ddd;
	 outline: 0;
	 font-size: 1.4rem;
	 color: #000;
	 padding: 7px 0;
	 background: transparent;
	 transition: border-color 0.2s;
	 font-family: 'Nunito', sans-serif;
}
 .form__field::placeholder {
	 color: transparent;
}
 .form__field:placeholder-shown ~ .form__label {
	 font-size: 1.3rem;
	 cursor: text;
	 top: 20px;
     font-family: 'Lato', sans-serif;
}
 .form__label {
	 position: absolute;
	 top: 0;
	 display: block;
	 transition: 0.2s;
	 font-size: 1.4rem;
	 color: #000000;
	 font-family: 'Lato', sans-serif;
}
select.form__label{
    font-weight:700!important;
}
 .form__field:focus {
	 padding-bottom: 5px;
	 font-weight: 600;
	 border-width: 2px;
	 border-image: linear-gradient(to right, #313938, #d87b39,#11998e);
	 border-image-slice: 1;
	 font-family: 'Lato', sans-serif;
}
 .form__field:focus ~ .form__label {
	 position: absolute;
	 top: 0;
	 display: block;
	 transition: 0.2s;
	 font-size: 1.2rem;
	 color: #11998e;
	 font-weight: 600;
	 font-family: 'Lato', sans-serif;
}
/* reset input */
 .form__field:required, .form__field:invalid {
	 box-shadow: none;
}
.submit_btn {
    border-radius:25px !important;font-size:16px !important;
}
.error {
    color: red;
    font-size: 1.2rem;
    display: block;
    margin-top: 2px;
}
.form__group.field input,.form__group.field select{
    padding-bottom:1.5rem;
}

</style>
<div class="wrapper">
    <section class="space-padding-top">
        <div class="container-fluid pse-2">
            <div class="row">
                <div class="col-md-5">
                    <img src="<?php echo SITEPATH; ?>images/analyst.png" alt="" class="img-fluid">
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-sm-12 mt-5">
                            <h3 class="sm-menu-question-header">
                                <strong>Build With Analyst</strong>
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 offset-md-1 card p-border mb-5 mt-3">
                <div class="panel panel-default">
                    <!--  <div class="panel-heading text-center bg-primary p-3 mt-1 text-white display-6">
                        <strong>Build With Analyst</strong>
                    </div>-->
                    <div class="panel-body">
                    <form id="build_with_analyst" method="post" action="">
                        <div class="form__group field">
                            <input type="text" class="form__field" placeholder="Survey Title" name="s_title" id='s_title'/>
                            <label for="title" class="form__label">Survey Title</label>
                        </div>
                        
                         <div class="form__group field">
                            <input type="text" class="form__field" placeholder="Survey Subject" name="s_subject" id='s_subject'/>
                            <label for="name" class="form__label">Survey Subject</label>
                        </div>
                        
                         <div class="form__group field">
                             <select class="form__field" id="s_category" name="s_category">
                                  <option value="">Select Category</option>
                                  <?php foreach($cat_list as $cat_lists){?>
                                  <option value="<?php echo $cat_lists['title'];?>"><?php echo $cat_lists['title'];?></option>
                                  <?php }?>
                             </select>
                        </div>
                        
                         <div class="form__group field">
                            <input type="text" class="form__field pb-5" placeholder="Description" name="s_desc" id='s_desc'/>
                            <label for="name" class="form__label">Description</label>
                        </div>
    
                        <div class="text-center mt-3 mb-3">
                             <input type="submit" value="Submit" class="submit_btn btn survey-btn rounded-25 border">
                             <button type="button" class="btn btn-secondary submit_btn btn survey-btn rounded-25 border cancel_btn" onclick="window.history.back();">Cancel</button>
                             <span class="spinner-border spinner-border-md mt-4" role="status" aria-hidden="true" id="span_loader" style="display:none"></span>
                        </div>
                    </form>
                </div>
                </div>
              </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
</div>
   
<?php include("footer.php")?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>
    $(document).ready(function(){
       $('.wrapper').addClass("toggled"); 
    });
    
    //---***** form validations ******------// 
    $(document).ready(function(){
    $('#build_with_analyst').validate({
			 	errorClass: "error",
				rules:{
					s_title:{
						required:true,
					},
					s_subject:{
						required:true,
					},
					s_category:{
						required:true,
					
					},
				
				},
				messages:{
					s_title:{
						required:"Please Enter Survey Title",
					},
					s_subject:{
						required:"Please Enter Survey Subject",
					},
					s_category:{
						required:"Please Select Survey Category",
					},
				

				},
				submitHandler: function(form) {
                var formData = new FormData(form);
                saveFormDatas(form);
              }

			});
			
		});	
    
     //---***** form data post ******------//     
    
    function saveFormDatas(form) {
        $('#span_loader').show();
        var s_title = $("#s_title").val();
        var s_subject = $("#s_subject").val();
        var s_category = $("#s_category").val();
        var s_desc = $("#s_desc").val();
        
        $.ajax({
            type : 'POST',
            data : {s_title:s_title,s_subject:s_subject,s_category:s_category,s_desc:s_desc},
            url  : 'build-with-analyst-action.php',
            success: function(response){
                 $('#span_loader').hide();
                 //alert(response);
                 swal({
                    text: "Thank you for your survey request. Our team will get back to you soon and start working on as per your request.",
                    icon: "success",
                    showConfirmButton: true,
                    confirmButtonColor: '#04AA26',
                    position: "center",
                });
                    $("#build_with_analyst").trigger("reset");
            }
        });
}
        
</script>
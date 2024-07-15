<?php include('header.php'); ?>
<?php include('sidebar-menu.php');?>

<div class="home-section">
    <?php include("top-bar.php"); ?>
    <section class="common-space">
        <div>
            <img src="images/Top.svg" class="img-fluid top-right-pattern">
         </div>
         <div id="page-wrapper">
            <div class="container">
             <div class="row">
                 <div class="col-md-12">
                     <img src="images/404.svg" class="img-fluid error_img">
                 </div>
             </div>
         </div>
         </div>
         <div>
             <img src="images/Bottom.svg" class="img-fluid bottom-left-pattern">
         </div>
     </section>
</div>
<?php include('footer.php')?>
<script>
  let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
 arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".fa-bars");

sidebarBtn.addEventListener("click",()=>{
  sidebar.classList.toggle("close");
});
</script>
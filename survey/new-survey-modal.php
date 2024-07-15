<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    
}

body{
    font-family: 'Poppins', sans-serif;

}

.tab-bx{
    display:flex;
    position: absolute;
    top: 27%;
    left: 50%;
    transform:translate(-50%, -20%);
    width: 1275px;
    height: 520px;
    box-shadow: rgba(0, 0, 0, 0.19) 0px 3px 8px;
    
}

.tab-btn-bx {
   display: block;
    width: 30%;
    height: 520px;
    /* background: #16a085; */
    transition: 0.5s;
    background: #fff;
    padding-top: 27px;
}

.tab-btn-bx .tab-btn {
    width:100%;
    height: 84px;
    border:none;
    outline: none;
    background: #fff;
    /* background:#16a085; */
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
}
.tab-btn-bx .tab-btn:hover{
    background:#ecf0f1;
}
.tab-ctn-bx{
    border-left:1px solid rgba(0, 0, 0, 0.19);
    width:100%;
    height:100%;
    /* box-shadow: rgba(0, 0, 0, 0.19) 0px 0 3px; */
}

.tab-ctn-bx .tab-ctn{
    width:100%;
    height: 100%;
    padding: 10px;
    display:none;
    
}
.dot {
  height: 25px;
  width: 25px;
  background-color: #fff;
  border-radius: 50%;
  float:right;
  margin:49px;
  padding-left:7px;
  cursor:pointer;
}
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button>
  
  
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div> 

<!--<div id="myModal1" class="modal fade">-->
<!--    <span class="dot" id="close">X</span>-->
<!--    <div class="tab-bx">-->
<!--                    <div class="tab-btn-bx">-->
<!--                        <h4 style="text-align:center;">START NEW</h4>-->
<!--                        <button class="tab-btn" onclick="showPan(0,'#F5F5F5')">Manual Survey</button>-->
<!--                        <button class="tab-btn" onclick="showPan(1,'#F5F5F5')">Template Survey</button>-->
<!--                        <button class="tab-btn" onclick="showPan(2,'#F5F5F5')">Bulk Upload Survey</button>-->
<!--                        <button class="tab-btn" onclick="showPan(3,'#F5F5F5')">Copy Paste Survey</button>-->
<!--                        <button class="tab-btn" onclick="showPan(4,'#F5F5F5')">Build Analyst Survey</button>-->
<!--                    </div>-->
<!--                    <div class="tab-ctn-bx">-->
<!--                        <div class="tab-ctn">-->
<!--                            <h3>Tab Content - 1</h3>-->
<!--                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum voluptate iusto quia nemo assumenda, perspiciatis nihil tenetur reiciendis possimus dolore, iure eaque molestiae repellendus, cumque sunt? Quo optio reiciendis necessitatibus ipsam, a eos? Explicabo atque in illo repellendus eos ipsa, alias optio repudiandae cupiditate neque modi doloremque nam maxime dolor.</p>-->
<!--                        </div>-->
<!--                        <div class="tab-ctn">-->
<!--                            <h3>Tab Content - 2</h3>-->
<!--                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum voluptate iusto quia nemo assumenda, perspiciatis nihil tenetur reiciendis possimus dolore, iure eaque molestiae repellendus, cumque sunt? Quo optio reiciendis necessitatibus ipsam, a eos? Explicabo atque in illo repellendus eos ipsa, alias optio repudiandae cupiditate neque modi doloremque nam maxime dolor.</p>-->
<!--                        </div>-->
<!--                        <div class="tab-ctn">-->
<!--                            <h3>Tab Content - 3</h3>-->
<!--                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum voluptate iusto quia nemo assumenda, perspiciatis nihil tenetur reiciendis possimus dolore, iure eaque molestiae repellendus, cumque sunt? Quo optio reiciendis necessitatibus ipsam, a eos? Explicabo atque in illo repellendus eos ipsa, alias optio repudiandae cupiditate neque modi doloremque nam maxime dolor.</p>-->
<!--                        </div>-->
<!--                        <div class="tab-ctn">-->
<!--                            <h3>Tab Content - 4</h3>-->
<!--                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum voluptate iusto quia nemo assumenda, perspiciatis nihil tenetur reiciendis possimus dolore, iure eaque molestiae repellendus, cumque sunt? Quo optio reiciendis necessitatibus ipsam, a eos? Explicabo atque in illo repellendus eos ipsa, alias optio repudiandae cupiditate neque modi doloremque nam maxime dolor.</p>-->
<!--                        </div>-->
<!--                        <div class="tab-ctn">-->
<!--                            <h3>Tab Content - 5</h3>-->
<!--                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum voluptate iusto quia nemo assumenda, perspiciatis nihil tenetur reiciendis possimus dolore, iure eaque molestiae repellendus, cumque sunt? Quo optio reiciendis necessitatibus ipsam, a eos? Explicabo atque in illo repellendus eos ipsa, alias optio repudiandae cupiditate neque modi doloremque nam maxime dolor.</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
            
<!--</div>-->
 <script type="text/javascript">
    $(document).ready(function () {
        $("#myModal1").modal('show');
        
        
        $("#close").click(function(){
          $("#myModal1").modal('hide');
        });
        
    });
        const tab_btn = document.querySelectorAll('.tab-btn');
        const tab_ctn = document.querySelectorAll('.tab-ctn');
        
        
        const showPan = (indx, clrCde) =>{
            tab_btn.forEach(element => {
                element.style.backgroundColor = "";
                element.style.color = "";
            });
            tab_btn[indx].style.backgroundColor = clrCde;
            tab_btn[indx].style.color="#000";
        
            tab_ctn.forEach(element => {
                element.style.display="none";
            });
        
            tab_ctn[indx].style.display="block";
            tab_ctn[indx].style.backgroundColor = clrCde;
            tab_ctn[indx].style.color="#000";
        }
        
        showPan(0,'#F5F5F5');
    </script>

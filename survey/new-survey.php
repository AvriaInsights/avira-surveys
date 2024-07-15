<link rel="stylesheet" href="<?php echo SITEPATH;?>css/survey.css">
<link rel="stylesheet" href="<?php echo SITEPATH;?>css/modal-style.css">
<style>

.split {
  height: 100%;
  
  position: fixed;
  z-index: 1;
  top: 0;
  overflow-x: hidden;
  padding-top: 20px;
}

.left {
  width: 30%;
  left: 0;
  background-color: #fff;
  border:1px solid grey;
}

.right {
  width: 70%;
  right: 0;
  background-color: #fff;
}

.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

.centered img {
  width: 150px;
  border-radius: 50%;
}
.navbar {
  font-size: 0;
}

.nav-item {
  background: #4d98f5;
  box-sizing: border-box;
  color: #fff;
  display: inline-block;
  font-size: 14px;
  line-height: 50px;
  margin: 0;
  padding: 0 15px;
  text-align: center;
  vertical-align: middle;
}

.nav-item:not(:first-child) {
  border-left: 1px solid #6ba7f1;
}

.nav-item:first-child {
  border-radius: 3px 0 0 3px;
}

.nav-item:last-child {
  border-radius: 0 3px 3px 0;
}
</style>
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">CREATE A NEW SURVEY</h5>
            </div>
            <div class="modal-body create-survey-modal">
				<div class="split left">
                  <div class="centered">
                    <div class="navbar">
    <div class="nav-item">Menu 1</div>
    <div class="nav-item">Menu 2</div>
    <div class="nav-item">Menu 3</div>
    <div class="nav-item">Menu 4</div>
    <div class="nav-item">Menu 5</div>
    <div class="nav-item">Menu 6</div>
  </div>
                  </div>
                </div>
                
                <div class="split right">
                  <div class="centered">
                    <img src="img_avatar.png" alt="Avatar man">
                    <h2>John Doe</h2>
                    <p>Some text here too.</p>
                  </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
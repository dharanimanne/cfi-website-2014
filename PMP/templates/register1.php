<html>
<link href="css/bootstrap.css" rel="stylesheet">
<script src="js/jquery2.min.js"></script> 
<script src="js/bootstrap.min.js"></script>
<style>.form-group{max-width:100%}</style>
<body class="well">


<form class="form-horizontal" id="form-registration" method="post" action=""   name="registration" style="left:50%"> 
	<div style="left:50%">
    		<div class="form-group">
                <label  class="col-sm-2 control-label">Name</label>
                	<div class="row">
                      <div class="col-xs-2">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" required="required">
                      </div>
                        
                    </div>
                 </div>
    
    				<div class="form-group">
                        <label  class="col-sm-2 control-label">User Name</label>
                        <div class="col-sm-2 row2">
                          <input type="text" class="form-control"  name="user_name" id="user_name" placeholder="Username"  required="required">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">User Email</label>
                        <div class="col-sm-2 row2">
                          <input type="email" class="form-control"  name="user_email" id="user_email" placeholder="Email" required="required">
                        </div>
                      </div>
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Password</label>
                        <div class="row">
                      		<div class="col-xs-2">
                        		<input type="password" class="form-control" name="user_password_new" id="user_password_new" placeholder="Password" required="required" pattern=".{6,}" required autocomplete="off">
                      		</div>
                      		
                    	</div>
                      </div>
                       
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Roll Number</label>
                          <div class="col-xs-2">
                            <input type="text" class="form-control" id="user_roll" name="user_roll"  placeholder="Roll Number" required="required">
                          </div>
                          </div>
                         </div>
                      </div> 
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Hostel</label>
                        
                          <div class="col-xs-2">
                            <input type="text" class="form-control" name="user_hostel" id="user_hostel" placeholder="Hostel" required="required">
                          </div>
                         
                      </div> 
                      <div class="form-group">
                        <label  class="col-sm-2 control-label">Room</label>
                        
                          <div class="col-xs-2">
                            <input type="text" class="form-control" name="user_room" id="user_room" placeholder="Room" required="required">
                          </div>
                       
                      </div>
                      <div class="form-group" style="float:left;position:relative;left:170px">
	                   <button type="submit" name="register" class="btn btn-primary">Register</button>
                      </div>

            </div>
      </form>

</body>

</html>
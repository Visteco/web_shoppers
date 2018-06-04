<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>
        <div class="col-md-offset-3 col-md-7">
            <form class="form-horizontal" method="POST" action="<?php echo URL::to('api/savenewpas'); ?>" enctype="multipart/form-data">
               
                <input type='hidden' name='uid' value='<?php echo $uid ?>' >
                <fieldset>

                    <!-- Form Name -->
                    <legend>password</legend>

                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="passwordinput">Change Your Password</label>
                        <div class="col-md-4">
                            <input id="passwordinput" name="newpass" type="password" placeholder="new password" class="form-control input-md">
                            <span class="help-block">enter your new password</span>
                        </div>
                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="passwordinput">Re enter Password</label>
                        <div class="col-md-4">
                            <input id="passwordinput" name="confirmpass" type="password" placeholder="Re enter your new password" class="form-control input-md">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-4">
                            <input type="submit" name="submit" class='btn btn-primary' value="Submit">  
                           
                        </div>
                    </div>

                </fieldset>
            </form>    
        </div>


    </body>
</html>

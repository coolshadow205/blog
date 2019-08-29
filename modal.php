<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Modal</title>

    <!-- Bootstrap -->
    <link href="admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- PAGE LEVEL FONT -->
    <link rel="stylesheet" href="admin/font-awesome/css/font-awesome.min.css">

    <!-- CUSTOM CSS -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<?php
    $id = 8; 
    ?>
<button class="btn btn-danger" data-toggle="modal" data-target="#createModal" id='deleteButton'><span class="fa fa-trash"></span></button>

<!--MODAL BEGINS-->
<div class="modal fade " id="createModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!--MODAL CONTENT BEGINS-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <p class="lead">Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer">
                        <?php
                            echo "<a href='' class='btn btn-success' id='deleteCat'>Yes</a>";
                        ?>
                        <button type="button" data-dismiss="modal" class="btn btn-default">No</button>
                </div>
            </div>
        </div>
        <!--MODAL CONTENT ENDS--> 
    </div>
</div>
<!--MODAL ENDS-->
    <script>
        document.getElementById("deleteButton").onclick = function() {
            document.getElementById("deleteCat").href = 'kjasdjkasd?source<?php echo $id;?>';
        }
    </script>
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
    
    </body>

</html>
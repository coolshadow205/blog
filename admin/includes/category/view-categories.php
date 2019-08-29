<!-- INSERTED CATEGORIES -->
<?php
    /*30-12-17*/
    if($user_role == "admin"){
        echo "<div class='col-xs-12 table-responsive'>";
    }
    else
        echo "<div class='col-xs-6 table-responsive'>";

?>
    <table class="table table-bordered table-hover">
       <thead class="thead-inverse">
            <tr>
                <th>ID</th>
                <th>Category title</th>
            <?php
                /*30-12-17*/
                if($user_role == "admin"){
            ?>
                <th>Delete</th>
                <th>Edit</th>
                <?php }//END OF IF?>
            </tr>
        </thead>
            <tbody>
               <?php
                    $query = "SELECT * FROM categories";
                    $select_all_categories_query = mysqli_query($connection , $query);
                    while($row = mysqli_fetch_assoc($select_all_categories_query)){
                        $cat_id = $row["cat_id"];
                        $cat_title = $row["cat_title"];
                        echo "<tr>";
                        echo "<td>$cat_id</td>";
                        echo"<td>$cat_title</td>";
                        if($user_role == "admin"){
                            echo "<td><a class='btn btn-danger transparent-a' href='categories.php?delete=$cat_id'><span class='fa fa-trash'></span></a></td>";
                           echo "<td><a class='btn btn-primary' href='categories.php?edit=$cat_id'><span class = 'fa fa-pencil'></span></a></td>";
                        }
                        echo"</tr>";
                    }//END OF WHILE
//                <td><button type='button' class='btn btn-danger' data-toggle='modal'data-target='#createModal' id='deleteButton[]'><span class='fa fa-trash'></span></button></td>
                    if(isset($_GET['delete'])){
                        $delete_id = $_GET['delete'];
                        $query = "DELETE FROM categories WHERE cat_id=$delete_id";
                        $delete_query = mysqli_query($connection , $query);
                        header("Location: categories.php");
                    }
                    
                ?>               
            </tbody>
    </table>
    <!--MODAL BEGINS-->
<div class="modal fade" id="createModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!--MODAL CONTENT BEGINS-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <p class="lead">Are you sure you want to delete?</p>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-success" id="deleteCat">Yes</a>
                    <button type="button" data-dismiss="modal" class="btn btn-default">No</button>
                </div>
            </div>
        </div>
        <!--MODAL CONTENT ENDS--> 
    </div>
</div>
<!--MODAL ENDS-->
<script>
   var a = ["a", "b", "c"];
a.forEach(function(entry) {
    console.log(entry);
});
</script>
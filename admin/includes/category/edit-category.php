<div class="col-xs-6">
<?php 
    editCategory();
   $edit_cat_title = fetchCategoryForEdit();
?>

<?php
    if(isset($edit_cat_title))
    {
?>
<form action="" method="post">
   <h3>Edit Category</h3>
    <div class="form-group">
       <label for="cat_title">Category</label>
        <input class="form-control" type="text" name="cat_title" value="<?php                                                               echo $edit_cat_title;?>">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" name="edit_submit" type="submit" value="Edit Category">
    </div>
</form>
<?php
    }
?>
</div>
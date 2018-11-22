<div class="container control">
    <h4 class="h-center">الاضافة</h4>
    <form class="form-add-update" action="/admin/add" method="POST" enctype="multipart/form-data" >
        <input type="file" name="file" >
        <p class="count-p">105</p>
        <input type="text" class="count-inpt" name="header" onkeyup="countChar(0,105)" placeholder="اضف عنوان" required="required">
        <p class="count-p">122</p>
        <input type="text" class="count-inpt" name="title"  onkeyup="countChar(1,122)" placeholder="اضف خلاصة" required="required">
        <select name="parts">
            <?php foreach ($optionsParts as $row ) { ?>
                <option value="<?php echo $row['PARTS'] ?>"><?php echo $row['PARTS'] ?></option>
            <?php } ?>
        </select>
        <TEXTAREA type="text" name="blog"></TEXTAREA>
        <script type="text/javascript">
            CKEDITOR.replace('blog');
        </script>
        <br>
        <input type="text" name="tags"  dir='ltr' placeholder="add tags">
        <input type="submit" value="اضف" name="add">
    </form>
</div>
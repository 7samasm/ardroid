<div class="container control">
    <h4 class="h-center">التعديل</h4>
    <form class="form-add-update" action="/admin/edit/<?= $cards->getID() ?>" method="POST" enctype="multipart/form-data" >
        <input type="hidden" name="id" value="<?= $cards->getID() ?>">
        <input type="hidden" name="adminid" value="<?= $cards->getADMIN_ID() ?>">
        <input type="file" name="file" >
        <p class="count-p">105</p>
        <input type="text" class="count-inpt" name="header" onkeyup="countChar(0,105)" value="<?= $cards->getHEADER() ?>" placeholder="اضف عنوان" required="required">
        <p class="count-p">122</p>
        <input type="text" class="count-inpt" name="title"  onkeyup="countChar(1,122)" value="<?= $cards->getTITLE() ?>" placeholder="اضف خلاصة" required="required">
        <select name="parts"><?php
            foreach ($optionsParts as $row ) { ?>
                <option
                <?php echo $row['PARTS'] == $cards->getPARTS() ? 'selected' : null ?>
                value="<?php echo $row['PARTS'] ?>"
                >
                    <?php echo $row['PARTS'] ?>
                </option><?php
            } ?>
        </select>
        <TEXTAREA type="text" name="blog"><?= $cards->getBLOG() ?></TEXTAREA>
        <script type="text/javascript">
            CKEDITOR.replace('blog');
        </script>
        <br>
        <input type="text" name="tags"  value="<?= $cards->getTAGS() ?>" dir='ltr' placeholder="add tags">
        <input type="submit" value="عدل"  name="update" style="background: #f39c12;">
    </form>
</div>
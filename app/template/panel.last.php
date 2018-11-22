<h3>اخر المواضيع</h3>
<?php foreach ( $panels as $panel ) {  ?>
<div class="last-topic">
    <a href="/index/article/<?= $panel->getID() ?>">
        <img src="/images/<?= $panel->getIMG() ?>">
        <p><?= $panel->getHEADER() ?></p>
    </a>
</div>
<?php } ?>

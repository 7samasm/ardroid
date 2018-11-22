<div class="panel">
	<?php
	if (!empty($cards)) { ?>
	<div class="ads-cards">
		<div class="row">
			<div class="col col-full">
				<div id="top-ads"></div>
			</div>
			<div class="col col-full">
				<div class="search-count"><span style="color: #777;">عناصر الوسم : </span><?php echo str_replace('_',' ',$vars['tagUrl']) ?></div>
			</div>
            <div class="clear"></div>
		</div>
		<?php require_once TEMPLATE . 'cardRow.php';  ?>
	</div>
	<div class="sider">
		<?php require_once TEMPLATE . 'panel.last.php';  ?>
	</div>
    <div class="clear"></div>
	<?php } else {
		echo "<p class='search-count'>عذرا لم يتم اضافة موضوع في هذا الوسم</p>" ;
	} ?>
</div>

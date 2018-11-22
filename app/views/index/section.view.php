<div class="panel" section="<?= $vars[0] ?>">
	<?php if (!empty($cards)) { ?>
	<div class="ads-cards">
		<div class="row">
			<div class="col col-full">
				<div id="top-ads"></div>
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
		echo "<p class='search-count'>عذرا لم يتم اضافة موضوع في هذا القسم</p>" ;
	} ?>
</div>

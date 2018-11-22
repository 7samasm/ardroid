<div class="panel">
	<?php
	if ($vars['count'] > 0 )
	{ ?>
		<div class="ads-cards">
			<div class="row">
				<div class="col col-full">
					<div id="top-ads"></div>
				</div>
				<div class="col col-full">
					<div class="search-count"><?php echo  $vars['count'] .'  من النتائج ل ' . $vars['getSearch'] ?></div>
				</div>
                <div class="clear"></div>
			</div>
			<?php require_once TEMPLATE . 'cardRow.php';  ?>
		</div>
		<div class="sider">
			<?php require_once TEMPLATE . 'panel.last.php';  ?>
		</div>
        <div class="clear"></div><?php
	}
	else
	{
		echo '<div class="search-count">' . ' لا توجد نتائج ل ' . $vars['getSearch'] .  '</div>';
	}  ?>
</div>

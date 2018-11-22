<div class="panel pb">
    <div class="ads-cards title">
    	<div class="row">
    		<div class="col col-full">
    			<img src="/images/<?= $article->getIMG() ?>">
    			<article>
    				<div id="pading-part">
    					<h4><?= $article->getHEADER() ?></h4>
    					<div class="t-a">
    						<div><?= $article->first_name . ' ' . $article->sec_name ?></div>
    						<div><time class="timeago" datetime="<?php echo date(DATE_ISO8601,strtotime($article->getDATE())) ?>" ></time></div>
    					</div>
    					<div id="blog"><?= $article->getBLOG() ?></div><?php
                        if ($article->getTAGS() !== '') {
                           echo "<h3>اقرأ المذيد عن :</h3>";
                        } ?>
    					<div class="tag-div">
        					<?php
                            $etags = explode(',',$article->getTAGS());
                            foreach ($etags as $tag) {
        						$tagUrl     = str_replace('_','-',$tag);
                                $tagDisplay = str_replace('_',' ',$tag);
        						echo "<a href=\"/index/tag/{$tagUrl}\" class='tag'>{$tagDisplay}</a>";
        					} ?>
    					</div>
    				</div>
    			</article>
    		</div>
            <div class="clear"></div>
    	</div>
    </div>
    <div class="sider">
        <?php require_once TEMPLATE . 'panel.last.php';  ?>
    </div>
    <div class="clear"></div>
</div>
<!--*********************************fab***************************-->
<div id="fab_ctn" class="mdl-button--fab_flinger-container">
    <button id="fab_btn" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
    	<i class="fa fa-share "></i>
    </button>
    <div class="mdl-button--fab_flinger-options share-icons">
    	<!--1-->
    	<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect btn1">
    		<a href="#">
    			<div class="btndiv"><i class="fa fa-facebook "></i></div>
    		</a>
    	</button>
    	<!--2-->
    	<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect btn2">
    		<a href="#">
    			<div class="btndiv"> <i class="fa fa-google-plus"></i> </div>
    		</a>
    	</button>
    	<!--3-->
    	<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect btn3">
    		<a href="#">
    			<div class="btndiv"><i class="fa fa-twitter"></i></div>
    		</a>
    	</button>
    	<!--4-->
    	<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect btn4">
    		<a href="/admin" target="_blank" >
    			<div class="btndiv"><i class="fa fa-whatsapp"></i></div>
    		</a>
    	</button>
    </div>
</div>
<!--*********************************end-fab************************-->
<script>
/*=============================fab==========================*/
    (function () {
        var VISIBLE_CLASS = "is-showing-options",
        fab_btn  = document.getElementById("fab_btn"),
        fab_ctn  = document.getElementById("fab_ctn"),
        showOpts = function(e) {
            var processClick = function (evt) {
                if (e !== evt) {
                    fab_ctn.classList.remove(VISIBLE_CLASS);
                    fab_ctn.IS_SHOWING = false;
                    document.removeEventListener("click", processClick);
                }
            };
            if (!fab_ctn.IS_SHOWING) {
                fab_ctn.IS_SHOWING = true;
                fab_ctn.classList.add(VISIBLE_CLASS);
                document.addEventListener("click", processClick);
            }
        };
        fab_btn.addEventListener("click", showOpts);
    }.call(this));
    // beha
    window.onscroll = function () {
        "use strict";
        fab_ctn.style.display = window.scrollY > 302 ? 'block' : 'none';
    };
    window.onload = function () {
        "use strict";
        fab_ctn.style.display = window.scrollY > 302 ? 'block' : 'none';
    };
    /*=============================fab==========================*/
</script>

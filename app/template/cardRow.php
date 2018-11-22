<div class="row card-loop">
    <?php foreach ( $cards as $card ) {  ?>
    <div class="col col-card">
        <div class="card-block">
            <a href="/index/article/<?= $card->getID() ?>">
                <img src="/images/<?= $card->getIMG() ?>" width="100%" height="165">
            </a>
            <div class="header-auther-time-div">
                <a href="/index/article/<?= $card->getID() ?>">
                    <h4><?= $card->getHEADER() ?></h4>
                </a>
                <div class="div-to-flaot">
                    <span><?= $card->first_name . ' ' . $card->sec_name ?></span>
                    <time class="timeago" datetime="<?= date(DATE_ISO8601,strtotime($card->getDATE())) ?>" ></time>
                </div>
            </div>
            <p><span><?= $card->getTITLE() ?></span></p>
            <div class="dp">
                <span><a href="/index/section/<?= $card->getPARTS() ?>"><?= $card->getPARTS() ?></a></span>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="clear"></div>
</div>

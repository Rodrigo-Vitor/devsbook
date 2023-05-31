<?= $render('header', ['loggedUser' => $loggedUser]) ?>
<?= $render('sidebar') ?>
<section class="feed mt-10">

    <div class="row">
        <div class="column pr-5">

            <?= $render('feed-editor', ['loggedUser' => $loggedUser]) ?>
            <?php foreach($feed['posts'] as $feedItem): ?>
                <?= $render('feed-item', ['data' => $feedItem, 'loggedUser' => $loggedUser]) ?>
            <?php endforeach ?>

            <div class="feed-pagination">
                <?php for($q=0; $q<$feed['pageCount']; $q++): ?>
                    <a class="<?=($q==$feed['currentPage'] ? 'active' : '')  ?>" href="<?=$base?>/?page=<?=$q?>"><?=$q+1?></a>
                <?php endfor; ?>
            </div>




        </div>
        <div class="column side pl-5">
            <div class="box banners">
                <div class="box-header">
                    <div class="box-header-text">Patrocinios</div>
                    <div class="box-header-buttons">

                    </div>
                </div>
                <div class="box-body">
                    <a href=""><img src="https://mazer.dev/pt-br/laravel/visao-geral/componentes-de-arquitetura-do-framework-laravel/featured-laravel_hu3769fdde211cec892c1d22aeaa807e50_30091_0x480_resize_box_3.png" /></a>
                    <!-- <a href=""><img src="https://alunos.b7web.com.br/media/courses/laravel-nivel-1.jpg" /></a> -->
                </div>
            </div>
            <div class="box">
                <div class="box-body m-10">
                    Criado com ❤️ por B7Web
                </div>
            </div>
        </div>
    </div>

</section>
</section>
<?= $render('footer') ?>
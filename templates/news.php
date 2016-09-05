<h3>Новости</h3>
<hr>
<?php
foreach ($this->articles as $article):
    $dateCreate = date('d.m.Y', $article->dateCreate);
    ?>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><?= $article->title ?></h4>
                <h6><?= $dateCreate ?></h6>
            </div>
            <div class="panel-body">
                <p><?= $article->content ?></p>
            </div>

        </div>
    </div>
    <?php
endforeach;
?>
<hr>
<div class="row">
    <div class="col-md-6">
        <?php
        foreach ($this->pagesArray as $v) {
            if ($this->currentPage == $v):

                ?>
                <span class="lead"><?= $v + 1 ?></span>
                <?php
            else:
                $pageLink = '/Index/News/' . $v;
                ?>
                <a href="<?= $pageLink ?>"><?= $v + 1 ?></a>
                <?php
            endif;
        }

        ?>
    </div>
    <div class="col-md-6 nextNews">
        <?php
        if (0 == $this->currentPage) {
            $pagePreviousLink = '/Index/News/0';
        } else {
            $pagePreviousLink = '/Index/News/' . ($this->currentPage - 1);
        }

        if ($this->pagesCount <= $this->currentPage) {
            $pageNextLink = '/Index/News/' . ($this->pagesCount - 1);
        } else {
            $pageNextLink = '/Index/News/' . ($this->currentPage + 1);
        }

        ?>
        <a href="<?= $pagePreviousLink ?>">&lt;Предыдущая страница&lt; </a>
        &nbsp;&nbsp;&nbsp;
        <a href="<?= $pageNextLink ?>"> &gt;Следующая страница&gt;</a>
    </div>
</div>

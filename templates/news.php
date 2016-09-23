<h3>Новости</h3>
<hr>
<?php
$editable = $this->login?'editable':'';
//$editable = !isset($editable)?'':$editable;
if ('editable' == $editable):
?>
<div class="row" style="text-align: center">
    <a href="#" style="text-decoration: none">
        <div class="panel panel-danger <?=$editable?>" style=" padding-top: 10px; padding-bottom: 10px">
            Добавить новость
        </div>
    </a>
</div>
<?php
endif;


foreach ($this->articles as $article):
    $dateCreate = date('d.m.Y', $article->dateCreate);
    ?>
    <div class="row echo-article">
        <div class="panel panel-info <?=$editable?>" id = "n<?=$article->id?>">
            <div class="panel-heading">
                <h4><?= $article->title ?></h4>
                <h6><?= $dateCreate ?></h6>
            </div>
            <div class="panel-body">
                <p><?= $article->content ?></p>
            </div>
<!--            <div class="editRemove"><span class="glyphicon glyphicon-remove"></span></div>-->
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
                <span class="lead"><?= $v ?></span>
                <?php
            else:
                $pageLink = '/Index/News/' . $v;
                ?>
                <a href="<?= $pageLink ?>"><?= $v ?></a>
                <?php
            endif;
        }

        ?>
    </div>
    <div class="col-md-6 nextNews">
        <?php
        if (1 == $this->currentPage) {
            $pagePreviousLink = '/Index/News/1';
        } else {
            $pagePreviousLink = '/Index/News/' . ($this->currentPage - 1);
        }

        if ($this->pagesCount <= $this->currentPage) {
            $pageNextLink = '/Index/News/' . ($this->pagesCount);
        } else {
            $pageNextLink = '/Index/News/' . ($this->currentPage + 1);
        }

        ?>
        <a href="<?= $pagePreviousLink ?>">&lt;Предыдущая страница&lt; </a>
        &nbsp;&nbsp;&nbsp;
        <a href="<?= $pageNextLink ?>"> &gt;Следующая страница&gt;</a>
    </div>
</div>

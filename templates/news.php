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
        //$this->pagesCount = 12203; // remove!!!
        $pagesStep = floor(strlen($this->pagesCount) / 2);
        if (0 == $pagesStep) {
            $pagesStep++;
        }
        $pagesStep =(INT) pow(10, $pagesStep);// интервал между группами страниц (10-100-1000...)
        //var_dump($pagesStep);
        //$this->currentPage = 80;
        $delta = 5;// кличество страниц идущих подряд до и после текущей
        for ($i = 0; $i < $this->pagesCount; $i++):

            $showLink = ($i < $delta) || (abs($this->currentPage - $i) <= $delta) || (($i + 1) % $pagesStep == 0) || ($i >= ($this->pagesCount - $delta));
            if ($showLink) {
                if ($this->currentPage == $i ):

                    ?>
                    <span class="lead"><?= $i+1 ?></span>
                    <?php
                else:
                    $pageLink = '/Index/News/' . $i;
                    ?>
                    <a href="<?= $pageLink ?>"><?= $i+1 ?></a>
                    <?php
                endif;
            }

        endfor;
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
            $pageNextLink = '/Index/News/' . $this->currentPage++;
        } else {
            $pageNextLink = '/Index/News/' . ($this->currentPage + 1);
        }

        ?>
        <a href="<?= $pagePreviousLink ?>">&lt;Предыдущая страница&lt; </a>
        &nbsp;&nbsp;&nbsp;
        <a href="<?= $pageNextLink ?>"> &gt;Следующая страница&gt;</a>
    </div>
</div>

<h3>Новости</h3>
<hr>
<?php
foreach ($this->articles as $article):
    $dateCreate=date('d.m.Y',$article->dateCreate);
?>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><?=$article->title?></h4>
            <h6><?=$dateCreate?></h6>
        </div>
        <div class="panel-body">
            <p><?=$article->content?></p>
        </div>

    </div>
</div>
<?php
endforeach;
?>
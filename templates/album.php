<h3><?=$this->header?></h3>
<hr>

<div class="row">
    <?php
        foreach ($this->gallery as $item):
            $src = '/assets/gallery/' . $this->folder . '/small/' . $item->filename;
            $href = '/assets/gallery/' . $this->folder . '/' . $item->filename;
            $info = $item->description;
            $label = $item->label;
            ?>
            <div class="echo-gallery-block col-lg-3 col-md-3 col-sm-4 col-xs-6">
                <a href="<?=$href?>"><img src="<?=$src?>" alt="<?=$info?>"></a>
                <div class="img_label"><?=$label?></div>
            </div>
    <?php
         endforeach;
    ?>
</div>

<div class="row">
    <div>
        <script src="/ckeditor/ckeditor.js"></script>
        <form name="ckForm" method="post" action="">
            <div><span class="lead">Заголовок - </span><input type="text" name="echoTitle" maxlength="100" size="40" value="<?=$this->editArticle->title?>"></div>
            <div><textarea name="echoContent" id="echoEditor" rows="15"  cols="80"><?=$this->editArticle->content?></textarea></div>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'echoEditor' );
            </script>
            <div><input name="ckSave" type="submit" value="Сохранить черновик"></div>
        </form>
    </div>
</div>

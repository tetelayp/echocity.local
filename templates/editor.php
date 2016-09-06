<div class="row">
    <div>
        <script src="../ckeditor/ckeditor.js"></script>
        <form name="ckForm" method="post" action="../index/login">
            <div><span class="lead">Заголовок - </span><input type="text" name="title1" maxlength="100" size="40"></div>
            <div><textarea name="editor1" id="editor1" rows="15"  cols="80"><?php include 'main.php';?></textarea></div>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
            <div><input name="ckSave" type="submit" value="Сохранить черновик"></div>
        </form>
    </div>
</div>

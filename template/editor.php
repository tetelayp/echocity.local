<div class="row">
    <div>
        <script src="../ckeditor/ckeditor.js"></script>
        <form>
            <textarea name="editor1" id="editor1" rows="15"  cols="80"><?php include 'main.php';?></textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
        </form>
    </div>
</div>

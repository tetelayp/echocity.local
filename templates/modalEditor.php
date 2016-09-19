<div class="editModal modalDisable wrapper">
    <div class="editModalBackground"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="panel panel-danger">
                        <div class="panel-heading" id="editPanelTitle">
                            Редактор
                        </div>
                        <div class="panel-body">
                            <script src="/ckeditor/ckeditor.js"></script>
                            <form name="editForm"  method="post" action="/ajax.php">
                                <div class="editItem">
                                    <input name="title" type="text" maxlength="100" id="editTitle" style="width: 100%" placeholder="Краткое описание (заголовок)">
                                </div>
                                <div class="row">
                                    <textarea name="content" id="editContent" style="width: 100%" placeholder="Содержание"></textarea>
                                </div>
                                <div class="editItem">
                                    <input id="editSubmit" type="submit" value="Сохранить">
                                    <input id="editCancel" type="button" value="Отменить">
                                </div>
                                <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor
                                    // instance, using default configuration.
                                    CKEDITOR.replace( 'editContent' );
                                </script>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editModalTitle">Редактор</h4>
            </div>
            <div class="modal-body echo-article">
                <script src="/ckeditor/ckeditor.js"></script>
<!--                <script src="//cdn.ckeditor.com/4.5.11/full/ckeditor.js"></script>-->
                <form name="editForm" class="editForm"  method="post" action="/ajax.php">
                    <div class="editItem">
                        <input name="title" type="text" maxlength="100" id="editTitle"  placeholder="Краткое описание (заголовок)">
                    </div>
                    <div class="row">
                        <textarea name="content" id="editContent"  placeholder="Содержание"></textarea>
                    </div>
                    <script>
                        // Replace the <textarea id="editor1"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'editContent');
                        CKEDITOR.config.filebrowserBrowseUrl = '/echoBrowser/echoBrowser.php';
                        //CKEDITOR.config.width = 767;
                        CKEDITOR.config.height = 300;
                        CKEDITOR.config.allowedContent = true;
                        CKEDITOR.config.contentsCss = CKEDITOR.getUrl('/assets/css/echoStyle.css');

                        //CKEDITOR.config.filebrowserUploadUrl = '/uploader/upload.php';
                        //CKEDITOR.config.filebrowserImageUploadUrl = '/uploader/upload.php?type=Images';
                        //CKEDITOR.config.toolbar =  [ ['About', 'Bold', 'Link', 'VideoDetector'] ];


                        CKEDITOR.config.extraPlugins = 'uploadimage';
                        CKEDITOR.config.uploadUrl = '/uploader/upload.php';


                            //CKEDITOR.editorConfig = function( config ) {
                        CKEDITOR.config.toolbarGroups = [
                            { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                            { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                            { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                            { name: 'forms', groups: [ 'forms' ] },
                            '/',
                            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                            { name: 'links', groups: [ 'links' ] },
                            { name: 'insert', groups: [ 'insert' ] },
                            '/',
                            { name: 'styles', groups: [ 'styles' ] },
                            { name: 'colors', groups: [ 'colors' ] },
                            { name: 'tools', groups: [ 'tools' ] },
                            { name: 'others', groups: [ 'others' ] },
                            { name: 'about', groups: [ 'about' ] }
                        ];

                        CKEDITOR.config.removeButtons = 'Save,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Flash,Iframe,About';
                        //    };
                        
                    </script>

                </form>

<!--                -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-danger" id="btnDelete">Удалить</button>
<!--                <button type="button" class="btn btn-warning" id="btnSaveNew">Новая запись</button>-->
                <button type="button" class="btn btn-primary" id="btnSave">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-example-modal-sm" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Подтвердите выбор
            </div>
            <div class="modal-body">
                Отменить действие будет невозможно!
                Удалить?
            </div>
            <div class="modal-footer">
                <button type="button" id="btnYes" class="btn btn-primary">Да</button>
                <button type="button" id="btnNo" class="btn btn-default" data-dismiss="modal">Нет</button>
            </div>
        </div>

    </div>
</div>
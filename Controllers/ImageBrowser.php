<?php
require __DIR__ . '/../autoload.php';
$db = new \Models\Db();

?>

<script>
    function useImage(imgSrc) {
        function getUrlParam( paramName ) {
            var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' ) ;
            var match = window.location.search.match(reParam) ;

            return ( match && match.length > 1 ) ? match[ 1 ] : null ;
        }
        var funcNum = getUrlParam( 'CKEditorFuncNum' );
        var imgSrc = imgSrc;
        var fileUrl = imgSrc;
        window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl );
        window.close();
    }
</script>
<img src="/assets/img/inter.png" onclick="

useImage('/assets/gallery/a_000000/p_000020.jpg');//http://echocity.local

">

<input type="text">
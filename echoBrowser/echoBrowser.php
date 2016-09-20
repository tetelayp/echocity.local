<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--    <link href="browserStyle.css">-->

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body, html, .imgList{

            height: 100%;
            width: 100%;
        }

        body{
            padding-left: 150px;
            background-color: white;
        }
        .sideBar{
            position: fixed;
            overflow-y: auto;
            left: 0;
            top: 0;
            float: left;

            height: 100%;
            width: 150px;

            padding: 15px;

            border: solid 2px #67b168;
        }

        a{
            text-decoration: none;

        }
        ul{
            list-style: none;
        }

        ul>li{
            padding-bottom: 15px;
        }

        .imgList {
            text-align: center;
        }

        .imgList>div {
            position: relative;
            display: inline-block;
            height: 200px;
            width: 200px;
            padding: 7px;
            margin: 2px;
            border: solid 1px #e2e2e2;
            border-radius: 5px;
            overflow: hidden;
            text-align: center;
        }
        .imgList img{
            max-height: 100%;
            width: 100%;

        }

        .imgList>div>div {
            position: absolute;
            bottom: 0;
            width: 100%;

            padding: 7px 0 12px 0;

            color: green;
            background-color: white;
            opacity: 0.65;
        }


    </style>
</head>

<body>



<?php
require __DIR__ . '/../autoload.php';
$db = new \Models\Db();

$albums = $db->getAllRecords(Settings::TABLE_GALLERY,\Models\Album::class);
$imgs = $db->getAllRecords(Settings::TABLE_PICTURES, \Models\Picture::class);
?>
<div class="sideBar">

        <ul>

            <?php
            foreach ($albums as $album):
            ?>
                <li><a href="#" album="<?=$album->id?>"><?=$album->label?></a></li>
            <?php
            endforeach;
            ?>
            <li><a href="#" album="-1">Остальные фото</a></li>
        </ul>

</div>

<?php
$serialize = '';
$itemSplitter = '=;=;=';
$fieldSplitter = ';;;';
foreach ($imgs as $img):

$serialize .= $itemSplitter.$img->id. $fieldSplitter .$img->albumID. $fieldSplitter .$img->label. $fieldSplitter .$img->filename;

endforeach;
$serialize = substr($serialize,strlen($itemSplitter));
?>
<!--    <div><img album="--><?//=$img->albumID?><!--" src="--><?//= '/assets/gallery/icons/' . $img->filename ?><!--" style="height: auto; width: 100px"><div>12345 x 12345</div></div>-->
<div class="imgList" id="picsContainer">
</div>
<script>
    var serialize = '<?=$serialize?>';
    var temp = serialize.split('<?=$itemSplitter?>');
    var temp1;
    var imgs = [];
    for (var i = 0; i<temp.length; i++){
        temp1 = temp[i].split('<?=$fieldSplitter?>');
        var img = {};
        img.id = temp1[0];
        img.albumID = temp1[1];
        img.label = temp1[2];
        img.filename = temp1[3];
        imgs[i] = img;
    }

//    console.log(imgs);

    var albumsLinks = document.querySelectorAll('a');
//    console.log(albumsLinks);
    for (var i = 0; i<albumsLinks.length; i++){

        albumsLinks[i].addEventListener('click', function (e) {
            e.preventDefault();
            var albumID = this.getAttribute('album');
            //alert (albumID);
            showAlbum(albumID, imgs, '#picsContainer');
        })
    }

    showAlbum(albumsLinks[0].getAttribute('album'), imgs, '#picsContainer');


    function showAlbum(albumID, picsArray, containerSelector) {
        var innerHTML='';

        for (var i = 0; i<picsArray.length; i++){
            if (albumID==picsArray[i].albumID){
                var src = '/assets/gallery/' + picsArray[i].filename;//icons/

                innerHTML += '<div><img src="' + src + '" ><div>' + '12345' + ' x ' + '12345' + '</div></div>';

            }
        }
        var containerLink = document.querySelector(containerSelector);
        containerLink.innerHTML = innerHTML;

        var links = document.querySelectorAll('img');

        for (var i = 0; i<links.length; i++){

            links[i].addEventListener('click',function (e) {
                var src = this.getAttribute('src');
                useImage(src);
            });

        }
    }







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
<!--<img src="/assets/img/inter.png" onclick="-->
<!--var src = this.getAttribute('src');-->
<!--//useImage('/assets/gallery/a_000000/p_000020.jpg');//http://echocity.local-->
<!--useImage(src);-->
<!--">-->






<!--<div class="imgList">-->
<!---->
<!--    <div><img src="/assets/gallery/p_000100.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000101.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000102.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000103.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000104.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000105.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000106.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000107.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000108.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000109.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000110.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000111.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000112.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000001.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000002.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000003.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000004.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000005.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000006.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000007.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000008.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000009.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000010.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000011.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000012.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000013.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000014.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000015.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000016.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000017.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000018.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000019.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000020.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000021.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000022.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/DSC_0222.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/DSC_0226.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/DSC_0227.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/DSC_0230.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/DSC_0232.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/DSC_0236.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/DSC_0239.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/DSC_0243.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/DSC_0250.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/DSC_0252.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/DSC_0253.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/DSC_0254.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000300.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000301.jpg"><div>12345 x 12345</div></div>-->
<!--    <div><img src="/assets/gallery/p_000302.jpg"><div>12345 x 12345</div></div>-->
<!---->
<!--</div>-->







</body>
</html>
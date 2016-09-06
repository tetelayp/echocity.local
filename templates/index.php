<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php if (isset($this->title)){echo $this->title;} else {echo'Title';}?></title>

    <!-- Bootstrap -->
      <link href="/assets/css/bootstrap.css" rel="stylesheet">
      <link href="/assets/css/echoStyle.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body>

<header>
    <div class="container-fluid">

        <div class="row">
            <nav role="navigation" class="navbar navbar-default">
                <div class="container">
                    <div class="navbar-header echo-header">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1><?php if (isset($this->title)){echo $this->title;} else {echo'Title';}?></h1>
                                    <p><?php if (isset($this->description)){echo $this->description;} else {echo'Site description';}?></p>
                                </div>
                            </div>
                        </div>
                        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                            <span class="sr-only">toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="navbarCollapse" class="collapse navbar-collapse navbar-right">
                        <ul class="nav nav-pills">
                            <li <?php
                                if ('main.php' == $this->subTemplate):
                                    ?>
                                    class="active"
                                    <?php
                                endif;
                            ?>><a href="/Index">На главную</a></li>
                            <li <?php
                            if ('news.php' == $this->subTemplate):
                                ?>
                                class="active"
                                <?php
                            endif;
                            ?>><a href="/Index/News">Новости</a></li>
                            <li <?php
                            if ('gallery.php' == $this->subTemplate):
                                ?>
                                class="active"
                                <?php
                            endif;
                            ?> role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Галерея <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="/Index/Gallery">Обзор альбомов</a></li>
                                    <?php
                                    foreach ($this->albumsArray as $album):
                                        ?>
                                        <li><a href="/Index/Gallery/<?=$album->id?>"><?=$album->label?></a></li>
                                        <?php
                                    endforeach;
                                    ?>
                                </ul>
                            </li>
                            <li><a href="#">Контакты</a></li>
                            <li><a href="#">О сайте</a></li>
                            <?php
                            if (!$this->login):
                            ?>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Вход <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="panel panel-info">
                                            <div class="panel-heading">Авторизация</div>
                                            <div class="panel-body">
                                                <form role="authorize" name="authorizeForm" method="post" action="../index/login">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" placeholder="login" name="name" class="form-control input-sm">
                                                        </div>
                                                        <div class="input-group">
                                                            <input type="password" placeholder="password" name="password" class="form-control input-sm">
                                                            <div class="input-group-btn text-right">
                                                                <button class="btn btn-default btn-sm" type="submit"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <?php
                            else:
                            ?>
                                <li><a href="../index/logout">Выход</a></li>
                            <?php
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
<main>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-lg-push-3">

                    <?php
                    /**
                     *  подключенье подшаблона
                     */
                        include __DIR__ . '/' . $this->subTemplate;

                    ?>

                </div>



                <div class="col-lg-3 col-lg-pull-9">

                    <div class="panel panel-info">
                        <div class="panel-heading">Последние новости</div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <?php
                                foreach ($this->articlesTitles as $articlesTitle):
                                    $dateCreate = date('d.m.y', $articlesTitle->dateCreate);
                                ?>
                                <li class="list-group-item">
                                    <a href="/Index/News/n<?=$articlesTitle->id?>">
                                        <div class="articleTitle"><?=$articlesTitle->title?> <span class="badge"><?=$dateCreate?></span></div>
                                    </a>

                                </li>
                                <?php
                                endforeach;
                                ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="clear"></div>
</main>
<footer>
    <div class="container">
        <p class="text-center"><a href="#">(C) <?=$this->server?></a></p>
    </div>
</footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/assets/js/bootstrap.min.js"></script>
</body>
</html>
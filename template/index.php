<?php
$title='Echocity';
$description='my new site';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php if (isset($title)){echo $title;} else {echo'Title';}?></title>

    <!-- Bootstrap -->
      <link href="../assets/css/bootstrap.css" rel="stylesheet">
      <link href="../assets/css/echoStyle.css" rel="stylesheet">
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
                                    <h1><?php if (isset($title)){echo $title;} else {echo'Title';}?></h1>
                                    <p><?php if (isset($description)){echo $description;} else {echo'Site description';}?></p>
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
                            <li class="active"><a href="index.php">Home</a></li>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Gallery <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">gallery1</a></li>
                                    <li><a href="#">gallery2</a></li>
                                    <li><a href="#">gallery3</a></li>
                                    <li><a href="#">gallery4</a></li>
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Projects <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Project1</a></li>
                                    <li><a href="#">Project2</a></li>
                                    <li><a href="#">Project3</a></li>
                                    <li><a href="#">Project4</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Files</a></li>
                            <li><a href="#">Contacts</a></li>
                            <li><a href="#">About</a></li>

                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Login <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="panel panel-info">
                                            <div class="panel-heading">Autorization</div>
                                            <div class="panel-body">
                                                <form role="autorize">
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
                    $page=isset($_GET['p'])?$_GET['p']:'main';

                    switch ($page){
                        case 'gallery':include __DIR__ . '/gallery.php';break;
                        case 'editor':include __DIR__ . '/editor.php';break;
                        default:include __DIR__ . '/main.php';break;
                    }

                    ?>

                </div>



                <div class="col-lg-3 col-lg-pull-9">

                    <div class="panel panel-info">
                        <div class="panel-heading">News</div>
                        <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item"><a href="#">News 1</a> <span class="badge">10</span></li>
                                <li class="list-group-item"><a href="#">News 2</a> <span class="badge">10</span></li>
                                <li class="list-group-item"><a href="#">News 3</a> <span class="badge">10</span></li>
                                <li class="list-group-item"><a href="#">News 4</a> <span class="badge">10</span></li>
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
        <p class="text-center"><a href="#">(C) echocity.ru</a></p>
    </div>
</footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
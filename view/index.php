<?php
    include '../DAO/ProductDAO.php';
    session_start();


    $array = array();
    $userDao = new ProductDAO();
    $array = $userDao->selectProduct();

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>API Pagamento</title>

    <!-- Bootstrap Core CSS -->
    <link href="../include/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../include/assets/css/heroic-features.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/APIPagamento/view/index.php">Integração API Pagamento</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="about.php">Sobre</a>
                    </li>
                    <li>
                        <a href="index.php#produtos">Produtos</a>
                    </li>
                    <li>
                        <a href="contato.php">Contato</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>OLÁ CLIENTE</h1>
            <p>Compre que é mais barato e etc</p>
        </header>

        <hr>

        <!-- Title -->
        <div class="row" id="produtos">
            <div class="col-lg-12">
                <h3>Produtos Mais Vendidos</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">
            <?php
                foreach ($array as $a){
            ?>

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h3><?php echo utf8_decode($a['name']); ?> </h3>
                        <p><?php echo utf8_decode($a['description']); ?></p>
                        <p>Price: <?php echo $a['price']; ?></p>
                        <p>
                            <a href="../controller/paymentController.php?productId=<?php echo $a['id']?>" class="btn btn-primary">Buy Now!</a> <a href="#" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div><?php } ?>
        </div>

        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php
            require_once('footer.php');
        ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../include/assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../include/assets/js/bootstrap.min.js"></script>

</body>

</html>

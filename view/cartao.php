<?php
    session_start();
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
                <a class="navbar-brand" href="index.php">Integração API Pagamento</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Sobre</a>
                    </li>
                    <li>
                        <a href="#">Produtos</a>
                    </li>
                    <li>
                        <a href="#">Contato</a>
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
            <h1><?php echo $_SESSION['name'] ; echo $_SESSION['maxid'] ;?></h1>
            <p><?php echo $_SESSION['description']?></p>
        </header>

        <hr>

        <div class="container" style="width: 500px; float: left;">
            <h2>Dados do Cartão de Credito</h2>
            <form action="../controller/stripe.php" method="post" name="cc_input">
                <div class="form-group">
                    <label for="numero">Numero:</label>
                    <input type="text" class="form-control" name="cc_number" placeholder="4242424242424242"
                        required="required">
                </div>
                <div class="form-group">
                    <label for="mes">Mes de Expiração:</label>
                    <input type="number" class="form-control" name="cc_month" placeholder="12" required="required">
                </div>
                <div class="form-group">
                    <label for="mes">Ano de Expiração:</label>
                    <input type="number" class="form-control" name="cc_year" placeholder="<?php echo date("Y"); ?>"
                        required="required">
                </div>
                <div class="form-group">
                    <label for="cvv">Codigo de Segurança:</label>
                    <input type="text" class="form-control" name="cc_cvv" placeholder="123" required="required">
                </div>
                <p>
                    <input type="submit" class="btn btn-primary" value="PAGAR" />
                </p>
            </form>
        </div>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../include/assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../include/assets/js/bootstrap.min.js"></script>
</body>
</html>

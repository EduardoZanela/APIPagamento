<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Site.com(LOJA)</title>
    <style type="text/css">
    body {background-color:#D7D7D7;}
    *{font-family: Tahoma, Geneva, sans-serif;}
    h1 {text-align:center; color:#333; font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;}
    h4 {color:#333; font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;}
    table {border:1px solid #666; border-radius:5px 5px 5px 5px; box-shadow:1px 0px 1px #999 inset; background-color:#F2F2F2; margin:0 auto;}
    input {border:1px solid #333; border-radius:4px 5px 5px 5px; box-shadow:1px 0px 1px #999 inset; padding:5px; margin-top:2px;}
    input:hover {background-color:#FFF; transition:ease-in-out 0.4s; box-shadow:1px 0px 1px #CCC inset;}
    </style>
    </head>

    <body>
    <?php
    $moeda = 'USD';
    ?>
<h1>Site.com</h1>
<table border="0" cellpadding="4">
    <tr>
        <td width="70%"><h4>Bilhetes Platina</h4>(Se vai ao concerto logo a noite, esta é a  sua melhor chance de ficar na fila V.I.P)</td>
        <td width="30%">
            <form method="post" action="paypalData.php">
                <input type="hidden" name="itemNome" value="Bilhetes Platina" />
                <input type="hidden" name="itemPreco" value="20.00" />
                Quantidade : <select name="itemQnt"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select>
                <input type="submit"  value="Comprar (20.00 <?php echo $moeda; ?>)" />
            </form>
        </td>
    </tr>
</table>
</body>
</html>
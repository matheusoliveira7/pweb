<html>

<head>
    <Title></Title>
    <script type="text/javascript">
    function loginsuccessfully(){
        setTimeout("window.location='index.php'", 3000);
    }
    function loginfailed(){
        setTimeout("window.location='recuperar-senha.php'", 3000);
    }
    </script>
</head>
<body>

<?php
    require_once("conecta.php");
    $email = $_POST["email"];

   // mysqli_set_charset($conn,'UTF-8');

    $sql = "SELECT * FROM usuario WHERE email = '$email'";

    $result = mysqli_query($conn,$sql);
    if (!$result) {
        echo "N�o foi poss�vel executar a consulta ($sql) no banco de dados: " . mysqli_error();
        exit;
    }
    $row = mysqli_num_rows($result);
    if ($row== 0) {
         echo "Email não cadastrado em nosso sistema. Tente novamente!";
        echo "<script>loginfailed()</script>";
        exit;
        

    }else{
        $row = mysqli_fetch_assoc($result);
        $nome = $row["nome"];
        $email = $row["email"];
        $senha = base64_decode( $row["senha"]);
   //     echo $row["email"];
        $msg = "Recuperação de Senha \nOlá $nome! Você realizou o procedimento para recuperar sua senha.\n\nSua senha é: $senha";

$mensagem = $msg;
$destinatario = $email;
$assunto = "Recupeação de senha";
$headers = "Bcc: [email]matheusoliveira@outlook.com.br[/email]";

ini_set('sendmail_from', 'matheusoliveira@outlook.com.br');
mail($destinatario, $assunto, $mensagem, $headers);
echo "Mensagem enviada com sucesso! Verifique seu email!";
echo "<script>loginsuccessfully()</script>";
       
    }

?>
</body>
</html>

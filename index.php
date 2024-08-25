<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Configuração para exibir todos os erros
error_reporting(E_ALL);
ini_set('display_errors', '1');

if(isset($_POST['submit'])){


    // Obtendo dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $descricao_servicos = $_POST['descricao_servicos'];



    // Envie um e-mail para o endereço profissional
    enviarEmail($nome, $email, $telefone, $descricao_servicos);

    echo ("<script>alert('Dados Enviados Com Sucesso!')</script>");
    
}

function enviarEmail($nome, $email, $telefone, $descricao_servicos) {
    // Configurações do PHPMailer
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();
    $mail->Host       = 'smtp.titan.email';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'Maria@cadastro.msprojetosambientais.com.br';
    $mail->Password   = 'JmJL#jA7WG^99j7Zv';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->CharSet    = "utf8";

    // Destinatário do e-mail
    $mail->setFrom('Maria@cadastro.msprojetosambientais.com.br', 'Cadastro MSPA'); 
    $mail->addAddress('maria.fsnery@gmail.com', 'Maria');
    $mail->addAddress('ms.pjambientais@gmail.com', 'MS Projetos Ambientais');
    $mail->addAddress('ochristopherfilipe@gmail.com', 'Christopher');


// Conteúdo do e-mail
$mail->isHTML(true);
$mail->Subject = 'Nova solicitação de serviço';
$mail->Body = "Nova solicitação de serviços no site MSprojetosambientais:<br><br>"
    . "Nome: $nome<br>"
    . "E-mail: $email<br>"
    . "Telefone: $telefone<br>"
    . "Descrição dos Serviços: $descricao_servicos<br>";

    // Enviar e-mail
    try {
        $mail->send();
        echo 'E-mail enviado com sucesso!';
    } catch (Exception $e) {
        echo "Erro no envio do e-mail: {$mail->ErrorInfo}";
    }
}
?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fale conosco</title>
    <subtitle>Faça um orçamento sem compromisso</subtitle>
    <link rel="icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="box">
            <form action="index.php" method="post">
                <fieldset>
                    <legend><b>Solicitação de Serviços</b></legend>
                    <br>
                    <div class="inputBox">
                        <input type="text" name="nome" id="nome" class="inputUser" required>
                        <label for="nome" class="labelInput">Nome completo</label>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <input type="text" name="email" id="email" class="inputUser" required>
                        <label for="email" class="labelInput">Email</label>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                        <label for="telefone" class="labelInput">Telefone</label>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <textarea name="descricao_servicos" id="descricao_servicos" class="inputUser" rows="6"
                            required></textarea>
                        <label for="descricao_servicos" class="labelInput">Breve descrição dos serviços que você
                            precisa:</label>
                    </div>
                    <br><br>
                    <input type="submit" name="submit" id="submit">
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>
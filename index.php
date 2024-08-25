<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Configuração para exibir todos os erros
error_reporting(E_ALL);
ini_set('display_errors', '1');

if(isset($_POST['submit'])) {
    // Obtendo dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $descricao_servicos = $_POST['descricao_servicos'];
    $tipo_servico = $_POST['tipo_servico'];

    // Enviar e-mail para o endereço profissional
    enviarEmail($nome, $email, $telefone, $descricao_servicos, $tipo_servico);

    echo ("<script>alert('Dados Enviados Com Sucesso!')</script>");
}

function enviarEmail($nome, $email, $telefone, $descricao_servicos, $tipo_servico) {
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
    $mail->Body    = "Nova solicitação de serviços no site MSprojetosambientais:<br><br>"
                   . "Nome: $nome<br>"
                   . "E-mail: $email<br>"
                   . "Telefone: $telefone<br>"
                   . "Descrição dos Serviços: $descricao_servicos<br>"
                   . "Tipo de Serviço: $tipo_servico<br>";

    // Enviar e-mail
    try {
        $mail->send();
        echo 'E-mail enviado com sucesso!';
    } catch (Exception $e) {
        echo "Erro no envio do e-mail: {$mail->ErrorInfo}";
    }
}
?>

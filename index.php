<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Configuração para exibir todos os erros
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (isset($_POST['submit'])) {
    // Obtendo dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $descricao_servicos = $_POST['descricao_servicos'];
    $tipo_servico = implode(", ", $_POST['tipo_servico']);
    $mensagem = $_POST['mensagem'];

    // Envie um e-mail para o endereço profissional
    enviarEmail($nome, $email, $telefone, $descricao_servicos, $tipo_servico, $mensagem);

    echo ("<script>alert('Dados Enviados Com Sucesso!')</script>");
}

function enviarEmail($nome, $email, $telefone, $descricao_servicos, $tipo_servico, $mensagem)
{
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
    $mail->Body = "
        <h2>Nova solicitação de serviços no site MSprojetosambientais:</h2>
        <p><strong>Nome:</strong> $nome</p>
        <p><strong>E-mail:</strong> $email</p>
        <p><strong>Telefone:</strong> $telefone</p>
        <p><strong>Descrição dos Serviços:</strong> $descricao_servicos</p>
        <p><strong>Tipo de Serviço:</strong> $tipo_servico</p>
        <p><strong>Mensagem:</strong> $mensagem</p>";

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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fale Conosco</title>
    <link rel="icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="box">
            <img src="logo.png" alt="Logo" class="logo">
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
                        <textarea name="descricao_servicos" id="descricao_servicos" class="inputUser" rows="6" required></textarea>
                        <label for="descricao_servicos" class="labelInput">Breve descrição dos serviços que você precisa:</label>
                    </div>
                    <br><br>

                    <div class="inputBox">
                        <label for="tipo_servico" class="labelInput">Tipo de Serviço</label>
                        <div id="tipo_servico" class="inputUser">
                            <fieldset>
                                <legend>Projetos, Laudos e Estudos Ambientais</legend>
                                <input type="checkbox" name="tipo_servico[]" value="Assessoria e Consultoria Ambiental"> Assessoria e Consultoria Ambiental<br>
                                <input type="checkbox" name="tipo_servico[]" value="Desenvolvimento de Diagnóstico Socioambiental"> Desenvolvimento de Diagnóstico Socioambiental<br>
                                <input type="checkbox" name="tipo_servico[]" value="Educação Ambiental"> Educação Ambiental<br>
                                <input type="checkbox" name="tipo_servico[]" value="Elaboração, implantação e acompanhamento de projetos e Laudos Ambientais"> Elaboração, implantação e acompanhamento de projetos e Laudos Ambientais<br>
                                <input type="checkbox" name="tipo_servico[]" value="Estudos e Gestão de Áreas Protegidas"> Estudos e Gestão de Áreas Protegidas<br>
                                <input type="checkbox" name="tipo_servico[]" value="Estudo de Impacto de Vizinhança (EIV)"> Estudo de Impacto de Vizinhança (EIV)<br>
                                <input type="checkbox" name="tipo_servico[]" value="Estudo e Relatório de Impacto Ambiental – (EIA/RIMA)"> Estudo e Relatório de Impacto Ambiental – (EIA/RIMA)<br>
                                <input type="checkbox" name="tipo_servico[]" value="Levantamento de Aspectos e Impactos Ambientais (LAIA)"> Levantamento de Aspectos e Impactos Ambientais (LAIA)<br>
                                <input type="checkbox" name="tipo_servico[]" value="Plano de Gerenciamento de Resíduos Sólidos - PGRS"> Plano de Gerenciamento de Resíduos Sólidos - PGRS<br>
                                <input type="checkbox" name="tipo_servico[]" value="Plano de Controle Ambiental (PCA)"> Plano de Controle Ambiental (PCA)<br>
                                <input type="checkbox" name="tipo_servico[]" value="Programa de Política Ambiental"> Programa de Política Ambiental<br>
                                <input type="checkbox" name="tipo_servico[]" value="Relatório de Atividades Potencialmente Poluidoras (RAPP)"> Relatório de Atividades Potencialmente Poluidoras (RAPP)<br>
                                <input type="checkbox" name="tipo_servico[]" value="Relatório de Controle Ambiental (RCA)"> Relatório de Controle Ambiental (RCA)<br>
                                <input type="checkbox" name="tipo_servico[]" value="Inventário Florestal"> Inventário Florestal<br>
                                <input type="checkbox" name="tipo_servico[]" value="Inventário de Fauna Silvestre"> Inventário de Fauna Silvestre<br>
                                <input type="checkbox" name="tipo_servico[]" value="Plano de Resgate de Fauna Silvestre"> Plano de Resgate de Fauna Silvestre<br>
                                <input type="checkbox" name="tipo_servico[]" value="Resgate e Afugentamento de Fauna Silvestre"> Resgate e Afugentamento de Fauna Silvestre<br>
                                <input type="checkbox" name="tipo_servico[]" value="Plano de Recuperação de Áreas Degradadas - PRAD"> Plano de Recuperação de Áreas Degradadas - PRAD<br>
                                <input type="checkbox" name="tipo_servico[]" value="Plano de Atendimento a Emergência - PAE"> Plano de Atendimento a Emergência - PAE<br>
                            </fieldset>
                            <fieldset>
                                <legend>Licenciamento e Autorizações Ambientais</legend>
                                <input type="checkbox" name="tipo_servico[]" value="Declaração de Inexigibilidade"> Declaração de Inexigibilidade<br>
                                <input type="checkbox" name="tipo_servico[]" value="Licenciamento Ambiental (Municipal, Estadual e Federal)"> Licenciamento Ambiental (Municipal, Estadual e Federal)<br>
                                <input type="checkbox" name="tipo_servico[]" value="Licença Ambiental Simplificada – LAS"> Licença Ambiental Simplificada – LAS<br>
                                <input type="checkbox" name="tipo_servico[]" value="Licença Prévia, Instalação e Operação"> Licença Prévia, Instalação e Operação<br>
                                <input type="checkbox" name="tipo_servico[]" value="Autorização Ambiental"> Autorização Ambiental<br>
                                <input type="checkbox" name="tipo_servico[]" value="Regularização Ambiental de Empreendimentos"> Regularização Ambiental de Empreendimentos<br>
                                <input type="checkbox" name="tipo_servico[]" value="Regularização Ambiental de Pequenas Propriedades"> Regularização Ambiental de Pequenas Propriedades<br>
                                <input type="checkbox" name="tipo_servico[]" value="Dispensa de Licenciamento"> Dispensa de Licenciamento<br>
                                <input type="checkbox" name="tipo_servico[]" value="Cadastro Técnico Federal"> Cadastro Técnico Federal<br>
                                <input type="checkbox" name="tipo_servico[]" value="CADRI - Certificado de Movimentação de Resíduos de Interesse Ambiental"> CADRI - Certificado de Movimentação de Resíduos de Interesse Ambiental<br>
                                <input type="checkbox" name="tipo_servico[]" value="CETESB - Companhia Ambiental do Estado de São Paulo"> CETESB - Companhia Ambiental do Estado de São Paulo<br>
                                <input type="checkbox" name="tipo_servico[]" value="ICMBIO - Instituto Chico Mendes de Conservação da Biodiversidade"> ICMBIO - Instituto Chico Mendes de Conservação da Biodiversidade<br>
                                <input type="checkbox" name="tipo_servico[]" value="TCA - Termo de Compromisso Ambiental"> TCA - Termo de Compromisso Ambiental<br>
                                <input type="checkbox" name="tipo_servico[]" value="Documentos e Laudos de Menor Impacto"> Documentos e Laudos de Menor Impacto<br>
                                <input type="checkbox" name="tipo_servico[]" value="CAR (Cadastro Ambiental Rural)"> CAR (Cadastro Ambiental Rural)<br>
                            </fieldset>
                            <fieldset>
                                <legend>Gestão Ambiental</legend>
                                <input type="checkbox" name="tipo_servico[]" value="Plano de Gestão Ambiental – PGA"> Plano de Gestão Ambiental – PGA<br>
                                <input type="checkbox" name="tipo_servico[]" value="Compensação Ambiental"> Compensação Ambiental<br>
                                <input type="checkbox" name="tipo_servico[]" value="Gestão Ambiental"> Gestão Ambiental<br>
                                <input type="checkbox" name="tipo_servico[]" value="Monitoramento Ambiental"> Monitoramento Ambiental<br>
                                <input type="checkbox" name="tipo_servico[]" value="Programa de Monitoramento de Fauna Silvestre - PMFS"> Programa de Monitoramento de Fauna Silvestre - PMFS<br>
                                <input type="checkbox" name="tipo_servico[]" value="Programa de Afugentamento, Resgate e Destinação de Fauna Silvestre - PSRDS"> Programa de Afugentamento, Resgate e Destinação de Fauna Silvestre - PSRDS<br>
                                <input type="checkbox" name="tipo_servico[]" value="Recuperação de Áreas Degradadas"> Recuperação de Áreas Degradadas<br>
                            </fieldset>
                            <fieldset>
                                <legend>Outros Serviços</legend>
                                <input type="checkbox" name="tipo_servico[]" value="Geoprocessamento"> Geoprocessamento<br>
                                <input type="checkbox" name="tipo_servico[]" value="Supressão Vegetal"> Supressão Vegetal<br>
                                <input type="checkbox" name="tipo_servico[]" value="Acompanhamento de Supressão Vegetal"> Acompanhamento de Supressão Vegetal<br>
                                <input type="checkbox" name="tipo_servico[]" value="Intervenção em APP (Área de Preservação Permanente)"> Intervenção em APP (Área de Preservação Permanente)<br>
                                <input type="checkbox" name="tipo_servico[]" value="Plantio de mudas"> Plantio de mudas<br>
                            </fieldset>
                        </div>
                    </div>
                    <br><br>
                    <div class="inputBox">
                        <textarea name="mensagem" id="mensagem" class="inputUser" rows="4"></textarea>
                        <label for="mensagem" class="labelInput">Deixe uma mensagem:</label>
                    </div>
                    <br><br>
                    <input type="submit" name="submit" id="submit" value="Enviar">
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>

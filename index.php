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
    $tipo_servico = $_POST['tipo_servico'];
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
    $mail->Body = "Nova solicitação de serviços no site MSprojetosambientais:<br><br>"
        . "Nome: $nome<br>"
        . "E-mail: $email<br>"
        . "Telefone: $telefone<br>"
        . "Descrição dos Serviços: $descricao_servicos<br>"
        . "Tipo de Serviço: $tipo_servico<br>"
        . "Mensagem: $mensagem<br>";

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
                        <select name="tipo_servico" id="tipo_servico" class="inputUser" required>
                            <optgroup label="Projetos, Laudos e Estudos Ambientais">
                                <option value="Assessoria e Consultoria Ambiental">Assessoria e Consultoria Ambiental</option>
                                <option value="Desenvolvimento de Diagnóstico Socioambiental">Desenvolvimento de Diagnóstico Socioambiental</option>
                                <option value="Educação Ambiental">Educação Ambiental</option>
                                <option value="Elaboração, implantação e acompanhamento de projetos e Laudos Ambientais">Elaboração, implantação e acompanhamento de projetos e Laudos Ambientais</option>
                                <option value="Estudos e Gestão de Áreas Protegidas">Estudos e Gestão de Áreas Protegidas</option>
                                <option value="Estudo de Impacto de Vizinhança (EIV)">Estudo de Impacto de Vizinhança (EIV)</option>
                                <option value="Estudo e Relatório de Impacto Ambiental – (EIA/RIMA)">Estudo e Relatório de Impacto Ambiental – (EIA/RIMA)</option>
                                <option value="Levantamento de Aspectos e Impactos Ambientais (LAIA)">Levantamento de Aspectos e Impactos Ambientais (LAIA)</option>
                                <option value="Plano de Gerenciamento de Resíduos Sólidos - PGRS">Plano de Gerenciamento de Resíduos Sólidos - PGRS</option>
                                <option value="Plano de Controle Ambiental (PCA)">Plano de Controle Ambiental (PCA)</option>
                                <option value="Programa de Política Ambiental">Programa de Política Ambiental</option>
                                <option value="Relatório de Atividades Potencialmente Poluidoras (RAPP)">Relatório de Atividades Potencialmente Poluidoras (RAPP)</option>
                                <option value="Relatório de Controle Ambiental (RCA)">Relatório de Controle Ambiental (RCA)</option>
                                <option value="Inventário Florestal">Inventário Florestal</option>
                                <option value="Inventário de Fauna Silvestre">Inventário de Fauna Silvestre</option>
                                <option value="Plano de Resgate de Fauna Silvestre">Plano de Resgate de Fauna Silvestre</option>
                                <option value="Resgate e Afugentamento de Fauna Silvestre">Resgate e Afugentamento de Fauna Silvestre</option>
                                <option value="Plano de Recuperação de Áreas Degradadas - PRAD">Plano de Recuperação de Áreas Degradadas - PRAD</option>
                                <option value="Plano de Atendimento a Emergência - PAE">Plano de Atendimento a Emergência - PAE</option>
                            </optgroup>
                            <optgroup label="Licenciamento e Autorizações Ambientais">
                                <option value="Declaração de Inexigibilidade">Declaração de Inexigibilidade</option>
                                <option value="Licenciamento Ambiental (Municipal, Estadual e Federal)">Licenciamento Ambiental (Municipal, Estadual e Federal)</option>
                                <option value="Licença Ambiental Simplificada – LAS">Licença Ambiental Simplificada – LAS</option>
                                <option value="Licença Ambiental Única – LAU">Licença Ambiental Única – LAU</option>
                                <option value="Corte de Árvores Isoladas - CAI">Corte de Árvores Isoladas - CAI</option>
                                <option value="Outorga de uso de Recursos Hídricos (Água Superficial ou Subterrânea)">Outorga de uso de Recursos Hídricos (Água Superficial ou Subterrânea)</option>
                                <option value="Outorga para Lançamento de Efluentes">Outorga para Lançamento de Efluentes</option>
                                <option value="AUMPF (Autorização de Uso da Matéria Prima Florestal)">AUMPF (Autorização de Uso da Matéria Prima Florestal)</option>
                                <option value="DOF (Documento de Origem Florestal)">DOF (Documento de Origem Florestal)</option>
                                <option value="Plano de Manejo Florestal de Maior Impacto">Plano de Manejo Florestal de Maior Impacto</option>
                                <option value="Plano de Manejo Florestal de Menor Impacto">Plano de Manejo Florestal de Menor Impacto</option>
                                <option value="CAR (Cadastro Ambiental Rural)">CAR (Cadastro Ambiental Rural)</option>
                            </optgroup>
                            <optgroup label="Gestão Ambiental">
                                <option value="Plano de Gestão Ambiental – PGA">Plano de Gestão Ambiental – PGA</option>
                                <option value="Compensação Ambiental">Compensação Ambiental</option>
                                <option value="Gestão Ambiental">Gestão Ambiental</option>
                                <option value="Monitoramento Ambiental">Monitoramento Ambiental</option>
                                <option value="Programa de Monitoramento de Fauna Silvestre - PMFS">Programa de Monitoramento de Fauna Silvestre - PMFS</option>
                                <option value="Programa de Afugentamento, Resgate e Destinação de Fauna Silvestre - PSRDS">Programa de Afugentamento, Resgate e Destinação de Fauna Silvestre - PSRDS</option>
                                <option value="Recuperação de Áreas Degradadas">Recuperação de Áreas Degradadas</option>
                            </optgroup>
                            <optgroup label="Outros Serviços">
                                <option value="Geoprocessamento">Geoprocessamento</option>
                                <option value="Supressão Vegetal">Supressão Vegetal</option>
                                <option value="Acompanhamento de Supressão Vegetal">Acompanhamento de Supressão Vegetal</option>
                                <option value="Intervenção em APP (Área de Preservação Permanente)">Intervenção em APP (Área de Preservação Permanente)</option>
                                <option value="Plantio de mudas">Plantio de mudas</option>
                            </optgroup>
                        </select>
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

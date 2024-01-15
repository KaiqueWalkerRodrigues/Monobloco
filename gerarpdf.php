<?php
include_once('class/classes.php');

$Servico = new Servicos();
$Orcamento = new Orcamentos();
$Cliente = new Clientes();
$Peca = new Pecas();

$rua = $_GET['rua'];
$bairro = $_GET['bairro'];
$cidade = $_GET['cidade'];
$modelo = $_GET['modelo'];
$ano = $_GET['ano'];
$placa = $_GET['placa'];
$cor = $_GET['cor'];
$id_orcamento = $_GET['idorcamento'];
$vezes = $_GET['vezes'];

$orcamento = $Orcamento->mostrar($id_orcamento);
$cliente = $Cliente->mostrar($orcamento->id_cliente);

$nome = $cliente->nome;
$cpf = $cliente->cpf;
$cpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
$telefone = $cliente->telefone;
$numero = $cliente->numero;
$email = $cliente->email;

$dados = $Servico->listar($id_orcamento);

require 'vendor/autoload.php'; // Carregue o autoloader do Composer

use Dompdf\Dompdf;
use Dompdf\Options;

// Crie uma instância do Dompdf
$dompdf = new Dompdf();

// Crie opções (opcional)
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf->setOptions($options);

{
    // Conteúdo HTML a ser incluído no PDF
    $html = '
    <style>
        body {
        font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h3{
            text-align: center;
        }

        .client-info, .project-info, .terms-and-conditions {
            margin-bottom: 20px;
        }

        .client-info p, .project-info p, .terms-and-conditions p {
            margin: 0;
        }

        .project-info h2, .terms-and-conditions h2 {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        .client-info p strong, .project-info p strong {
            font-weight: bold;
        }
        .linha-preta {
        background-color: black;
        height: 2px;
        width: 100%;
        margin-top: -20px;
        position: relative;
        } 
        table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: center;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            th {
                background-color: #333;
                color: #fff;
            }

            th.quantity {
                width: 10%;
            }

            th.garantia {
                width: 15%;
            }

            th.valor {
                width: 20%;
            }

            th.servico {
                width: 60%;
            }

            th.assinatura {
                width: 40%;
            }
    </style>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Relatório de Orçamento</title>
    </head>
    <body>
        <div class="container">
            <div style="text-align: center; margin-bottom: -50px; margin-top: -85px;">
                <img style="height: 15%" src="data:image/png;base64,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" alt="">
            </div>
            <h3>MonoBloco</h3>
            <p style="text-align: center; margin-top: -15px;">Alinhamento Técnico - Caster - Cambagem <br> Chassi - Longarina - Eixo Traseiro e Solda Mig.</p>
            <p style="text-align: center; margin-top: -10px;">monoblocosantoandre@hotmail.com | www.mbmonobloco.site.com.br</p>
            <p style="text-align: center; margin-top: -15px;">Telefone/Whatsapp: <strong style="font-size: 20px;">4463-5196</strong></p>
            <div style="text-align: center; margin-bottom: -10px; margin-top: -15px;"><span style="font-size: 19px; color: darkred;">Aceitamos Cartões Visa/Mastercard</span></div>
            
            <h3 style="text-align: center; background-color:darkgrey">Rua Sedan, 19 - Utinga - Santo André - SP - CEP 09290-180</h3>
            <div class="linha-preta"></div>

            <div style="text-align: center;"><strong style="margin-top: 2px; margin-bottom: 0px;">Orçamento <span style="font-size: 22px;">N°:</span> <span style="color: red; font-size: 22px;">'.$id_orcamento.'</span></strong></div>
            <div class="client-info">
                <p><strong>Cliente: </strong>'.$nome.' <strong>CPF: </strong>'.$cpf.'</p>
                <p><strong>Email: </strong>'.$email.'<strong> Telefone: </strong>'.$telefone.'</p>
                <p><strong>Rua: </strong>'.$rua.' <strong>N: </strong>'.$numero.' <strong>Bairro: </strong>'.$bairro.' <strong>Cidade: </strong>'.$cidade.'</p>
                <p><strong>Veículo: </strong>'.$modelo.' <strong>Ano: </strong>'.$ano.' <strong>Placa: </strong>'.$placa.' <strong>Cor: </strong>'.$cor.'</p>
            </div>
            <!-- <div class="project-info">
                <h3>Detalhes do Projeto</h3>
                <p><strong>Descrição do Projeto:</strong> [Descrição do Projeto]</p>
                <p><strong>Preço Total:</strong> R$ [Preço Total]</p>
                <p><strong>Data de Validade:</strong> [Data de Validade do Orçamento]</p>
            </div> -->
            <div>
                <table>
                    <thead>
                        <tr>
                            <th class="quantity">Qntd</th>
                            <th class="servico">Serviço</th>
                            <th class="garantia">Garantia</th>
                            <th class="valor">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        [listaservico]
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right;">Total Serviços</td>
                            <td style="font-size: 14px;">[totalservico],00</td>
                        </tr>
                    </tfoot>
                </table>
                <table>
                    <thead>
                        <tr>
                            <th class="garantia">Prazo</th>
                            <th class="assinatura">Assinatura do Cliente</th>
                            <th class="garantia">PGTO</th>
                            <th class="quantity">Vezes</th>
                            <th class="valor">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>[prazo]</td>
                            <td></td>
                            <td>[forma_pgto]</td>
                            <td>[vezes]</td>
                            <td style="font-size: 14px;">[total],00</td>
                        </tr>
                    </tbody>
                </table> 
                <br>
                <table>
                    <thead>
                        <tr>
                            <th class="quantity">Qntd</th>
                            <th class="servico">Peça (Pago separadamente) </th>
                            <th class="garantia">Garantia</th>
                            <th class="valor">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        [listapecas]
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: right;">Total Peças</td>
                            <td style="font-size: 14px;">[totalpeca],00</td>
                        </tr>
                    </tfoot>
                </table>
                <br>   
            </div>
        </div>
        <p style="margin-left:70px; margin-top: -25px;">Emitido em [data]</p>
    </body>
    </html>

    ';
}

$i = 1;
$totalservico = 0;
$totalpeca = 0;
$lista = '';
$listapecas = '';
foreach($Servico->listar($id_orcamento) as $s){
    $valor = number_format($s->valor, 0, ',', '.');
    $lista = $lista.'<tr><td>'.$s->qntd.'</td><td>'.$s->servico.'</td><td>'.$s->garantia.'</td><td style="font-size: 14px;">R$ '.$valor.',00</td></tr>';
    $totalservico+= $s->valor;
    $i+=1;
}
$i = 1;
foreach($Peca->listar($id_orcamento) as $p){
    $valor = number_format($p->valor, 0, ',', '.');
    $listapecas = $listapecas.'<tr><td>'.$p->qntd.'</td><td>'.$p->peca.'</td><td>'.$p->garantia.'</td><td style="font-size: 14px;">R$ '.$valor.',00</td></tr>';
    $totalpeca+= $p->valor;
    $i+=1;
}
if($vezes != 0){
    $total = ($totalservico/$vezes);
}else{
    $total = $totalservico;
} 

if($orcamento->forma_pgmt == 0){
    $forma = "Dinheiro";
}elseif($orcamento->forma_pgmt == 1){
    $forma = "Pix";
}elseif($orcamento->forma_pgmt == 2){
    $forma = "Cartão";
}elseif($orcamento->forma_pgmt == -1){
    $forma = "";
}else{
    $forma = "Erro";
}



$html = str_replace('[prazo]', $orcamento->prazo , $html);
$html = str_replace('[forma_pgto]', $forma , $html);
if($vezes != 0){
    $html = str_replace('[vezes]', $vezes.'x' , $html);
}else{
    $html = str_replace('[vezes]', ' ' , $html);
}

$html = str_replace('[listaservico]', $lista , $html);
$html = str_replace('[listapecas]', $listapecas , $html);

$totalservico = number_format($totalservico, 0, ',', '.');
$html = str_replace('[totalservico]', 'R$ '.$totalservico, $html);

$totalpeca =  number_format($totalpeca, 0, ',', '.');
$html = str_replace('[totalpeca]', 'R$ '.$totalpeca, $html);

$total =  number_format($total, 0, ',', '.');
$html = str_replace('[total]', 'R$ '.$total, $html);

$data = date('d/m/Y').' ás '.date('H:i');
$html = str_replace('[data]', $data , $html);

// Carregue o conteúdo HTML
$dompdf->loadHtml($html);

// Renderize o PDF
$dompdf->render();

// Defina o nome do arquivo PDF com o nome fornecido na variável $nome
$filename = strtolower($nome).'-orcamento.pdf';

// Gere o PDF e defina o nome do arquivo na resposta
$dompdf->stream($filename, array('Attachment' => false));
?>

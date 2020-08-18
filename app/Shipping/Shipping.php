<?php


namespace App\Shipping;


class Shipping
{
    private $nVlAltura;
    private $nVlComprimento;
    private $nVlLargura;
    private $nVlPeso;
    private $sCepDestino;
    private $services;
    private $sCepOrigem;

    public function __construct($sCepDestino, $nVlAltura, $nVlComprimento, $nVlLargura, $nVlPeso)
    {
        $this->sCepOrigem = '13177365';
        $this->services = [
            ['id' => '04510', 'name' => 'PAC'],
            ['id' => '04014', 'name' => 'SEDEX']
        ];
        $this->sCepDestino = str_replace(".","", str_replace("-", "", $sCepDestino));
        $this->nVlAltura = ($nVlAltura > 1) ? $nVlAltura : 1;
        $this->nVlComprimento = ($nVlComprimento > 15) ? $nVlComprimento : 15;
        $this->nVlLargura = ($nVlLargura > 10) ? $nVlLargura : 10;
        $this->nVlPeso = $nVlPeso;
    }


    public function calculateShipping()
    {
        $data = "&sCepOrigem={$this->sCepOrigem}";
        $data.= "&sCepDestino={$this->sCepDestino}";
        $data.= "&nVlAltura={$this->nVlAltura}";
        $data.= "&nVlComprimento={$this->nVlComprimento}";
        $data.= "&nVlLargura={$this->nVlLargura}";
        $data.= "&nVlPeso={$this->nVlPeso}";

        foreach ($this->services as $service){
            $nCdServico = "&nCdServico={$service['id']}";
            $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCdAvisoRecebimento=n&sCdMaoPropria=n&nVlValorDeclarado=0&nVlDiametro=0&StrRetorno=xml&nIndicaCalculo=3&nCdFormato=1" . $data . $nCdServico;

            $unparsedResult = file_get_contents($url);
            $parsedResult = simplexml_load_string($unparsedResult);

            if(strval($parsedResult->cServico->Erro) == 0)
            {
                $res[] = [
                        'service' => $service['id'],
                        'name'  =>$service['name'],
                        'price' => strval($parsedResult->cServico->Valor),
                        'deadline' => strval($parsedResult->cServico->PrazoEntrega)
                ];
            }else{
                $res[] = [
                    'erro' => 'Não foi possivel calcular o frete.'
                ];
            }
        }
        return $res;
    }
}

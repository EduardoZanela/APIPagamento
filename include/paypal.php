<?php
class paypal{
//Função de conexão com a API
    function api($comando,$param){
        $api = 'https://api-3t.sandbox.paypal.com/nvp'; # URL para o modo sandbox
        $api_user = urlencode('eduardogzanela_api1.gmail.com');
        $api_senha = urlencode('LLYHX92UGA8C7A4X');
        $api_assinatura = urlencode('AFeAQw6hVsiHbylx-T6lriIxBtbbAEze6E9jLxV3EAieywa.mDPwI4AQ');
        $api_versao = urlencode('109.0'); # Esta é a versão da API a ser utilizada
        $i = curl_init();
        # Definimos uma cabeçalho para a requisição
        curl_setopt($i, CURLOPT_URL, $api);
        curl_setopt($i, CURLOPT_VERBOSE, 1);
        #Desactivar a verificação do servidor e do peer
        curl_setopt($i, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($i, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($i, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($i, CURLOPT_POST, 1);

        //Passando os parâmetros da API
        $nvp = "METHOD=$comando&VERSION=$api_versao&PWD=$api_senha&USER=$api_user&SIGNATURE=$api_assinatura$param";

        //Definindo o nvp como campo POST do cURL
        curl_setopt($i, CURLOPT_POSTFIELDS, $nvp);
        $resposta = curl_exec($i);
        curl_close($i);

        if(!$resposta){
            exit("Erro do $comando ".curl_error($i)."(".curl_errno($i).")");
            die();
        }
        #Aqui transformamos a nossa URL numa array associativa
        $respostaP = $this->nvp($resposta);
        if(0 == sizeof($respostaP) || !array_key_exists('ACK',$respostaP)){
            exit("HTTP resposta inválida do servidor($nvp) para $api");
            die();
        }

        return $respostaP;
    }
    // função para converter a resposta da cURL em array
    function nvp($resposta){
        $i = explode('&',$resposta);
        $respostaP = array();
        foreach($i as $key=>$value){
            $d = explode('=',$value);
            if(sizeof($d)>1){
                $respostaP[$d[0]] = $d[1];
            }
        }
        return $respostaP;
    }


}
<?php
// converter algarismos para escrita por extenso
// Author: EliasPereirah (https://github.com/EliasPereirah)
function units($v){
    $numbers = ['zero','um','dois','três','quatro','cinco','seis','sete','oito','nove','dez','onze','doze','treze','quartorze','quinze','dezesseis','dezessete','dezoito','dezenove'];
    $ex = $numbers[$v];
    return $ex;
}
function dezenas($v){
    $numbers = ['vinte','trinta','quarenta','cinquenta','sessente','setenta','oitenta','noventa'];
    $ex = $numbers[$v];
    return $ex;
}
function centenas($v){
    $numbers = ['cento','duzentos','trezentos','quatrocentos','quinhetos','seiscentos','setecentos','oitocentos','novecentos'];
    $ex = $numbers[$v];
    return $ex;
}
function prepareNumber($n){
    $length = strlen($n);
    if($length==1 OR $n<20){
        /// unidades e dezenas até 19
       echo ' '.units($n);
    }elseif($length==2){
        // dezenas e unidades de 20 a 99
        $dezena = substr("$n",0,1)-2;
        $unidade = substr("$n",1,1);
       echo ' '.dezenas($dezena);
       if($unidade!=0){
           echo " e ".units($unidade);
       }
    }elseif($length==3){
        // centenas
        $casa0 = substr("$n",2,1);
        $casa1 = substr("$n",1,1);
        $casa2 = substr("$n",0,1);
        if($casa0 ==0 and $casa1==0){
            if($n==100){
                echo "cem";
            }else{
                echo centenas($casa2-1);
            }
        }else{
            echo centenas($casa2-1).' e ';
            if($casa1 ==0){
                // exe 104 casa1 seria o 0[zero]
                echo units($casa0);
            }else{
                prepareNumber("{$casa1}{$casa0}");
            }
        }
    }elseif($length>3 and $length<7){
        // milhar
        $milhar = intval($n/1000);
        if($milhar>1){
            prepareNumber($milhar);
            // remova esse if se quiser a escrita de UM MIL invés de MIL
        }
        echo " mil";
        $sobra = $n - ($milhar*1000);
        if($sobra !=0){
            echo " e ";
            prepareNumber($sobra);
        }
    }elseif($length>6 and $length<10){
        // milhão
        $milhao = intval($n/1000000);
            prepareNumber($milhao);
         if($milhao>1){
             echo " milhões";
         }else{
             echo " milhão";
         }
        $sobra = $n - ($milhao*1000000);
        if($sobra !=0){
            echo "  ";
            prepareNumber($sobra);
        }}elseif($length>9 and $length<13){
        // bilão
        $bilhao = intval($n/1000000000);
        prepareNumber($bilhao);
        if($bilhao>1){
            echo " bilhões";
        }else{
            echo " bilhão";
        }
        $sobra = $n - ($bilhao*1000000000);
        if($sobra !=0){
            echo " ";
            prepareNumber($sobra);
        }}else{
        echo "Acima de trilhão";
    }}
    ##### USO ######
prepareNumber(320432987302); //trezentos e vinte bilhões quatrocentos e trinta e dois milhões novecentos e oitenta e sete mil e trezentos e dois
?>

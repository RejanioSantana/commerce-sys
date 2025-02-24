<?php

function whatsappNumber($number)
    {
        $n = str_replace("(","", $number);
        $n = str_replace(")","", $n);
        $n = str_replace(" ","", $n);
        $n = str_replace("-","", $n);
        return intval($n);
    }

function validarCPF($cpf) {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/\D/', '', $cpf);
    
        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }
    
        // Verifica se todos os dígitos são iguais (exemplo: 111.111.111-11)
        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }
    
        // Calcula e verifica o primeiro dígito verificador
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = (10 * $d) % 11;
            if ($d == 10) {
                $d = 0;
            }
            if ($cpf[$t] != $d) {
                return false;
            }
        }
    
        return true;
    }
    
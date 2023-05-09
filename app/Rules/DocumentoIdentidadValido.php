<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DocumentoIdentidadValido implements Rule
{
    public function passes($attribute, $value)
    {
        // Eliminamos espacios en blanco y guiones del valor
        $value = str_replace([' ', '-'], '', $value);
        
        // Validamos el CIF
        if (preg_match('/^[A-HJNPQRSUVW]{1}[0-9]{7}[0-9A-J]{1}$/', $value)) {
            $control = strtoupper(substr($value, 8, 1));
            $suma_pares = 0;
            for ($i = 2; $i <= 6; $i += 2) {
                $suma_pares += intval(substr($value, $i, 1));
            }
            for ($i = 1; $i <= 7; $i += 2) {
                $suma_impares = 2 * intval(substr($value, $i, 1));
                if ($suma_impares > 9) {
                    $suma_impares = 1 + ($suma_impares - 10);
                }
                $suma_pares += $suma_impares;
            }
            $n = 10 - substr($suma_pares, -1);
            if (($n == 10 && $control == 'J') || ($n == 10 && $control == 'H') || ($n == substr($control, 0, 1))) {
                return true;
            }
        }
        
        // Validamos el NIF
        if (preg_match('/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i', $value)) {
            $letra = substr($value, -1);
            $numero = substr($value, 0, 8);
            $letra_calculada = substr('TRWAGMYFPDXBNJZSQVHLCKE', intval($numero) % 23, 1);
            if (strtoupper($letra) === $letra_calculada) {
                return true;
            }
        }
        
        return false;
    }

    public function message()
    {
        return 'El CIF/NIF no es válido.';
    }
}

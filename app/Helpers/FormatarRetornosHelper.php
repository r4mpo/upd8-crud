<?php

namespace App\Helpers;

class FormatarRetornosHelper
{
    /**
     * Formata o CPF para o formato XXX.XXX.XXX-XX.
     *
     * @param string $cpf
     * @return string
     */
    public static function formatarCPF(string $cpf): string
    {
        // Aplica a máscara de CPF
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
    }

    /**
     * Formata a data de nascimento para o formato dd/mm/yyyy.
     *
     * @param string|null $data
     * @return string|null
     */
    public static function formatarDataNascimento(?string $data): ?string
    {
        // Retorna null se a data não estiver presente
        if (!$data) {
            return null;
        }

        // Converte a data para o formato desejado
        $date = new \DateTime($data);
        return $date->format('d/m/Y');
    }

    /**
     * Converte o sexo para o formato "Masculino" ou "Feminino".
     * Caso contrário, retorna "Indefinido".
     *
     * @param string $sexo
     * @return string
     */
    public static function formatarSexo(string $sexo): string
    {
        // Retorna "Masculino" ou "Feminino" dependendo do valor, ou "Indefinido"
        return match ($sexo) {
            'M' => 'Masculino',
            'F' => 'Feminino',
            default => 'Indefinido',
        };
    }
}

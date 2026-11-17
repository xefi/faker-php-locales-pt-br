<?php

namespace Xefi\Faker\PtBr\Extensions;

use Xefi\Faker\Extensions\Extension;

class CompanyExtension extends Extension
{
    /**
     * Returns the locale of the extension.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'pt_BR';
    }

    private array $companies = [
        'Silva & Filhos Ltda.', 'Horizonte Tecnologia S.A.', 'Construtora Andrade Ltda.',
        'Ipê Amarelo Comércio Ltda.', 'Cerrado Agronegócios S.A.', 'Mantiqueira Engenharia Ltda.',
        'Paulista Logística S.A.', 'Rocha & Associados Advocacia', 'Brisa do Mar Turismo Ltda.',
        'Guanabara Distribuidora Ltda.', 'Sabiá Alimentos S.A.', 'Araucária Móveis Ltda.',
        'Nordeste Energia Solar S.A.', 'Pantanal Transportes Ltda.', 'Oliveira Contabilidade ME',
        'Jabuticaba Doces Finos Ltda.', 'Tropical Sistemas S.A.', 'Mineira Laticínios Ltda.',
        'Rio Doce Mineração S.A.', 'Carvalho & Cia. Ltda.', 'Amazônia Farmacêutica S.A.',
        'Serra Gaúcha Vinhos Ltda.', 'Baía de Todos os Santos Pescados Ltda.', 'Cais do Porto Importadora S.A.',
        'Vale Verde Saneamento Ltda.', 'Bandeirantes Seguros S.A.', 'Capivara Digital Ltda.',
        'Recôncavo Têxtil S.A.', 'Alvorada Clínica Médica Ltda.', 'Pampa Metalúrgica S.A.',
    ];

    /**
     * Generate a company name.
     *
     * @return string
     */
    public function company(): string
    {
        return $this->pickArrayRandomElement($this->companies);
    }

    /**
     * Generate a CNPJ (Cadastro Nacional da Pessoa Jurídica) with valid check digits.
     *
     * @param bool $formatted Whether to return the number as 00.000.000/0000-00
     *
     * @return string
     */
    public function cnpj(bool $formatted = true): string
    {
        do {
            $base = array_map('intval', str_split($this->randomizer->getBytesFromString('0123456789', 8)));
        } while (count(array_unique($base)) === 1);

        $digits = array_merge($base, [0, 0, 0, $this->randomizer->getInt(1, 9)]);
        $digits[] = $this->cnpjCheckDigit($digits);
        $digits[] = $this->cnpjCheckDigit($digits);

        $cnpj = implode('', $digits);

        if (!$formatted) {
            return $cnpj;
        }

        return sprintf(
            '%s.%s.%s/%s-%s',
            substr($cnpj, 0, 2),
            substr($cnpj, 2, 3),
            substr($cnpj, 5, 3),
            substr($cnpj, 8, 4),
            substr($cnpj, 12, 2)
        );
    }

    /**
     * Compute the next CNPJ check digit for the given digits.
     *
     * @param array<int> $digits
     *
     * @return int
     */
    private function cnpjCheckDigit(array $digits): int
    {
        $weights = array_slice([6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2], 13 - count($digits));
        $sum = 0;

        foreach ($digits as $index => $digit) {
            $sum += $digit * $weights[$index];
        }

        $remainder = $sum % 11;

        return $remainder < 2 ? 0 : 11 - $remainder;
    }
}

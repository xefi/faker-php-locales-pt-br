<?php

namespace Xefi\Faker\PtBr\Extensions;

use Xefi\Faker\Extensions\PersonExtension as BasePersonExtension;

class PersonExtension extends BasePersonExtension
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

    protected $firstNameMale = [
        'José', 'João', 'Antônio', 'Francisco', 'Carlos', 'Paulo', 'Pedro', 'Lucas', 'Luiz', 'Marcos',
        'Luís', 'Gabriel', 'Rafael', 'Daniel', 'Marcelo', 'Bruno', 'Eduardo', 'Felipe', 'Raimundo', 'Rodrigo',
        'Manoel', 'Mateus', 'André', 'Fernando', 'Fábio', 'Leonardo', 'Gustavo', 'Guilherme', 'Leandro', 'Tiago',
        'Anderson', 'Ricardo', 'Márcio', 'Jorge', 'Sebastião', 'Alexandre', 'Roberto', 'Edson', 'Diego', 'Vítor',
    ];

    protected $firstNameFemale = [
        'Maria', 'Ana', 'Francisca', 'Antônia', 'Adriana', 'Juliana', 'Márcia', 'Fernanda', 'Patrícia', 'Aline',
        'Sandra', 'Camila', 'Amanda', 'Bruna', 'Jéssica', 'Letícia', 'Júlia', 'Luciana', 'Vanessa', 'Mariana',
        'Gabriela', 'Vera', 'Vitória', 'Larissa', 'Cláudia', 'Beatriz', 'Luana', 'Rita', 'Sônia', 'Renata',
        'Eliane', 'Josefa', 'Simone', 'Natália', 'Cristiane', 'Carla', 'Débora', 'Rosângela', 'Jaqueline', 'Raimunda',
    ];

    protected $lastName = [
        'Silva', 'Santos', 'Oliveira', 'Souza', 'Rodrigues', 'Ferreira', 'Alves', 'Pereira', 'Lima', 'Gomes',
        'Costa', 'Ribeiro', 'Martins', 'Carvalho', 'Almeida', 'Lopes', 'Soares', 'Fernandes', 'Vieira', 'Barbosa',
        'Rocha', 'Dias', 'Nascimento', 'Andrade', 'Moreira', 'Nunes', 'Marques', 'Machado', 'Mendes', 'Freitas',
        'Cardoso', 'Ramos', 'Gonçalves', 'Santana', 'Teixeira', 'Araújo', 'Pinto', 'Correia', 'Cavalcanti', 'Monteiro',
    ];

    protected $titleMale = ['Sr.', 'Dr.', 'Prof.', 'Eng.'];

    protected $titleFemale = ['Sra.', 'Srta.', 'Dra.', 'Profa.', 'Enga.'];

    /**
     * Generate a CPF (Cadastro de Pessoas Físicas) with valid check digits.
     *
     * @param bool $formatted Whether to return the number as 000.000.000-00
     *
     * @return string
     */
    public function cpf(bool $formatted = true): string
    {
        do {
            $digits = array_map('intval', str_split($this->randomizer->getBytesFromString('0123456789', 9)));
        } while (count(array_unique($digits)) === 1);

        $digits[] = $this->cpfCheckDigit($digits);
        $digits[] = $this->cpfCheckDigit($digits);

        $cpf = implode('', $digits);

        if (!$formatted) {
            return $cpf;
        }

        return sprintf('%s.%s.%s-%s', substr($cpf, 0, 3), substr($cpf, 3, 3), substr($cpf, 6, 3), substr($cpf, 9, 2));
    }

    /**
     * Compute the next CPF check digit for the given digits.
     *
     * @param array<int> $digits
     *
     * @return int
     */
    private function cpfCheckDigit(array $digits): int
    {
        $weight = count($digits) + 1;
        $sum = 0;

        foreach ($digits as $digit) {
            $sum += $digit * $weight--;
        }

        $remainder = $sum % 11;

        return $remainder < 2 ? 0 : 11 - $remainder;
    }
}

<?php

namespace Xefi\Faker\PtBr\Extensions;

use Xefi\Faker\Extensions\ColorsExtension as BaseColorsExtension;

class ColorsExtension extends BaseColorsExtension
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

    protected array $safeColorNames = [
        'Preto', 'Bordô', 'Verde', 'AzulMarinho', 'Oliva',
        'Roxo', 'VerdeAzulado', 'Lima', 'Azul', 'Prata',
        'Cinza', 'Amarelo', 'Fúcsia', 'Água', 'Branco',
    ];

    protected array $colorNames = [
        'Preto', 'Bordô', 'Verde', 'AzulMarinho', 'Oliva',
        'Roxo', 'VerdeAzulado', 'Lima', 'Azul', 'Prata',
        'Cinza', 'Amarelo', 'Fúcsia', 'Água', 'Branco',
        'Bege', 'Chocolate', 'Coral', 'Ciano', 'Carmesim',
        'AzulEscuro', 'LaranjaEscuro', 'Tijolo', 'VerdeMar', 'BrancoFloral',
        'VerdeFloresta', 'Dourado', 'Rosa', 'Índigo', 'Cáqui',
        'Lavanda', 'AzulClaro', 'CoralClaro', 'VerdeClaro', 'SalmãoClaro',
        'Linho', 'Magenta', 'AzulMédio', 'OrquídeaMédia', 'Mocassim',
        'Laranja', 'Vermelho', 'Ameixa', 'Peru', 'AzulRoyal',
        'Salmão', 'MarromAreia', 'AzulCéu', 'Neve', 'Turquesa',
        'Violeta', 'BrancoFumaça',
    ];
}

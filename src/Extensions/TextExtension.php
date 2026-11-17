<?php

namespace Xefi\Faker\PtBr\Extensions;

use Xefi\Faker\Extensions\TextExtension as BaseTextExtension;

class TextExtension extends BaseTextExtension
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

    protected array $paragraphs = [
        [
            ['A', 'qualidade', 'dos', 'serviços', 'continua', 'sendo', 'uma', 'prioridade', 'para', 'as', 'empresas', 'brasileiras.'],
            ['Cada', 'projeto', 'exige', 'planejamento', 'cuidadoso', 'e', 'acompanhamento', 'constante.'],
            ['As', 'equipes', 'trabalham', 'juntas', 'para', 'alcançar', 'metas', 'em', 'comum.'],
            ['Uma', 'comunicação', 'clara', 'entre', 'os', 'colaboradores', 'aumenta', 'a', 'produtividade.'],
        ],
        [
            ['O', 'gerenciamento', 'de', 'recursos', 'é', 'fundamental', 'para', 'o', 'desempenho', 'da', 'organização.'],
            ['Os', 'métodos', 'de', 'trabalho', 'mudam', 'conforme', 'as', 'necessidades', 'do', 'mercado.'],
            ['A', 'capacidade', 'de', 'adaptação', 'mantém', 'o', 'negócio', 'competitivo', 'e', 'inovador.'],
            ['Os', 'processos', 'internos', 'são', 'revisados', 'para', 'otimizar', 'os', 'resultados', 'do', 'trimestre.'],
        ],
        [
            ['A', 'satisfação', 'do', 'cliente', 'depende', 'do', 'atendimento', 'e', 'da', 'rapidez', 'nas', 'respostas.'],
            ['Indicadores', 'de', 'desempenho', 'orientam', 'as', 'decisões', 'da', 'diretoria.'],
            ['Os', 'desafios', 'do', 'dia', 'a', 'dia', 'são', 'superados', 'com', 'organização', 'e', 'bom', 'humor.'],
            ['Avaliações', 'periódicas', 'ajudam', 'a', 'identificar', 'oportunidades', 'de', 'melhoria.'],
        ],
        [
            ['O', 'treinamento', 'dos', 'funcionários', 'é', 'um', 'investimento', 'de', 'longo', 'prazo.'],
            ['Os', 'colaboradores', 'são', 'incentivados', 'a', 'desenvolver', 'novas', 'habilidades', 'e', 'propor', 'ideias.'],
            ['Estratégias', 'de', 'melhoria', 'contínua', 'reduzem', 'custos', 'e', 'riscos', 'operacionais.'],
            ['Programas', 'de', 'capacitação', 'personalizados', 'apoiam', 'o', 'crescimento', 'profissional', 'de', 'cada', 'pessoa.'],
        ],
        [
            ['A', 'análise', 'de', 'dados', 'revela', 'áreas', 'de', 'crescimento', 'e', 'pontos', 'de', 'atenção.'],
            ['As', 'metas', 'são', 'ajustadas', 'de', 'acordo', 'com', 'a', 'evolução', 'do', 'setor.'],
            ['O', 'acompanhamento', 'semanal', 'dos', 'resultados', 'permite', 'corrigir', 'o', 'rumo', 'rapidamente.'],
            ['Decisões', 'bem', 'fundamentadas', 'dependem', 'de', 'informações', 'confiáveis', 'e', 'atualizadas.'],
            ['Reuniões', 'de', 'balanço', 'servem', 'para', 'revisar', 'as', 'estratégias', 'e', 'definir', 'próximos', 'passos.'],
        ],
    ];
}

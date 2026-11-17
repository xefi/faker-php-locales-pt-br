<?php

namespace Xefi\Faker\PtBr\Extensions;

use Xefi\Faker\Extensions\Extension;

class AddressExtension extends Extension
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

    protected $regions = [
        'Norte', 'Nordeste', 'Centro-Oeste', 'Sudeste', 'Sul',
    ];

    protected $states = [
        ['AC' => 'Acre'], ['AL' => 'Alagoas'], ['AP' => 'Amapá'], ['AM' => 'Amazonas'], ['BA' => 'Bahia'],
        ['CE' => 'Ceará'], ['DF' => 'Distrito Federal'], ['ES' => 'Espírito Santo'], ['GO' => 'Goiás'], ['MA' => 'Maranhão'],
        ['MT' => 'Mato Grosso'], ['MS' => 'Mato Grosso do Sul'], ['MG' => 'Minas Gerais'], ['PA' => 'Pará'], ['PB' => 'Paraíba'],
        ['PR' => 'Paraná'], ['PE' => 'Pernambuco'], ['PI' => 'Piauí'], ['RJ' => 'Rio de Janeiro'], ['RN' => 'Rio Grande do Norte'],
        ['RS' => 'Rio Grande do Sul'], ['RO' => 'Rondônia'], ['RR' => 'Roraima'], ['SC' => 'Santa Catarina'], ['SP' => 'São Paulo'],
        ['SE' => 'Sergipe'], ['TO' => 'Tocantins'],
    ];

    protected $cities = [
        'São Paulo' => 'SP', 'Rio de Janeiro' => 'RJ', 'Brasília' => 'DF', 'Salvador' => 'BA', 'Fortaleza' => 'CE',
        'Belo Horizonte' => 'MG', 'Manaus' => 'AM', 'Curitiba' => 'PR', 'Recife' => 'PE', 'Goiânia' => 'GO',
        'Belém' => 'PA', 'Porto Alegre' => 'RS', 'Guarulhos' => 'SP', 'Campinas' => 'SP', 'São Luís' => 'MA',
        'Maceió' => 'AL', 'Natal' => 'RN', 'Teresina' => 'PI', 'Campo Grande' => 'MS', 'João Pessoa' => 'PB',
        'Florianópolis' => 'SC', 'Cuiabá' => 'MT', 'Aracaju' => 'SE', 'Porto Velho' => 'RO', 'Vitória' => 'ES',
        'Macapá' => 'AP', 'Boa Vista' => 'RR', 'Rio Branco' => 'AC', 'Palmas' => 'TO', 'Joinville' => 'SC',
        'Uberlândia' => 'MG', 'Ribeirão Preto' => 'SP', 'Londrina' => 'PR', 'Niterói' => 'RJ', 'Feira de Santana' => 'BA',
    ];

    protected $streetTypes = [
        'Rua', 'Avenida', 'Travessa', 'Alameda', 'Praça', 'Estrada', 'Rodovia', 'Largo', 'Viela', 'Ladeira',
    ];

    protected $streetNames = [
        'Sete de Setembro', 'XV de Novembro', 'Tiradentes', 'Dom Pedro II', 'Getúlio Vargas', 'Santos Dumont',
        'Barão do Rio Branco', 'Marechal Deodoro', 'Duque de Caxias', 'Princesa Isabel', 'Rui Barbosa', 'José Bonifácio',
        'Floriano Peixoto', 'Benjamin Constant', 'Paulista', 'Augusta', 'da Consolação', 'Brigadeiro Faria Lima',
        'Atlântica', 'Presidente Vargas', 'das Flores', 'das Palmeiras', 'dos Andradas', 'São João', 'Ipiranga',
        'Visconde de Mauá', 'Castro Alves', 'Machado de Assis', 'Monteiro Lobato', 'Anita Garibaldi', 'Senador Dantas',
        'Joaquim Nabuco', 'Bento Gonçalves', 'Carlos Gomes', 'Santa Rita', 'do Comércio', 'da Liberdade', 'Rio Branco',
    ];

    /**
     * Generate a Brazilian geographic region.
     *
     * @return string
     */
    public function region(): string
    {
        return $this->pickArrayRandomElement($this->regions);
    }

    /**
     * Generate a Brazilian state as an array keyed by its UF code.
     *
     * @return array<string, string>
     */
    public function state(): array
    {
        return $this->pickArrayRandomElement($this->states);
    }

    /**
     * Generate a Brazilian city name.
     *
     * @return string
     */
    public function city(): string
    {
        return $this->pickArrayRandomKey($this->cities);
    }

    /**
     * Generate a CEP (Código de Endereçamento Postal) in the 00000-000 format.
     *
     * @return string
     */
    public function postcode(): string
    {
        return sprintf('%05d-%03d', $this->randomizer->getInt(1000, 99999), $this->randomizer->getInt(0, 999));
    }

    /**
     * Generate a house number.
     *
     * @return int
     */
    public function houseNumber(): int
    {
        return $this->randomizer->getInt(1, 2999);
    }

    /**
     * Generate a street name prefixed by its street type.
     *
     * @return string
     */
    public function streetName(): string
    {
        return sprintf('%s %s', $this->pickArrayRandomElement($this->streetTypes), $this->pickArrayRandomElement($this->streetNames));
    }

    /**
     * Generate a street address, such as "Rua Augusta, 1500".
     *
     * @return string
     */
    public function streetAddress(): string
    {
        return sprintf('%s, %d', $this->streetName(), $this->houseNumber());
    }

    /**
     * Generate a full address, such as "Rua Augusta, 1500, São Paulo - SP, 01305-100".
     *
     * @return string
     */
    public function fullAddress(): string
    {
        $city = $this->city();

        return sprintf('%s, %s - %s, %s', $this->streetAddress(), $city, $this->cities[$city], $this->postcode());
    }
}

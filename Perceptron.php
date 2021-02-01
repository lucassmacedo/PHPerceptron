<?php


class Perceptron
{
    /**
     * @var float
     */
    public $taxa_aprendizado;

    /**
     * @var int
     */
    public $interacoes;

    /**
     * Perceptron constructor.
     * @param float $taxa_aprendizado
     * @param int $interacoes
     */
    public function __construct($taxa_aprendizado = 0.01, $interacoes = 10)
    {
        $this->taxa_aprendizado = $taxa_aprendizado;
        $this->interacoes = $interacoes;
    }

    /**
     * Função que executa o Perceptron
     * @param $X
     * @param $y
     */
    public function fit($X, $y)
    {
        if (count($X) <> count($y)) {
            return "Error";
        }

        $size = max(array_map('count', $X));
        $weight_ = $this->randoDecimal($size);
        $errors_ = [];

        for ($i = 0; $i <= $this->interacoes; $i++) {
            $erros = [];

            for ($i = 0; $i < count($X); $i++) {


            }
        }
    }

    public function predict()
    {

    }

    public function net_input()
    {

    }

    /**
     * Gerador de números decimais de -1 até 1
     * @param int $size
     * @return array
     */
    public
    function randoDecimal($size = 1)
    {
        $data = [];
        for ($i = 0; $i <= $size; $i++) {
            $data[] = rand(0, 1) == 1 ? (rand(0, 100) - 100) / 100 : -(rand(0, 20) - 100) / 100;
        }
        return $data;
    }

}

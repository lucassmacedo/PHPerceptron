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

                $target = $y[$i];
                $xi = $X[$i];

                $update = $this->taxa_aprendizado * ($target - $this->predict($xi, $weight_));
                dd($update);
            }
        }
    }

    public function predict($X, $weight_)
    {
        return $this->net_input($X, $weight_);
    }


    public function net_input($X, $weight_)
    {

        $bias = $weight_[0];
        unset($weight_[0]);
        $weight_ = array_values($weight_);
        $X = array_values($X);

        return $this->multiply($X, $weight_) + $bias;

    }

    /**
     * Gerador de números decimais de -1 até 1
     * @param int $size
     * @return array
     */
    public function randoDecimal($size = 1)
    {
        $data = [];
        for ($i = 0; $i <= $size; $i++) {
            $data[] = rand(0, 1) == 1 ? (rand(0, 100) - 100) / 100 : -(rand(0, 20) - 100) / 100;
        }
        return $data;
    }

    /**
     * Map multiply against multiple arrays
     *
     * [x₁ * y₁, x₂ * y₂, ... ]
     *
     * @param array ...$arrays Two or more arrays of numbers
     *
     * @return array
     *
     */
    public static function multiply(array ...$arrays)
    {


        $number_of_arrays = \count($arrays);
        $length_of_arrays = \count($arrays[0]);

        $products = \array_fill(0, $length_of_arrays, 1);

        for ($i = 0; $i < $length_of_arrays; $i++) {
            for ($j = 0; $j < $number_of_arrays; $j++) {
                $products[$i] *= $arrays[$j][$i];
            }
        }

        return array_sum($products);
    }

}

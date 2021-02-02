<?php


/**
 * Class Perceptron.
 * Reprodução do Modelo Redes Neurais "Perceptron" em Python usando PHP.
 * Este modelo foi reproduzido usando como base as aulas do professor Everton Gomede e também o tutoria
 * https://medium.com/@urapython.community/perceptron-com-python-uma-introdu%C3%A7%C3%A3o-f19aaf9e9b64
 */
class Perceptron
{
    /**
     * Taxa de Aprendizado
     * @var float
     */
    public $taxa_aprendizado;

    /**
     * Quantidade de Epocas
     * @var float
     */
    private int $epocas;


    /**
     * Perceptron constructor.
     * @param float $taxa_aprendizado
     * @param int $epocas
     */
    public function __construct($taxa_aprendizado = 0.01, $epocas = 100)
    {
        $this->taxa_aprendizado = $taxa_aprendizado;
        $this->epocas = $epocas;
    }

    /**
     * Função que executa o Perceptron
     * @param $X
     * @param $y
     */
    public function fit($X, $y)
    {
        // Confere se existe uma diferença entre os tamanhos dos arrays/matrizes
        if (count($X) <> count($y)) {
            return "Matriz X e y de tamanhos diferentes.";
        }

        $size = max(array_map('count', $X));

        // Inicia os pesos com valores aleatórios
        $weight_ = collect($this->randoDecimal($size));

        $errors_ = [];

        for ($i_epocas = 0; $i_epocas <= $this->epocas; $i_epocas++) {

            $errors = 0;
            for ($i = 0; $i < count($X); $i++) {

                $target = $y[$i];
                $xi = $X[$i];

                // Taxa de Aprendizado
                $update = ($target - $this->predict($xi, $weight_));

                // Atulizando os pesos e também o Bias
                $weight_ = $weight_->map(function ($item, $key) use ($update, $xi) {

                    // Atualiza o Bias
                    if ($key == 0) {
                        return $item + $update;
                    }

                    // Atualiza os pesos
                    return $item + ($update * $xi[$key - 1]);
                });

                $errors += $update > 0 ? 1 : 0;
            }

            $errors_[] = $errors;
        }
    }

    /**
     * Função Predict ou Função de Ativação Degral Bipolar (Step)
     * @param $X
     * @param $weight_
     * @return int
     */
    public function predict($X, $weight_): int
    {
        return $this->net_input($X, $weight_) >= 0 ? 1 : -1;
    }

    /**
     * Função NetInput que é responsavel por fazer a multiplicação das Matrizes (Entradas x Pesos)
     * @param $X
     * @param $weight_
     * @return array|mixed
     */
    public function net_input($X, $weight_)
    {
        $weight_ = $weight_->toArray();

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
     * Função que realiza as multiplicações de matrizes
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

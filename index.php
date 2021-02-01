<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "vendor/autoload.php";
include "Perceptron.php";
$response = file('https://archive.ics.uci.edu/ml/machine-learning-databases/iris/iris.data', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$header_values = ["sepal_lenght", "sepal_width", "petal_leght", "petal_width", "class"];

$data = array_map(function ($item) use ($header_values) {
    return array_combine($header_values, explode(',', $item));
}, $response);


$y = array_map(function ($item) {
    return $item == 'Iris-setosa' ? 1 : -1;
}, array_column($data, 'class'));

// Remove a Coluna "Class" do DataSet
array_walk($data, function (&$v) {
    array_splice($v, 4, 1);
});

$X = $data;

$perceptron = new Perceptron();
$perceptron->fit($X, $y);

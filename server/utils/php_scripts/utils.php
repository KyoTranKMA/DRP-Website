<?php
function convertToFloat($str) {
  preg_match('/(\d+)\s*(\d*\/\d*)?/', $str, $matches);
  $fraction = 0;
  if (isset($matches[2]) && !empty($matches[2])) {
      list($numerator, $denominator) = explode('/', $matches[2]);
      $fraction =  (float)($numerator) / (float)($denominator);
  }
  $total = intval($matches[1]) + $fraction;
  return number_format($total, 5); // round the decimal to 5
}

function separateValueAndUnit($str) {
  preg_match('/([\d\s\/]+)\s*(\D+)/', $str, $matches);
  $value = trim($matches[1]); // Phần giá trị số
  $unit = trim($matches[2]); // Phần đơn vị
  return array($value, $unit);
}
?>

<?php
  class Recipe_Unit_Converter {

    const CONVERSION_RATIOS = [
        'TSP' => ['DSP' => 4/3, 'TBSP' => 1/3, 'CUP' => 1/48, 'ML' => 5, 'LIT' => 1/200],
        'DSP' => ['TSP' => 3/4, 'TBSP' => 3/4, 'CUP' => 1/20, 'ML' => 20, 'LIT' => 1/60],
        'TBSP' => ['TSP' => 3, 'CUP' => 1/16, 'ML' => 15, 'LIT' => 1/67],
        'CUP' => ['TSP' => 48, 'TBSP' => 16, 'ML' => 240, 'LIT' => 0.24],
        'ML' => ['TSP' => 1/5, 'TBSP' => 1/16, 'CUP' => 1/240, 'LIT' => 1/1000],
        'LIT' => ['TSP' => 200, 'TBSP' => 67, 'CUP' => 240, 'ML' => 1000],
        'G' => ['KG' => 1/1000, 'MG' => 1000],
        'KG' => ['G' => 1000, 'MG' => 1000000],
        'MG' => ['G' => 1/1000, 'KG' => 1/1000000]
    ];

    public static function convertUnits($amount, $fromUnit, $toUnit) {
      try {
        if (!isset(self::CONVERSION_RATIOS[$fromUnit]) || !isset(self::CONVERSION_RATIOS[$fromUnit][$toUnit])) 
          throw new Exception("Incapitable unit or no suitable conversion ratio! ");
        $conversionRatio = self::CONVERSION_RATIOS[$fromUnit][$toUnit];
        $convertedAmount = $amount * $conversionRatio;
        return $convertedAmount;
      }
      catch(Exception $e){
        echo $e->getMessage();
        return false;
      }
    }
  
  }
?>

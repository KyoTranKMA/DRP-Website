<?php 
class Add_Ingre_Handler {
    public static function handlePostRequest($conn) {
        try {
            if ($conn) {
                if(isset($_POST["NutritionComponentType"]) && isset($_POST["NutritionComponentValue"])) {
                    $nutritionComponents = $_POST["NutritionComponentType"];
                    $nutritionValue = $_POST["NutritionComponentValue"];
                    $nutritionData = array();
                    for($i = 0; $i < count($nutritionComponents); $i++)
                        $nutritionData[$nutritionComponents[$i]] = $nutritionValue[$i];
                } else throw new Exception("Error(s) in handling nutrition array. ");
                $newIngredient = new Ingredients($_POST['Name'], $_POST['Categories'], $_POST['MeasurementUnit'],  true, json_encode($nutritionData),
                                                (isset($_POST['SpecialRequirement']) ? $_POST['SpecialRequirement'] : ""));
                $newIngredient->addIngredient($conn);
                return true;
            }
            throw new Exception('Error(s) occour in connection to database. ');
        }
        catch(Exception $exception) {
            echo $exception->getMessage();
            return false;
        }
    }
}
?>
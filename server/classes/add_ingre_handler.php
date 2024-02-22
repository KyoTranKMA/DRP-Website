<?php 
class Add_Ingre_Handler {
    public static function handlePostRequest($conn) {
        try {
            if (!$conn) 
                throw new Exception('Error(s) occour in connection to database. '); 

            if(!isset($_POST["NutritionComponentType"]) || !isset($_POST["NutritionComponentValue"])) 
                throw new Exception("Error(s) in handling nutrition array. Nutrition components can not be left empty");

            $nutritionComponents = $_POST["NutritionComponentType"];
            $nutritionValue = $_POST["NutritionComponentValue"];
            $nutritionData = array();
            for($i = 0; $i < count($nutritionComponents); $i++)
                $nutritionData[$nutritionComponents[$i]] = $nutritionValue[$i];

            $newIngredient = new Ingredients($_POST['Name'], $_POST['Categories'], $_POST['MeasurementUnit'],  true, json_encode($nutritionData),
                                            (isset($_POST['SpecialRequirement']) ? $_POST['SpecialRequirement'] : ""));
            $newIngredient->addIngredient($conn);
            return true;
        }
        catch(Exception $exception) {
            echo $exception->getMessage();
            return false;
        }
    }
}
?>
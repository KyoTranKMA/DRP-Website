<? require_once($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/header.php"); ?>
    <div class="form">

        <form method="post" id="frmUPDATEingredient" action="/ingredient/edit" style="width: 50vw; margin: 0 auto; padding: 20px; border: 1px solid #e1ebfa; border-radius: 10px; box-shadow: 0 0 10px 0 #e1ebfa; margin-top: 50px; margin-bottom: 50px;">
            <fieldset>
            <? $ingredient = $data[0]; ?>
            <legend>Update ingredient</legend>

            <div class="row">
                <label for="id">ID:</label>
                <input name="id" id="id" type="hidden" value="<?=htmlspecialchars($ingredient->getId())?>" style="width: 20"; readonly/>
                <?=htmlspecialchars($ingredient->getId())?>
            </div>

            <div class="row">
                <label for="description">Name:</label>
                <input name="name" id="name" type="text" value="<?=htmlspecialchars($ingredient->getName())?>"/>
            </div>

            <div class="row">
                <label for="author">category:</label>
                <select name="category" id="category">
                    <option value="EMMP" <?=($ingredient->getCategory() == 'EMMP') ? 'selected' : ''?>>Eggs, milk and milk products</option>
                    <option value="FAO" <?=($ingredient->getCategory() == 'FAO') ? 'selected' : ''?>> Fats and oils</option>
                    <option value="FRU" <?=($ingredient->getCategory() == 'FRU') ? 'selected' : ''?>>Fruits</option>
                    <option value="GNBK" <?=($ingredient->getCategory() == 'GNBK') ? 'selected' : ''?>>Grain, nuts and baking products</option>
                    <option value="HRBS" <?=($ingredient->getCategory() == 'HRBS') ? 'selected' : ''?>>Herbs and spices</option>
                    <option value="MSF" <?=($ingredient->getCategory() == 'MSF') ? 'selected' : ''?>>Meat, sausages and fish</option>
                    <option value="PRP" <?=($ingredient->getCategory() == 'PRP') ? 'selected' : ''?>>Pasta, rice and pulses</option>
                    <option value="VEGI" <?=($ingredient->getCategory() == 'VEGI') ? 'selected' : ''?>>Vegetables</option>
                    <option value="OTHR" <?=($ingredient->getCategory() == 'OTHR') ? 'selected' : ''?>>Others</option>
                </select>
            </div>

            <div class="row">
            <label for="author">Measurement description:</label>
                <select name="measurement_description" id="measurement_description">
                    <option value="tsp" <?=($ingredient->getMeasurementDescription() == 'tsp') ? 'selected' : ''?>>teaspoon</option>
                    <option value="cup" <?=($ingredient->getMeasurementDescription() == 'cup') ? 'selected' : ''?>>cup</option>
                    <option value="tbsp" <?=($ingredient->getMeasurementDescription() == 'tbsp') ? 'selected' : ''?>>table spoon</option>
                    <option value="g" <?=($ingredient->getMeasurementDescription() == 'g') ? 'selected' : ''?>>gram</option>
                    <option value="lb" <?=($ingredient->getMeasurementDescription() == 'lb') ? 'selected' : ''?>>lb</option>
                    <option value="can" <?=($ingredient->getMeasurementDescription() == 'can') ? 'selected' : ''?>>can</option>
                    <option value="oz" <?=($ingredient->getMeasurementDescription() == 'oz') ? 'selected' : ''?>>oz</option>
                    <option value="unit" <?=($ingredient->getMeasurementDescription() == 'unit') ? 'selected' : ''?>>unit</option>
                </select>
            </div>

            <?php $nutritionComponents = $ingredient->getNutritionComponents() ?>

            <div class="row">
                <label for="calcium">Calcium:</label>
                <input name="calcium" id="calcium" type="number" value="<?=htmlspecialchars($nutritionComponents['calcium'])?>"/>
            </div>

            <div class="row">
                <label for="calories">Calories:</label>
                <input name="calories" id="calories" type="number" value="<?=htmlspecialchars($nutritionComponents['calories'])?>"/>
            </div>

            <div class="row">
                <label for="carbohydrate">Carbohydrate:</label>
                <input name="carbohydrate" id="carbohydrate" type="number" value="<?=htmlspecialchars($nutritionComponents['carbohydrate'])?>"/>
            </div>

            <div class="row">
                <label for="cholesterol">Cholesterol:</label>
                <input name="cholesterol" id="cholesterol" type="number" value="<?=htmlspecialchars($nutritionComponents['cholesterol'])?>"/>
            </div>

            <div class="row">
                <label for="fiber">Fiber:</label>
                <input name="fiber" id="fiber" type="number" value="<?=htmlspecialchars($nutritionComponents['fiber'])?>"/>
            </div>

            <div class="row">
                <label for="iron">Iron:</label>
                <input name="iron" id="iron" type="number" value="<?=htmlspecialchars($nutritionComponents['iron'])?>"/>
            </div>

            <div class="row">
                <label for="fat">Fat:</label>
                <input name="fat" id="fat" type="number" value="<?=htmlspecialchars($nutritionComponents['fat'])?>"/>
            </div>

            <div class="row">
                <label for="monounsaturated_fat">Monounsaturated Fat:</label>
                <input name="monounsaturated_fat" id="monounsaturated_fat" type="number" value="<?=htmlspecialchars($nutritionComponents['monounsaturated_fat'])?>"/>
            </div>

            <div class="row">
                <label for="polyunsaturated_fat">Polyunsaturated Fat:</label>
                <input name="polyunsaturated_fat" id="polyunsaturated_fat" type="number" value="<?=htmlspecialchars($nutritionComponents['polyunsaturated_fat'])?>"/>
            </div>

            <div class="row">
                <label for="saturated_fat">Saturated Fat:</label>
                <input name="saturated_fat" id="saturated_fat" type="number" value="<?=htmlspecialchars($nutritionComponents['saturated_fat'])?>"/>
            </div>

            <div class="row">
                <label for="potassium">Potassium:</label>
                <input name="potassium" id="potassium" type="number" value="<?=htmlspecialchars($nutritionComponents['potassium'])?>"/>
            </div>

            <div class="row">
                <label for="protein">Protein:</label>
                <input name="protein" id="protein" type="number" value="<?=htmlspecialchars($nutritionComponents['protein'])?>"/>
            </div>

            <div class="row">
                <label for="sodium">Sodium:</label>
                <input name="sodium" id="sodium" type="number" value="<?=htmlspecialchars($nutritionComponents['sodium'])?>"/>
            </div>

            <div class="row">
                <label for="sugar">Sugar:</label>
                <input name="sugar" id="sugar" type="number" value="<?=htmlspecialchars($nutritionComponents['sugar'])?>"/>
            </div>
            
            <div class="row">
                <label for="vitamin_a">Vitamin A:</label>
                <input name="vitamin_a" id="vitamin_a" type="number" value="<?=htmlspecialchars($nutritionComponents['vitamin_a'])?>"/>    
            </div>

            <div class="row">
                <label for="vitamin_c">Vitamin C:</label>
                <input name="vitamin_c" id="vitamin_c" type="number" value="<?=htmlspecialchars($nutritionComponents['vitamin_c'])?>"/>
            </div>

            <div class="row">
                <input class="btn" type="submit" value="Update">
                <input class="btn" type="reset" value="Cancel"
                onclick="parent.location='/homepage'"/>
            </div>

        </fieldset>
    </form>
</div>
<? require_once($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/footer.php"); ?>
document.addEventListener("DOMContentLoaded", function() {
    const addNutritionButton = document.getElementById("addNutrition");
    const nutritionContainer = document.getElementById("nutritionComponentsContainer");

    const  nutrientOptions = [
        { value: "BIOT", display: "Vitamin Biotin" },
        { value: "FOLT", display: "Vitamin Folate" },
        { value: "VITA", display: "Vitamin A" },
        { value: "VITB1", display: "Vitamin B1" },
        { value: "VITB2", display: "Vitamin B2" },
        { value: "VITB3", display: "Vitamin B3" },
        { value: "VITB5", display: "Vitamin B5" },
        { value: "VITB6", display: "Vitamin B6" },
        { value: "VITB12", display: "Vitamin B12" },
        { value: "VITC", display: "Vitamin C" },
        { value: "VITD", display: "Vitamin D" },
        { value: "VITE", display: "Vitamin E" },
        { value: "VITK", display: "Vitamin K" },
        { value: "CALC", display: "Calcium" },
        { value: "IRON", display: "Iron" },
        { value: "MAGN", display: "Magnesium" },
        { value: "CHRO", display: "Chromium" },
        { value: "COPP", display: "Copper" },
        { value: "CHLO", display: "Chlorine" },
        { value: "FLUR", display: "Fluorine" },
        { value: "IODI", display: "Iodine" },
        { value: "NICK", display: "Nickel" },
        { value: "MANG", display: "Manganese" },
        { value: "MOLY", display: "Molybdenum" },
        { value: "POTA", display: "Potassium" },
        { value: "PROT", display: "Protein" },
        { value: "FIBR", display: "Fibre" },
        { value: "CARB", display: "Carbohydrate" },
        { value: "FATS", display: "Fats" },
        { value: "WATE", display: "Water" }
    ];
    

    addNutritionButton.addEventListener("click", function() {
        const newRow = document.createElement("div");
        newRow.classList.add("row", "nutritionRow");

        const typeSelect = document.createElement("select");
        typeSelect.classList.add("nutritionComponentType");
        typeSelect.name = "NutritionComponentType[]";

        // Add disabled placeholder option
        const placeholderOption = document.createElement("option");
        placeholderOption.value = "";
        placeholderOption.textContent = "--Select a nutrition component--";
        placeholderOption.disabled = true;
        placeholderOption.selected = true;
        typeSelect.appendChild(placeholderOption);

        nutrientOptions.forEach(function(option) {
            const typeOption = document.createElement("option");
            typeOption.value = option.value;
            typeOption.textContent = option.display;
            typeSelect.appendChild(typeOption);
        });

        const valueLabel = document.createElement("label");
        valueLabel.textContent = "Value";

        const valueInput = document.createElement("input");
        valueInput.type = "number";
        valueInput.classList.add("nutritionComponentValue");
        valueInput.name = "NutritionComponentValue[]";
        valueInput.placeholder = "Enter value";
        valueInput.step = "any";

        const removeButton = document.createElement("button");
        removeButton.type = "button";
        removeButton.classList.add("removeNutrition");
        removeButton.textContent = "Remove";
        removeButton.addEventListener("click", function() {
            newRow.remove();
        });

        newRow.appendChild(typeSelect);
        
        newRow.appendChild(valueLabel);
        newRow.appendChild(valueInput);
        newRow.appendChild(removeButton);
        $(typeSelect).selectize();
        
        nutritionContainer.appendChild(newRow);
    });

    nutritionContainer.addEventListener("click", function(event) {
        if (event.target.classList.contains("removeNutrition")) {
            event.target.parentNode.remove();
        }
    });
});

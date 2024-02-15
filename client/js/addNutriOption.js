document.addEventListener("DOMContentLoaded", function() {
  const addNutritionButton = document.getElementById("addNutrition");
  const nutritionContainer = document.getElementById("nutritionComponentsContainer");

  const nutritionOptions = [
      "Vitamin Biotin", "Vitamin Folate", "Vitamin A", "Vitamin B1", "Vitamin B2",
      "Vitamin B3", "Vitamin B5", "Vitamin B6", "Vitamin B12", "Vitamin C", "Vitamin D",
      "Vitamin E", "Vitamin K", "Calcium", "Iron", "Magnesium", "Chromium", "Copper",
      "Chlorine", "Fluorine", "Iodine", "Nickel", "Manganese", "Molybdenum", "Potassium",
      "Protein", "Fibre", "Carbohydrate", "Fats", "Water"
  ];

  addNutritionButton.addEventListener("click", function() {
      const newRow = document.createElement("div");
      newRow.classList.add("row", "nutritionRow");

      const typeLabel = document.createElement("label");
      typeLabel.textContent = "Nutrition component type";

      const typeSelect = document.createElement("select");
      typeSelect.classList.add("nutritionComponentType");
      typeSelect.name = "NutritionComponentType[]";
      nutritionOptions.forEach(function(option) {
          const typeOption = document.createElement("option");
          typeOption.value = option;
          typeOption.textContent = option;
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

      newRow.appendChild(typeLabel);
      newRow.appendChild(typeSelect);
      newRow.appendChild(valueLabel);
      newRow.appendChild(valueInput);
      newRow.appendChild(removeButton);

      nutritionContainer.appendChild(newRow);
  });

  nutritionContainer.addEventListener("click", function(event) {
      if (event.target.classList.contains("removeNutrition")) {
          event.target.parentNode.remove();
      }
  });
});

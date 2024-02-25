function addOpts(optionsToSelect, elementId, labelDisplay, placeholderDisplay){
  const container = document.getElementById(elementId);

  if (!container) {
    console.error("Container element not found.");
    return;
  }

  const newRow = document.createElement("div");
  newRow.classList.add("row","optionRow");

  const typeLabel = document.createElement("label");
  typeLabel.textContent = labelDisplay; 

  const typeSelect = document.createElement("select");
  typeSelect.classList.add(elementId);
  typeSelect.name = elementId + "[]";

  const placeholderOption = document.createElement("option");
  placeholderOption.value = "";
  placeholderOption.textContent = placeholderDisplay;
  placeholderOption.disabled = true; 
  placeholderOption.selected = true; 
  typeSelect.appendChild(placeholderOption);

  optionsToSelect.forEach(function(option) {
    const newOption = document.createElement("option");
    newOption.value = option.value;
    newOption.textContent = option.display;
    typeSelect.add(newOption);
  });

  newRow.appendChild(typeLabel);
  newRow.appendChild(typeSelect);
  $(typeSelect).selectize(); 

  container.appendChild(newRow); 
}

export { addOpts };

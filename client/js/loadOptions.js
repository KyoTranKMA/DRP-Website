import { addOpts } from './addOpts.js';

document.addEventListener("DOMContentLoaded", function () {
  const categoryOption = [
    { value: "EMP", display: "Trứng, sữa và các sản phẩm liên quan" },
    { value: "FAO", display: "Chất béo" },
    { value: "FRU", display: "Trái cây" },
    { value: "GNB", display: "Ngũ cốc, các loại hạt và bánh mì" },
    { value: "HAS", display: "Thảo mộc và gia vị" },
    { value: "MSF", display: "Thịt, xúc xích và cá" },
    { value: "PRP", display: "Gạo, mì và các loại đậu" },
    { value: "VEG", display: "Rau củ" },
    { value: "OTH", display: "Khác" }
  ];

  const MeasurementUnitOption = [
    { value: "MGR", display: "Miligrams" },
    { value: "GRA", display: "Grams" },
    { value: "KGR", display: "Kilograms" },
    { value: "MLI", display: "Mililitres" },
    { value: "LIT", display: "Litres" },
    { value: "TES", display: "Thìa cafe" },
    { value: "TAS", display: "Muỗng canh" },
    { value: "CUP", display: "Cốc" },
  ];

  addOpts(categoryOption, "Categories", "Category", "--Select a category--");
  addOpts(MeasurementUnitOption, "MeasurementUnit", "Measurement unit type", "--Select a category--");
});

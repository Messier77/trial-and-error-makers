const nav = document.querySelector(".mobile-nav");
const burger = document.querySelector(".burger-toggle");
const links = nav.querySelectorAll("a");
const burgerClose = document.getElementById("burger-close");

burger.addEventListener("click", () => {
    nav.classList.toggle("inactive-menu");
    // burger.style.display = "none";
    // burgerClose.style.display = "block";
});

links.forEach(link => {
    link.addEventListener('click', () => {
        nav.classList.toggle("inactive-menu");
        // burger.style.display = "block";
        // burgerClose.style.display = "none";
        // burgerImg.src = "./images/icons/burger-menu.svg";
    })
});


let myApp = {
  productListFull: [],
  categoryListFull: [],
  materialListFull: [],
  productList: [],
  filters: {
    materials: [],
    categories: []
  },
  activeFilters: {
    materials: [],
    categories: []
  },
  init: function(products, categories, materials) {

    myApp.productListFull = products;
    myApp.productList = products;
    myApp.categoryListFull = categories;
    myApp.materialListFull = materials;

    myApp.setFilters(products, categories, materials);

    console.log(JSON.stringify(myApp));

    myApp.printProducts();
    myApp.printMaterials();
    myApp.printCategories();
  },
  setFilters: function(products, categories, materials) {

    let allCategoriesFromProducts = products.map(product => product.product_category);
    let allMaterialsFromProducts = products.map(product => product.product_material);

    myApp.filters.categories = categories.filter((category) => {
      if (allCategoriesFromProducts.includes(category.category_tag)) {
        return category;
      }
    });
    myApp.filters.materials = materials.filter((material) => {
      if (allMaterialsFromProducts.includes(material.material_tag)) {
        return material;
      }
    });

  },
  updateProductList: function() {

    if (myApp.activeFilters.materials.length) {
      myApp.productList = myApp.productListFull.filter(product => {
        const productMaterialObject = myApp.filters.materials.filter((material) => material.material_name === product.product_material);
        const productMaterialId = productMaterialObject.material_id;

        return myApp.activeFilters.materials.includes(productMaterialId);
      });
    }

    myApp.printProducts();

    myApp.printCategories();
    myApp.printMaterials();

  },
  printProducts: function() {
      let res = "";
      myApp.productList.forEach(element => {
          let item = `
              <a href="../project/project.php?product=${element.product_id}" class="all-projects">
              <div class="project">
                  <img src="../images/products/${element.product_id}/${element.product_featured_photo}" alt="" class="project-img" />
                  <div class="project-info">
                      <h4>${element.product_name}</h4>
                      <p>${element.product_short_description}</p>
                      <img src="../images/icons/arrow.svg" alt="">
                  </div>
              </div>
              </a>
              `;
      res += item;
      });

      document.querySelector("#project-center-new").innerHTML = "";
      document.querySelector("#project-center-new").innerHTML = res;
  },
  printMaterials: function() {


      let res = "";
      myApp.filters.materials.forEach(element => {
        let id = element.material_id;  
        let item = `
                <input onclick="myApp.toggleMaterial(${id})" type="checkbox" id="material${id}" name="materials${id}" value="${element.material_name}" rel="${element.material_name}">
                <label for="${element.material_name}" class="material">${element.material_name}</label>
              `;
      res += item;
      });

      document.querySelector("#materials").innerHTML = "";
      document.querySelector("#materials").innerHTML = res;
  },
  printCategories: function() {
      let res = "";
      myApp.categoryListFull.forEach(element => {
          let id = element.category_id;  
          let item = `
                <input type="checkbox" id="category${id}" name="categories" value="${element.category_name}" rel="${element.category_name}">
                <label for="${element.category_name}" class="category">${element.category_name}</label>
              `;
      res += item;
      });

      document.querySelector("#categories").innerHTML = "";
      document.querySelector("#categories").innerHTML = res;
  },
  toggleMaterial: function(materialId) {

    debugger;

    if (myApp.activeFilters.materials.includes(materialId)) {
      myApp.activeFilters.materials = myApp.activeFilters.materials.filter((id) => id !== materialId);
    } else {
      myApp.activeFilters.materials.push(materialId);
    }

    myApp.updateProductList();

  }
}



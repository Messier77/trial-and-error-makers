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
  productList: [],
  filtersFull: {
    materials: [],
    categories: [],
  },
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
    myApp.filtersFull.materials = materials;
    myApp.filtersFull.categories = categories;

    myApp.setFilters(products, categories, materials);

    console.log(myApp);

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

  updateFilters: function() {
    let allCategoriesFromProducts = myApp.productList.map(product => product.product_category);
    let allMaterialsFromProducts = myApp.productList.map(product => product.product_material);

    myApp.filters.categories = myApp.filtersFull.categories.filter((category) => {
      if (allCategoriesFromProducts.includes(category.category_tag)) {
        return category;
      }
    });
    myApp.filters.materials = myApp.filtersFull.materials.filter((material) => {
      if (allMaterialsFromProducts.includes(material.material_tag)) {
        return material;
      }
    });

  },
  updateProductList: function() {

    myApp.productList = myApp.productListFull;

    if (myApp.activeFilters.materials.length) {
      myApp.productList = myApp.productList.filter(product => {
        const productMaterialObject = myApp.filters.materials.find((material) => material.material_tag === product.product_material);


        if (productMaterialObject) {
          const productMaterialId = parseInt(productMaterialObject.material_id);
          return myApp.activeFilters.materials.includes(productMaterialId);
        }

      });
    }

    myApp.updateFilters();

    if (myApp.activeFilters.categories.length) {
      myApp.productList = myApp.productList.filter(product => {
        const productCategoryObject = myApp.filters.categories.find((cateogry) => cateogry.cateogry_tag === product.product_cateogry);
        
        if (productCategoryObject) {
          const productCategoryId = parseInt(productCategoryObject.category_id);
          return myApp.activeFilters.categories.includes(productCategoryId);
        }

      });
    }

    myApp.updateFilters();

    myApp.printProducts();

    myApp.printCategories();
    myApp.printMaterials();

    myApp.printAddedFilters();

  },

  printAddedFilters: function() {
    let res = "";

    myApp.filtersFull.materials.forEach(material => {

      if (myApp.activeFilters.materials.includes(parseInt(material.material_id))) {
        let item = `
          <div class="added-filter">
            <img src="../images/icons/close-filter.svg" alt="">
            <p>${material.material_name}</p>
          </div>
        `;
        res += item;
      }
    });

    myApp.filtersFull.categories.forEach(category => {

      if (myApp.activeFilters.categories.includes(parseInt(category.category_id))) {
        let item = `
          <div class="added-filter">
            <img src="../images/icons/close-filter.svg" alt="">
            <p>${category.category_name}</p>
          </div>
        `;
        res += item;
      }
    });

    document.querySelector("#added-filters").innerHTML = "";
    document.querySelector("#added-filters").innerHTML = res;


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
                <input data-material="${id}" type="checkbox" id="material${id}" name="materials${id}" value="${element.material_name}" rel="${element.material_name}">
                <label for="material${id}" onclick="myApp.toggleMaterial(${id})" class="material label ${myApp.activeFilters.materials.includes(parseInt(element.material_id)) ? 'checked' : ''}">${element.material_name}</label>
              `;
      res += item;
      });

      document.querySelector("#materials").innerHTML = "";
      document.querySelector("#materials").innerHTML = res;
  },
  printCategories: function() {
      let res = "";
      myApp.filters.categories.forEach(element => {
          let id = element.category_id;  
          let item = `
                <input data-category="${id}" type="checkbox" id="category${id}" name="categories" value="${element.category_name}" rel="${element.category_name}">
                <label for="category${id}" onclick="myApp.toggleCategory(${id})" class="category label ${myApp.activeFilters.categories.includes(parseInt(element.category_id)) ? 'checked' : ''}">${element.category_name}</label>
              `;
      res += item;
      });

      document.querySelector("#categories").innerHTML = "";
      document.querySelector("#categories").innerHTML = res;
  },
  toggleMaterial: function(materialId) {


    if (myApp.activeFilters.materials.includes(materialId)) {
      myApp.activeFilters.materials = myApp.activeFilters.materials.filter((id) => id !== materialId);
    } else {
      myApp.activeFilters.materials.push(materialId);
    }

    myApp.updateProductList();

  },
  toggleCategory: function(categoryId) {

    if (myApp.activeFilters.categories.includes(categoryId)) {
      myApp.activeFilters.categories = myApp.activeFilters.categories.filter((id) => id !== categoryId);
    } else {
      myApp.activeFilters.categories.push(categoryId);
    }

    myApp.updateProductList();

  },

}



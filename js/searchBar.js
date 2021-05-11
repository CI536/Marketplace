window.addEventListener("load", function(){
    const productsList = document.getElementById('productsList');
    const searchBar = document.getElementById('searchBar');
    const searchBtn = document.querySelector('.searchBtn');
    
    // Category boxes
    const showAll = document.querySelector("input[name=all]");
    const vehicle = document.querySelector("input[name=vehicle]");
    const clothing = document.querySelector("input[name=clothing]");
    const electronics = document.querySelector("input[name=electronics]");
    const books = document.querySelector("input[name=books]");
    
    let filters = {
         listingName: [],
         category: [],
    };
    let products = [];
    
    console.log(filters);
    
    // Credit: jherax https://gist.github.com/jherax/f11d669ba286f21b7a2dcff69621eb72
    // Ignores case-sensitive
    const getValue = value => (typeof value === 'string' ? value.toUpperCase() : value);
    
    /**
     * Filters an array of objects (one level-depth) with multiple criteria.
     *
     * @param  {Array}  array: the array to filter
     * @param  {Object} filters: an object with the filter criteria
     * @return {Array}
     */
    function filterPlainArray(array, filters) {
      const filterKeys = Object.keys(filters);
      return array.filter(item => {
        // Validates all filter criteria
        return filterKeys.every(key => {
          // Ignores an empty filter
          if (!filters[key].length) return true;
          return filters[key].find(filter => getValue(item[key]).includes(getValue(filter)));
        });
      });
    }
            
    
searchBar.addEventListener('keyup', (e) => {
        const searchString = e.target.value.toLowerCase(); // Get input value
        // Filter the results by name and house. Always convert to lowercase
        const filteredProducts = products.filter((product) => {
           return ( 
                product.listingName.toLowerCase().includes(searchString)
            );
        });
        console.log(filteredProducts);
        displayProducts(filteredProducts);
    });
    // searchBar.addEventListener('keyup', (e) => {
        
    //      delete filters.listingName;
    //      if (event.keyCode === 13) {
    //         // Cancel the default action, if needed
    //         event.preventDefault();
    //         // Trigger the button element with a click
    //         searchBtn.click(e);
    //       }
    // });
    
    // //Search button
    // searchBtn.addEventListener("click", function(e){
    //     // Filter the results by name
    //     searchString = searchBar.value; // Get input value
    //     // Add name filter only if searchBar input is not empty
    //     if (searchString.length!=0){ 
    //       filters.listingName = [searchString];
    //     }
    //     // Refresh results
    //     filteredItems = filterPlainArray(products, filters);
    //     displayProducts(filteredItems);
    // });
    
    //load items from the API
    function loadProducts(){
        try {
            function readTextFile(file, callback) {
                var rawFile = new XMLHttpRequest();
                rawFile.overrideMimeType("application/json");
                rawFile.open("GET", file, true);
                rawFile.onreadystatechange = function() {
                    if (rawFile.readyState === 4 && rawFile.status == "200") {
                        callback(rawFile.responseText);
                    }
                }
                rawFile.send(null);
            }

            readTextFile("products.json", function(text){
                products = JSON.parse(text);
                displayProducts(products);
                console.log(products)
            });
        } catch (err) {
            console.error(err);
        }
    }



    //get details from API and inject them in HTML
    const displayProducts = (products) => {
        const htmlString = products
            .map((product) => {
                return `
                <li class="card">
                  <div class="card-content">
                    <a href="singleListing.php">
                        <h2>${product.listingName}</h2>
                        <p>${product.listingPrice}</p>
                        <img src="images/${product.fileName}"></img>
                    </a>
                  </div>
                </li>
            `;
            })
            .join('');
        productsList.innerHTML = htmlString;
    };
    
    // Categories

    // When show all is checked all other boxes are unchecked
    $(showAll).on('change', function() {
       $('input[type="checkbox"]').not(this).prop('checked', false);
    });
    // When any box other than 'Show all' is checked, uncheck 'Show all'
    $('input[type="checkbox"]').on('change', function() {
       $(showAll).not(this).prop('checked', false);
    });
    // Set showAll to checked when all other boxes are unchecked
    $('.preventUncheck').on('change', function(e) {
        if ($('.preventUncheck:checked').length == 0 && !this.checked)
        	$(showAll).prop('checked', true);
    });
    
    
    // 'Show all' filter
    showAll.addEventListener('change', function(){
        if (this.checked){
          filters.category =[];
          console.log(filters.category);
          loadProducts();
        }
    });
    
    // Vehicle filter
    vehicle.addEventListener('change', function(){
         if (this.checked){
            // Push category to the array of filters
            filters.category.push("vehicles");
            console.log(filters.category);
        } else {
            // Remove from array when box is unchecked
            let arr = filters.category;
            for( var i = 0; i < arr.length; i++){ 
                if ( arr[i] === "vehicles") { 
                    arr.splice(i, 1); 
                }
            }
        }
        // Apply all filters and display
        filteredItems = filterPlainArray(products, filters);
        displayProducts(filteredItems);
    });
    
    // Clothing filter
    clothing.addEventListener('change', function(){
         if (this.checked){
            // Push category to the array of filters
            filters.category.push("Clothes");
            console.log(filters.category);
        } else {
            // Remove from array when box is unchecked
            let arr = filters.category;
            for( var i = 0; i < arr.length; i++){ 
                if ( arr[i] === "Clothes") { 
                    arr.splice(i, 1); 
                }
            }
        }
        // Apply all filters and display
        filteredItems = filterPlainArray(products, filters);
        displayProducts(filteredItems);
    });
    
    // Electronics filter
    electronics.addEventListener('change', function(){
        if (this.checked){
            // Push category to the array of filters
            filters.category.push("electronics");
            console.log(filters.category);
        } else {
            // Remove from array when box is unchecked
            let arr = filters.category;
            for( var i = 0; i < arr.length; i++){ 
                if ( arr[i] === "electronics") { 
                    arr.splice(i, 1); 
                }
            }
        }
        // Apply all filters and display
        filteredItems = filterPlainArray(products, filters);
        displayProducts(filteredItems);
    });
        
    // Books filter
    books.addEventListener('change', function(){
        if (this.checked){
            // Push category to the array of filters
            filters.category.push("Books");
            console.log(filters.category);
        } else {
            // Remove from array when box is unchecked
            let arr = filters.category;
            for( var i = 0; i < arr.length; i++){ 
                if ( arr[i] === "Books") { 
                    arr.splice(i, 1); 
                }
            }
        }
        // Apply all filters and display
        filteredItems = filterPlainArray(products, filters);
        displayProducts(filteredItems);
    });

    loadProducts();
});

// ------------End of onload-----------
    


window.addEventListener("load", function(){
    const productsList = document.getElementById('productsList');
    const searchBar = document.getElementById('searchBar');
    const searchBtn = document.querySelector('.searchBtn');
    
    //Price
    const minPrice = document.getElementById('min-price');
    const maxPrice = document.getElementById('max-price');

    // Category boxes
    const showAll = document.querySelector("input[name=all]");
    const vehicle = document.querySelector("input[name=vehicle]");
    const clothing = document.querySelector("input[name=clothing]");
    const electronics = document.querySelector("input[name=electronics]");
    const books = document.querySelector("input[name=books]");
    const accessories = document.querySelector("input[name=accessories]");
    
    let filters = {
         listingName: [],
         category: []
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
    
    // Price
    
    minPrice.addEventListener('keyup', (e) => {
        const minAmt = e.target.value;
        const maxAmt = maxPrice.value;
        const filteredPrices = products.filter((product) => {
            if (minAmt ===""){
                if (maxAmt===""){
                     return product.listingPrice >= 0;
                }else{
                     return product.listingPrice <= parseFloat(maxAmt);
                }
            }else if (maxAmt===""){
                return product.listingPrice >= parseFloat(minAmt);
            }else{
                return product.listingPrice >= parseFloat(minAmt) && product.listingPrice <= parseFloat(maxAmt);
            }
           
        });
        console.log(parseFloat(minAmt));
        console.log(parseFloat(maxAmt));
        console.log(filteredPrices);
        displayProducts(filteredPrices);
    });
    
    maxPrice.addEventListener('keyup', (e) => {
        const minAmt = minPrice.value;
        const maxAmt = e.target.value;
        
        const filteredPrices = products.filter((product) => {
           if (maxAmt ===""){
                if (minAmt===""){
                     return product.listingPrice >= 0;
                }else{
                     return product.listingPrice >= parseFloat(minAmt);
                }
            }else if (minAmt===""){
                return product.listingPrice <= parseFloat(maxAmt);
            }else{
                return product.listingPrice >= parseFloat(minAmt) && product.listingPrice <= parseFloat(maxAmt);
            }
        });
         console.log(parseFloat(minAmt));
        console.log(parseFloat(maxAmt));
        console.log(filteredPrices);
        displayProducts(filteredPrices);

    });
    
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
          loadProducts();
        }
    });
    
    // Vehicle filter
    vehicle.addEventListener('change', function(){
         if (this.checked){
            // Push category to the array of filters
            filters.category.push("vehicles");
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
    
    // Accessories filter
    accessories.addEventListener('change', function(){
        if (this.checked){
            // Push category to the array of filters
            filters.category.push("accessories");
        } else {
            // Remove from array when box is unchecked
            let arr = filters.category;
            for( var i = 0; i < arr.length; i++){ 
                if ( arr[i] === "accessories") { 
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
    


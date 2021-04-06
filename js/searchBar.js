window.addEventListener("load", function(){
    const charactersList = document.getElementById('charactersList');
    const searchBar = document.getElementById('searchBar');
    
    //Categories
   
    const showAll = document.querySelector("input[name=all]");
    const vehicle = document.querySelector("input[name=vehicle]");
    const clothing = document.querySelector("input[name=clothing]");
    const electronics = document.querySelector("input[name=electronics]");
    const books = document.querySelector("input[name=books]");
    

    let hpCharacters = [];
    
    searchBar.addEventListener('keyup', (e) => {
        const searchString = e.target.value.toLowerCase(); // Get input value
        // Filter the results by name and house. Always convert to lowercase
        const filteredCharacters = hpCharacters.filter((character) => {
           return ( 
                character.name.toLowerCase().includes(searchString) ||
                character.house.toLowerCase().includes(searchString)
            );
        });
        displayCharacters(filteredCharacters);
        console.log(filteredCharacters)
    });

    //load items from the API
    //TODO: implement our own API
    const loadCharacters = async () => {
        try {
            const res = await fetch('https://hp-api.herokuapp.com/api/characters');
            hpCharacters = await res.json();
            displayCharacters(hpCharacters);
        } catch (err) {
            console.error(err);
        }
    };

    //get details from API and inject them in HTML
    const displayCharacters = (characters) => {
        const htmlString = characters
            .map((character) => {
                return `
                <li class="card">
                  <div class="card-content">
                    <a href="studentdata/placeholder/marketplace/listingpage.php">
                        <h2>${character.name}</h2>
                        <p>House: ${character.house}</p>
                        <img src="${character.image}"></img>
                    </a>
                  </div>
                </li>
            `;
            })
            .join('');
        charactersList.innerHTML = htmlString;
    };
    
    
    // Categories

    // Every time a checkbox status is changed all boxes are unchecked except
    // for the one just checked, so that only one box is checked at a time
    $('input[type="checkbox"]').on('change', function() {
       $('input[type="checkbox"]').not(this).prop('checked', false);
    });
    
    // 'Show all' filter
    showAll.addEventListener('change', function(){
        if (this.checked){
         loadCharacters();
        }
    });
    
    // Vehicle filter
    vehicle.addEventListener('change', function(){
        if (this.checked){
         const filteredCharacters = hpCharacters.filter((character) => {
           return character.house.includes("Gryffindor");
        });
        displayCharacters(filteredCharacters);
        }
    });
    
    // Clothing filter
    clothing.addEventListener('change', function(){
        if (this.checked){
         const filteredCharacters = hpCharacters.filter((character) => {
           return character.house.includes("Slytherin");
        });
        displayCharacters(filteredCharacters);
        }
    });
    
    // Electronics filter
    electronics.addEventListener('change', function(){
        if (this.checked){
         const filteredCharacters = hpCharacters.filter((character) => {
           return character.house.includes("Hufflepuff");
        });
        displayCharacters(filteredCharacters);
        } 
    });
        
    // Books filter
    books.addEventListener('change', function(){
       if (this.checked){
         const filteredCharacters = hpCharacters.filter((character) => {
           return character.house.includes("Ravenclaw");
        });
        displayCharacters(filteredCharacters);
        }
    });

    
    loadCharacters();

});



window.addEventListener("load", function(){
    const charactersList = document.getElementById('charactersList');
    const searchBar = document.getElementById('searchBar');
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

loadCharacters();
});


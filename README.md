run: ```docker compose up```

url: http://localhost:3000  (porta mappata via docker webserver container)

user: root@example.com
pswd: password


**Note**:


- Dopo il login utente mostro il token in pagina.

- Lanciando la call da FE verso endpoint Laravel di backend uso il bearer token nell'header Authorization per autenticare la chiamata.

- Note sul frontend: la pagina da dove lanciare la API call è /breweries.
Ho evitato di renderizzare la pagina in js, ho fatto tutto in un'unica pagina html/blade senza usare layouts, ecc..

- per praticità ho versionato anche il .env (che non dovrebbe mai andare sul repo)
  (commentato in .gitignore)

- **Paginazione**: fatta manualmente sfruttando i parametri ```page=``` e ```per_age=``` dell'Api. Arbitrariamente la lista paginata prende **10 items** per pagina (ma si potrebbe parametrizzare).
Conoscendo il numero totale degli items (da fare con un'altra chiamata Api verso https://api.openbrewerydb.org/v1/breweries/meta) si può affinare la paginazione deducendo il numero totale delle pagine)

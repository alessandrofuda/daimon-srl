run: ```docker compose up```

url: http://localhost:3000  (porta mappata via docker webserver container)

user: root@example.com
pswd: password


**Note**:


- Dopo il login utente mostro il token in pagina.

- Lanciando la call da FE verso endpoint laravel di backend uso il bearer token nell'header Authorization per autenticare la chiamata.

- Note sul frontend: la pagina pubblica da dove lanciare la API call è /breweries.
Ho evitato di renderizzare la pagina in js, ho fatto tutto in un'unica pagina html/blade senza usare layouts, ecc..

- per praticità in via eccezionale ho versionato anche il .env (che non dovrebbe mai andare sul repo)
  (commentato in .gitignore)

- **Paginazione**: sfrutto i parametri ```page=``` e ```per_age=``` dell'Api. La lista paginata prende **10 items** per pagina (ma si potrebbe parametrizzare). 
Per switchare tra le pagine aggiungere/modificare la parametro ```&page=..``` direttamente in url (se non presente (comportamento di default) --> va a pagina 1).
  (Invece: per creare la classica paginazione di Laravel col Paginator, usando $breweries->links() direttamente in blade mi restituisce un errore da indagare ulteriormente).

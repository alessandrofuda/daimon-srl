run: ```docker compose up```

url: http://localhost:3000  (porta mappata via docker webserver container)

user: root@example.com
pswd: password


Note:


- Dopo il login utente mostro il token in pagina.

- Lanciando la call da FE verso endpoint laravel protetto uso il bearer token nell'header Authorization per autenticare la chiamata

- Note sul frontend: la pagina pubblica da dove lanciare la API call è /breweries.
Ho evitato di renderizzare la pagina in js, ho fatto tutto in un'unica pagina html/blade senza usare layouts, ecc..

- per praticità in via eccezionale ho versionato anche il .env (che non dovrebbe mai andare sul repo)
  (commentato in .gitignore)

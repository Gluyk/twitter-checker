How to start? 
1) cp docker-compose.override.yml.dist docker-compose.override.yml  
2) Build and up! docker-compose up --build
3) make composer-install  
4) make migrations-migrate
5) add twitter-bearer-token at setting page. (with twitter-bearer-token like a key and you key like a value)
6) Add filters (pilulka.cz, #pilulka, #pilulkacz)

For get all from api
>curl -X GET "http://localhost:8081/api/twitter_contents?page=1" -H  "accept: application/ld+json"

Or visit /api

    Logic for work with twitter api at src/Service/TwitterService.php

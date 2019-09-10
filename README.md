# DPP
Docker - Php - Python

# Requirements


    git
    docker

# Setup

    git clone git@github.com:amineHKS/DPP.git cd DPP/docker/


    docker-compose build --no-cache && docker-compose up -d --force-recreate

# Create Table

    docker exec oney-app ./bin/console doctrine:migrations:migrate --no-interaction

# Run API

- Add new distance : 

    http://127.0.0.1:80/distance/new

Post object Exemple:

    {
        "address_ip": "8.8.8.8",
        "address_number": 12,
        "address_street": "rue cortot",
        "address_postal_code": 75018,
        "address_city": "paris",
        "address_country": "france"
    }

# Routes available

- show all distances stored on mysql Database http://127.0.0.1:80/distance/
- Edit distance : http://127.0.0.1:80/distance/{id}/edit
- delete distance : http://127.0.0.1:80/distance/delete/{id}/


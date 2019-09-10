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

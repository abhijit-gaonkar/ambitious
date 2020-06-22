# ambitious
Ambitious goal of rebuilding Amazon.com’s shopping experience as a set of microservices

### Build Base Image
docker build -t php-basic-nginx:latest -f Docker/nginx/Dockerfile .
docker build -t php-basic-php-fpm:latest -f Docker/php-fpm/Dockerfile .

### Build the stack locally
docker-compose up -d 
Note docker-compose.yml is used for development only.

### Register to ECR and push Images
aws ecr create-repository --repository ambitious/php
docker tag php-basic-php-fpm 290988396993.dkr.ecr.us-west-1.amazonaws.com/ambitious/php
docker push 290988396993.dkr.ecr.us-west-1.amazonaws.com/ambitious/php

aws ecr create-repository --repository ambitious/nginx
docker tag php-basic-nginx 290988396993.dkr.ecr.us-west-1.amazonaws.com/ambitious/nginx
docker push 290988396993.dkr.ecr.us-west-1.amazonaws.com/ambitious/nginx

### Create Cluster
aws ecs create-cluster --cluster-name ambitious

### Create Cluster Task Definition
aws ecs register-task-definition --cli-input-json file://web-task-definition.json

### Run Task
aws ecs run-task --cluster ambitious --task-definition web --count 1

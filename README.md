# Ambitious
Ambitious goal of rebuilding Amazon.com’s shopping experience as a set of microservices.<br>

This is the **Auth** service which implements OAuth2 grant-type password.

#### Build Base Image
docker build -t php-basic-nginx:latest -f Docker/nginx/Dockerfile .<br>
docker build -t php-basic-php-fpm:latest -f Docker/php-fpm/Dockerfile .<br>

#### Build the stack locally
docker-compose up -d <br>
__Note: docker-compose.yml is used for development only.__

#### Docker Login in ECR
aws ecr get-login-password --region us-west-1 | docker login --username AWS --password-stdin xxxxxx.dkr.ecr.us-west-1.amazonaws.com

#### Register Images in ECR and push Images
aws ecr create-repository --repository ambitious/php
docker tag php-basic-php-fpm [AWS_ACCOUNT_ID].dkr.ecr.us-west-1.amazonaws.com/ambitious/php
docker push [AWS_ACCOUNT_ID].dkr.ecr.us-west-1.amazonaws.com/ambitious/php

aws ecr create-repository --repository ambitious/nginx
docker tag php-basic-nginx [AWS_ACCOUNT_ID].dkr.ecr.us-west-1.amazonaws.com/ambitious/nginx
docker push [AWS_ACCOUNT_ID].dkr.ecr.us-west-1.amazonaws.com/ambitious/nginx


## Deploy Application to AWS
Run Cloudformation script in AWS EcsStack.json





### CI/CD
CI CD is accomplished by Gihub Actions Workflow: Deploy to ECS
Refer aws.yml file for Workflow Definition.

Create a Release..


#### Create Cluster
aws ecs create-cluster --cluster-name ambitious

#### Create Cluster Task Definition
aws ecs register-task-definition --cli-input-json file://web-task-definition.json

#### Run Task
aws ecs run-task --cluster ambitious --task-definition web --count 1

#### Create Service
aws ecs create-service --cluster ambitious --service-name web --task-definition  web --desired-count 1

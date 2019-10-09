default: help

build: ## Build docker compose
	@docker-compose build

up: ## Start containers
	docker-compose up -d

destroy: ## Destroys containers
	docker-compose down

stop: ## Stops containers
	docker-compose stop

help: ## This help message
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' -e 's/:.*#/: #/' | column -t -s '##'

ssh-web: ## SSH into web server container
	docker-compose exec apiwebserver /bin/bash

ssh-mysql: ## SSH into mysql server container
	docker-compose exec db /bin/bash

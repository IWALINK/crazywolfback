up:
	docker-compose up -d --build

dev:
	docker-compose -f docker-compose.dev.yml up -d --build

prod:
	docker-compose up -d --build

dev-down:
	docker-compose -f docker-compose.dev.yml down -v

prod-down:
	docker-compose down -v

dev-restart:
	make dev-down
	make dev

prod-restart:
	make prod-down
	make prod

dev-logs:
	docker-compose -f docker-compose.dev.yml logs -f

prod-logs:
	docker-compose logs -f

down:
	docker-compose down -v

restart:
	make down
	make up

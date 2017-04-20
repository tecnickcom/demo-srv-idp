# MAKEFILE
#
# @author      Nicola Asuni <nicola.asuni@miracl.com>
# @link        https://github.com/miracl/demo-srv-idp
# ------------------------------------------------------------------------------

.PHONY: help start stop clean

help:
	@echo ""
	@echo "The following commands are available:"
	@echo ""
	@echo "    make start  : Build and run Docker containers"
	@echo "    make stop   : Stop Docker containers"
	@echo "    make clean  : Stop and remove Docker containers"
	@echo ""

start:
	docker-compose up -d --force-recreate
	sleep 10
	docker cp config.json demo-srv-idp-consul:/tmp/config.json
	docker exec demo-srv-idp-consul curl --request PUT --data @/tmp/config.json http://127.0.0.1:8500/v1/kv/config/srv-idp
	docker cp ldap_users.ldif demo-srv-idp-ldap:/tmp/ldap_users.ldif
	docker exec demo-srv-idp-ldap ldapadd -x -H ldap://127.0.0.1:389/ -D "cn=admin,dc=example,dc=com" -w password -f /tmp/ldap_users.ldif
	docker-compose restart idp

stop:
	docker-compose down

clean:
	docker-compose down --rmi all

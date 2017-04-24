@ECHO OFF
C:
CD\
CLS

:MENU
CLS

ECHO =========== demo-srv-idp ============
ECHO -------------------------------------
ECHO 1.  Build and run Docker containers
ECHO 2.  Stop Docker containers
ECHO 3.  Stop and remove Docker containers
ECHO -------------------------------------
ECHO ========= PRESS 'Q' TO QUIT =========
ECHO.

SET INPUT=
SET /P INPUT=Please select a number:

IF /I '%INPUT%'=='1' GOTO Start
IF /I '%INPUT%'=='2' GOTO Stop
IF /I '%INPUT%'=='3' GOTO Clean
IF /I '%INPUT%'=='Q' GOTO Quit

CLS

ECHO =========== INVALID INPUT ===========
ECHO -------------------------------------
ECHO Please select a number from the Main
echo Menu [1-3] or select 'Q' to quit.
ECHO -------------------------------------
ECHO ===== PRESS ANY KEY TO CONTINUE =====

PAUSE > NUL
GOTO MENU

:Start

docker-compose up -d --force-recreate
sleep 10
docker cp config.json demo-srv-idp-consul:/tmp/config.json
docker exec demo-srv-idp-consul curl --request PUT --data @/tmp/config.json http://127.0.0.1:8500/v1/kv/config/srv-idp
docker cp ldap_users.ldif demo-srv-idp-ldap:/tmp/ldap_users.ldif
docker exec demo-srv-idp-ldap ldapadd -x -H ldap://127.0.0.1:389/ -D "cn=admin,dc=example,dc=com" -w password -f /tmp/ldap_users.ldif
docker-compose restart idp

:Stop

docker-compose down

:Clean

docker-compose down --rmi all

:Quit
CLS

EXIT

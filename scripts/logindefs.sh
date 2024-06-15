#!/bin/bash
# ------------- Colores
clear
red="\e[0;91m"
cyan="\e[0;36m"
magenta="\e[0;35m"
blue="\e[0;94m"
Purple='\033[0;35m'       
celeste="\e[0;34m"
green="\e[0;92m"
amarillo="\e[0;93m"
reset="\e[0m"
# -------------  

while [ $s==0 ]
do
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	echo 	"           ${Purple}M E N U   D E   O P C I O N E S              "
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	echo "																	"
	echo "           ${cyan}1. Ver archivo login.defs${reset}               "
	echo "           ${amarillo}2. Ver timepo maximo de login${reset}           "
	echo "           ${magenta}3. Ver variable de intentos de logeo${reset}    "
	echo "           ${green}4. Verificar estado de logs de ingresos correctos${reset}"
	echo "           ${blue}5. Volver${reset}                                "
	echo "           ${red}0. Salir${reset}                                 "
	echo "																	"
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	read opcion
	case $opcion in
		1) cat /etc/login.defs;; # Muestra el archivo login.defs
		2) grep -r "LOGIN_TIMEOUT" /etc/login.defs;; # Muestra la seccion de "LOGIN_TIMEOUT" del archivo login.defs y si no existe, muestra un mensaje de error.
		3) grep -r "LOGIN_RETRIES" /etc/login.defs;; # Muestra la seccion de "LOGIN_RETRIES" del archivo login.defs
		4) grep -r "LOG_OK_LOGINS"  /etc/login.defs;; # Muestra la seccion de "LOG_OK_LOGINS" del archivo login.defs
		5) sh Inicio.sh;; # Vuelve al menu principal
		0) exit;; # Cierra el script
		*) echo "La opcion que usted selecciono no es correcta";; # En caso de seleccionar una opcion que no pertenece a las del listado, indica que no es correcta.
	esac
done
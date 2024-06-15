#!/bin/bash
# ------------- Colores
clear
s="0"
red="\e[0;91m"
cyan="\e[0;36m"
magenta="\e[0;35m"
blue="\e[0;94m"
Purple='\033[0;35m'       
reset="\e[0m"
# -------------

while [ $s==0 ]
do
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	echo 	"           ${Purple}L O G I N              "
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	echo "																	"
	echo "           ${cyan}1. Ver los intentos de login${reset}               "
	echo "           ${magenta}2. Volver al Inicio${reset}               "
	echo "           ${red}0. Salir${reset}                                 "
	echo "																	"
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	read opcion
	case $opcion in 
	
		1) 
			# Busca los intentos de logeo / autenticacion fallidos en /var/log/auth.log en caso de no encontrar, mostrar un mensaje.
			if grep -E "authentication failure|Failed password" /var/log/auth.log
			then
				grep -E "authentication failure|Failed password" /var/log/auth.log
			else
				echo "No se encontraron intentos de login fallidos"
			fi;;
			
		2) sh Inicio.sh;; # Vuelve al menu principal

		0)
			echo "Saliendo..."
			exit;; # Cierra el script
		*)
			echo "La opcion $opcion que usted selecciono no es la correcta" # En caso de seleccionar una opcion que no pertenece a las del listado, indica que no es correcta.
		;;
	esac
done




















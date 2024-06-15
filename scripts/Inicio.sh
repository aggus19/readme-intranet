#!/bin/bash
# ------------- Colores
clear
s="0"
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
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	echo 	"           ${Purple}M E N U  P R I N C I P A L              "
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	echo "																	"
	echo "           ${cyan}1. Usuarios${reset}               "
	echo "           ${amarillo}2. Grupos${reset}           "
	echo "           ${magenta}3. Parametros${reset}    "
	echo "           ${green}4. Claves${reset}"
	echo "           ${red}5. Intentos login${reset}"
	echo "           ${blue}0. Salir${reset}                                "
	echo "																	"
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	
	read opcion
	case $opcion in
		1)
			sh abmlUsuarios.sh # Abre el script abmlUsuarios
		;;
		2)
			sh abmlGrupos.sh # Abre el script abmlGrupos	
		;;
		3)
			sh logindefs.sh	# Abre el script logindefs
		;;
		4)	
			sh abmlClaves.sh # Abre el script abmlClaves
		;;
		5)	
			sh loginLogs.sh # Abre el script LogingLogs
		;;
		0)
			echo "Saliendo..."
			exit # Cierra el script
		;;
		*)
			echo "La opcion $opcion que usted selecciono no es la correcta" # En caso de seleccionar una opcion que no pertenece a las del listado, indica que no es correcta.
		;;
    esac
done


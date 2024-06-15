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
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	echo 	"           ${Purple}C O N T R A S E Ñ A S              "
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	echo "																	"
	echo "    ${cyan}1. Cuantos dias durara una contraseña antes de ser cambiada${reset}            "
	echo "    ${amarillo}2. Tiempo minimo permitido entre cambios de contraseña${reset}           "
	echo "    ${magenta}3. Cambiar dias para avisar antes que caduzca la contraseña${reset}    "
	echo "    ${green}4. Volver${reset}"
	echo "    ${blue}0. Salir${reset}                                "
	echo "																	"
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	read opcion # Espera a que el usuario escriba un valor (del 0 al 4) dependiendo la opcion, se ejecuta una accion
	case $opcion in 
		1)
			echo "Cuanto tiempo durara esta contraseña?"
			read tiempo1
			echo "A que usuario se le aplicara?"				 
			read user1
			chage -M $tiempo1 $user1 # Toma como $tiempo1 el tiempo establecido que durara la contraseña, y como $user1 es el usuario que se le hace ese cmbio
		;;
		2)
			echo "Cada cuanto se podra cambiar la contraseña de esta cuenta?"
			read tiempo2
			echo "A que usuario se le aplicara?"
			read user2
			chage -m $tiempo2 $user2 # Toma como $tiempo2 el tiempo establecido que será para cambiar nuevamente la contraseña, y como $user2 es el usuario que se le hace ese cmbio
		;;
		3)	
			echo "Cuanto tiempo antes quieres avisar sobre el vencimiento de la contraseña?"
			read tiempo3
			echo "A que usuario se le aplicara?"
			read user3
			chage -W $tiempo3 $user3 # Toma como $tiempo3 el tiempo establecido que será para avisar sobre el vencimiento de la contraseña, y como $user3 es el usuario que se le hace ese cmbio
		;;
		4)
			echo "Volviendo..."
			sh Inicio.sh # Vuelve al menu principal
		;;
		0)	
			echo "Saliendo..."
			exit # Al presionar "0" se cierra el Script
		;;
		*)
			echo "La opcion $opcion que usted selecciono no es la correcta" # En caso de seleccionar una opcion que no pertenece a las del listado, indica que no es correcta.
		;;
	esac
done
exit


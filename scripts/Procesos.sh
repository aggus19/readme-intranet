#!/bin/bash
clear
s="0"
# ------------- Colores
red="\e[0;91m"
cyan="\e[0;36m"
magenta="\e[0;35m"
blue="\e[0;94m"
Purple='\033[0;35m'
celeste="\e[0;34m"
green="\e[0;92m"
amarillo="\e[0;93m"
cian="\e[1;36m"
gray="\e[1;30m"
reset="\e[0m"
# -------------

# ------------- Tipos de letra
bold=$(tput bold)
normal=$(tput sgr0)
# ------------


while [ $s==0 ]
do
	echo ${cian} "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" ${reset}
	echo 	     "           Configuracion de Procesos" 
	echo ${cian} "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" ${reset}
	echo ${gray}"      1. Listar todos los Procesos             "${reset}
	echo ${gray}"      2. Terminar un Proceso                   "${reset}
	echo ${gray}"      3. El proceso vuelva a leer sus archivos "${reset}
	echo ${gray}"      4. Parar un proceso momentaneamente      "${reset}
	echo ${gray}"      5. Volver                                "${reset}
	echo ${gray}"      0. Salir                                 "${reset}
	echo ${cian} "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" ${reset}
	read opcion
	case $opcion in
		1)
			ps aux
		;;
		2)
			echo "Que proceso deseas terminar?"
			read PID
			kill $PID
		;;
		3)
			echo "Que procesos deseas qeu vuelva a leer sus archivos?"
			read PID
			kill -HUP $PID
		;;
		4)
			echo "Que proceso desaeas que se detenga momentaneamente?"
			read PID
			kill -STOP $PID
		;;
		5)
			sh Inicio.sh	
		;;
		0)
			clear
			echo "Saliendo..."
			exit
		;;
		*)
			echo "La opcion $opcion no es correcta"
		;;
	esac
done

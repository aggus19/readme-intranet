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
	echo ${cian} "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" ${reset}
	echo "               Configuraciones de Red"
	echo ${cian} "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" ${reset}
	echo ${gray} "      1. Abrir el archivo de red               "${reset}
	echo ${gray} "      2. Aplicar cambios de la configuracion   "${reset}
	echo ${gray} "      5. Volver                                "${reset}
	echo ${gray} "      0. Salir                                 "${reset}
	echo ${cian} "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" ${reset}
	read opcion
	case $opcion in
		1)
			vi /etc/netplan/00-installer-config.yaml
		;;
		2)
			netplan apply
		;;
		5)
			echo "Volviendo..."
			sh Inicio.sh
		;;
		0)
			echo "Saliendo..."
			exit
		;;
		*)
			echo "La opcion $opcion no es correcta"
		;;		
	esac
done

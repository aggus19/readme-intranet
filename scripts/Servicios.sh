#!/bib/bash
clear
s="0"
# ------------- Colores
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
	echo ${cian} "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" ${reset}
	echo ${bold} " Configuracion de lo Servicios del Servidor " ${normal}
       	echo ${cian} "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" ${reset}
	echo ${gray}"          1. Listar Servicios                "${reset}
	echo ${gray}"          2. Iniciar un Servicio             "${reset}
	echo ${gray}"          3. Detener un Servicio             "${reset}
	echo ${gray}"          4. Estado de un Servicio           "${reset}
	echo ${gray}"          5. Volver                          "${reset}
	echo ${gray}"          0. Salir                           "${reset}
	echo ${cian} "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" ${reset}
	read opcion
	case $opcion in
		1)
			systemctl list-unit-files --type service --all
		;;
		2)
			echo "Que servicio desea iniciar?"
			read servicio
			systemctl start $servicio
		;;
		3)
			echo "Que servicio desea detener?"
			read servicio
			systemctl stop $servicio
		;;
		4)
			echo "De que servicio desea conocer el estado?"
			read servicio
			systemctl status $servicio
		;;
		5)
			echo "Volviendo..."
			sh Inicio.sh
		;;
		0)
			clear
			echo "Saliendo..."
			exit
		;;
		*)
			echo "La opcion $opcion no es valida"
		;;
	esac
done

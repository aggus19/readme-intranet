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
	echo 	"           ${Purple}G R U P O S              "
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	echo "																	"
	echo "           ${cyan}1. Crear grupo${reset}               "
	echo "           ${amarillo}2. Agregar usuario al grupo${reset}           "
	echo "           ${magenta}3. Eliminar grupo${reset}    "
	echo "           ${green}4. Listar grupos y usuarios${reset}"
	echo "           ${blue}5. Modificar permisos${reset}                                "
	echo "           ${blue}6. Volver${reset}                                "
	echo "           ${red}0. Salir${reset}                                 "
	echo "																	"
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	read opcion
	case $opcion in 
	
		1) 
			echo "Que nombre le dara al grupo?"
			read gruponame
			groupadd $gruponame # Crea un grupo con el nombre que le escriba el usuario
		;;

		2) 
			echo "A que grupo quiere agregar al usuario?"
			read grupo
			echo "Que usuario quiere agregar al grupo?"
		    read user
			usermod -G $grupo $user # La variable $grupo es el grupo y $user es el usuario, ambos escritos por la persona y el script lo añade
		;;

		3) 
			echo "Que grupo desea eliminar?"
			read borrar
			groupdel $borrar # Elimina el grupo escrito por el usuario como $borrar
		;;

		4) cut -d ":" -f1,4 /etc/group;;  # Muestra grupos y usuarios

		5) nano /etc/sudoers;; # Abre el archivo sudoers

		6) sh Inicio.sh;; # Vuelve al menu principal

		0) exit;; # Cierra el script

		*)
			echo "La opcion $opcion que usted selecciono no es la correcta" # En caso de seleccionar una opcion que no pertenece a las del listado, indica que no es correcta.
		;;
	esac
done

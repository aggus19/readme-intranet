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
	echo 	"               ${Purple}U S U A R I O S             "
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	echo "																	"
	echo "           ${cyan}1. Crear${reset}               "
	echo "           ${amarillo}2. Eliminar${reset}           "
	echo "           ${magenta}3. Modificar${reset}    "
	echo "           ${green}4. Listar${reset}"
	echo "           ${blue}5. Modificar permisos${reset}                                "
	echo "           ${blue}6. Volver${reset}                                "
	echo "           ${red}0. Salir${reset}                                 "
	echo "																	"
	echo "${blue}・━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ ・${reset}"
	read opcion
	case $opcion in
		1)
			echo "Ingresar nombre del usuario:"
			read nombre
			echo "\nIngrese el directorio y nombre de logueo:"
			read logueo
			useradd -c"$nombre" -d /home/$logueo -m -s/bin/bash -k /etc/skel $logueo
			echo "\nUsuario creado correctamente \n" # Crea un usuario definiendo su nombre y directorio
		;;
		2)
			echo "Ingresar nombre de logueo del usuario que desea eliminar:"
			read nombreU
			echo "Usuario eliminado correctamente \n"
			userdel $nombreU # Elimina un usuario del sistema
		;;	
		3)
			echo "Ingrese nombre del usuario:"
			read nombre
			echo "\nIngresar modificacion:"
			read modificacion
			echo "Usuario modificado correctamente \n"
			usermod -c $modificacion $nombre	# Modifica el usuario dependiendo el parametro elegido 
		;;
		4)
			cut -d ":" -f1 /etc/passwd # Lista los usuarios
		;;
		5)
			nano /etc/sudoers # Abre el archivo para modificar permisos
		;;
		6)
			echo "Volviendo..."
			sh Inicio.sh  # Vuelve al menu principal
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

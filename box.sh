#!/bin/bash

# -*- ENCODING: UTF-8 -*-

#proyecto=@@nombre_proyecto@@

proyecto=${PWD##*/}
echo $proyecto
if [[ $1 ]] || [[ $2 ]] || [[ $3 ]]; then

	if [[ $1 ]]; then
		if [[ $2 ]] || [[ $3 ]]; then
		    	echo ""
				for i in {0..75} {75..0} ; do echo -en "\e[38;5;256m-\e[0m" ; done ; echo
				echo -e '\E[37;44m'"\033[5m Vista "$2" creada y enlazada al layout "$1".php \033[0m"  
		    	echo ""
				for i in {0..75} {75..0} ; do echo -en "\e[38;5;256m-\e[0m" ; done ; echo
				echo -e '\E[37;44m'"\033[5m Controlador "$1" creado. \033[0m"  

				if [ ! -d "$1/$2" ]; then
					cd resources/jade
				    echo "archivo no existe"
				    mkdir -m 777 $1
				    cd $1 
				    mkdir -m 777 $2
				    cd ..
				    sudo chmod 777 -R $1
				    cd ..
				    cd ..
				    ls
				fi
				php artisan make:view $3 --extension=jade --extends=layouts.$1 --directory=resources/jade/$1/$2/ --section=content
				# sudo php artisan make:view $3 --extends=layouts.$1 --directory=resources/views/$1/$2/ --section=content
		    	gulp
		    	php artisan make:controller ${1^}/PrincipalController
		    	php artisan make:controller ${1^}/${2^}Controller --resource
		    	cd ..
		    	sudo chmod 777 -R $proyecto;
		    	echo ${1^}
		    	for i in {0..75} {75..0} ; do echo -en "\e[38;5;256m-\e[0m" ; done ; echo
				echo ""
		else
			echo ""
			for i in {0..75} {75..0} ; do echo -en "\e[38;5;256m-\e[0m" ; done ; echo
			echo ""
			for i in {0..75} {75..0} ; do echo -en "\e[38;5;256m-\e[0m" ; done ; echo
			echo -e '\E[37;44m'"\033[5m Vista "$1" creada. \033[0m"  
			sudo ./html.sh $2 $3 $4 $proyecto
			for i in {0..75} {75..0} ; do echo -en "\e[38;5;256m-\e[0m" ; done ; echo
			echo ""
		fi
		#sudo ./html.sh $2 $3 $4 $proyecto
	fi
else
	echo ""
	for i in {0..75} {75..0} ; do echo -en "\e[38;5;256m-\e[0m" ; done ; echo
	echo -e "\e[1m  Ingrese un comando ejemplo: box, stylus, migrar  \033[0m"
	echo ""
	echo -e "\e[1m Creador de vistas\033[0m"
	echo " Este comando genera automaticamente carpetas, vistas y contraladores partiendo de parametros de roles."
	echo -e "\e[7m ejemplo-> $ box admin archivos ingresar\033[0m"
	echo ""	
	for i in {0..75} {75..0} ; do echo -en "\e[38;5;256m-\e[0m" ; done ; echo
	echo ""
fi


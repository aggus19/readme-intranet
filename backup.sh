#! Backup de SQL ==============================================================================
  
FECHA_ACTUAL=`date "+%d-%m-%Hhs"`
CARPETA=`date "+%d-%m"`

IP=localhost
USER=''
PASS=''
TIEMPO_ESPERA="3"


echo "\n[+] Generando copia de la base de datos... espere ${TIEMPO_ESPERA} segundos..."
sleep ${TIEMPO_ESPERA}

if [ ! -d "/home/backup/sql/${CARPETA}" ]; then
        mkdir -p "/home/backup/sql/${CARPETA}"
fi

#! ==============================================================================

mysqldump -h ${IP} --user=${USER} --password=${PASS} 'biblioteca' >> /home/backup/sql/"${CARPETA}"/biblioteca-"${FECHA_ACTUAL}".sql
echo "[*] Finalizado [sql-backup] \n" 

#! Backup de Apache ==============================================================================

echo "[+] Generando copia de los archivos de Apache... espere ${TIEMPO_ESPERA} segundos..."
sleep ${TIEMPO_ESPERA}

if [ ! -d "/home/backup/apache/" ]; then
        mkdir -p "/home/backup/apache"
fi

cp -r "/etc/apache2/sites-available" "/home/backup/apache"
cp -r "/etc/apache2/sites-enabled" "/home/backup/apache"
cp -r "/etc/apache2/apache2.conf" "/home/backup/apache"

echo "[*] Finalizado [apache2-backup] (config & sites) \n" 

echo "\n[+] Eliminando el anterior Backup de Github"
cd /var/www/panel/
rm -rf backup-*
git pull
git add .
git commit -m "Deleted old backup"
git push

echo "[+] Generando .zip del contenido de la carpeta..."
zip -r backup-${FECHA_ACTUAL}.zip /home/backup/apache /home/backup/sql
sleep ${TIEMPO_ESPERA}

echo "\n[+] Subiendo en Github el backup"
cd /var/www/panel/
git pull
git add backup-*
git commit -m "New Backup ${FECHA_ACTUAL}"
git push

echo "[*] Finalizado [github-backup] \n"
sleep ${TIEMPO_ESPERA}
echo "[*] Eliminando backups anteriores \n"
cd /home/backup/
rm -rf backup-*
sleep ${TIEMPO_ESPERA}


echo "\n[+] Eliminando .zip de la carpeta html..."
rm -rf backup-${FECHA_ACTUAL}.zip
rm -rf /home/backup/apache /home/backup/sql
echo "\n[=] Finalizado."


#! ==============================================================================

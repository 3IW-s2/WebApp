#!/bin/bash

# Paramètres de connexion à la base de données PostgreSQL
DB_HOST="46.226.107.16"
DB_PORT="5432"
DB_NAME="database_tiw"
DB_USER="postgres"
DB_PASSWORD="postgres"




#Chemin de sauvegarde
BACKUP_DIR="./Backup/"


#Nom du fichier de sauvegarde (basé sur la date et l'heure)
BACKUP_FILENAME="backup_$(date +%Y%m%d%H%M%S).sql"

# Définition du mot de passe en tant que variable d'environnement
export PGPASSWORD="$DB_PASSWORD"

# Commande  de sauvegarde
pg_dump -h "$DB_HOST" -p "$DB_PORT" -U "$DB_USER" -d "$DB_NAME" -F p > "$BACKUP_DIR/$BACKUP_FILENAME"

# Vérification du statut de la sauvegarde
if [ $? -eq 0 ]; then
  echo "Sauvegarde terminée avec succès : $BACKUP_FILENAME"
else
  echo "Erreur lors de la sauvegarde de la base de données."
fi

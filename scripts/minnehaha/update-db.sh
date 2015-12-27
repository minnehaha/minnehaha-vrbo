#!/bin/bash
MUSER="$1"
MPASS="$2"
MDB="$3"

# Detect paths
MYSQL=$(which mysql)
MYSQLDUMP=$(which mysqldump)
AWK=$(which awk)
GREP=$(which grep)

echo "*****backing up into minnehaha_view_drupal_date.sql******"
suffix=$(date "+%Y-%m-%d")
$MYSQLDUMP -u $MUSER -p$MPASS $MDB>minnehaha_view_drupal_$suffix.sql

if [ $# -ne 3 ]
then
	echo "Usage: $0 {MySQL-User-Name} {MySQL-User-Password} {MySQL-Database-Name}"
	echo "Drops all tables from a MySQL"
	exit 1
fi

TABLES=$($MYSQL -u $MUSER -p$MPASS $MDB -e 'show tables' | $AWK '{ print $1}' | $GREP -v '^Tables' )

for t in $TABLES
do
	echo "Deleting $t table from $MDB database..."
	$MYSQL -u $MUSER -p$MPASS $MDB -e "drop table $t"
done

echo "******************"
echo "****Importing*****"
$MYSQL -u $MUSER -p$MPASS -h localhost $MDB < minnehaha_view_drupal.sql
echo "...done"
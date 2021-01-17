/!\ ATTENTION /!\


PROJET FAIT SOUS MYSQL VERSION 5.7.31


J'ai testé le projet sur mon PC portable qui est en  version 8.0 et j'ai ce message : SQL Error [1525] [HY000]: Incorrect DATETIME value: ''

Après recherches, j'en ai conclu que ce qui causait ce problème était très probablement dû à la version de MYSQL étant donné que tout fonctionne sur mon PC FIXE mais pas sur mon PC portable.

Voici entre autres ce qui m'a convaincu dans ma théorie (voir la réponse du post) : https://stackoverflow.com/questions/62230150/sql-error-1525-hy000-incorrect-datetime-value 


----->  "It's seems not related to database changes itself, but something changed in version 8.0.16 regarding comparison on DATETIME and TIMESTAMP types against strings. The behavior is documented already in 8.0.16 change log as following:

When comparing DATE values with constant strings, MySQL first tries to convert the string to a DATE and then to perform the comparison. When the conversion failed, MySQL executed the comparison treating the DATE as a string, which could lead to unpredictable behavior. Now in such cases, if the conversion of the string to a DATE fails, the comparison fails with ER_WRONG_VALUE. (Bug #29025656)

Also, this is reported as a bug here.

PD: Your query works on my old 5.7 MySQL version."
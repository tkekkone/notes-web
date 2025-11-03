# Rsync for backup

Backing up photos with rsync. This will copy from source to destination. If file is deleted in source afterwards, it goes to \_old\_ folder in target.


```
rsync -vrb --timeout=60 --delete --time-limit=30 --backup-dir=_old_/$(date +%F) \
--suffix=$(date +_%F-%T) --update --times /photo /backup/ &>> /var/log/backup.log
```

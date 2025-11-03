# Importing docker images to wsl

Just first run the container and use export. The entrypoint has to be bash or something in the image so that it stays on. Otherwise replace that. After export its fine to stop the container. I dont know if the filesystem could be exported from image but at least havent found a way to do that.

This step can be run anywhere to get the .tar file.
```
docker run --rm --name klwsl -it -d tkekkone/kekkislinux
docker export --output kekkislinuxfs.tar klwsl
docker stop klwsl
```

Then import the tar file as wsl distribution. I think this only works in windows cmd. This creates the folder for the wsl distro in the current folder.

```
wsl --import kekkislinux .\kekkislinux\ .\kekkislinuxfs.tar
```


You can then delete the .tar. The wsl directory has to stay.

```
del kekkislinuxfs.tar
```

You can set the distro as default

```
wsl --set-default kekkislinux
```

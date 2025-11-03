# Running windows apps without rdp

From CI pipelines you might want to run Windows applications with GUI for testing purposes. This is a nightmare but it almost works. This ntends to run the whole thing without ever opening the windows desktop(as god intended it). This setup is based on azure vms.

## Prepare windows image

Create your windows image for example with packer. Not covering that here but using base image from azure for windows 2022 server and running packer provisioner to install things like chocolatey and then packages with that.

Software thats needed:
* Psexec - Found from choco, its sysinternals tool
* Autologon - Another sysinternals tool to setup so that user automatically logs in on startup
* Openssh - Openssh server to get remote powershell to the machine

## Deploy vm from image

Run the usual az resource deploy. At deploy time, call autologon to set your user to automatically log in. That goes like 
```
autologon username computername password
```
You also set username and password for the admin user here usually.

## Prepare ssh 

Once the machine is running you can call the az run command to echo the ssh key to the proper place.

## Install rest of the software

Install the software you cannot have in the image. Usually the software under test. Through ssh somehow. Ansible or choco.

## Reboot

You must reboot at some point so that the autologon thing kicks in

## Connect and execute program

Now you should be able to ssh and call powershell to run the psexec that runs the gui program. First you can check the current sessions with `qwinsta` and in session id 1 there should be a session open with your user because autologon started it.

```
psexec -accepteula -u user -p pass -di 1 calc
```
This starts calc on session 1 which is the default local user desktop session. Accepteula is important and otherwise psexec just hangs because it displays the eula on desktop session somewhere.

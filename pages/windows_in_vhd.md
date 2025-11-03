# Boot directly to virtual machine

You can set an vhdx image to appear as boot option by first mounting it as a drive in windows and then  on admin command prompt calling 

```
bcdboot <drive>:\Windows

```

Mounting is easy, just right click and mount on the vhdx file.

bcdedit can be used to edit the entry. 

# Graphics card to guest

Amd 5800x

`echo "options vfio-pci ids=10de:1b80,10de:10f0 disable_vga=1"> /etc/modprobe.d/vfio.conf`

Kernel arguments

`iommu=pt initcall_blacklist=sysfb_init`

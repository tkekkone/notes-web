# Routing to localhost

Routing form any network to localhost port. Useful when creating tunnels and such to localhost. First set the prerouting rule to iptables.

```
iptables -t nat -A PREROUTING -d 172.18.0.1/32 -p tcp -m tcp --dport 6443 -j DNAT --to-destination 127.0.0.1:5443
```

Adjust kernel paremeters.

```
sudo sysctl net.ipv4.conf.br-6840ca53108f.route_localnet=1
```


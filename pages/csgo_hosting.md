# Running csgo server as a noob

Run with docker compose to get all env config done easily

```
version: "3.8"
services:
  csgo:
    network_mode: host
    volumes:
      - "/home/user/csgo/steammount:/home/steam/csgo-dedicated/"
    image: cm2network/csgo
    environment:
      - SRCDS_PORT=27015
      - SRCDS_TV_PORT=27020
      - SRCDS_NET_PUBLIC_ADDRESS="0" (public facing ip, useful for local network setups)
      - SRCDS_IP="0" (local ip to bind)
      - SRCDS_FPSMAX=300
      - SRCDS_TICKRATE=128
      - SRCDS_MAXPLAYERS=14
      - SRCDS_STARTMAP="de_dust2"
      - SRCDS_REGION=3
      - SRCDS_MAPGROUP="mg_active"
      - SRCDS_GAMETYPE=0
	...
```

to configure remote server use rcon_address and rcon_pasword. Then use commands as usual but prefix with rcon ...


| Command       | Example |Effect     | 
| :------------- | :----------: | :------|
|map | map de_dust| Change map |
|mp_restartgame | map de_dust| Change map |
|mp_warmup_end | - | Change map |
|map | map de_dust| Change map |

Execute configs from /cfg. Executing esl5on5.cfg:

```
exec esl5on5
```

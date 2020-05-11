Chirripo Launcher
=================

Launcher for [Chirripo](https://github.com/chirripo/chirripo) project.

# Instructions
- Download latest stable release via CLI (code below) or browse to https://github.com/chirripo/chirripo-launcher/releases/latest.

OSX:
```
curl -OL https://github.com/chirripo/chirripo-launcher/releases/latest/download/chirripo.phar
```

Linux:
```
wget -O chirripo.phar https://github.com/chirripo/chirripo-launcher/releases/latest/download/chirripo.phar
```

- Make downloaded file executable: chmod +x chirripo.phar
- Move chirripo.phar to a location listed in your $PATH, rename to chirripo:
```
sudo mv chirripo.phar /usr/local/bin/chirripo
```
- Use Chirripo by simply invoking `chirripo` command from any project using chirripo
- If you have [proxy](https://github.com/chirripo/chirripo-proxy) installed; you can also manage it with `proxy-up` and `proxy-down` commands

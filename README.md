# ctf-fbctf-patches
Patches should be applied to fbctf 

make a new lxc and attach to it.
  apt-get update
  apt-get install git

first install fbctf:
  cd /root
  git clone https://github.com/facebook/fbctf
  cd fbctf
  ./extra/provision.sh -m prod -s $PWD
	if you are using proxy, remove all network related sudo commands from extra/provision.sh and extra/lib.sh
        if you want to change admin password: source ./extra/lib.sh set_password [new_password] ctf ctf fbctf $PWD

lets patching:
  edit /etc/hhvm/server.ini and comment line:  "; hhvm.repo.authoritative = true"
  service hhvm restart
  service memcached stop
  cd /root
  git clone https://github.com/mabdi/ctf-fbctf-patches.git
  cd ctf-fbctf-patches
  cp lang_fa.php /var/www/fbctf/src/languages/lang_fa.php
  cp -r fa /var/www/fbctf/src/static/css/locals/
  cp RedirectController.php /var/www/fbctf/src/controller/

  edit /etc/hhvm/server.ini and uncomment line:  "; hhvm.repo.authoritative = true"
  service hhvm restart
  service memcached start



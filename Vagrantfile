Vagrant.configure(2) do |config|

  config.vm.box = "ubuntu/xenial64"

  config.vm.network "forwarded_port", guest:80, host:8080, auto_correct: true

  #config.vm.synced_folder ".", "/var/www/html" 
  
  config.vm.define "Percevic"
  
  config.vm.hostname = "Percevic"

  config.vm.provision :file, source: "dir.conf", destination: "/tmp/dir.conf"
  
  config.vm.provision :file, source: "index.php", destination: "/tmp/index.php"
  
  config.vm.provision :file, source: "sendmail.php", destination: "/tmp/sendmail.php"

config.vm.provider "virtualbox" do |vb|

  vb.name = "Percevic"
  
  vb.memory = "1024"  

end

config.vm.provision "shell", inline: <<-SHELL

  
  sudo su
   
  #User erstellen

  useradd EinBenutzer
  echo "EinBenutzer:password" | chpasswd

  #User in die Sudo Gruppe einfügen

  sudo usermod -G sudo EinBenutzer

  sudo apt-get update 

  #Apache 2 installieren
  sudo apt-get -y install apache2
  
  sudo apt-get -y install php libapache2-mod-php php-mcrypt php-mysql
  
  sudo systemctl restart apache2
  
  cd /etc/apache2/mods-enabled/
  
  sudo cp /tmp/dir.conf .
  
  chmod 777 dir.conf
  
  cd /var/www/html
  
  apt install composer -y
  
  composer require phpmailer/phpmailer 

  sudo cp /tmp/index.php .
  
  chmod 777 index.php
  
  sudo cp /tmp/sendmail.php .
  
  chmod 777 sendmail.php
  
  sudo systemctl restart apache2
  
  #Firewall installieren und die Ports 22(SSH) und 80(Webserver) auf Allow setzen
  sudo ufw --force enable
  sudo ufw default deny incoming
  sudo ufw allow 22/tcp
  sudo ufw allow 80/tcp


SHELL

end
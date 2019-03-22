<h1>Modul 300 Dokumentation LB1</h1>

<h2>Nemanja Percevic</h2>

## Inhaltsverzeichnis
* [Einleitung](#Einleitung)<br>
* [Vergleich Vorwissen mit Wissenszuwachs & aktueller Wissenstand](#Vergleich-Vorwissen-mit-Wissenszuwachs-&-aktueller-Wissenstand)<br>
* [Sicherheitsmassnahmen](#Sicherheitsmassnahmen)<br>
* [Testfälle](#Testfälle)<br>
* [Reflexion](#Reflexion)<br>
* [Resultat](#Resultat)<br>

**<h2>Einleitung</h2>**
Ich hatte die Idee, einen Webserver zu installieren, auf dem ich eine Mail senden kann. Aus dieser Idee entstand dann ein Mail-Feedback-Formular, welches man ausfüllen kann und dann wird eine Mail verschickt. Das Ganze wurde mit Appache2 und PhpMailer realisiert.

**Vagrantfile**<br>
```
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
```
**index.php**<br>
Index.php Datei wird benötigt, um die HTML-Seite nach meinen Bedürfnissen zu erstellen. In dieser Datei habe ich das Formular erstellt, welches auf der Website angezeigt wird.

**dir.conf**<br>
Diese Datei wird benötigt, um die Datei index.php vor der Datei index.html zu laden. Die Datei index.php enthält den Inhalt unserer Website.

**sendmail.php**<br>
Sendmail.php enthält den Code, der benötigt wird, um die E-Mail korrekt zu versenden.

**<h2>Vergleich Vorwissen mit Wissenszuwachs & aktueller Wissenstand</h2>**
Zu Beginn des Moduls wusste ich nichts über Git, Vagrant, MarkDown. Ich fand den Anfang sehr kompliziert. Es hat lange gedauert, bis ich verstanden habe, wie Vagrant wirklich funktioniert, und so weiter. Ich fand die automatisierte VM-Installation sehr spannend, vor allem, wenn ich darüber nachdachte, wo man sie überall einsetzen könnte und wie viel Zeit man sparen könnte.

Am Anfang hatte ich Probleme mit vm.synced_folders, die Dateien in der VM zu überschreiben. So wurde beispielsweise die für die Website verwendete Datei index.php immer als Text in die vorhandene Datei kopiert und nicht als Code für die VM. Also musste ich eine neue Lösung finden. Ich kam dann zu "config.vm.provision :file, source: " sendmail.php", Ziel: "/tmp/sendmail.php""" und konnte eine grosse Herausforderung von mir klären.

**Linux/Ubuntu**

Ubuntu ist ein Open-Source-Software-Betriebssystem. Ubuntu ist eine Linux-Distribution, die auf Debian basiert. Ich habe Ubuntu Xenial 64 für die LB1 verwendet.

**VirtualBox**
VirtualBox ist ein kostenloser und Open-Source Hypervisor. Es unterstützt die Erstellung und Verwaltung von virtuellen Gastmaschinen. Meine virtuelle Maschine Ubuntu Xenial 64 kann über VirtualBox gestartet und verwendet werden.

**Virtualisierung**

Virtualisierung bezieht sich auf due Erstellung einer virtuellen Version von etwas, einschliesslich virtueller Computerhardwareplattformen, Speichervorrichtungen und Computernetzwerk-Ressourcen.

**Vagrant**

Vagrant ist ein Tool zum automatischen Erstellen und Verwalten von Virtuellen Maschinen. Dies kann sehr vorteilhaft sein, da man die VM nur einmal installieren und konfigurieren muss, und dann kann man sie auf verschiedene Systeme verteilen und dort automatisch mit dem Vagrantfile erstellen.

**Git**

Git ist ein spezifisches Open-Source-Versionskontrollsystem. Git ist ein verteiltes Versionskontrollsystem, was bedeutet, dass die gesamte Codebasis und Historie auf jedem Entwicklercomputer verfügbar ist.


**Mark Down**

Markdown ist eine Markup-Sprache mit einfacher Textformatierungssyntax. Es ist sehr einfach zu bedienen und macht Spass. Als Mark-Down-Editor habe ich Visual Studio-Code verwendet.

**Systemsicherheit**<br>
Es geht um Zugangskontrollen, die verhindern, dass unbefugte Personen in ein System eindringen oder darauf zugreifen können. Ebenfalls handelt es sich um den Schutz von Informationen.

<h2>Lernschritte</h2>
Ich konnte viel über all diese Themen lernen. Im Moment betrachten wir Virtualisierung mit VirtualBox und Linux im ÜK, aber ich hatte keine Erfahrung mit Mark-Down, Git und Vagrant. Ich konnte viele neue Dinge lernen. Ich habe auch neue Dinge über VirtualBox und Linux gelernt. Das wären z.B. neue Befehle, das Einrichten von Firewalls, etc. Ich habe auch zum ersten Mal mit Phpmailer gearbeitet. Ich hatte anfangs Schwierigkeiten, aber durch die erfolgreiche Zusammenarbeit mit Amauri Valdez konnte ich es erfolgreich implementieren.


**Netzwerkplan**<br>
![Image](./photo4.png)

**<h2>Sicherheitsmassnahmen</h2>**
**TLS**<br>
Die E-Mail wird mit dem TLS-Übertragungsprotokoll verschlüsselt übertragen. Dies ist sehr wichtig, damit die E-Mail während der Übertragung nicht bei einem Dritten landet. Die Datei sendmail.php enthält **"$mail->SMTPSecure = 'tls';"**. Diese Zeile stellt sicher, dass die E-Mails mit TLS verschlüsselt werden.

**Benutzer mit Administratorrechten**<br>
Ich habe auch einen Benutzer "EinBenutzer" erstellt, den ich auch der Sudo-Gruppe hinzugefügt habe, um volle Sudo-Rechte zu erhalten..<br>
```
  useradd EinBenutzer
  echo "EinBenutzer:password" | chpasswd
  sudo usermod -G sudo EinBenutzer
````
**Firewall**<br>
Ich habe auch die Firewall eingeschaltet und die Ports 22 (SSH) und 80 (Webserver) auf Allow und Standard auf Deny gesetzt..<br>
```
  sudo ufw --force enable
  sudo ufw default deny incoming
  sudo ufw allow 22/tcp
  sudo ufw allow 80/tcp
```
**<h2>Testfälle</h2>**
| Testfall | Tester | Datum | Resultat |
| :--:|:--:| :--:|:--:|
| Beim Klicken auf der Button soll eine neue Webseite erscheinen | Nemanja Percevic | 21.03.2019 | Neue Webseite wurde erfolgreich geladen |
 Das Feedback-Mail soll beim Button-Anklicken gesendet werden | Nemanja Percevic | 21.03.2019 | Das Feedback-Mail wurde erfolgreich gesendet |
  Das Mail sollte nicht gesendet werden, wenn keine E-Mail-Adresse angegeben wurde | Nemanja Percevic | 21.03.2019 | Es wird nach der E-Mail Adresse gefragt |
  ufw status eingeben, um den Firewall-Status zu überprüfen | Nemanja Percevic | 21.03.2019 | Status: active |
  Anmeldung mit dem User EinBenutzer | Nemanja Percevic | 21.03.2019 | Erfolgreiche Anmeldung mit dem User EinBenutzer |
  Sudo shutdown mit dem User EinBenutzer testen | Nemanja Percevic | 21.03.2019 | Shutdown scheduled for Fri 2019-03-22 12:53:59 UTC, use 'shutdown -c' to cancel. |

**<h2>Reflexion</h2>**
Durch die LB1 konnte ich viel Neues lernen, aber ich musste auch viel Zeit investieren, denn mit der LB1 war fast alles neu. Wie immer konnte ich sehr gut mit Amauri Valdez zusammenarbeiten, da wir bei solchen Aufgaben meist zusammenarbeiten und uns gut verstehen. Meiner Meinung nach konnten wir beide viel lernen und uns gegenseitig sehr helfen.

**<h2>Resultat</h2>**

**Die Webseite:**<br>
![Image](./photo1.png)


**Die zweite Webseite:**<br>
![Image](./photo2.png)

**E-Mail:**<br>
![Image](./photo3.png)